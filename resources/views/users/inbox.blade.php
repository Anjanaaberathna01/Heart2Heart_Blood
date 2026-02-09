@extends('layouts.user')

@section('title', 'Inbox - Heart2Heart LK')

@section('content')
<style>
	.inbox-container {
		max-width: 900px;
		margin: 30px auto;
		padding: 0 20px;
	}

	.inbox-header {
		background: linear-gradient(135deg, #dc3545 0%, #a71e2a 100%);
		color: white;
		padding: 24px;
		border-radius: 10px;
		margin-bottom: 20px;
	}

	.inbox-header h1 {
		margin: 0;
		font-size: 24px;
	}

	.inbox-card {
		background: white;
		border-radius: 10px;
		padding: 18px;
		margin-bottom: 15px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
		border-left: 4px solid #28a745;
	}

	.inbox-meta {
		display: flex;
		justify-content: space-between;
		gap: 10px;
		flex-wrap: wrap;
		font-size: 13px;
		color: #666;
		margin-top: 6px;
	}

	.ref-number {
		display: inline-block;
		background: #e9f7ef;
		color: #155724;
		padding: 4px 10px;
		border-radius: 14px;
		font-size: 12px;
		font-weight: 600;
		margin-top: 6px;
	}

	.empty-state {
		text-align: center;
		padding: 50px 20px;
		background: white;
		border-radius: 10px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
	}

	.empty-state h3 {
		color: #666;
		margin: 0 0 8px 0;
	}

	.empty-state p {
		color: #888;
		margin: 0;
	}
</style>

<div class="inbox-container">
	<div class="inbox-header">
		<h1><i class="fas fa-inbox"></i> Inbox</h1>
		<p>Approved requests and your reference numbers.</p>
	</div>

	@if($approvedRequests->isEmpty())
		<div class="empty-state">
			<h3>No approved requests yet</h3>
			<p>When an admin approves your request, the reference number will appear here.</p>
		</div>
	@else
		@foreach($approvedRequests as $request)
			<div class="inbox-card">
				<strong>Request Approved</strong>
				<div class="ref-number">Reference: {{ $request->reference_number ?? 'Pending' }}</div>
				<div class="inbox-meta">
					<span>Blood Type: {{ $request->blood_type }}</span>
                    <span>Hospital: {{ $request->hospital->user_name }}</span>
                    <span>Location: {{ $request->hospital->district }}</span>
					<span>Approved: {{ $request->approved_at ? $request->approved_at->format('M d, Y') : '—' }}</span>
				</div>
			</div>
		@endforeach
	@endif
</div>
@endsection
