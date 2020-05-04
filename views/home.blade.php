@extends ('layout')
@section('content')
    <div class="container">
        <a href="/main/create" class="btn btn-primary btn-lg mb-3" role="button" aria-disabled="true">Create</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Text</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{ $task['id'] }}</th>
                    <td>{{ $task['username'] }}</td>
                    <td>{{ $task['email'] }}</td>
                    <td>{{ $task['text'] }}</td>
                    <td>{{ $task['status'] ? 'Выполнено' : 'Не выполнено' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($pages > 1)
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="/main/?page=1">First</a></li>
                    <?php for($p=1; $p<=$pages; $p++){?>
                    <li class="page-item <?= $page == $p ? 'active' : ''; ?>"><a class="page-link" href="/main/<?= '?page='.$p; ?>"><?= $p; ?></a></li>
                    <?php }?>
                    <li class="page-item"><a class="page-link" href="/main/?page=<?= $pages; ?>">Last</a></li>
                </ul>
            </nav>
        @endif
    </div>
@endsection