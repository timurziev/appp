@extends ('layout')
@section('content')
    <div class="container">
        <form action="auth/login" method="post">
            <div class="form-group">
                <label for="name">Email address</label>
                <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection