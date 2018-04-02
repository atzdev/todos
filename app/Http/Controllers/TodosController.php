<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Session;

class TodosController extends Controller
{
    public function index () {
    	$todos = Todo::orderBy('created_at', 'desc')->paginate(20);
    	return view('todo')->with('todos',$todos);
    }

    public function store (Request $request) 
    {
    	$this->validate($request, [
    		'todo' => 'required'
    	]);

    	$todo = Todo::create([
    		'todo' => $request->todo,
    		'complete' => 0
    	]);
    	


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


    
}
