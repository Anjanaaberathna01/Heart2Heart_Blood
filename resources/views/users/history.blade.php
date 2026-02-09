@extends('layouts.user')

@section('title', 'Donation History - Heart2Heart LK')

@section('content')
<style>
    .history-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .history-header {
        background: linear-gradient(135deg, #dc3545 0%, #a71e2a 100%);
        color: white;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .history-header h1 {
        margin-bottom: 10px;
    }

    .filters {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .filters input,
    .filters select {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Poppins', Arial, sans-serif;
    }

    .filters button {
        padding: 10px 20px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .filters button:hover {
        background-color: #b80500;
    }

    .history-card {
        background: white;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 4px solid #dc3545;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .history-card h3 {
        color: #dc3545;
        margin-bottom: 10px;
    }

    .history-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin: 15px 0;
    }

    .meta-item {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 6px;
    }

    .meta-item strong {
        color: #333;
        display: block;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .meta-item span {
        color: #666;
        font-size: 14px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .empty-state i {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #666;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #999;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .filters {
            flex-direction: column;
        }

        .history-container {
            padding: 10px;
        }

        .history-meta {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="history-container">
    <!-- Header -->
    <div class="history-header">
        <h1><i class="fas fa-history"></i> Donation History</h1>
        <p>View your blood donation requests and records</p>
    </div>

    <!-- Filters -->
    <div class="filters">
        <input type="text" placeholder="Search by hospital name..." id="searchInput">
        <select id="statusFilter">
            <option value="">All Status</option>
            <option value="completed">Completed</option>
            <option value="pending">Pending</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <button onclick="applyFilters()">Search</button>
    </div>


    @if ($requests->isEmpty())
    <!-- Empty State -->
    <div class="empty-state">
        <i class="fas fa-inbox"></i>
        <h3>No History Yet</h3>
        <p>You don't have any blood donation requests yet. <a href="{{ route('donate.request') }}" style="color: #dc3545; text-decoration: none; font-weight: 600;">Create one now</a></p>
    </div>
    @else

    <!-- Sample History Cards (for demonstration) -->
    <div id="history-list">
        @foreach ($requests as $request)
        <div class="history-card">
            <div style="display: flex; justify-content: space-between; align-items: start;">
                <div>
                    <h3>Blood Type {{ $request->blood_type }}</h3>
                    <span class="status-badge status-{{ $request->status }}">{{ ucfirst($request->status) }}</span>
                </div>
                <span style="color: #999; font-size: 12px;">{{ $request->created_at->format('Y M, d') }}</span>
            </div>

            <div class="history-meta">
                <div class="meta-item">
                    <strong>Hospital</strong>
                    <span>{{ $request->hospital->user_name }}</span>
                </div>
                <div class="meta-item">
                    <strong>District</strong>
                    <span>{{ $request->hospital->district }}</span>
                </div>
                <div class="meta-item">
                    <strong>Blood Type</strong>
                    <span>{{ $request->blood_type }}</span>
                </div>
                <div class="meta-item">
                    <strong>Status</strong>
                    <span>{{ $request->status }}</span>
                </div>
                <div class="meta-item">
                    <strong>Completed On</strong>
                    <span>{{ $request->created_at->format('Y M, d') }}</span>
                </div>
            </div>

            @if ($request->reason)
            <p style="color: #666; font-size: 14px; margin-top: 10px;">
                <strong>Notes:</strong> {{ $request->reason }}
            </p>
            @endif

        </div>
        @endforeach
    </div>
</div>
@endif
<script>
    function applyFilters() {
        // Implement filtering logic here
        console.log('Filters applied');
    }
</script>
@endsection
