@extends ('layouts.app')
@section('content')


<div class="d-flex justify-content-center">
    <div class="card mt-5" style="width:500px;border-radius:18px;overflow:hidden;">
        <div class="card-header">
            <h3>Category</h3>
        </div>
        <div class="card-body">
            <h5>Add new category</h5>
            <form action="{{ route('category.save') }}" method="POST">
                @csrf
                <input type="hidden" class="form-control" value="{{ $category->id }}" name="category_id">
                <div class="form-outline mb-4 mt-4">
                    <input type="text" id="category" name="category" class="form-control"
                        value="{{ old('category', $category) }}" />
                    @error('category')
                        <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                    @enderror
                </div>
        
                <button type="submit" class="btn btn-primary form-control">Save Category</button>
            </form>
        </div>
    </div>
</div>

   
@endsection
