@php
    use App\Models\Category;
    $categories = Category::latest()->get();
@endphp

@extends ('layouts.app')
@section('content')
    <div class="d-flex justify-content-center">
        <div class="card mt-2 mb-4" style="width:700px;border-radius:18px;overflow:hidden">
            <div class="card-header">
                <h3>Task</h3>
            </div>
            <div class="card-body">
                <h5>Add new task</h5>
                <form action="{{ route('task.create') }}" method="POST">
                    @csrf

                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title') }}" />
                        @error('title')
                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label" for="category">Category</label>
                        <select class="form-select" name="category" id="category">
                            <option disabled selected>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                        @enderror
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label" for="due_date">Due Date</label>
                        <input type="date" id="due_date" name="due_date" class="form-control"
                            value="{{ old('due_date') }}" />
                        @error('due_date')
                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Task</button>
                </form>
            </div>
        </div>
    </div>
@endsection
