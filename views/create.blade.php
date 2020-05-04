@extends ('layout')
@section('content')
    <div class="container">
        <h1>Create task</h1>
        @if($_GET['message'] == 'success')
            <div class="alert alert-success" role="alert">
                Task created successfully!
            </div>
        @endif
        @if(isset($errors))
            @foreach($errors as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}!
                </div>
            @endforeach
        @endif
        <form action="/main/store" method="post">
            <div class="form-group">
                <label for="name">User name</label>
                <input  type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input  type="email" name="email" class="form-control" id="email"  placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Text</label>
                <input  type="text" name="text" class="form-control" id="text" placeholder="Text">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection