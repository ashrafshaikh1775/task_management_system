<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="../css/login.css" rel="stylesheet">

</head>
<body class="dashboard_body">
    <div class="container nav-bar">
        <span>Hello! {{ $data->name }}</span>
        <a href='/logout' class="btn btn-danger logout-btn">Logout</a>
    </div>
            <form action="deleteTask" method='post' class="container dashboard_form col-sm-12 p-3 mt-5"  onchange="this.submit()">
                @csrf
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible"> {{$error}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @break
                @endforeach
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger alert-dismissible"> {{Session::get('fail')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                <input type="submit" class="btn btn-primary mb-2 addnewtaskbtn" value="Add New Task"  id="addnewtask_btn"></input>
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Status <select name="orderbyselect">
                            <option value="all" @if (Session::get('orderbystatus') == 'all') selected  @endif>All</option>
                            <option value="pending" @if (Session::get('orderbystatus') == 'pending') selected  @endif>Pending</option>
                            <option value="completed" @if (Session::get('orderbystatus') == 'completed') selected  @endif>Completed</option>
                            </select>
                         </td>
                        <td>Due Date <select name="orderbydate">
                            <option value="asc"  @if (Session::get('orderbydate') == 'asc') selected  @endif>Asc</option>
                            <option value="desc"  @if (Session::get('orderbydate') == 'desc') selected  @endif>Desc</option>
                            </select>
                        </td>
                        <td>Action</td>
                        </tr>
                    </thead>
                        <tbody>
                       @foreach ($listOfTask as $task)
                        <tr>
                            <td>{{ $task->title}}</td>
                            <td>{{ $task->description}}</td>
                            <td>{{ $task->status}}</td>
                            <td>{{ $task->due_date}}</td>
                            <td><input type="submit" name={{ $task->id }} class="btn btn-danger me-1" value="Delete"></input><span class="btn btn-primary me-1 editTaskbtn" id="editTaskbtn{{ $task->id }}">Edit</span></td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
            </form>

                <div class="task_list_outer">
                        <form  action="addNewTask" method='post' class="container col-sm-12 task_list">
                            @csrf
                        <input type="text" class="form-control mt-3" placeholder="Title" name="title" value="{{old('title')}}" required></input>
                        <textarea  type="text" class="form-control mt-3" placeholder="Description" rows="10" name="description" value="{{old('description')}}" required></textarea >
                        <select id="status" name="status" class="form-control mt-3">
                                <option value="select" default hidden>Select Status</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                        </select>
                        <input type="date" class="form-control mt-3" name="date" value="{{old('date')}}" required></input>
                        <input type="submit" class="btn btn-primary col-4 offset-4 mt-5 mb-5"></input>
                     </form>
                </div>
                <div class="edit_task">
                    <form  action="editTask" method='post' class="container col-sm-12 task_list">
                        @csrf
                    <input type="text" class="form-control mt-3" placeholder="Title" name="title" id="title" required></input>
                    <textarea  type="text" class="form-control mt-3" placeholder="Description" rows="10" name="description" id="description" required></textarea>
                    <select id="status" name="status" id="status" class="form-control mt-3">
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                    </select>
                    <input type="date" class="form-control mt-3" name="date"  id="date" required></input>
                    <input type="submit" id="edit" class="btn btn-primary col-4 offset-4 mt-5 mb-5" value="Edit"></input>
                 </form>
            </div>

</body>
<script>
     var listOfTask = <?php echo $listOfTask ?>; 
    document.querySelector('#addnewtask_btn').addEventListener('click',(e)=>{
        e.preventDefault();
        document.querySelector('.task_list_outer').style.display="block";
    });
    document.querySelector('.task_list_outer').addEventListener('click',(e)=>{
        document.querySelector('.task_list_outer').style.display="none";
    });
    document.querySelector('.task_list').addEventListener('click',(e)=>{
        e.stopPropagation();
    });

  

    document.querySelector('.edit_task').addEventListener('click',(e)=>{
        document.querySelector('.edit_task').style.display="none";
    });
    
 
    listOfTask.forEach(element => {
    document.querySelector('#editTaskbtn'+element.id).addEventListener('click',(e)=>{
        if(e.target.id === 'editTaskbtn'+element.id){
         document.querySelector('.edit_task #edit').setAttribute('name', element.id);
         document.querySelector('.edit_task #title').value = element.title;
         document.querySelector('.edit_task #description').value = element.description;
         document.querySelector('.edit_task #status').value = element.status;
         document.querySelector('.edit_task #date').value = element.due_date;
         document.querySelector('.edit_task').style.display="block";
        }
      
    });
});
    document.querySelector('.edit_task .task_list').addEventListener('click',(e)=>{
        e.stopPropagation();
    });
</script>

</html>