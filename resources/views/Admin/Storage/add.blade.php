<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Storage</title>
</head>

<body>
    <form action="{{ Route('saveStorage') }}" method="POST">
        <label for="storage">Bộ nhớ:</label>
        <input type="text" id="storage" name="storage"><br><br>

        <input type="submit" value="Submit">
        @csrf
    </form>

</body>

</html>
