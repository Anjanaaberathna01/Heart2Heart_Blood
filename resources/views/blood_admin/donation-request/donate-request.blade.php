<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #e10600;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-card.pending {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stat-card.approved {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card.rejected {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            opacity: 0.9;
        }

        .filter-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #ddd;
            background-color: white;
            color: #333;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .filter-btn.active {
            background-color: #e10600;
            color: white;
            border-color: #e10600;
        }

        .filter-btn:hover {
            border-color: #e10600;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #f5f5f5;
        }

        table th {
            padding: 15px;
            text-align: left;
            color: #333;
            font-weight: 600;
            border-bottom: 2px solid #ddd;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        table tr:hover {
            background-color: #fafafa;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge.approved {
            background-color: #d4edda;
            color: #155724;
        }

        .badge.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

        .btn-view {
            background-color: #17a2b8;
            color: white;
        }

        .btn-view:hover {
            background-color: #138496;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            color: #e10600;
            font-size: 20px;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }

        .modal-close:hover {
            color: #333;
        }

        .request-details {
            margin-bottom: 20px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 150px 1fr;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
        }

        .detail-value {
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: "Poppins", Arial, sans-serif;
            resize: vertical;
            min-height: 80px;
        }

        textarea:focus {
            outline: none;
            border-color: #e10600;
            box-shadow: 0 0 5px rgba(225, 6, 0, 0.3);
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .modal-actions button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .success {
            color: #28a745;
            padding: 12px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error {
            color: #e10600;
            padding: 12px;
            background-color: #ffe6e6;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background-color: #ccc;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            table {
                font-size: 12px;
            }

            table th, table td {
                padding: 10px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('admin.dashboard') }}" class="back-btn">← Back to Dashboard</a>

    <div class="header">
        <h1>🩸 Donation Requests</h1>
    </div>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <!-- Stats -->
    <div class="stats">
        <div class="stat-card pending">
            <div class="stat-number">{{ $donationRequests->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Pending Requests</div>
        </div>
        <div class="stat-card approved">
            <div class="stat-number">{{ $donationRequests->where('status', 'approved')->count() }}</div>
            <div class="stat-label">Approved</div>
        </div>
        <div class="stat-card rejected">
            <div class="stat-number">{{ $donationRequests->where('status', 'rejected')->count() }}</div>
            <div class="stat-label">Rejected</div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <button class="filter-btn active" onclick="filterRequests('all')">All Requests</button>
        <button class="filter-btn" onclick="filterRequests('pending')">Pending</button>
        <button class="filter-btn" onclick="filterRequests('approved')">Approved</button>
        <button class="filter-btn" onclick="filterRequests('rejected')">Rejected</button>
    </div>

    <!-- Table -->
    @if ($donationRequests->count() > 0)
        <div class="table-wrapper">
            <table id="requestsTable">
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
                    @foreach ($donationRequests as $request)
                        <tr class="request-row"
                            data-status="{{ $request->status }}"
                            data-request-id="{{ $request->id }}"
                            data-reason="{{ $request->reason ?? 'Not provided' }}"
                            data-submitted="{{ $request->created_at->format('M d, Y') }}">
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td>
                                <strong class="user-name">{{ $request->user->name ?? 'N/A' }}</strong><br>
                                <small style="color: #666;">{{ $request->user->email ?? 'N/A' }}</small>
                            </td>
                            <td class="hospital-name">{{ $request->hospital->user_name ?? 'N/A' }}</td>
                            <td><strong class="blood-type">{{ $request->blood_type }}</strong></td>
                            <td><span class="badge {{ $request->status }}">{{ ucfirst($request->status) }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-view" onclick="viewDetails({{ $request->id }})">View</button>
                                    @if ($request->status === 'pending')
                                        <button class="btn btn-approve" onclick="openApprovalModal({{ $request->id }})">Approve</button>
                                        <button class="btn btn-reject" onclick="openRejectionModal({{ $request->id }})">Reject</button>
                                    @else
                                        <button class="btn btn-approve" disabled>Approve</button>
                                        <button class="btn btn-reject" disabled>Reject</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📋</div>
            <h3>No Donation Requests Yet</h3>
            <p>Users will submit their donation requests here.</p>
        </div>
    @endif
</div>

<!-- View Details Modal -->
<div id="detailsModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Request Details</h2>
            <button class="modal-close" onclick="closeModal('detailsModal')">&times;</button>
        </div>
        <div id="detailsContent"></div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Approve Request</h2>
            <button class="modal-close" onclick="closeModal('approvalModal')">&times;</button>
        </div>
        <form id="approvalForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="approveNotes">Admin Notes (Optional)</label>
                <textarea id="approveNotes" name="admin_notes" placeholder="Add any notes about this approval..."></textarea>
            </div>
            <div class="modal-actions">
                <button type="submit" style="background-color: #28a745; color: white;">Approve Request</button>
                <button type="button" style="background-color: #ddd; color: #333;" onclick="closeModal('approvalModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Reject Request</h2>
            <button class="modal-close" onclick="closeModal('rejectionModal')">&times;</button>
        </div>
        <form id="rejectionForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="rejectNotes">Reason for Rejection *</label>
                <textarea id="rejectNotes" name="admin_notes" placeholder="Please provide a reason for rejecting this request..." required></textarea>
            </div>
            <div class="modal-actions">
                <button type="submit" style="background-color: #dc3545; color: white;">Reject Request</button>
                <button type="button" style="background-color: #ddd; color: #333;" onclick="closeModal('rejectionModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function viewDetails(requestId) {
        // Get request data from the table
        const row = document.querySelector(`[data-request-id="${requestId}"]`);
        if (!row) {
            // Fetch details via AJAX if needed, or use data attributes
            alert('Request details not found');
            return;
        }

        // Build details HTML
        const detailsHtml = `
            <div class="request-details">
                <div class="detail-row">
                    <div class="detail-label">User Name:</div>
                    <div class="detail-value">${row.querySelector('.user-name')?.textContent || 'N/A'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Blood Type:</div>
                    <div class="detail-value">${row.querySelector('.blood-type')?.textContent || 'N/A'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Units:</div>
                    <div class="detail-value">${row.querySelector('.units')?.textContent || 'N/A'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Hospital:</div>
                    <div class="detail-value">${row.querySelector('.hospital-name')?.textContent || 'N/A'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Reason:</div>
                    <div class="detail-value">${row.dataset.reason || 'Not provided'}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Submitted:</div>
                    <div class="detail-value">${row.dataset.submitted || 'N/A'}</div>
                </div>
            </div>
        `;

        document.getElementById('detailsContent').innerHTML = detailsHtml;
        document.getElementById('detailsModal').classList.add('show');
    }

    function openApprovalModal(requestId) {
        const form = document.getElementById('approvalForm');
        form.action = `/admin/donate-request/${requestId}/approve`;
        document.getElementById('approvalModal').classList.add('show');
    }

    function openRejectionModal(requestId) {
        const form = document.getElementById('rejectionForm');
        form.action = `/admin/donate-request/${requestId}/reject`;
        document.getElementById('rejectionModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    function filterRequests(status) {
        const rows = document.querySelectorAll('.request-row');
        const buttons = document.querySelectorAll('.filter-btn');

        // Update active button
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Filter rows
        rows.forEach(row => {
            if (status === 'all' || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Close modal when clicking outside
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });
    });
</script>
</body>
</html>
