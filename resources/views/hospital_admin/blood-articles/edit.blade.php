<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Blood Article</title>
	<style>
		body { font-family: Arial, sans-serif; margin: 24px; }
		label { display: block; margin-top: 12px; }
		input, textarea { width: 100%; max-width: 520px; padding: 8px; }
		textarea { min-height: 140px; }
	</style>
</head>
<body>
	<h1>Edit Blood Article</h1>

	@if ($errors->any())
		<ul style="color: #b91c1c;">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

	<form method="POST" action="{{ route('hospital_admin.blood-articles.update', $bloodArticle) }}">
		@csrf
		@method('PUT')

		<label for="title">Title</label>
		<input id="title" name="title" type="text" value="{{ old('title', $bloodArticle->title) }}" required>

		<label for="date">Date</label>
		<input id="date" name="date" type="date" value="{{ old('date', $bloodArticle->date) }}" required>

		<label for="hospital_name">Hospital Name</label>
		<input id="hospital_name" name="hospital_name" type="text" value="{{ old('hospital_name', $bloodArticle->hospital_name) }}" required>

		<label for="blood_type">Blood Type</label>
		<input id="blood_type" name="blood_type" type="text" value="{{ old('blood_type', $bloodArticle->blood_type) }}" required>

		<label for="description">Description</label>
		<textarea id="description" name="description" required>{{ old('description', $bloodArticle->description) }}</textarea>

		<div style="margin-top: 12px;">
			<button type="submit">Update</button>
			<a href="{{ route('hospital_admin.blood-articles.index') }}">Cancel</a>
		</div>
	</form>
</body>
</html>
