@extends ('layouts.auth')
@section('content')
    <div class="vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-5 p-4 border shadow-sm rounded-3">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <h2>REGISTER</h2>

                    <div class="form-outline mb-4 mt-4">
                        @error('name')
                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                        @enderror
                        <input type="name" id="name" name="name" class="form-control" value="{{ old('name') }}" />
                        <label class="form-label" for="name">Name</label>
                    </div>

                    <div class="form-outline mb-4 mt-4">
                        @error('email')
                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                        @enderror
                        <input type="text" id="email" name="email" class="form-control"
                            value="{{ old('email') }}" />
                        <label class="form-label" for="email">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                        @error('password')
                            <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                        @enderror
                        <input type="password" id="password" name="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                    </div>


                    <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign Up</button>


                    <div class="text-center">
                        <p>Already Registered? <a href="{{ url('/') }}">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
