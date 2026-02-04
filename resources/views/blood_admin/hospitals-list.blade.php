<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospitals List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #e10600;
            margin-bottom: 20px;
        }

        .btn-add {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e10600;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #b80500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #e10600;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .empty-message {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 18px;
        }

        .success {
            color: #28a745;
            padding: 10px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Hospitals List</h1>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.add.hospital') }}" class="btn-add">+ Add Hospital</a>

    @if ($hospitals->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Hospital ID</th>
                    <th>Reg Number</th>
                    <th>Mobile 1</th>
                    <th>Mobile 2</th>
                    <th>District</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hospitals as $hospital)
                    <tr>
                        <td>{{ $hospital->hospital_id }}</td>
                        <td>{{ $hospital->hospital_reg_number }}</td>
                        <td>{{ $hospital->mobile_number1 }}</td>
                        <td>{{ $hospital->mobile_number2 ?? 'N/A' }}</td>
                        <td>{{ $hospital->district }}</td>
                        <td>{{ $hospital->address }}</td>
                        <td>
                            <a href="{{ route('admin.hospitals.edit', $hospital->id) }}" class="btn">Edit</a>
                            <form action="{{ route('admin.hospitals.destroy', $hospital->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" onclick="return confirm('Delete this hospital?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-message">
            No hospitals found. <a href="{{ route('admin.add.hospital') }}" style="color: #e10600; text-decoration: underline;">Add one now</a>
        </div>
    @endif
</div>
</body>
</html>
