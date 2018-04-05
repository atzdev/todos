<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Session;
use Auth;

class TodosController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index () {
        
    	$todos = Todo::where('complete', 0)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
    	return view('todo')->with('todos',$todos);
    }

public function test(){
    return 'test';
}
    public function store (Request $request) 
    {


    	$this->validate($request, [
    		'todo' => 'required'
    	]);

    	$todo = Todo::create([
    		'todo' => $request->todo,
    		'complete' => 0,
            'user_id' => Auth::user()->id
    	]);
    	

        //return response()->json($todo);
    	$result = [
    		'success' => 'Todo created successfully.',
    		'updated_at' => $todo->updated_at->diffForHumans(),
    		'todo' => $todo
    	];
    	

    	//Session::flash('success', 'Todo created successfully.');

    	return response()->json($result);
    }

    public function update (Request $request, $id)
    {
    	$todo = Todo::find($id);
        $title = str_limit($todo->todo, 50);
    	$str_noti = "";
    	if(!is_null($todo)) {
    		if($todo->complete) {
    			$todo->complete = 0;
    			$str_noti = "Incomplete todo: ".$title." successfully.";
    		} else {
    			$todo->complete = 1;
    			$str_noti = "Complete todo: ".$title." successfully.";
    		}
            $todo->user_id = Auth::user()->id;
    		$todo->save();
    	}

    	$result = [
    		'success' => $str_noti,
            'title' => $title,
    		'updated_at' => $todo->updated_at->diffForHumans(),
    		'todo' => $todo
    	];

    	return response()->json($result);


    }

    public function show($assign) 
    {
        switch ($assign) {
            case 'all':
                $todos = Todo::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
                break;
            case 'incomplete':
                $todos = Todo::where('complete', 0)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
                break;
            case 'complete':
                $todos = Todo::where('complete', 1)->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
                break;    
            default:
                $todos = Todo::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(20);
                break;
        }

        return view('todo')->with('todos',$todos);
    }


    
}
