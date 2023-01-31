<!doctype html>

<title>The Bank</title>

<body>
    <div>
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
</body>