<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Màu</title>

    <link rel="stylesheet" href="css.bootstrap.min.css">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Màu</th>
                <th>Mã màu</th>
                <th>SubID</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getAllColor as $key => $color)
                <tr>
                    <td>{{ $color->sort }}</td>
                    <td>{{ $color->color_name }}</td>
                    <td>{{ $color->color_code }}</td>
                    <td>{{ $color->subID }}</td>
                    <td>
                        <form action="{{ route('deleteColor', $color->color_id) }}" method="POST">
                            @csrf
                            {{-- /*method trong form chỉ hỗ trợ phương thức POST */ --}}
                            @method('DELETE')
                            <input type="submit" value="Xóa">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>
