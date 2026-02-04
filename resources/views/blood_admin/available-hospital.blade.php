<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hospital Availability</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            max-width: 1100px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #e10600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box {
            background: #e8f4f8;
            border-left: 4px solid #0066cc;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #0066cc;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            background-color: #e10600;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #b80500;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        th {
            background-color: #fafafa;
            color: #333;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-available {
            background-color: #d4edda;
            color: #155724;
        }

        .status-unavailable {
            background-color: #f8d7da;
            color: #721c24;
        }

        .toggle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 20px;
            margin: 0 5px;
        }

        .toggle-available {
            background-color: #28a745;
            color: white;
        }

        .toggle-available:hover {
            background-color: #218838;
            transform: scale(1.1);
        }

        .toggle-unavailable {
            background-color: #dc3545;
            color: white;
        }

        .toggle-unavailable:hover {
            background-color: #c82333;
            transform: scale(1.1);
        }

        .empty {
            padding: 20px;
            background: #fff3f3;
            color: #b80500;
            border: 1px solid #f3c1c1;
            border-radius: 6px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }

        .action-cell {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .hospital-name {
            font-weight: 600;
            color: #333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .modal-content h3 {
            color: #e10600;
            margin-bottom: 15px;
        }

        .modal-content p {
            margin-bottom: 15px;
            color: #666;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
        }

        .modal-buttons button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
        }

        .confirm-btn {
            background-color: #28a745;
            color: white;
        }

        .cancel-btn {
            background-color: #6c757d;
            color: white;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .toggle-btn {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .action-cell {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>
        <i class="fas fa-hospital"></i>
        Manage Hospital Availability
    </h1>

    <div class="info-box">
        <i class="fas fa-info-circle"></i>
        <strong>Toggle Hospital Status:</strong> Click the button in the Status column to mark hospitals as available (green) or unavailable (red) for blood donation.
    </div>

    @if(session('success'))
        <div class="success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="toolbar">
        <div>
            <span style="padding: 6px 12px; background: #f0f0f0; border-radius: 4px; font-size: 14px;">
                <strong>Total Hospitals:</strong> {{ $hospitals->count() }}
            </span>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    @if($hospitals->isEmpty())
        <div class="empty">
            <i class="fas fa-inbox"></i>
            No hospitals added yet.
        </div>
    @else
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Hospital Name</th>
                        <th>Email</th>
                        <th>District</th>
                        <th>Phone</th>
                        <th>Current Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hospitals as $hospital)
                        <tr>
                            <td class="hospital-name">{{ $hospital->user_name }}</td>
                            <td>{{ $hospital->email }}</td>
                            <td>{{ $hospital->district }}</td>
                            <td>{{ $hospital->mobile_number1 }}</td>
                            <td>
                                @if($hospital->available_for_donation)
                                    <span class="status-badge status-available">
                                        <i class="fas fa-check-circle"></i> Available
                                    </span>
                                @else
                                    <span class="status-badge status-unavailable">
                                        <i class="fas fa-times-circle"></i> Unavailable
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-cell">
                                    <form action="{{ route('admin.hospitals.toggle-availability', $hospital) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PUT')
                                        @if($hospital->available_for_donation)
                                            <button type="submit" class="toggle-btn toggle-available" title="Click to mark as unavailable">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @else
                                            <button type="submit" class="toggle-btn toggle-unavailable" title="Click to mark as available">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
    // Optional: Add confirmation before toggling
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const status = this.querySelector('.toggle-btn');
            const isAvailable = status.classList.contains('toggle-available');
            const newStatus = isAvailable ? 'unavailable' : 'available';

            if (!confirm(`Mark this hospital as ${newStatus}?`)) {
                e.preventDefault();
            }
        });
    });
</script>
</body>
</html>
