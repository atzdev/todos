@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-md-10 text-right">
                        <input type="text" class="form-control" id="todo" name="todo">
                    </div>
                    <div class="col-md-2 text-left">
                        <button type="btn" class="btn btn-primary btn-add">Add</button>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Todo</th>
                    <th class="text-right">Updated</th>
                    <th class="text-center">Complete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todos as $todo)
                <tr id="row{{ $todo->id }}">
                    <td><a href="#" data-toggle="popover" data-trigger="hover" data-content="{{ $todo->todo }}" style="text-decoration: none;">{{ str_limit($todo->todo, 50) }}</a></td>
                    <td class="text-right">{{ $todo->updated_at->diffForHumans() }}</td>
                    <td class="text-center">
                        @if($todo->complete == 1)
                            <a class="btn btn-success btn-xs" onclick="updateTodo({{ $todo->id }})"><i class="glyphicon glyphicon-ok"></i></a>
                        @else
                            <a class="btn btn-warning btn-xs" onclick="updateTodo({{ $todo->id }})"><i class="glyphicon glyphicon-remove"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $todos->links() }}
        @section('scripts')

            <script>
                $(document).ready(function(){
                    $('[data-toggle="popover"]').popover();   
                });

                $(".btn-add").click(function(){
                    if($("#todo").val() ==''){
                        $("#todo").addClass("alert alert-warning");
                        $("#todo").focus();
                        toastr.warning('Pleas input your todo list.');
                    } else {

                        
                        var todo = $("#todo").val();
                        //toastr.info(todo);
                        var token = $("input[name='_token']").val();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF_TOKEN': token
                            }
                        });

                        $.ajax({
                            type: 'post',
                            url: '/todo',
                            data: {
                                'todo': todo
                            },
                            success: function(data){
                                console.log(data)

                                var newRow = "<tr id='row"+data.todo.id+"'><td>"+data.todo.todo+"</td><td class='text-right'>"+data.updated_at+"</td><td class='text-center'><a class='btn btn-warning btn-xs' onclick='updateTodo("+data.todo.id+")'><i class='glyphicon glyphicon-remove'></i></a></td></tr>";

                                $('table > tbody > tr:first').before(newRow);

                                toastr.success(data.success);
                            }
                        });



                    } // end if($("#todo").val() ==''){
                }); // end btn-add click



                // start updateTodo()
                function updateTodo(id){
                    //toastr.info(id);
                    var token = $("input[name='_token']").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF_TOKEN': token
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/todo/'+id,
                        data: {
                            '_method': "PUT"
                        },
                        success: function(data){
                            //console.log(data);
                            if(data.todo.complete ==1) {
                                btn_class = 'btn-success';
                                glyphicon_class = 'glyphicon-ok';
                                toastr.success(data.success);

                            } else {
                                btn_class = 'btn-warning';
                                glyphicon_class = 'glyphicon-remove';
                                toastr.warning(data.success);
                            }
                            //console.log(btn_class);


                            $("#row"+id).replaceWith("<tr id='row"+id+"'><td><a href='#'  data-toggle='popover' data-trigger='hover' data-content='"+data.todo.todo+"' style='text-decoration: none;'>"+data.todo.todo+"</a></td><td class='text-right'>"+data.updated_at+"</td><td class='text-center'><a class='btn "+btn_class+" btn-xs' onclick='updateTodo("+id+")'><i class='glyphicon "+glyphicon_class+"'></i></a></td></tr>");

                            
                        }
                    });
                } // end updateTodo()


                /*@if(Session::get('success'))
                    toastr.success("{{ Session::get('success') }}");
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                    $('#todo').addClass('alert alert-danger');
                @endif*/
            </script>

        @stop
    </div>
</div>
@endsection