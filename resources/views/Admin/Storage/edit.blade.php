<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Color</title>
</head>

<body>
    <form action="{{ Route('updateStorage'), $storage->storage_id }}" method="PUT">
        <label for="storage">Màu:</label>
        <input type="text" value="{{ $value->storage }}" id="storage" name="storage"><br><br>

        <input type="submit" value="Submit">
        @csrf
    </form>

</body>

</html>
