<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page For Test API</title>
</head>
<body>
    <div class="container">
        <form action="{{ route('test', ['id' => 1]) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <button type="submit">Test</button>
            </div>
        </form>
    </div>
</body>
</html>