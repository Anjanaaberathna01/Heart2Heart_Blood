<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blood Articles</title>
	<style>
		body { font-family: Arial, sans-serif; margin: 24px; }
		table { width: 100%; border-collapse: collapse; margin-top: 16px; }
		th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
		th { background: #f3f4f6; }
		.muted { color: #6b7280; }
		.actions form { display: inline; }
	</style>
</head>
<body>
	<h1>Blood Articles</h1>

	<p>
		<a href="{{ route('hospital_admin.blood-articles.create') }}">Create New Article</a>
	</p>

	@if (session('success'))
		<p style="color: #15803d;">{{ session('success') }}</p>
	@endif
	@if (session('error'))
		<p style="color: #b91c1c;">{{ session('error') }}</p>
	@endif

	@if ($articles->isEmpty())
		<p class="muted">No blood articles yet.</p>
	@else
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Date</th>
					<th>Hospital</th>
					<th>Blood Type</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($articles as $index => $article)
					<tr>
						<td>{{ $index + 1 }}</td>
						<td>{{ $article->title }}</td>
						<td>{{ $article->date }}</td>
						<td>{{ $article->hospital_name }}</td>
						<td>{{ $article->blood_type }}</td>
						<td class="actions">
							<a href="{{ route('hospital_admin.blood-articles.edit', $article) }}">Edit</a>
							<form method="POST" action="{{ route('hospital_admin.blood-articles.destroy', $article) }}">
								@csrf
								@method('DELETE')
								<button type="submit" onclick="return confirm('Delete this article?')">Delete</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</body>
</html>
