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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header h1 {
        font-size: 28px;
        margin: 0;
    }

    .filter-section {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 8px 16px;
        border: 2px solid rgba(255,255,255,0.5);
        background: transparent;
        color: white;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-btn.active {
        background: white;
        color: #667eea;
        border-color: white;
    }

    .filter-btn:hover {
        border-color: white;
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
        text-decoration: none;
        display: inline-block;
    }

    .btn-approve {
        background: #28a745;
        color: white;
        margin-right: 8px;
    }

    .btn-approve:hover {
        background: #218838;
        transform: translateY(-2px);
    }

    .btn-reject {
        background: #dc3545;
        color: white;
    }

    .btn-reject:hover {
        background: #c82333;
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
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending {
        background: #fff3cd;
        color: #856404;
    }

    .badge-approved {
        background: #d4edda;
        color: #155724;
    }

    .badge-rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .stat-item {
        background: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .stat-item-number {
        font-size: 24px;
        font-weight: 700;
        color: #667eea;
    }

    .stat-item-label {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
        font-weight: 500;
    }
</style>

<div class="container">
    <a href="{{ route('admin.dashboard') }}" class="back-btn">← Back to Dashboard</a>

    <div class="page-header">
        <h1>📋 All Donation Requests</h1>
    </div>

    @if(session('success'))
        <div class="success">✓ {{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">✗ {{ $errors->first() }}</div>
    @endif

    <!-- Stats Summary -->
    <div class="stats-summary">
        <div class="stat-item">
            <div class="stat-item-number">{{ $totalRequests }}</div>
            <div class="stat-item-label">Total Requests</div>
        </div>
        <div class="stat-item">
            <div class="stat-item-number" style="color: #f5576c;">{{ $pendingCount }}</div>
            <div class="stat-item-label">Pending</div>
        </div>
        <div class="stat-item">
            <div class="stat-item-number" style="color: #00f2fe;">{{ $approvedCount }}</div>
            <div class="stat-item-label">Approved</div>
        </div>
        <div class="stat-item">
            <div class="stat-item-number" style="color: #fee140;">{{ $rejectedCount }}</div>
            <div class="stat-item-label">Rejected</div>
        </div>
    </div>

    @if($donationRequests->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">📋</div>
            <h3>No Donation Requests</h3>
        </div>
    @else
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Hospital</th>
                        <th>Blood Type</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donationRequests as $request)
                        <tr>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td><strong>{{ $request->user->name ?? 'N/A' }}</strong></td>
                            <td>{{ $request->hospital->user_name ?? 'N/A' }}</td>
                            <td><strong style="color: #e10600;">{{ $request->blood_type }}</strong></td>
                            <td>{{ $request->reason ?? '—' }}</td>
                            <td>
                                @if($request->status === 'pending')
                                    <span class="badge badge-pending">⏳ Pending</span>
                                @elseif($request->status === 'approved')
                                    <span class="badge badge-approved">✅ Approved</span>
                                @else
                                    <span class="badge badge-rejected">❌ Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($request->status === 'pending')
                                    <button type="button" class="btn btn-approve" onclick="openApproveModal({{ $request->id }})">✓ Approve</button>
                                    <button type="button" class="btn btn-reject" onclick="openRejectModal({{ $request->id }})">✗ Reject</button>
                                @elseif($request->status === 'approved')
                                    <button type="button" class="btn btn-approve" onclick="openApproveModal({{ $request->id }})">✓ Keep Approved</button>
                                    <button type="button" class="btn btn-reject" onclick="openRejectModal({{ $request->id }})">✗ Change to Reject</button>
                                @else
                                    <button type="button" class="btn btn-approve" onclick="openApproveModal({{ $request->id }})">✓ Change to Approve</button>
                                    <button type="button" class="btn btn-reject" onclick="openRejectModal({{ $request->id }})">✗ Keep Rejected</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Approve Modal -->
<div id="approveModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Approve Request</h2>
            <span class="close" onclick="closeModal('approveModal')">&times;</span>
        </div>
        <form id="approveForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="approveNotes">Admin Notes (Optional):</label>
                <textarea id="approveNotes" name="admin_notes" rows="4" placeholder="Add any notes..."></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-approve">✓ Confirm Approve</button>
                <button type="button" class="btn btn-cancel" onclick="closeModal('approveModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Reject Request</h2>
            <span class="close" onclick="closeModal('rejectModal')">&times;</span>
        </div>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="rejectNotes">Reason for Rejection:</label>
                <textarea id="rejectNotes" name="admin_notes" rows="4" placeholder="Please provide a reason..." required></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-reject">✗ Confirm Reject</button>
                <button type="button" class="btn btn-cancel" onclick="closeModal('rejectModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Modal Styles */
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
    }

    .modal.show {
        display: flex !important;
    }

    .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 15px;
    }

    .modal-header h2 {
        margin: 0;
        color: #333;
        font-size: 20px;
    }

    .close {
        font-size: 28px;
        font-weight: bold;
        color: #999;
        cursor: pointer;
        transition: color 0.3s;
    }

    .close:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }

    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-family: inherit;
        resize: vertical;
        box-sizing: border-box;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
    }

    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
</style>

<script>
    function openApproveModal(requestId) {
        const form = document.getElementById('approveForm');
        form.action = `/admin/donate-request/${requestId}/approve`;
        document.getElementById('approveNotes').value = '';
        document.getElementById('approveModal').classList.add('show');
    }

    function openRejectModal(requestId) {
        const form = document.getElementById('rejectForm');
        form.action = `/admin/donate-request/${requestId}/reject`;
        document.getElementById('rejectNotes').value = '';
        document.getElementById('rejectModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const approveModal = document.getElementById('approveModal');
        const rejectModal = document.getElementById('rejectModal');

        if (event.target === approveModal) {
            approveModal.classList.remove('show');
        }
        if (event.target === rejectModal) {
            rejectModal.classList.remove('show');
        }
    }
</script>

@endsection
