<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard - Heart2Heart Blood</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: "Poppins", Arial, sans-serif;
			background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
			min-height: 100vh;
		}

		/* Header */
		.header {
			background: linear-gradient(135deg, #e10600 0%, #b80500 100%);
			color: white;
			padding: 20px 40px;
			box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
		}

		.header-content {
			max-width: 1400px;
			margin: 0 auto;
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-wrap: wrap;
			gap: 15px;
		}

		.logo-section h1 {
			font-size: 24px;
			font-weight: 700;
			margin-bottom: 5px;
		}

		.logo-section p {
			font-size: 13px;
			opacity: 0.9;
		}

		.header-actions {
			display: flex;
			gap: 12px;
			align-items: center;
		}

		.header-btn {
			padding: 10px 20px;
			background: rgba(255, 255, 255, 0.2);
			color: white;
			text-decoration: none;
			border-radius: 8px;
			font-weight: 600;
			font-size: 14px;
			transition: all 0.3s ease;
			border: 2px solid rgba(255, 255, 255, 0.3);
		}

		.header-btn:hover {
			background: rgba(255, 255, 255, 0.3);
			transform: translateY(-2px);
		}

		.logout-btn {
			background: rgba(0, 0, 0, 0.2);
			border: 2px solid rgba(255, 255, 255, 0.4);
			cursor: pointer;
		}

		/* Main Container */
		.container {
			max-width: 1400px;
			margin: 30px auto;
			padding: 0 20px;
		}

		/* Stats Cards */
		.stats {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 20px;
			margin-bottom: 30px;
		}

		.stat-card {
			background: white;
			padding: 25px;
			border-radius: 15px;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
			position: relative;
			overflow: hidden;
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}

		.stat-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
		}

		.stat-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 4px;
		}

		.stat-card.pending::before { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
		.stat-card.approved::before { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
		.stat-card.rejected::before { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
		.stat-card.all-requests::before { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

		.stat-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 15px;
		}

		.stat-title {
			font-size: 14px;
			color: #666;
			font-weight: 500;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.stat-icon {
			width: 45px;
			height: 45px;
			border-radius: 12px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 22px;
		}

		.stat-card.pending .stat-icon { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
		.stat-card.approved .stat-icon { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
		.stat-card.rejected .stat-icon { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
		.stat-card.all-requests .stat-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }

		.stat-number {
			font-size: 36px;
			font-weight: 700;
			color: #333;
		}

		/* Content Card */
		.content-card {
			background: white;
			border-radius: 15px;
			padding: 30px;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
			margin-bottom: 25px;
		}

		.card-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 25px;
			flex-wrap: wrap;
			gap: 15px;
		}

		.card-title {
			font-size: 20px;
			font-weight: 700;
			color: #333;
		}

		.badge {
			display: inline-block;
			padding: 8px 16px;
			border-radius: 8px;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			font-size: 13px;
			font-weight: 600;
		}

		.btn-group {
			display: flex;
			gap: 12px;
			flex-wrap: wrap;
		}

		.btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			padding: 12px 24px;
			background: linear-gradient(135deg, #e10600 0%, #b80500 100%);
			color: white;
			text-decoration: none;
			border-radius: 10px;
			font-weight: 600;
			font-size: 14px;
			transition: all 0.3s ease;
			border: none;
			cursor: pointer;
			box-shadow: 0 4px 15px rgba(225, 6, 0, 0.3);
		}

		.btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(225, 6, 0, 0.4);
		}

		.btn-secondary {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
		}

		.btn-secondary:hover {
			box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
		}

		/* Table */
		.table-wrap {
			overflow-x: auto;
			margin-top: 20px;
		}

		table {
			width: 100%;
			border-collapse: separate;
			border-spacing: 0;
			min-width: 1000px;
		}

		th, td {
			text-align: left;
			padding: 16px;
			font-size: 14px;
		}

		th {
			background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
			color: #495057;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 12px;
			letter-spacing: 0.5px;
			border-bottom: 2px solid #dee2e6;
		}

		th:first-child {
			border-top-left-radius: 10px;
		}

		th:last-child {
			border-top-right-radius: 10px;
		}

		tbody tr {
			transition: all 0.3s ease;
			border-bottom: 1px solid #f0f0f0;
		}

		tbody tr:hover {
			background-color: #f8f9fa;
			transform: scale(1.01);
		}

		td {
			color: #495057;
		}

		.status-badge {
			padding: 6px 12px;
			border-radius: 6px;
			font-size: 12px;
			font-weight: 600;
			display: inline-block;
		}

		.status-available {
			background-color: #d4edda;
			color: #155724;
		}

		.status-unavailable {
			background-color: #f8d7da;
			color: #721c24;
		}

		.status-pending {
			background-color: #fff3cd;
			color: #856404;
		}

		.status-approved {
			background-color: #d4edda;
			color: #155724;
		}

		.status-rejected {
			background-color: #f8d7da;
			color: #721c24;
		}

		/* Action Buttons */
		.action-btn {
			padding: 8px 16px;
			border-radius: 6px;
			font-size: 12px;
			font-weight: 600;
			border: none;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-right: 6px;
			text-decoration: none;
			display: inline-block;
		}

		.action-btn:hover {
			transform: translateY(-2px);
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
		}

		.btn-edit {
			background-color: #007bff;
			color: white;
		}

		.btn-toggle {
			background-color: #28a745;
			color: white;
		}

		.btn-toggle.disable {
			background-color: #ffc107;
		}

		.btn-delete {
			background-color: #dc3545;
			color: white;
		}

		.btn-approve {
			background-color: #28a745;
			color: white;
		}

		.btn-reject {
			background-color: #dc3545;
			color: white;
		}

		/* Alert */
		.alert {
			padding: 16px 20px;
			border-radius: 10px;
			margin-bottom: 25px;
			font-weight: 500;
			display: flex;
			align-items: center;
			gap: 12px;
		}

		.alert-success {
			background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
			color: #155724;
			border-left: 4px solid #28a745;
		}

		.empty {
			padding: 40px;
			text-align: center;
			background: linear-gradient(135deg, #fff3f3 0%, #ffe8e8 100%);
			color: #b80500;
			border-radius: 10px;
			font-size: 16px;
		}

		/* Section Divider */
		.section-divider {
			margin: 40px 0 25px;
			padding-bottom: 12px;
			border-bottom: 3px solid #e10600;
		}

		.section-title {
			font-size: 22px;
			font-weight: 700;
			color: #333;
		}
        .stats a {
            text-decoration: none;
            color: inherit;
        }

        .stat-card {
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

		@media (max-width: 768px) {
			.header {
				padding: 15px 20px;
			}

			.logo-section h1 {
				font-size: 20px;
			}

			.container {
				padding: 0 15px;
			}

			.content-card {
				padding: 20px;
			}

			.stat-number {
				font-size: 28px;
			}

			.card-header {
				flex-direction: column;
				align-items: flex-start;
			}

			.btn-group {
				width: 100%;
			}

			.btn {
				flex: 1;
			}

			table {
				font-size: 12px;
			}

			th, td {
				padding: 10px;
			}
		}
	</style>
</head>
<body>
	<!-- Header -->
	<div class="header">
		<div class="header-content">
			<div class="logo-section">
				<h1>🩸 Heart2Heart Blood Bank</h1>
				<p>Administrator Dashboard</p>
			</div>
			<div class="header-actions">
				<a href="{{ route('admin.add.hospital') }}" class="header-btn">➕ Add Hospital</a>
				<a href="{{ route('admin.donate.request') }}" class="header-btn">📋 All Requests</a>
				<form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
					@csrf
					<button type="submit" class="header-btn logout-btn">🚪 Logout</button>
				</form>
			</div>
		</div>
	</div>

	<!-- Main Container -->
	<div class="container">
		<!-- Statistics Cards -->
		<div class="stats">
            <a href="{{ route('admin.donate.pending') }}" style="text-decoration: none;">
			<div class="stat-card pending">
				<div class="stat-header">
					<div class="stat-title">Pending Requests</div>
					<div class="stat-icon">⏳</div>
				</div>
				<div class="stat-number">{{ $requestStats['pending'] ?? 0 }}</div>
			</div>
            </a>

            <a href="{{ route('admin.donate.approved') }}" style="text-decoration: none;">
			<div class="stat-card approved">
				<div class="stat-header">
					<div class="stat-title">Approved Requests</div>
					<div class="stat-icon">✅</div>
				</div>
				<div class="stat-number">{{ $requestStats['approved'] ?? 0 }}</div>
			</div>
            </a>

            <a href="{{ route('admin.donate.rejected') }}" style="text-decoration: none;">
			<div class="stat-card rejected">
				<div class="stat-header">
					<div class="stat-title">Rejected Requests</div>
					<div class="stat-icon">❌</div>
				</div>
				<div class="stat-number">{{ $requestStats['rejected'] ?? 0 }}</div>
			</div>
            </a>

            <a href="{{ route('admin.donate.all') }}" style="text-decoration: none;">
			<div class="stat-card all-requests">
				<div class="stat-header">
					<div class="stat-title">All Requests</div>
					<div class="stat-icon">📋</div>
				</div>
				<div class="stat-number">{{ ($requestStats['pending'] ?? 0) + ($requestStats['approved'] ?? 0) + ($requestStats['rejected'] ?? 0) }}</div>
			</div>
            </a>
		</div>

		@if(session('success'))
			<div class="alert alert-success">
				✔️ {{ session('success') }}
			</div>
		@endif

		<!-- Hospitals Section -->
		<div class="content-card">
			<div class="card-header">
				<div>
					<h2 class="card-title">🏥 Hospitals Management</h2>
				</div>
				<div>
					<span class="badge">Total: {{ $hospitals->count() }}</span>
				</div>
			</div>

			@if($hospitals->isEmpty())
				<div class="empty">📋 No hospitals added yet. Click "Add Hospital" to get started!</div>
			@else
				<div class="table-wrap">
					<table>
						<thead>
							<tr>
								<th>Hospital ID</th>
								<th>Reg Number</th>
								<th>Name</th>
								<th>Email</th>
								<th>Contact</th>
								<th>District</th>
								<th>Status</th>
								<th>Created</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($hospitals as $hospital)
								<tr>
									<td><strong>{{ $hospital->hospital_id }}</strong></td>
									<td>{{ $hospital->hospital_reg_number }}</td>
									<td>{{ $hospital->user_name }}</td>
									<td>{{ $hospital->email }}</td>
									<td>{{ $hospital->mobile_number1 }}</td>
									<td>{{ $hospital->district }}</td>
									<td>
										@if($hospital->available_for_donation)
											<span class="status-badge status-available">● Available</span>
										@else
											<span class="status-badge status-unavailable">● Unavailable</span>
										@endif
									</td>
									<td>{{ $hospital->created_at?->format('M d, Y') }}</td>
									<td>
										<a href="{{ route('admin.hospitals.edit', $hospital) }}" class="action-btn btn-edit">Edit</a>
										<form action="{{ route('admin.hospitals.toggle-availability', $hospital) }}" method="POST" style="display:inline;">
											@csrf
											@method('PUT')
											<button type="submit" class="action-btn btn-toggle {{ $hospital->available_for_donation ? 'disable' : '' }}">
												{{ $hospital->available_for_donation ? 'Disable' : 'Enable' }}
											</button>
										</form>
										<form action="{{ route('admin.hospitals.destroy', $hospital) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this hospital?');">
											@csrf
											@method('DELETE')
											<button type="submit" class="action-btn btn-delete">Delete</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endif
		</div>

		<!-- Latest Donation Requests Section -->
		<div class="section-divider">
			<h2 class="section-title">🩸 Latest Donation Requests</h2>
		</div>

		<div class="content-card">
			@if(($latestRequests ?? collect())->isEmpty())
				<div class="empty">📋 No donation requests yet.</div>
			@else
				<div class="table-wrap">
					<table>
						<thead>
							<tr>
								<th>Date</th>
								<th>User</th>
								<th>Hospital</th>
								<th>Blood Type</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($latestRequests as $request)
								<tr>
									<td>{{ $request->created_at?->format('M d, Y') }}</td>
									<td><strong>{{ $request->user->name ?? 'N/A' }}</strong></td>
									<td>{{ $request->hospital->user_name ?? 'N/A' }}</td>
									<td><strong style="color: #e10600;">{{ $request->blood_type }}</strong></td>
									<td>
										@if($request->status === 'pending')
											<span class="status-badge status-pending">● Pending</span>
										@elseif($request->status === 'approved')
											<span class="status-badge status-approved">● Approved</span>
										@else
											<span class="status-badge status-rejected">● Rejected</span>
										@endif
									</td>
									<td>
										@if($request->status === 'pending')
											<form action="{{ route('admin.donate.approve', $request) }}" method="POST" style="display:inline;">
												@csrf
												<input type="hidden" name="admin_notes" value="Approved from dashboard">
												<button type="submit" class="action-btn btn-approve">✓ Approve</button>
											</form>
											<form action="{{ route('admin.donate.reject', $request) }}" method="POST" style="display:inline;">
												@csrf
												<input type="hidden" name="admin_notes" value="Rejected from dashboard">
												<button type="submit" class="action-btn btn-reject">✗ Reject</button>
											</form>
										@else
											<span style="color: #999; font-size: 12px;">—</span>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endif
		</div>
	</div>
</body>
</html>

