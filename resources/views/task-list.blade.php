@extends ('layouts.app')
@section('content')

<div class="d-flex w-100 align-items-center justify-content-center "></div>
    <a href="{{ url('/task/new') }}" class="btn btn-primary mt-4">Add Task</a>


    <div class="my-5">
        <div style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius:16px; overflow-y:auto ;height:60vh;">

            @if(filled($tasks))
            <table class="table w-100">
                <thead>
                    <tr >
                        <th style= "background-color: #d1d5db;">#</th>
                        <th style= "background-color: #d1d5db;">Title</th>
                        <th style= "background-color: #d1d5db;">Category</th>
                        <th style= "background-color: #d1d5db;">Description</th>
                        <th style= "background-color: #d1d5db;">Due Date</th>
                        <th style= "background-color: #d1d5db;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->category->category }}</td>
                            <td>{!! nl2br($task->description) !!}</td>
                            <td>{{ $task->due_date }}</td>
                            <td>
                                {{-- view details --}}
                                <a href="{{ route('task.detail', ['id' => $task->id]) }}" class="btn btn-primary">View</a>
    
                                {{-- edit task --}}
    
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#EditTaskModal{{ $task->id }}">
                                    Edit
                                </button>
    
                                <div class="modal fade" id="EditTaskModal{{ $task->id }}" tabindex="-1"
                                    aria-labelledby="EditTaskModal{{ $task->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="EditTaskModal{{ $task->id }}Label">Edit Task</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('task.edit', ['id' => $task->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
    
    
                                                    <div class="form-outline mb-4 mt-4">
                                                        <label class="form-label" for="title">Title</label>
                                                        <input type="text" id="title" name="title" class="form-control"
                                                            value="{{ old('title', $task->title) }}" />
                                                        @error('title')
                                                            <span style="color: brown; font-size: 12px;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
    
                                                    <div class="form-outline mb-4 mt-4">
                                                        <label class="form-label" for="category_id">Category</label>
                                                        <select class="form-select" name="category_id" id="category_id">
                                                            <option disabled selected>Select a category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->category }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                                                        @enderror
                                                    </div>
    
                                                    <div class="form-outline mb-4">
                                                        <label class="form-label" for="description">Description</label>
                                                        <textarea id="description" name="description" class="form-control" rows="5">{{ old('description', $task->description) }}</textarea>
                                                        @error('description')
                                                            <span style="color: brown; font-size: 12px;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
    
                                                    <div class="form-outline mb-4 mt-4">
                                                        <label class="form-label" for="due_date">Due Date</label>
                                                        <input type="date" id="due_date" name="due_date"
                                                            class="form-control"
                                                            value="{{ old('due_date', $task->due_date) }}" />
                                                        @error('due_date')
                                                            <span style="color: brown; font-size: 12px;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
    
    
    
                                {{-- delete task --}}
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#DeleteTaskModal{{ $task->id }}">
                                    Delete
                                </button>
    
                                <div class="modal fade" id="DeleteTaskModal{{ $task->id }}" tabindex="-1"
                                    aria-labelledby="DeleteTaskModal{{ $task->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="DeleteTaskModal{{ $task->id }}Label">Delete Task</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
    
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this task ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('task.delete', ['id' => $task->id]) }}" method="POST">
                                                    @method ('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete Task</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h2 class="text-center pt-3">No Task to view</h2>
            @endif
        </div>
       
    </div>
@endsection
