@extends ('layout')
@section('content')
    <div class="container">
        <h1>{{ $_SERVER["REQUEST_URI"] == '/main/edit/'.$task[0]['id'] || $_SERVER["REQUEST_URI"] == '/main/edit/'.$task[0]['id'].'?message=success' ? 'Edit' : 'Create' }} task</h1>
        @if($_GET['message'] == 'success')
            <div class="alert alert-success" role="alert">
                Task {{ $_SERVER["REQUEST_URI"] == '/main/edit/'.$task[0]['id'].'?message=success' ? 'edited' : 'created' }} successfully!
            </div>
        @endif
        @if(isset($errors))
            @foreach($errors as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}!
                </div>
            @endforeach
        @endif
        <form action="{{ $_SERVER["REQUEST_URI"] == '/main/edit/'.$task[0]['id'] || '/main/edit/'.$task[0]['id'].'?message=success' ? '/main/update/'.$task[0]['id'] : '/main/store' }}" method="post">
            <div class="form-group">
                <label for="name">User name</label>
                <input value="{{ $task[0]['username'] }}" required type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input value="{{ $task[0]['email'] }}" required type="email" name="email" class="form-control" id="email"  placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Text</label>
                <input value="{{ $task[0]['text'] }}" required type="text" name="text" class="form-control" id="text" placeholder="Text">
            </div>
            @if(isset($_SESSION["is_admin"]) && ($_SERVER["REQUEST_URI"] == '/main/edit/'.$task[0]['id'] || $_SERVER["REQUEST_URI"] == '/main/edit/'.$task[0]['id'].'?message=success'))
                <div class="form-group">
                    <input name="status" {{ $task[0]['status'] ? 'checked' : '' }} class="form-group-input" type="checkbox" value="1" id="checkbox">
                    <label class="form-group-label" for="checkbox">
                        Completed
                    </label>
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection