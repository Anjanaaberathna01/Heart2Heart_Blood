<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard - Hospitals</title>
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
		}

		.btn:hover {
			background-color: #b80500;
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

		.badge {
			display: inline-block;
			padding: 4px 8px;
			border-radius: 4px;
			background: #e8f4f8;
			color: #0066cc;
			font-size: 12px;
			font-weight: 600;
		}

		.empty {
			padding: 20px;
			background: #fff3f3;
			color: #b80500;
			border: 1px solid #f3c1c1;
			border-radius: 6px;
		}

		@media (max-width: 768px) {
			.container {
				padding: 20px;
			}

			h1 {
				font-size: 22px;
			}
		}
	</style>
</head>
<body>
<div class="container">
	<h1>Hospital Admin Dashboard</h1>

	<div class="toolbar">
		<div>
			<span class="badge">Total Hospitals: {{ $hospitals->count() }}</span>
		</div>
		<a href="{{ route('admin.add.hospital') }}" class="btn">Add Hospital</a>
	</div>

	@if(session('success'))
		<div style="margin-bottom: 15px; color: #155724; background: #d4edda; border: 1px solid #c3e6cb; padding: 10px; border-radius: 6px;">
			{{ session('success') }}
		</div>
	@endif

	@if($hospitals->isEmpty())
		<div class="empty">No hospitals added yet.</div>
	@else
		<div class="table-wrap">
			<table>
				<thead>
					<tr>
						<th>Hospital ID</th>
						<th>Reg Number</th>
						<th>Username</th>
						<th>Email</th>
						<th>Mobile 1</th>
						<th>District</th>
						<th>Availability</th>
						<th>Created</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($hospitals as $hospital)
						<tr>
							<td>{{ $hospital->hospital_id }}</td>
							<td>{{ $hospital->hospital_reg_number }}</td>
							<td>{{ $hospital->user_name }}</td>
							<td>{{ $hospital->email }}</td>
							<td>{{ $hospital->mobile_number1 }}</td>
							<td>{{ $hospital->district }}</td>
							<td>
								@if($hospital->available_for_donation)
									<span class="badge" style="background-color: #d4edda; color: #155724;">Available</span>
								@else
									<span class="badge" style="background-color: #f8d7da; color: #721c24;">Unavailable</span>
								@endif
							</td>
							<td>{{ $hospital->created_at?->format('Y-m-d') }}</td>
							<td>
								<a href="{{ route('admin.hospitals.edit', $hospital) }}" style="background-color: #007bff; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px; margin-right: 5px;">Edit</a>
								<form action="{{ route('admin.hospitals.toggle-availability', $hospital) }}" method="POST" style="display:inline;">
									@csrf
									@method('PUT')
									<button type="submit" style="background-color: {{ $hospital->available_for_donation ? '#ffc107' : '#28a745' }}; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-size: 12px; cursor: pointer; margin-right: 5px;">
										{{ $hospital->available_for_donation ? 'Disable' : 'Enable' }}
									</button>
								</form>
								<form action="{{ route('admin.hospitals.destroy', $hospital) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this hospital?');">
									@csrf
									@method('DELETE')
									<button type="submit" style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endif
</div>
</body>
</html>

