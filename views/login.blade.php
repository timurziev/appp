@extends ('layout')
@section('content')
    <div class="container">
        <h1>Login</h1>
        @if(isset($errors))
            @foreach($errors as $error)
                @if(isset($error))
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endif
            @endforeach
        @endif
        <form action="/auth/login" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input  type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input  type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection