<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin-nav')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Rejected Articles</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Serif+Display&display=swap');

        :root {
            --bg: #f9fafb;
            --panel: #ffffff;
            --panel-2: #f3f4f6;
            --text: #1f2937;
            --muted: #6b7280;
            --accent: #dc2626;
            --accent-2: #fee2e2;
            --good: #16a34a;
            --border: #e5e7eb;
            --shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
            --radius: 16px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Sora", sans-serif;
            background:
                radial-gradient(800px 420px at 10% -10%, #ffe4e6, transparent),
                radial-gradient(600px 320px at 90% -20%, #fff1f2, transparent),
                var(--bg);
            color: var(--text);
        }

        .page {
            min-height: 100vh;
            padding: 32px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mark {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            color: #ffffff;
            font-weight: 700;
            box-shadow: var(--shadow);
        }

        h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 0.2px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: var(--panel);
            color: var(--text);
            cursor: pointer;
            transition: 0.2s ease;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: var(--shadow);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
            border: 0;
            color: #ffffff;
        }

        .btn-ghost {
            background: #ffffff;
            border: 1px solid var(--border);
            color: var(--muted);
            box-shadow: none;
        }

        .toolbar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .search {
            flex: 1;
            min-width: 240px;
            position: relative;
        }

        .search input {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--panel-2);
            color: var(--text);
        }

        .search span {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
        }

        .filters select {
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: var(--panel-2);
            color: var(--text);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(160px, 1fr));
            gap: 14px;
            margin: 18px 0 20px;
        }

        .stat-card {
            background: var(--panel);
            padding: 16px;
            border-radius: 14px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .stat-title {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            margin-top: 8px;
            font-family: "DM Serif Display", serif;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px;
        }

        .article-card {
            background: var(--panel);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-height: 220px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .article-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 32px rgba(15, 23, 42, 0.14);
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            line-height: 1.4;
        }

        .card-meta {
            color: var(--muted);
            font-size: 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .card-divider {
            height: 1px;
            background: var(--border);
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: auto;
        }

        .meta-pill {
            background: var(--accent-2);
            color: var(--accent);
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-type {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-date {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-status {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .excerpt {
            color: var(--muted);
            max-width: 380px;
        }

        .empty {
            padding: 32px;
            text-align: center;
            color: var(--muted);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 16px;
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
@php
    $totalArticles = $articles->count();
    $uniqueHospitals = $articles->pluck('hospital_name')->filter()->unique()->count();
    $latest = $articles->first();
    $latestDate = $latest ? ($latest->date ?? $latest->created_at) : null;
    $latestLabel = $latestDate ? \Carbon\Carbon::parse($latestDate)->format('M d, Y') : 'N/A';
@endphp
<div class="page">
    <div class="topbar">
        <div class="title">
            <div class="mark">BA</div>
            <div>
                <h1>Rejected Articles</h1>
                <div class="subtitle">Admin view of rejected hospital articles</div>
            </div>
        </div>
        <div class="actions">
            <a class="btn btn-ghost" href="{{ route('admin.articles') }}">Pending</a>
            <a class="btn btn-ghost" href="{{ route('admin.articles.approved') }}">Approved</a>
            <span class="btn btn-primary">Rejected</span>
        </div>
    </div>

    <div class="toolbar">
        <div class="search">
            <span>Search</span>
            <input type="text" placeholder="Search title, hospital, or blood type" />
        </div>
        <div class="filters">
            <select>
                <option>All Blood Types</option>
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
                <option>O+</option>
                <option>O-</option>
            </select>
        </div>
        <div class="filters">
            <select>
                <option>Sort: Newest</option>
                <option>Sort: Oldest</option>
            </select>
        </div>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-title">Total Articles</div>
            <div class="stat-value">{{ $totalArticles }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Unique Hospitals</div>
            <div class="stat-value">{{ $uniqueHospitals }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-title">Latest Article Date</div>
            <div class="stat-value">{{ $latestLabel }}</div>
        </div>
    </div>

    <div class="cards">
        @forelse ($articles as $article)
            <div class="article-card">
                <div class="card-top">
                    <h3 class="card-title">{{ $article->title }}</h3>
                    <span class="meta-pill">{{ $article->blood_type }}</span>
                </div>
                <div class="card-meta">
                    <span>Hospital: {{ $article->hospital_name }}</span>
                    <span>Article Date: {{ \Carbon\Carbon::parse($article->date)->format('M d, Y') }}</span>
                    <span>Created: {{ $article->created_at ? $article->created_at->format('M d, Y') : 'N/A' }}</span>
                </div>
                <div class="card-divider"></div>
                <div class="excerpt">{{ \Illuminate\Support\Str::limit($article->description, 140) }}</div>
                <div class="card-footer">
                    <span class="badge badge-date">{{ \Carbon\Carbon::parse($article->date)->format('M d, Y') }}</span>
                    <span class="badge badge-type">{{ $article->blood_type }}</span>
                    <span class="badge badge-status">Rejected</span>
                </div>
            </div>
        @empty
            <div class="empty">No rejected articles found yet.</div>
        @endforelse
    </div>

    <div class="pagination">
        <div>Showing {{ $totalArticles }} article{{ $totalArticles === 1 ? '' : 's' }}</div>
        <div>Rejected list</div>
    </div>
</div>
</body>
</html>
