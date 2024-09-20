<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ram</title>
</head>

<body>
    <form action="{{ Route('saveRam') }}" method="POST">
        <label for="ram">RAM:</label>
        <input type="text" id="ram" name="ram"><br><br>

        <input type="submit" value="Submit">
        @csrf
    </form>

</body>

</html>
