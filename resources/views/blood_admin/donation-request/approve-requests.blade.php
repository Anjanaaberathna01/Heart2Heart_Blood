@extends('layouts.app')

@section('content')
<style>
    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 0 20px;
    }

    .back-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #e10600;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: #b80500;
        transform: translateX(-5px);
    }

    .page-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .page-header h1 {
        font-size: 28px;
        margin: 0;
    }

    .success {
        background: #d4edda;
        color: #155724;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid #28a745;
    }

    .error {
        background: #f8d7da;
        color: #721c24;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid #f5c6cb;
    }

    .table-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f8f9fa;
    }

    th {
        padding: 18px;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #e9ecef;
    }

    td {
        padding: 15px 18px;
        border-bottom: 1px solid #e9ecef;
    }

    tbody tr:hover {
        background: #f8f9fa;
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .empty-state-icon {
        font-size: 60px;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: #666;
        font-size: 20px;
        margin: 0;
    }

    .badge {
        display: inline-block;
        background: #d4edda;
        color: #155724;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
</style>

<div class="container">
    <a href="{{ route('admin.dashboard') }}" class="back-btn">← Back to Dashboard</a>

    <div class="page-header">
        <h1>✅ Approved Donation Requests</h1>
    </div>

    @if(session('success'))
        <div class="success">✓ {{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">✗ {{ $errors->first() }}</div>
    @endif

    @if($donationRequests->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">✅</div>
            <h3>No Approved Requests</h3>
        </div>
    @else
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Approval Date</th>
                        <th>User Name</th>
                        <th>Hospital</th>
                        <th>Blood Type</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donationRequests as $request)
                        <tr>
                            <td>{{ $request->approved_at ? $request->approved_at->format('M d, Y') : '—' }}</td>
                            <td><strong>{{ $request->user->name ?? 'N/A' }}</strong></td>
                            <td>{{ $request->hospital->user_name ?? 'N/A' }}</td>
                            <td><strong style="color: #e10600;">{{ $request->blood_type }}</strong></td>
                            <td>{{ $request->reason ?? '—' }}</td>
                            <td><span class="badge">Approved</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
