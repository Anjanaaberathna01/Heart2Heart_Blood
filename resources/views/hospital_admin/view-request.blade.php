<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hospital Donation Requests</title>
	<style>
		body { font-family: Arial, sans-serif; margin: 24px; }
		table { width: 100%; border-collapse: collapse; margin-top: 16px; }
		th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
		th { background: #f3f4f6; }
		.muted { color: #6b7280; }
	</style>
</head>
<body>
	<h1>Donation Requests</h1>

	@if (session('success'))
		<p style="color: #15803d;">{{ session('success') }}</p>
	@endif
	@if (session('error'))
		<p style="color: #b91c1c;">{{ session('error') }}</p>
	@endif

	@if ($donationRequests->isEmpty())
		<p class="muted">No donation requests for this hospital yet.</p>
	@else
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Donor Name</th>
					<th>Donor Email</th>
					<th>Blood Type</th>
					<th>Status</th>
					<th>Reason</th>
					<th>Requested At</th>
					<th>Reference</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($donationRequests as $index => $request)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>{{ optional($request->user)->name ?? 'N/A' }}</td>
						<td>{{ optional($request->user)->email ?? 'N/A' }}</td>
						<td>{{ $request->blood_type }}</td>
						<td>{{ ucfirst($request->status) }}</td>
						<td>{{ $request->reason ?? 'N/A' }}</td>
						<td>{{ optional($request->created_at)->format('Y-m-d H:i') ?? 'N/A' }}</td>
						<td>{{ $request->reference_number ?? 'N/A' }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</body>
</html>
