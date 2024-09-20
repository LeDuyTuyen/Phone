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
                <th>RAM</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getAllRam as $key => $ram)
                <tr>
                    <td>{{ $ram->ram_id }}</td>
                    <td>{{ $ram->ram }}</td>
                    <td>
                        <button onclick="showEditForm({{ $ram->ram_id }})">Sửa</button>
                        <form id="editForm{{ $ram->ram_id }}" action="{{ route('updateRam', $ram->ram_id) }}"
                            method="POST" style="display: none;">
                            <input type="text" value="{{ $ram->ram }}" id="ram" name="ram"><br><br>
                            <input type="submit" value="Lưu">
                            @csrf
                            {{-- Để sử dụng phương thức PUT, thêm @method('PUT') --}}
                            @method('PUT')
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('deleteRam', $ram->ram_id) }}" method="POST">
                            @csrf
                            {{-- method trong form chỉ hỗ trợ phương thức POST  --}}
                            @method('DELETE')
                            <input type="submit" value="Xóa">
                        </form>
                    </td>
                </tr>
            @endforeach

            <script>
                function showEditForm(ram_id) {
                    var form = document.getElementById('editForm' + ram_id);
                    if (form.style.display === "none") {
                        form.style.display = "block";
                    } else {
                        form.style.display = "none";
                    }
                }
            </script>

        </tbody>

    </table>

</body>

</html>
