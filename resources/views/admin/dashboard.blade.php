@include('admin.inc.header')

<!-- Dashboard Main Content Container -->
<div class="container-fluid" style="padding: 24px 20px;">

    <!-- 1. Hero Welcome Banner -->
    <div class="dash-welcome-banner">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-12 mb-3 mb-lg-0">
                <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                    <span class="dash-status-beacon">
                        <span class="pulse-dot"></span> News Portal Active
                    </span>
                    <span class="badge" style="background: rgba(255,255,255,0.12); color: #e2e8f0; font-size: 11px; padding: 6px 12px; border-radius: 20px;">
                        <i class="fa fa-calendar-o mr-1"></i> {{ now()->format('l, d M Y') }}
                    </span>
                </div>
                <h1 class="dash-welcome-title">
                    Welcome back, {{ Auth::user()->name ?? 'Administrator' }}! 👋
                </h1>
                <p class="dash-welcome-sub">
                    Here is an overview of your news portal's publishing operations, audience metrics, and recent editorial activity.
                </p>
            </div>
            <div class="col-lg-4 col-md-12 text-lg-right">
                <div class="dash-hero-actions justify-content-lg-end">
                    <a href="{{ route('admin.posts.create') }}" class="dash-btn-primary">
                        <i class="fa fa-plus-circle"></i> Create New Article
                    </a>
                    <a href="{{ url('/') }}" target="_blank" class="dash-btn-glass" title="Open Front Portal in New Tab">
                        <i class="fa fa-external-link"></i> Live Site
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Primary KPI Stat Cards (4 Cards) -->
    <div class="row">
        <!-- Total Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-primary">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Total Articles</div>
                            <h3 class="dash-kpi-value">{{ number_format($posts) }}</h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-primary">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span class="dash-kpi-trend dash-trend-neutral">
                        <i class="fa fa-database"></i> All content in database
                    </span>
                    <a href="{{ route('admin.posts.view') }}" class="dash-kpi-link">View all &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Published Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-success">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Published & Live</div>
                            <h3 class="dash-kpi-value">{{ number_format($active) }}</h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-success">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span class="dash-kpi-trend dash-trend-up">
                        <i class="fa fa-arrow-up"></i> {{ $posts > 0 ? round(($active / $posts) * 100, 1) : 0 }}% publication rate
                    </span>
                    <a href="{{ route('admin.posts.view') }}" class="dash-kpi-link">Manage &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Draft Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-warning">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Drafts & Pending</div>
                            <h3 class="dash-kpi-value">{{ number_format($drafts) }}</h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-warning">
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span class="dash-kpi-trend dash-trend-neutral">
                        <i class="fa fa-clock-o"></i> {{ $posts > 0 ? round(($drafts / $posts) * 100, 1) : 0 }}% awaiting review
                    </span>
                    <a href="{{ route('admin.posts.view') }}" class="dash-kpi-link">Review &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Rejected Articles -->
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
            <div class="dash-kpi-card dash-kpi-danger">
                <div>
                    <div class="dash-kpi-top">
                        <div>
                            <div class="dash-kpi-label">Rejected Articles</div>
                            <h3 class="dash-kpi-value">{{ number_format($rejected) }}</h3>
                        </div>
                        <div class="dash-kpi-icon dash-icon-danger">
                            <i class="fa fa-ban"></i>
                        </div>
                    </div>
                </div>
                <div class="dash-kpi-bottom">
                    <span class="dash-kpi-trend dash-trend-down">
                        <i class="fa fa-exclamation-circle"></i> Requires revision
                    </span>
                    <a href="{{ route('admin.posts.view') }}" class="dash-kpi-link">Check &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Secondary Metrics Strip (Categories, Team, Media) -->
    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="dash-mini-stat">
                <div class="dash-kpi-icon dash-icon-cyan">
                    <i class="fa fa-folder-open-o"></i>
                </div>
                <div class="dash-mini-stat-info">
                    <h4>{{ $categoriesCount }}</h4>
                    <p>News Categories <a href="{{ route('admin.categories.view') }}" class="ml-1 text-primary font-weight-bold">&rarr;</a></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="dash-mini-stat">
                <div class="dash-kpi-icon dash-icon-purple">
                    <i class="fa fa-users"></i>
                </div>
                <div class="dash-mini-stat-info">
                    <h4>{{ $usersCount }}</h4>
                    <p>Writers & Editorial Team <a href="{{ route('admin.users.view') }}" class="ml-1 text-primary font-weight-bold">&rarr;</a></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mb-4">
            <div class="dash-mini-stat">
                <div class="dash-kpi-icon dash-icon-pink">
                    <i class="fa fa-picture-o"></i>
                </div>
                <div class="dash-mini-stat-info">
                    <h4>{{ $filesCount }}</h4>
                    <p>Media Assets & Attachments <a href="{{ route('admin.attachements.view') }}" class="ml-1 text-primary font-weight-bold">&rarr;</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Quick Action Shortcuts Hub -->
    <div class="dash-card mb-4">
        <div class="dash-card-header">
            <div>
                <h3 class="dash-card-title">
                    <i class="fa fa-bolt" style="color: #f59e0b;"></i> Quick Actions Hub
                </h3>
                <p class="dash-card-sub">Fast shortcuts for everyday editorial and management workflows</p>
            </div>
        </div>
        <div class="dash-card-body" style="padding-bottom: 12px;">
            <div class="dash-quick-grid">
                <a href="{{ route('admin.posts.create') }}" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #e0e7ff; color: #4338ca;">
                        <i class="fa fa-pencil"></i>
                    </div>
                    <span class="dash-quick-title">New Article</span>
                </a>

                <a href="{{ route('admin.posts.view') }}" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #dcfce7; color: #15803d;">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <span class="dash-quick-title">All Articles</span>
                </a>

                <a href="{{ route('admin.categories.create') }}" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #cffafe; color: #0e7490;">
                        <i class="fa fa-tags"></i>
                    </div>
                    <span class="dash-quick-title">Add Category</span>
                </a>

                <a href="{{ route('admin.attachements.create') }}" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #fce7f3; color: #be185d;">
                        <i class="fa fa-upload"></i>
                    </div>
                    <span class="dash-quick-title">Upload Media</span>
                </a>

                <a href="{{ route('admin.users.create') }}" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #ede9fe; color: #6d28d9;">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <span class="dash-quick-title">Add Author</span>
                </a>

                <a href="{{ route('admin.settings') }}" class="dash-quick-item">
                    <div class="dash-quick-icon" style="background: #f1f5f9; color: #475569;">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <span class="dash-quick-title">Site Settings</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 5. Visual Analytics Row (Monthly Activity Chart & Workflow Doughnut) -->
    <div class="row">
        <!-- Monthly Activity Chart -->
        <div class="col-lg-8 mb-4">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-line-chart"></i> Publishing Activity Trend
                        </h3>
                        <p class="dash-card-sub">Content output across active monthly periods</p>
                    </div>
                    <span class="badge badge-light" style="padding: 6px 12px; font-size: 11px;">
                        <i class="fa fa-bar-chart"></i> Activity
                    </span>
                </div>
                <div class="dash-card-body">
                    <div class="dash-chart-container" style="height: 280px;">
                        <canvas id="publishTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workflow Status Breakdown Doughnut -->
        <div class="col-lg-4 mb-4">
            <div class="dash-card h-100">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-pie-chart"></i> Status Distribution
                        </h3>
                        <p class="dash-card-sub">Current distribution of articles</p>
                    </div>
                </div>
                <div class="dash-card-body d-flex flex-column justify-content-center">
                    <div class="dash-chart-container" style="height: 200px; position: relative;">
                        <canvas id="statusBreakdownChart"></canvas>
                    </div>
                    <div class="dash-chart-legend mt-3">
                        <div class="dash-legend-item">
                            <span class="dash-legend-box" style="background: #10b981;"></span>
                            <span>Published ({{ $active }})</span>
                        </div>
                        <div class="dash-legend-item">
                            <span class="dash-legend-box" style="background: #f59e0b;"></span>
                            <span>Drafts ({{ $drafts }})</span>
                        </div>
                        <div class="dash-legend-item">
                            <span class="dash-legend-box" style="background: #ef4444;"></span>
                            <span>Rejected ({{ $rejected }})</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 6. Recent Articles Hub & Side Widgets Row -->
    <div class="row">
        <!-- Recent Articles Table -->
        <div class="col-xl-8 col-lg-12 mb-4">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-clock-o"></i> Recent Articles
                        </h3>
                        <p class="dash-card-sub">Latest news posts updated or created on your portal</p>
                    </div>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-outline-primary" style="font-size: 12px; font-weight: 600; border-radius: 6px;">
                        <i class="fa fa-plus"></i> New Article
                    </a>
                </div>
                <div class="dash-table-wrap">
                    <table class="table dash-table">
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Updated</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentPosts as $post)
                                @php
                                    $imgSrc = null;
                                    if (!empty($post->image)) {
                                        if (str_starts_with($post->image, 'post_images/')) {
                                            $imgSrc = asset('storage/' . $post->image);
                                        } else {
                                            $imgSrc = asset('storage/post_images/' . $post->image);
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <div class="dash-article-cell">
                                            @if($imgSrc)
                                                <img src="{{ $imgSrc }}"
                                                     alt="{{ $post->title }}"
                                                     class="dash-article-thumb"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div class="dash-article-thumb-fallback" style="display: none;">
                                                    <i class="fa fa-file-text-o"></i>
                                                </div>
                                            @else
                                                <div class="dash-article-thumb-fallback">
                                                    <i class="fa fa-file-text-o"></i>
                                                </div>
                                            @endif
                                            <div class="dash-article-info">
                                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="dash-article-title" title="{{ $post->title }}">
                                                    {{ Str::limit($post->title, 45) }}
                                                </a>
                                                <div class="dash-article-meta">
                                                    <span><i class="fa fa-hashtag"></i> ID: #{{ $post->id }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light" style="font-weight: 600; color: #4338ca; background: #e0e7ff; border-radius: 6px; padding: 4px 8px;">
                                            {{ $post->category_name ?? 'General' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="font-weight: 500; color: #334155; font-size: 12px;">
                                            {{ $post->writer_name ?? 'Editor' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($post->status == 1)
                                            <span class="dash-badge dash-badge-success">
                                                <span class="dash-badge-dot"></span> Published
                                            </span>
                                        @elseif ($post->status == 0)
                                            <span class="dash-badge dash-badge-warning">
                                                <span class="dash-badge-dot"></span> Draft
                                            </span>
                                        @else
                                            <span class="dash-badge dash-badge-danger">
                                                <span class="dash-badge-dot"></span> Rejected
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="color: #64748b; font-size: 11px;">
                                            {{ \Carbon\Carbon::parse($post->updated_at ?? $post->created_at)->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-light" style="padding: 3px 8px; border-radius: 6px; font-size: 11px;" title="Edit Article">
                                            <i class="fa fa-pencil text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fa fa-newspaper-o fa-2x mb-2 d-block text-secondary"></i>
                                        No articles found. Start by creating a new article!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="dash-card-footer">
                    <a href="{{ route('admin.posts.view') }}" class="font-weight-bold text-primary" style="font-size: 13px;">
                        View All Articles ({{ $posts }}) &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side Widgets Column -->
        <div class="col-xl-4 col-lg-12">
            <!-- Widget 1: Top Categories by Articles -->
            <div class="dash-card mb-4">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-folder-open-o" style="color: #06b6d4;"></i> Content Categories
                        </h3>
                        <p class="dash-card-sub">Top categories ranked by volume</p>
                    </div>
                    <a href="{{ route('admin.categories.view') }}" class="text-muted" title="View all">
                        <i class="fa fa-ellipsis-h"></i>
                    </a>
                </div>
                <div class="dash-card-body py-2">
                    @forelse($topCategories as $cat)
                        @php
                            $catPercentage = $posts > 0 ? round(($cat->total_posts / $posts) * 100) : 0;
                        @endphp
                        <div class="dash-cat-item">
                            <div style="flex-grow: 1; padding-right: 15px;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="dash-cat-name">{{ $cat->name }}</span>
                                    <span class="dash-cat-count">{{ $cat->total_posts }} articles</span>
                                </div>
                                <div class="dash-cat-bar">
                                    <div class="dash-cat-progress" style="width: {{ max($catPercentage, 4) }}%;"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-3">No categories found.</p>
                    @endforelse
                </div>
                <div class="dash-card-footer">
                    <a href="{{ route('admin.categories.create') }}" class="font-weight-bold text-primary" style="font-size: 12px;">
                        <i class="fa fa-plus"></i> Add New Category
                    </a>
                </div>
            </div>

            <!-- Widget 2: Top Authors & Editorial Team -->
            <div class="dash-card mb-4">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-users" style="color: #8b5cf6;"></i> Editorial Team
                        </h3>
                        <p class="dash-card-sub">Writers & content contributors</p>
                    </div>
                    <a href="{{ route('admin.users.view') }}" class="text-muted" title="Manage Users">
                        <i class="fa fa-cog"></i>
                    </a>
                </div>
                <div class="dash-card-body py-2">
                    @forelse($topAuthors as $author)
                        <div class="dash-author-item">
                            <div class="dash-avatar-circle">
                                {{ strtoupper(substr($author->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="dash-author-info">
                                <h5 class="dash-author-name">{{ $author->name }}</h5>
                                <p class="dash-author-role">{{ $author->email }}</p>
                            </div>
                            <div>
                                <span class="badge badge-light" style="font-size: 11px; padding: 4px 8px; border-radius: 10px; background: #f1f5f9; color: #334155;">
                                    <strong>{{ $author->posts_count }}</strong> posts
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-3">No authors found.</p>
                    @endforelse
                </div>
                <div class="dash-card-footer">
                    <a href="{{ route('admin.users.create') }}" class="font-weight-bold text-primary" style="font-size: 12px;">
                        <i class="fa fa-user-plus"></i> Invite Team Member
                    </a>
                </div>
            </div>

            <!-- Widget 3: System & Portal Info -->
            <div class="dash-card mb-4">
                <div class="dash-card-header">
                    <div>
                        <h3 class="dash-card-title">
                            <i class="fa fa-server" style="color: #64748b;"></i> Portal System Info
                        </h3>
                        <p class="dash-card-sub">Environment & framework status</p>
                    </div>
                </div>
                <div class="dash-card-body py-2">
                    <div class="dash-system-item">
                        <span class="dash-system-label"><i class="fa fa-code"></i> Framework</span>
                        <span class="dash-system-value">Laravel v{{ app()->version() }}</span>
                    </div>
                    <div class="dash-system-item">
                        <span class="dash-system-label"><i class="fa fa-cogs"></i> PHP Version</span>
                        <span class="dash-system-value">v{{ phpversion() }}</span>
                    </div>
                    <div class="dash-system-item">
                        <span class="dash-system-label"><i class="fa fa-database"></i> Database</span>
                        <span class="dash-system-value">MySQL / MariaDB</span>
                    </div>
                    <div class="dash-system-item">
                        <span class="dash-system-label"><i class="fa fa-shield"></i> Environment</span>
                        <span class="dash-system-value badge badge-success text-white" style="font-size: 10px; padding: 3px 8px; border-radius: 6px;">{{ strtoupper(config('app.env')) }}</span>
                    </div>
                </div>
                <div class="dash-card-footer">
                    <a href="{{ route('admin.settings') }}" class="font-weight-bold text-muted" style="font-size: 12px;">
                        <i class="fa fa-wrench"></i> Configure System Settings
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End Dashboard Main Content Container -->

@include('admin.inc.footer')

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Publishing Activity Trend Chart (Bar Chart)
    var trendCtx = document.getElementById('publishTrendChart');
    if (trendCtx) {
        var labels = {!! json_encode($monthLabels) !!};
        var counts = {!! json_encode($monthCounts) !!};

        if (!labels || labels.length === 0) {
            labels = ['Recent'];
            counts = [{{ $posts }}];
        }

        new Chart(trendCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Articles Created',
                    data: counts,
                    backgroundColor: 'rgba(79, 70, 229, 0.85)',
                    hoverBackgroundColor: 'rgba(67, 56, 202, 1)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: '#0f172a',
                    titleFontFamily: "'Inter', sans-serif",
                    bodyFontFamily: "'Inter', sans-serif",
                    titleFontSize: 13,
                    bodyFontSize: 12,
                    cornerRadius: 8,
                    xPadding: 12,
                    yPadding: 10,
                    callbacks: {
                        label: function(tooltipItem) {
                            return ' Articles: ' + tooltipItem.yLabel;
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            fontColor: '#64748b',
                            fontSize: 11
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#f1f5f9',
                            zeroLineColor: '#e2e8f0',
                            drawBorder: false
                        },
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#64748b',
                            fontSize: 11,
                            precision: 0
                        }
                    }]
                }
            }
        });
    }

    // 2. Status Distribution Doughnut Chart
    var statusCtx = document.getElementById('statusBreakdownChart');
    if (statusCtx) {
        var activeCount = {{ (int) $active }};
        var draftsCount = {{ (int) $drafts }};
        var rejectedCount = {{ (int) $rejected }};

        // Fallback if all 0
        var chartData = [activeCount, draftsCount, rejectedCount];
        if (activeCount === 0 && draftsCount === 0 && rejectedCount === 0) {
            chartData = [1, 0, 0];
        }

        new Chart(statusCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Published', 'Drafts', 'Rejected'],
                datasets: [{
                    data: chartData,
                    backgroundColor: [
                        '#10b981', // emerald
                        '#f59e0b', // amber
                        '#ef4444'  // rose
                    ],
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverBorderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 68,
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: '#0f172a',
                    cornerRadius: 8,
                    xPadding: 12,
                    yPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var currentValue = dataset.data[tooltipItem.index];
                            var currentLabel = data.labels[tooltipItem.index];
                            return ' ' + currentLabel + ': ' + currentValue + ' posts';
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
