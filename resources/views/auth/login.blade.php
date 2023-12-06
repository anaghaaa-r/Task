@extends ('layouts.auth')
@section('content')
    <div class="vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-5 p-4 border shadow-sm rounded-3">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <h2>LOGIN</h2>

                    <div class="form-outline mb-4 mt-4">
                        <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" />
                        <label class="form-label" for="email">Email address</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control" />
                        <label class="form-label" for="password">Password</label>
                    </div>


                    @error('error')
                        <span style="color: brown; font-size: 12px;"><b>{{ $message }}</b></span>
                    @enderror
                    <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign In</button>


                    <div class="text-center">
                        <p>Not a member? <a href="{{ url('/register') }}">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
