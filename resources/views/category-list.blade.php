@extends ('layouts.app')
@section('content')
    <a href="{{ url('/category/create') }}" class="btn btn-primary mt-4">Add Category</a>


    <div class="my-5">
        <div style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; border-radius:16px; overflow-y:auto ;height:60vh;">

            @if (filled($categories))
                <table class="table w-100">
                    <thead>
                        <tr>
                            <th style= "background-color: #d1d5db;">#</th>
                            <th style= "background-color: #d1d5db;">Category</th>
                            <th style= "background-color: #d1d5db;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->category }}</td>

                                <td>
                                    <a href="{{ route('category.edit', ['id' => $category->id]) }}"
                                        class="btn btn-primary">Edit</a>

                                    {{-- delete task --}}
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#DeleteCategoryModal">
                                        Delete
                                    </button>

                                    <div class="modal fade" id="DeleteCategoryModal" tabindex="-1"
                                        aria-labelledby="DeleteCategoryModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="DeleteCategoryModalLabel">Delete
                                                        Category</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this category ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="{{ route('category.delete', ['id' => $category->id]) }}"
                                                        method="POST">
                                                        @method ('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete
                                                            Category</button>
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
                <h2 class="text-center pt-3">No Category to view</h2>
            @endif
        </div>
    </div>
@endsection
