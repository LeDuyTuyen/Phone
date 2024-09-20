<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Color</title>
</head>

<body>
    <form action="{{ Route('updateColor'), $color->color_id }}" method="PUT">
        <label for="color_name">Màu:</label>
        <input type="text" value="{{ $value->color_name }}" id="color_name" name="color_name"><br><br>

        <label for="color_code">Mã màu:</label>
        <input type="text" value="{{ $value->color_code }}" id="color_code" name="color_code"><br><br>

        <input type="submit" value="Submit">
        @csrf
    </form>

</body>

</html>
