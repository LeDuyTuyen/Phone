<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Màu</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Màu</th>
                <th>Mã màu</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getAllStorage as $key => $storage)
                <tr>
                    <td>{{ $storage->storage_id }}</td>
                    <td>{{ $storage->storage_name }}</td>
                    <td>{{ $storage->storage_code }}</td>
                    <td>
                        <form action="{{ route('deleteStorage', $storage->storage_id) }}" method="POST">
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
