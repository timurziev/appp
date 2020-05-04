@extends ('layout')
@section('content')
    <div class="container">
        <a href="/main/create" class="btn btn-primary mb-3" role="button" aria-disabled="true">Create</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <a href="/main/?page={{ $_GET['page'] ?: 1 }}&column=username&order={{ $_GET['order'] == 'desc' ? 'asc' : 'desc' }}">Username</a>
                </th>
                <th scope="col">
                    <a href="/main/?page={{ $_GET['page'] ?: 1 }}&column=email&order={{ $_GET['order'] == 'desc' ? 'asc' : 'desc' }}">Email</a>
                </th>
                <th scope="col">Text</th>
                <th scope="col">
                    <a href="/main/?page={{ $_GET['page'] ?: 1 }}&column=status&order={{ $_GET['order'] == 'desc' ? 'asc' : 'desc' }}">Status</a>
                </th>
                @if(isset($_SESSION["is_admin"]))
                    <th scope="col"?>Manage</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{ $task['id'] }}</th>
                    <td>{{ $task['username'] }}</td>
                    <td>{{ $task['email'] }}</td>
                    <td>{{ $task['text'] }}</td>
                    <td>
                        {{ $task['status'] ? 'Выполнено' : 'Не выполнено' }}<br>
                        {{ $task['edited'] ? 'Отредактировано админом' : '' }}
                    </td>
                    @if(isset($_SESSION["is_admin"]))
                        <td>
                            <a href="/main/edit/{{ $task['id'] }}" class="btn btn-info">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($pages > 1)
            <nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="/main/?page=1&column={{ $_GET['column'] }}&order={{ $_GET['order'] }}">First</a></li>
                    @for($p = 1; $p <= $pages; $p++)
                        <li class="page-item <?= $_GET['page'] == $p ? 'active' : ''; ?>">
                            <a class="page-link" href="/main/<?= '?page='.$p; ?>&column={{ $_GET['column'] }}&order={{ $_GET['order'] }}"><?= $p; ?></a>
                        </li>
                    @endfor
                    <li class="page-item"><a class="page-link" href="/main/?page=<?= $pages; ?>&column={{ $_GET['column'] }}&order={{ $_GET['order'] }}">Last</a></li>
                </ul>
            </nav>
        @endif
    </div>
@endsection