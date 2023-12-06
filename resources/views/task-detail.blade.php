@extends ('layouts.app')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="card mt-5" style="width:500px;border-radius:18px;overflow:hidden;">
            <div class="card-header">
                <h3>Task</h3>
            </div>
            <div class="card-body">
                <div class="my-2">
                    <h5 class="d-inline">Title :</h5>
                    <span>{{ $task->title }}</span>
                </div>
                <div class="my-2">
                    <h5 class="d-inline">Description :</h5>
                    <span>{!! nl2br($task->description) !!}</span>
                </div>
                <div class="my-2">
                    <h5 class="d-inline">Category :</h5>
                    <span>{{ $task->category->category }}</span>
                </div>
                <div class="my-2">
                    <h5 class="d-inline">Due Date :</h5>
                    <span>{{ $task->due_date }}</span>
                </div>
            </div>
        </div>
    </div>
    
@endsection
