@include('admin.inc.header')

{{-- ═══════════════════════════════════════════════════════════════
     SETTINGS PAGE STYLES
═══════════════════════════════════════════════════════════════ --}}
<style>
:root {
    --set-primary: #6366f1;
    --set-primary-dark: #4f46e5;
    --set-success: #22c55e;
    --set-warning: #f59e0b;
    --set-danger: #ef4444;
    --set-info: #06b6d4;
    --set-bg: #0f172a;
    --set-card: #1e293b;
    --set-border: rgba(99,102,241,0.18);
    --set-text: #e2e8f0;
    --set-muted: #94a3b8;
    --set-input-bg: #0f172a;
}

/* ── Settings Page Layout ── */
.settings-page { padding: 0 0 40px; }

/* ── Page Header ── */
.settings-hero {
    background: linear-gradient(135deg, #1e1b4b 0%, #1e293b 40%, #0f172a 100%);
    border-bottom: 1px solid var(--set-border);
    padding: 32px 28px 24px;
    margin-bottom: 0;
    position: relative;
    overflow: hidden;
}
.settings-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
    pointer-events: none;
}
.settings-hero h1 {
    font-size: 1.65rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 4px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.settings-hero h1 i { color: var(--set-primary); font-size: 1.4rem; }
.settings-hero p { color: var(--set-muted); font-size: .9rem; margin: 0; }

/* ── Tab Navigation ── */
.settings-tabs-wrapper {
    background: var(--set-card);
    border-bottom: 1px solid var(--set-border);
    padding: 0 28px;
    overflow-x: auto;
    white-space: nowrap;
    scrollbar-width: none;
}
.settings-tabs-wrapper::-webkit-scrollbar { display: none; }
.settings-nav { display: flex; gap: 0; margin: 0; padding: 0; list-style: none; }
.settings-nav li { flex-shrink: 0; }
.settings-nav .nav-tab {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 16px 20px;
    color: var(--set-muted);
    font-size: .86rem;
    font-weight: 500;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    transition: all .2s ease;
    cursor: pointer;
    background: none;
    border-top: none;
    border-left: none;
    border-right: none;
}
.settings-nav .nav-tab i { font-size: .9rem; }
.settings-nav .nav-tab:hover { color: #fff; border-bottom-color: rgba(99,102,241,.4); }
.settings-nav .nav-tab.active { color: var(--set-primary); border-bottom-color: var(--set-primary); }
.tab-badge {
    font-size: .68rem;
    padding: 1px 6px;
    border-radius: 10px;
    background: rgba(99,102,241,.2);
    color: var(--set-primary);
}

/* ── Tab Content ── */
.settings-body { padding: 28px; }
.tab-pane { display: none; }
.tab-pane.active { display: block; }

/* ── Settings Card ── */
.s-card {
    background: var(--set-card);
    border: 1px solid var(--set-border);
    border-radius: 16px;
    margin-bottom: 24px;
    overflow: hidden;
    transition: box-shadow .3s;
}
.s-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,.3); }
.s-card-header {
    padding: 18px 24px;
    border-bottom: 1px solid var(--set-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(99,102,241,.04);
}
.s-card-header-left { display: flex; align-items: center; gap: 12px; }
.s-card-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .95rem;
    flex-shrink: 0;
}
.s-card-icon.purple { background: rgba(99,102,241,.15); color: var(--set-primary); }
.s-card-icon.green  { background: rgba(34,197,94,.15);  color: var(--set-success); }
.s-card-icon.blue   { background: rgba(6,182,212,.15);  color: var(--set-info); }
.s-card-icon.orange { background: rgba(245,158,11,.15); color: var(--set-warning); }
.s-card-icon.red    { background: rgba(239,68,68,.15);  color: var(--set-danger); }
.s-card-icon.teal   { background: rgba(20,184,166,.15); color: #14b8a6; }
.s-card-title { font-size: 1rem; font-weight: 600; color: #fff; margin: 0; }
.s-card-subtitle { font-size: .78rem; color: var(--set-muted); margin: 2px 0 0; }
.s-card-body { padding: 24px; }

/* ── Form Controls ── */
.s-form-group { margin-bottom: 20px; }
.s-label {
    display: block;
    font-size: .82rem;
    font-weight: 600;
    color: var(--set-text);
    margin-bottom: 7px;
    letter-spacing: .3px;
}
.s-label .required { color: var(--set-danger); margin-left: 3px; }
.s-label .hint-badge {
    font-size: .7rem;
    padding: 1px 7px;
    border-radius: 8px;
    background: rgba(99,102,241,.15);
    color: var(--set-primary);
    margin-left: 6px;
    font-weight: 500;
}
.s-input, .s-select, .s-textarea {
    width: 100%;
    background: var(--set-input-bg);
    border: 1.5px solid rgba(99,102,241,.2);
    border-radius: 10px;
    color: var(--set-text);
    padding: 10px 14px;
    font-size: .88rem;
    transition: all .2s;
    outline: none;
}
.s-input:focus, .s-select:focus, .s-textarea:focus {
    border-color: var(--set-primary);
    box-shadow: 0 0 0 3px rgba(99,102,241,.12);
    background: #1a2236;
}
.s-input::placeholder, .s-textarea::placeholder { color: #475569; }
.s-textarea { resize: vertical; min-height: 80px; }
.s-input-group { position: relative; }
.s-input-group .s-input { padding-left: 40px; }
.s-input-group-icon {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--set-muted);
    font-size: .88rem;
    pointer-events: none;
}
.s-input-password { padding-right: 44px !important; }
.s-password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--set-muted);
    cursor: pointer;
    padding: 0;
    font-size: .9rem;
}
.s-password-toggle:hover { color: var(--set-primary); }

/* ── Toggle Switch ── */
.s-toggle-group {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 18px;
    background: rgba(0,0,0,.2);
    border-radius: 10px;
    border: 1px solid var(--set-border);
    margin-bottom: 14px;
}
.s-toggle-info h6 { color: #fff; font-size: .88rem; font-weight: 600; margin: 0 0 2px; }
.s-toggle-info p { color: var(--set-muted); font-size: .78rem; margin: 0; }
.s-toggle { position: relative; display: inline-block; width: 46px; height: 25px; }
.s-toggle input { display: none; }
.s-toggle-slider {
    position: absolute; inset: 0;
    background: #334155;
    border-radius: 25px;
    cursor: pointer;
    transition: .3s;
}
.s-toggle-slider::before {
    content: '';
    position: absolute;
    width: 19px; height: 19px;
    background: #fff;
    border-radius: 50%;
    left: 3px; top: 3px;
    transition: .3s;
    box-shadow: 0 2px 5px rgba(0,0,0,.3);
}
.s-toggle input:checked + .s-toggle-slider { background: var(--set-primary); }
.s-toggle input:checked + .s-toggle-slider::before { transform: translateX(21px); }

/* ── Buttons ── */
.s-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 10px;
    font-size: .86rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all .2s;
    text-decoration: none;
}
.s-btn-primary { background: linear-gradient(135deg, var(--set-primary), var(--set-primary-dark)); color: #fff; }
.s-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(99,102,241,.4); color: #fff; }
.s-btn-success { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; }
.s-btn-success:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(34,197,94,.4); color: #fff; }
.s-btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; }
.s-btn-danger:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(239,68,68,.4); color: #fff; }
.s-btn-info { background: linear-gradient(135deg, #06b6d4, #0891b2); color: #fff; }
.s-btn-info:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(6,182,212,.4); color: #fff; }
.s-btn-warning { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; }
.s-btn-warning:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(245,158,11,.4); color: #fff; }
.s-btn-outline {
    background: transparent;
    border: 1.5px solid var(--set-border);
    color: var(--set-text);
}
.s-btn-outline:hover { border-color: var(--set-primary); color: var(--set-primary); background: rgba(99,102,241,.06); }
.s-btn-sm { padding: 7px 14px; font-size: .8rem; }
.s-btn-lg { padding: 13px 28px; font-size: .94rem; }
.s-btn[disabled], .s-btn:disabled { opacity: .55; cursor: not-allowed; transform: none !important; box-shadow: none !important; }

/* ── Image Preview ── */
.s-img-preview-box {
    border: 2px dashed var(--set-border);
    border-radius: 12px;
    padding: 16px;
    text-align: center;
    cursor: pointer;
    transition: all .2s;
    position: relative;
    overflow: hidden;
}
.s-img-preview-box:hover { border-color: var(--set-primary); background: rgba(99,102,241,.04); }
.s-img-preview-box img { max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 8px; }
.s-img-upload-btn {
    display: block;
    margin-top: 10px;
    font-size: .8rem;
    color: var(--set-primary);
    font-weight: 500;
}

/* ── Info Boxes ── */
.s-info-box {
    background: rgba(6,182,212,.07);
    border: 1px solid rgba(6,182,212,.2);
    border-radius: 10px;
    padding: 14px 16px;
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
}
.s-info-box i { color: var(--set-info); font-size: 1rem; margin-top: 1px; flex-shrink: 0; }
.s-info-box p { color: var(--set-muted); font-size: .82rem; margin: 0; line-height: 1.6; }
.s-info-box.warning { background: rgba(245,158,11,.07); border-color: rgba(245,158,11,.2); }
.s-info-box.warning i { color: var(--set-warning); }
.s-info-box.success { background: rgba(34,197,94,.07); border-color: rgba(34,197,94,.2); }
.s-info-box.success i { color: var(--set-success); }
.s-info-box.danger { background: rgba(239,68,68,.07); border-color: rgba(239,68,68,.2); }
.s-info-box.danger i { color: var(--set-danger); }

/* ── Status Badge ── */
.s-status { display: inline-flex; align-items: center; gap: 6px; font-size: .78rem; font-weight: 600; padding: 4px 10px; border-radius: 20px; }
.s-status.active { background: rgba(34,197,94,.15); color: var(--set-success); }
.s-status.inactive { background: rgba(239,68,68,.15); color: var(--set-danger); }
.s-status .dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; }

/* ── Code Block ── */
.s-code-block {
    background: #0a0f1a;
    border: 1px solid var(--set-border);
    border-radius: 10px;
    padding: 16px;
    font-family: 'Courier New', monospace;
    font-size: .82rem;
    color: #a5f3fc;
    overflow-x: auto;
    white-space: pre-wrap;
    word-break: break-all;
    max-height: 250px;
    overflow-y: auto;
    line-height: 1.7;
    margin-top: 12px;
}

/* ── Divider ── */
.s-divider { border: none; border-top: 1px solid var(--set-border); margin: 20px 0; }

/* ── Form Row ── */
.s-row { display: grid; gap: 20px; }
.s-row-2 { grid-template-columns: 1fr 1fr; }
.s-row-3 { grid-template-columns: 1fr 1fr 1fr; }
@media(max-width:768px) { .s-row-2, .s-row-3 { grid-template-columns: 1fr; } }

/* ── VAPID Key Box ── */
.vapid-key-display {
    background: #0a0f1a;
    border: 1px solid var(--set-border);
    border-radius: 10px;
    padding: 12px 14px;
    font-family: monospace;
    font-size: .75rem;
    color: #86efac;
    word-break: break-all;
    line-height: 1.6;
}

/* ── Section subtitle ── */
.s-section-title {
    font-size: .78rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--set-primary);
    margin: 24px 0 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.s-section-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--set-border);
}

/* ── Maintenance Banner ── */
.s-maintenance-active {
    background: linear-gradient(135deg, rgba(239,68,68,.1), rgba(239,68,68,.05));
    border: 1px solid rgba(239,68,68,.3);
    border-radius: 12px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
}
.s-maintenance-active i { color: var(--set-danger); font-size: 1.3rem; }
.s-maintenance-active h6 { color: #fca5a5; font-weight: 700; margin: 0 0 3px; }
.s-maintenance-active p { color: var(--set-muted); font-size: .82rem; margin: 0; }

/* ── Scrollbar ── */
.s-code-block::-webkit-scrollbar { width: 5px; height: 5px; }
.s-code-block::-webkit-scrollbar-track { background: transparent; }
.s-code-block::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }

/* ── Animations ── */
@keyframes pulse-dot { 0%,100%{transform:scale(1);opacity:1} 50%{transform:scale(1.4);opacity:.7} }
.online-dot { animation: pulse-dot 2s infinite; display:inline-block; }
</style>

<div class="settings-page">
    {{-- ── Hero Header ── --}}
    <div class="settings-hero">
        <h1><i class="fa fa-cogs"></i> System Settings Manager</h1>
        <p>Manage website, SEO, logos, email SMTP, Telegram, and web push notifications — all in one place.</p>
    </div>

    {{-- ── Tab Navigation ── --}}
    <div class="settings-tabs-wrapper">
        <ul class="settings-nav" id="settingsNav">
            <li><button class="nav-tab active" data-tab="website"><i class="fa fa-globe"></i> Website</button></li>
            <li><button class="nav-tab" data-tab="seo"><i class="fa fa-search"></i> SEO</button></li>
            <li><button class="nav-tab" data-tab="logos"><i class="fa fa-image"></i> Logo & Favicon</button></li>
            <li><button class="nav-tab" data-tab="social"><i class="fa fa-share-alt"></i> Social Media</button></li>
            <li><button class="nav-tab" data-tab="smtp"><i class="fa fa-envelope"></i> Email SMTP</button></li>
            <li><button class="nav-tab" data-tab="telegram"><i class="fa fa-paper-plane"></i> Telegram</button></li>
            <li><button class="nav-tab" data-tab="webpush"><i class="fa fa-bell"></i> Web Push</button></li>
        </ul>
    </div>

    {{-- ── Tab Content ── --}}
    <div class="settings-body">

        {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
             TAB 1 : WEBSITE SETTINGS
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
        <div class="tab-pane active" id="tab-website">
            @if($settings->maintenance_mode)
            <div class="s-maintenance-active">
                <i class="fa fa-exclamation-triangle"></i>
                <div>
                    <h6>Maintenance Mode is ACTIVE</h6>
                    <p>Your website is currently in maintenance mode. Visitors will see the maintenance message below.</p>
                </div>
            </div>
            @endif

            <div class="s-row s-row-2">
                <div class="s-card">
                    <div class="s-card-header">
                        <div class="s-card-header-left">
                            <div class="s-card-icon purple"><i class="fa fa-globe"></i></div>
                            <div>
                                <div class="s-card-title">Website Identity</div>
                                <div class="s-card-subtitle">Site name, title & URL</div>
                            </div>
                        </div>
                    </div>
                    <div class="s-card-body">
                        <form action="{{ route('admin.settings.general.update') }}" method="POST">
                            @csrf @method('PUT')
                            <div class="s-form-group">
                                <label class="s-label">Website Name <span class="required">*</span></label>
                                <div class="s-input-group">
                                    <i class="fa fa-tag s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="name" value="{{ $settings->name }}" placeholder="My News Site" maxlength="60" required>
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Website Title <span class="required">*</span> <span class="hint-badge">Max 70 chars</span></label>
                                <div class="s-input-group">
                                    <i class="fa fa-heading s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="title" value="{{ $settings->title }}" placeholder="Latest News & Updates" maxlength="70" required>
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Website URL</label>
                                <div class="s-input-group">
                                    <i class="fa fa-link s-input-group-icon"></i>
                                    <input type="url" class="s-input" name="url" value="{{ $settings->url }}" placeholder="https://yourdomain.com">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="s-btn s-btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="s-card">
                    <div class="s-card-header">
                        <div class="s-card-header-left">
                            <div class="s-card-icon red"><i class="fa fa-wrench"></i></div>
                            <div>
                                <div class="s-card-title">Maintenance Mode</div>
                                <div class="s-card-subtitle">Control website availability</div>
                            </div>
                        </div>
                        <span class="s-status {{ $settings->maintenance_mode ? 'inactive' : 'active' }}">
                            <span class="dot online-dot"></span>
                            {{ $settings->maintenance_mode ? 'OFFLINE' : 'ONLINE' }}
                        </span>
                    </div>
                    <div class="s-card-body">
                        <form action="{{ route('admin.settings.general.update') }}" method="POST">
                            @csrf @method('PUT')
                            {{-- Hidden fields to keep other values intact --}}
                            <input type="hidden" name="name" value="{{ $settings->name }}">
                            <input type="hidden" name="title" value="{{ $settings->title }}">
                            <input type="hidden" name="url" value="{{ $settings->url }}">

                            <div class="s-toggle-group">
                                <div class="s-toggle-info">
                                    <h6>Enable Maintenance Mode</h6>
                                    <p>Block all public access to website</p>
                                </div>
                                <label class="s-toggle">
                                    <input type="checkbox" name="maintenance_mode" value="1" {{ $settings->maintenance_mode ? 'checked' : '' }}>
                                    <span class="s-toggle-slider"></span>
                                </label>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Maintenance Message</label>
                                <textarea class="s-textarea" name="maintenance_message" rows="4" placeholder="We are currently performing scheduled maintenance. We'll be back shortly!">{{ $settings->maintenance_message }}</textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="s-btn s-btn-danger"><i class="fa fa-power-off"></i> Update Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
             TAB 2 : SEO SETTINGS
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
        <div class="tab-pane" id="tab-seo">
            <div class="s-card">
                <div class="s-card-header">
                    <div class="s-card-header-left">
                        <div class="s-card-icon green"><i class="fa fa-search"></i></div>
                        <div>
                            <div class="s-card-title">SEO & Meta Configuration</div>
                            <div class="s-card-subtitle">Optimize your site for search engines</div>
                        </div>
                    </div>
                </div>
                <div class="s-card-body">
                    <form action="{{ route('admin.settings.seo.update') }}" method="POST">
                        @csrf @method('PUT')

                        <p class="s-section-title"><i class="fa fa-align-left"></i> Basic Meta Tags</p>
                        <div class="s-row s-row-2">
                            <div class="s-form-group">
                                <label class="s-label">Meta Author</label>
                                <div class="s-input-group">
                                    <i class="fa fa-user s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="meta_author" value="{{ $settings->meta_author }}" placeholder="Author name or company">
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Robots Index</label>
                                <select class="s-select" name="robots_index">
                                    @foreach(['index,follow'=>'Index, Follow (Recommended)', 'noindex,nofollow'=>'No Index, No Follow', 'index,nofollow'=>'Index, No Follow', 'noindex,follow'=>'No Index, Follow'] as $val=>$label)
                                        <option value="{{ $val }}" {{ ($settings->robots_index ?? 'index,follow') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="s-form-group">
                            <label class="s-label">Meta Description <span class="hint-badge">Max 300 chars</span></label>
                            <textarea class="s-textarea" name="description" rows="3" placeholder="A concise summary of your website for search engines...">{{ $settings->description }}</textarea>
                        </div>

                        <div class="s-form-group">
                            <label class="s-label">Focus Keywords <span class="hint-badge">Comma separated</span></label>
                            <textarea class="s-textarea" name="keywords" rows="3" placeholder="news, latest news, breaking news, updates...">{{ $settings->keywords }}</textarea>
                        </div>

                        <div class="s-form-group">
                            <label class="s-label">About Us Content</label>
                            <textarea class="s-textarea" name="about" rows="4" placeholder="Brief description about your website...">{{ $settings->about }}</textarea>
                        </div>

                        <p class="s-section-title"><i class="fa fa-google"></i> Google Integrations</p>
                        <div class="s-row s-row-2">
                            <div class="s-form-group">
                                <label class="s-label">Google Analytics ID</label>
                                <div class="s-input-group">
                                    <i class="fa fa-bar-chart s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="google_analytics_id" value="{{ $settings->google_analytics_id }}" placeholder="G-XXXXXXXXXX or UA-XXXXX-X">
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Search Console Verification</label>
                                <div class="s-input-group">
                                    <i class="fa fa-check-circle s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="google_search_console" value="{{ $settings->google_search_console }}" placeholder="Verification meta content value">
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="s-btn s-btn-primary s-btn-lg"><i class="fa fa-save"></i> Save SEO Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
             TAB 3 : LOGO & FAVICON
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
        <div class="tab-pane" id="tab-logos">
            <form action="{{ route('admin.settings.images-update') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="s-row s-row-3">
                    {{-- Logo Light --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon purple"><i class="fa fa-image"></i></div>
                                <div>
                                    <div class="s-card-title">Logo (Light)</div>
                                    <div class="s-card-subtitle">Main site logo</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-img-preview-box" onclick="document.getElementById('logoInput').click()">
                                <img id="previewLogo" src="{{ $settings->logo ? asset('storage/' . $settings->logo) : 'https://placehold.co/200x80?text=Logo' }}" alt="Logo">
                                <span class="s-img-upload-btn"><i class="fa fa-upload"></i> Click to upload</span>
                            </div>
                            <input type="file" id="logoInput" name="logo" accept="image/*" class="d-none" onchange="previewImg(this,'previewLogo')">
                            <div class="mt-2" style="color:var(--set-muted);font-size:.75rem;">PNG, JPG, SVG, WebP — max 2MB</div>
                        </div>
                    </div>

                    {{-- Logo Dark --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon blue"><i class="fa fa-moon-o"></i></div>
                                <div>
                                    <div class="s-card-title">Logo (Dark Mode)</div>
                                    <div class="s-card-subtitle">Used for dark backgrounds</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-img-preview-box" onclick="document.getElementById('logoDarkInput').click()">
                                <img id="previewLogoDark" src="{{ $settings->logo_dark ? asset('storage/' . $settings->logo_dark) : 'https://placehold.co/200x80/1e293b/6366f1?text=Dark+Logo' }}" alt="Dark Logo">
                                <span class="s-img-upload-btn"><i class="fa fa-upload"></i> Click to upload</span>
                            </div>
                            <input type="file" id="logoDarkInput" name="logo_dark" accept="image/*" class="d-none" onchange="previewImg(this,'previewLogoDark')">
                        </div>
                    </div>

                    {{-- Favicon --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon orange"><i class="fa fa-star"></i></div>
                                <div>
                                    <div class="s-card-title">Favicon</div>
                                    <div class="s-card-subtitle">Browser tab icon (32×32)</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-img-preview-box" onclick="document.getElementById('faviconInput').click()">
                                <img id="previewFavicon" src="{{ $settings->favicon ? asset('storage/' . $settings->favicon) : 'https://placehold.co/64x64?text=ICO' }}" alt="Favicon" style="max-height:80px;">
                                <span class="s-img-upload-btn"><i class="fa fa-upload"></i> Click to upload</span>
                            </div>
                            <input type="file" id="faviconInput" name="favicon" accept="image/*" class="d-none" onchange="previewImg(this,'previewFavicon')">
                            <div class="mt-2" style="color:var(--set-muted);font-size:.75rem;">ICO, PNG, JPG — max 512KB</div>
                        </div>
                    </div>

                    {{-- Apple Touch Icon --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon teal"><i class="fa fa-apple"></i></div>
                                <div>
                                    <div class="s-card-title">Apple Touch Icon</div>
                                    <div class="s-card-subtitle">iOS home screen icon (180×180)</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-img-preview-box" onclick="document.getElementById('appleTouchInput').click()">
                                <img id="previewAppleTouch" src="{{ $settings->apple_touch_icon ? asset('storage/' . $settings->apple_touch_icon) : 'https://placehold.co/180x180?text=Apple' }}" alt="Apple Touch Icon" style="max-height:80px;">
                                <span class="s-img-upload-btn"><i class="fa fa-upload"></i> Click to upload</span>
                            </div>
                            <input type="file" id="appleTouchInput" name="apple_touch_icon" accept="image/*" class="d-none" onchange="previewImg(this,'previewAppleTouch')">
                        </div>
                    </div>

                    {{-- OG Image --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon green"><i class="fa fa-share-square-o"></i></div>
                                <div>
                                    <div class="s-card-title">Open Graph Image</div>
                                    <div class="s-card-subtitle">Social share preview (1200×630)</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-img-preview-box" onclick="document.getElementById('ogImageInput').click()">
                                <img id="previewOgImage" src="{{ $settings->og_image ? asset('storage/' . $settings->og_image) : 'https://placehold.co/1200x630/1e293b/fff?text=OG+Image' }}" alt="OG Image">
                                <span class="s-img-upload-btn"><i class="fa fa-upload"></i> Click to upload</span>
                            </div>
                            <input type="file" id="ogImageInput" name="og_image" accept="image/*" class="d-none" onchange="previewImg(this,'previewOgImage')">
                        </div>
                    </div>

                    {{-- Main Image --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon red"><i class="fa fa-picture-o"></i></div>
                                <div>
                                    <div class="s-card-title">Main Banner Image</div>
                                    <div class="s-card-subtitle">Homepage hero image</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-img-preview-box" onclick="document.getElementById('mainImageInput').click()">
                                <img id="previewMainImage" src="{{ $settings->image ? asset('storage/' . $settings->image) : 'https://placehold.co/800x400?text=Banner' }}" alt="Main Image">
                                <span class="s-img-upload-btn"><i class="fa fa-upload"></i> Click to upload</span>
                            </div>
                            <input type="file" id="mainImageInput" name="main_image" accept="image/*" class="d-none" onchange="previewImg(this,'previewMainImage')">
                        </div>
                    </div>
                </div>

                <div class="text-end mt-2">
                    <button type="submit" class="s-btn s-btn-primary s-btn-lg"><i class="fa fa-cloud-upload"></i> Upload All Images</button>
                </div>
            </form>
        </div>

        {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
             TAB 4 : SOCIAL MEDIA
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
        <div class="tab-pane" id="tab-social">
            <div class="s-card">
                <div class="s-card-header">
                    <div class="s-card-header-left">
                        <div class="s-card-icon blue"><i class="fa fa-share-alt"></i></div>
                        <div>
                            <div class="s-card-title">Social Media Links</div>
                            <div class="s-card-subtitle">Connect your social profiles</div>
                        </div>
                    </div>
                </div>
                <div class="s-card-body">
                    <form action="{{ route('admin.social-media-settings.update') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="s-row s-row-2">
                            @php
                            $socials = [
                                ['name'=>'fbPage',    'label'=>'Facebook Page',    'icon'=>'fa-facebook-official', 'color'=>'#1877f2', 'placeholder'=>'https://facebook.com/yourpage', 'val'=>$settings->fbPage],
                                ['name'=>'tgChannel', 'label'=>'Telegram Channel', 'icon'=>'fa-telegram',          'color'=>'#0088cc', 'placeholder'=>'https://t.me/yourchannel', 'val'=>$settings->tgChannel],
                                ['name'=>'ytChannel', 'label'=>'YouTube Channel',  'icon'=>'fa-youtube-play',      'color'=>'#ff0000', 'placeholder'=>'https://youtube.com/c/yourchannel', 'val'=>$settings->ytChannel],
                                ['name'=>'wpGroup',   'label'=>'WhatsApp Group',   'icon'=>'fa-whatsapp',          'color'=>'#25d366', 'placeholder'=>'https://chat.whatsapp.com/xxx', 'val'=>$settings->wpGroup],
                                ['name'=>'instagram', 'label'=>'Instagram',        'icon'=>'fa-instagram',         'color'=>'#e1306c', 'placeholder'=>'https://instagram.com/yourprofile', 'val'=>$settings->instagram],
                                ['name'=>'twitter',   'label'=>'Twitter / X',      'icon'=>'fa-twitter',           'color'=>'#1da1f2', 'placeholder'=>'https://twitter.com/yourhandle', 'val'=>$settings->twitter],
                                ['name'=>'linkedin',  'label'=>'LinkedIn',         'icon'=>'fa-linkedin-square',   'color'=>'#0a66c2', 'placeholder'=>'https://linkedin.com/in/yourprofile', 'val'=>$settings->linkedin],
                            ];
                            @endphp
                            @foreach($socials as $social)
                            <div class="s-form-group">
                                <label class="s-label">
                                    <i class="fa {{ $social['icon'] }}" style="color:{{ $social['color'] }}; margin-right:4px;"></i>
                                    {{ $social['label'] }}
                                </label>
                                <input type="{{ in_array($social['name'], ['fbPage','ytChannel','wpGroup','instagram','twitter','linkedin']) ? 'url' : 'text' }}"
                                    class="s-input" name="{{ $social['name'] }}"
                                    value="{{ $social['val'] }}"
                                    placeholder="{{ $social['placeholder'] }}">
                            </div>
                            @endforeach
                        </div>
                        <div class="text-end">
                            <button type="submit" class="s-btn s-btn-primary s-btn-lg"><i class="fa fa-save"></i> Save Social Links</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
             TAB 5 : EMAIL SMTP
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
        <div class="tab-pane" id="tab-smtp">
            <div class="s-row s-row-2">
                <div class="s-card" style="grid-column: 1 / -1;">
                    <div class="s-card-header">
                        <div class="s-card-header-left">
                            <div class="s-card-icon orange"><i class="fa fa-envelope"></i></div>
                            <div>
                                <div class="s-card-title">SMTP Configuration</div>
                                <div class="s-card-subtitle">Outgoing email server settings</div>
                            </div>
                        </div>
                        @if($settings->smtp_host)
                        <span class="s-status active"><span class="dot"></span> Configured</span>
                        @else
                        <span class="s-status inactive"><span class="dot"></span> Not Configured</span>
                        @endif
                    </div>
                    <div class="s-card-body">
                        <div class="s-info-box">
                            <i class="fa fa-info-circle"></i>
                            <p>These settings override your <code>.env</code> MAIL_* values at runtime. Passwords are encrypted before storage. Use "Test Email" to verify your configuration.</p>
                        </div>
                        <form action="{{ route('admin.settings.smtp.update') }}" method="POST" id="smtpForm">
                            @csrf @method('PUT')
                            <div class="s-row s-row-2">
                                <div class="s-form-group">
                                    <label class="s-label">SMTP Host <span class="required">*</span></label>
                                    <div class="s-input-group">
                                        <i class="fa fa-server s-input-group-icon"></i>
                                        <input type="text" class="s-input" name="smtp_host" value="{{ $settings->smtp_host }}" placeholder="smtp.gmail.com" required>
                                    </div>
                                </div>
                                <div class="s-form-group">
                                    <label class="s-label">SMTP Port <span class="required">*</span></label>
                                    <div class="s-input-group">
                                        <i class="fa fa-plug s-input-group-icon"></i>
                                        <input type="number" class="s-input" name="smtp_port" value="{{ $settings->smtp_port ?? 587 }}" placeholder="587" min="1" max="65535" required>
                                    </div>
                                </div>
                                <div class="s-form-group">
                                    <label class="s-label">SMTP Username <span class="required">*</span></label>
                                    <div class="s-input-group">
                                        <i class="fa fa-user s-input-group-icon"></i>
                                        <input type="text" class="s-input" name="smtp_username" value="{{ $settings->smtp_username }}" placeholder="your@email.com" required>
                                    </div>
                                </div>
                                <div class="s-form-group">
                                    <label class="s-label">SMTP Password <span class="hint-badge">Leave blank to keep current</span></label>
                                    <div class="s-input-group" style="position:relative;">
                                        <i class="fa fa-lock s-input-group-icon"></i>
                                        <input type="password" class="s-input s-input-password" name="smtp_password" id="smtpPassword" placeholder="Enter new password to update">
                                        <button type="button" class="s-password-toggle" onclick="togglePassword('smtpPassword', this)"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                                <div class="s-form-group">
                                    <label class="s-label">Encryption <span class="required">*</span></label>
                                    <select class="s-select" name="smtp_encryption" required>
                                        <option value="tls" {{ ($settings->smtp_encryption ?? 'tls') === 'tls' ? 'selected' : '' }}>TLS (Recommended)</option>
                                        <option value="ssl" {{ ($settings->smtp_encryption ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                        <option value="none" {{ ($settings->smtp_encryption ?? '') === 'none' ? 'selected' : '' }}>None</option>
                                    </select>
                                </div>
                                <div class="s-form-group">
                                    <label class="s-label">From Name <span class="required">*</span></label>
                                    <div class="s-input-group">
                                        <i class="fa fa-id-card s-input-group-icon"></i>
                                        <input type="text" class="s-input" name="mail_from_name" value="{{ $settings->mail_from_name ?? $settings->name }}" placeholder="My News Site" required>
                                    </div>
                                </div>
                                <div class="s-form-group" style="grid-column: 1 / -1;">
                                    <label class="s-label">From Email Address <span class="required">*</span></label>
                                    <div class="s-input-group">
                                        <i class="fa fa-at s-input-group-icon"></i>
                                        <input type="email" class="s-input" name="mail_from_address" value="{{ $settings->mail_from_address }}" placeholder="no-reply@yourdomain.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="s-btn s-btn-primary"><i class="fa fa-save"></i> Save SMTP Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Test Email Card --}}
                <div class="s-card" style="grid-column: 1 / -1;">
                    <div class="s-card-header">
                        <div class="s-card-header-left">
                            <div class="s-card-icon green"><i class="fa fa-send"></i></div>
                            <div>
                                <div class="s-card-title">Send Test Email</div>
                                <div class="s-card-subtitle">Verify your SMTP configuration works</div>
                            </div>
                        </div>
                    </div>
                    <div class="s-card-body">
                        <form action="{{ route('admin.settings.smtp.test') }}" method="POST">
                            @csrf
                            <div class="s-row s-row-2" style="align-items:flex-end;">
                                <div class="s-form-group" style="margin:0;">
                                    <label class="s-label">Send Test Email To</label>
                                    <div class="s-input-group">
                                        <i class="fa fa-envelope s-input-group-icon"></i>
                                        <input type="email" class="s-input" name="test_email" placeholder="your@email.com" required>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="s-btn s-btn-success"><i class="fa fa-paper-plane"></i> Send Test Email</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
             TAB 6 : TELEGRAM
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
        <div class="tab-pane" id="tab-telegram">
            <div class="s-row s-row-2">

                {{-- Telegram Configuration --}}
                <div class="s-card">
                    <div class="s-card-header">
                        <div class="s-card-header-left">
                            <div class="s-card-icon blue"><i class="fa fa-telegram"></i></div>
                            <div>
                                <div class="s-card-title">Telegram Configuration</div>
                                <div class="s-card-subtitle">Bot, groups & channel links</div>
                            </div>
                        </div>
                    </div>
                    <div class="s-card-body">
                        <form action="{{ route('admin.settings.telegram.update') }}" method="POST">
                            @csrf @method('PUT')

                            <p class="s-section-title"><i class="fa fa-link"></i> Channel & Group Links</p>
                            <div class="s-form-group">
                                <label class="s-label">Telegram Channel Link</label>
                                <div class="s-input-group">
                                    <i class="fa fa-telegram s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="tg_channel" value="{{ $settings->tgChannel }}" placeholder="https://t.me/yourchannel">
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Telegram Group Link</label>
                                <div class="s-input-group">
                                    <i class="fa fa-users s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="tg_group_link" value="{{ $settings->tg_group_link }}" placeholder="https://t.me/yourgroup">
                                </div>
                            </div>

                            <p class="s-section-title"><i class="fa fa-robot"></i> Bot Configuration</p>
                            <div class="s-form-group">
                                <label class="s-label">Bot Token <span class="hint-badge">From @BotFather</span></label>
                                <div class="s-input-group" style="position:relative;">
                                    <i class="fa fa-key s-input-group-icon"></i>
                                    <input type="password" class="s-input s-input-password" name="tg_bot_token" id="tgBotToken"
                                        value="{{ $settings->tg_bot_token_decrypted }}" placeholder="1234567890:AABBccDDee...">
                                    <button type="button" class="s-password-toggle" onclick="togglePassword('tgBotToken',this)"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Channel/Group Chat ID <span class="hint-badge">For auto-posting</span></label>
                                <div class="s-input-group">
                                    <i class="fa fa-hashtag s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="tg_chat_id" value="{{ $settings->tg_chat_id }}" placeholder="-100XXXXXXXXXX">
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">Admin Personal Chat ID <span class="hint-badge">For confirmations</span></label>
                                <div class="s-input-group">
                                    <i class="fa fa-user-circle s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="tg_admin_chat_id" value="{{ $settings->tg_admin_chat_id }}" placeholder="Your personal chat ID from @userinfobot">
                                </div>
                            </div>

                            <p class="s-section-title"><i class="fa fa-toggle-on"></i> Automation</p>
                            <div class="s-toggle-group">
                                <div class="s-toggle-info">
                                    <h6>Auto-post to Channel/Group</h6>
                                    <p>Automatically post new articles to Telegram</p>
                                </div>
                                <label class="s-toggle">
                                    <input type="checkbox" name="tg_auto_post" value="1" {{ $settings->tg_auto_post ? 'checked' : '' }}>
                                    <span class="s-toggle-slider"></span>
                                </label>
                            </div>
                            <div class="s-toggle-group">
                                <div class="s-toggle-info">
                                    <h6>Send Confirmation to Personal Chat</h6>
                                    <p>Get a confirmation when articles are posted</p>
                                </div>
                                <label class="s-toggle">
                                    <input type="checkbox" name="tg_send_confirmation" value="1" {{ $settings->tg_send_confirmation ? 'checked' : '' }}>
                                    <span class="s-toggle-slider"></span>
                                </label>
                            </div>

                            <div class="text-end mt-3">
                                <button type="submit" class="s-btn s-btn-primary"><i class="fa fa-save"></i> Save Telegram Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Telegram Tools & Status --}}
                <div>
                    {{-- Bot Info --}}
                    <div class="s-card mb-4">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon green"><i class="fa fa-info-circle"></i></div>
                                <div>
                                    <div class="s-card-title">Bot Details</div>
                                    <div class="s-card-subtitle">Fetch info from Telegram API</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <form action="{{ route('admin.settings.telegram.fetch-bot') }}" method="POST">
                                @csrf
                                <button type="submit" class="s-btn s-btn-info w-100"><i class="fa fa-refresh"></i> Fetch Bot Info from Telegram</button>
                            </form>
                            @if($settings->tg_bot_details)
                            <pre class="s-code-block">{{ $settings->tg_bot_details }}</pre>
                            @else
                            <div class="s-info-box mt-3">
                                <i class="fa fa-info-circle"></i>
                                <p>No bot details fetched yet. Save your bot token, then click "Fetch Bot Info".</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Webhook --}}
                    <div class="s-card mb-4">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon orange"><i class="fa fa-chain"></i></div>
                                <div>
                                    <div class="s-card-title">Webhook Setup</div>
                                    <div class="s-card-subtitle">Set/remove Telegram webhook</div>
                                </div>
                            </div>
                            @if($settings->tg_webhook_url)
                            <span class="s-status active"><span class="dot"></span> Active</span>
                            @else
                            <span class="s-status inactive"><span class="dot"></span> None</span>
                            @endif
                        </div>
                        <div class="s-card-body">
                            @if($settings->tg_webhook_url)
                            <div class="s-info-box success mb-3">
                                <i class="fa fa-check-circle"></i>
                                <p>Webhook active: <strong>{{ $settings->tg_webhook_url }}</strong></p>
                            </div>
                            @endif
                            <form action="{{ route('admin.settings.telegram.setup-webhook') }}" method="POST" class="mb-3">
                                @csrf
                                <div class="s-form-group">
                                    <label class="s-label">Webhook URL</label>
                                    <div class="s-input-group">
                                        <i class="fa fa-link s-input-group-icon"></i>
                                        <input type="url" class="s-input" name="webhook_url"
                                            value="{{ $settings->tg_webhook_url ?? url('/telegram/webhook') }}"
                                            placeholder="https://yourdomain.com/telegram/webhook" required>
                                    </div>
                                </div>
                                <button type="submit" class="s-btn s-btn-warning"><i class="fa fa-chain"></i> Set Webhook</button>
                            </form>
                            @if($settings->tg_webhook_url)
                            <form action="{{ route('admin.settings.telegram.delete-webhook') }}" method="POST">
                                @csrf
                                <button type="submit" class="s-btn s-btn-danger s-btn-sm" onclick="return confirm('Remove webhook?')">
                                    <i class="fa fa-chain-broken"></i> Remove Webhook
                                </button>
                            </form>
                            @endif
                            @if($settings->tg_webhook_details)
                            <pre class="s-code-block">{{ $settings->tg_webhook_details }}</pre>
                            @endif
                        </div>
                    </div>

                    {{-- Test Message --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon teal"><i class="fa fa-paper-plane"></i></div>
                                <div>
                                    <div class="s-card-title">Test Bot Message</div>
                                    <div class="s-card-subtitle">Send test to your personal chat</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-info-box">
                                <i class="fa fa-info-circle"></i>
                                <p>Sends a test message to your <strong>Admin Personal Chat ID</strong>. Use <a href="https://t.me/userinfobot" target="_blank" style="color:var(--set-primary);">@userinfobot</a> to get your chat ID.</p>
                            </div>
                            <form action="{{ route('admin.settings.telegram.test') }}" method="POST">
                                @csrf
                                <button type="submit" class="s-btn s-btn-success w-100" {{ !$settings->tg_bot_token || !$settings->tg_admin_chat_id ? 'disabled' : '' }}>
                                    <i class="fa fa-send"></i> Send Test Message to Admin Chat
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
             TAB 7 : WEB PUSH
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
        <div class="tab-pane" id="tab-webpush">
            <div class="s-row s-row-2">
                <div class="s-card">
                    <div class="s-card-header">
                        <div class="s-card-header-left">
                            <div class="s-card-icon purple"><i class="fa fa-bell"></i></div>
                            <div>
                                <div class="s-card-title">Web Push Configuration</div>
                                <div class="s-card-subtitle">VAPID keys for push notifications</div>
                            </div>
                        </div>
                        <span class="s-status {{ $settings->web_push_enabled ? 'active' : 'inactive' }}">
                            <span class="dot {{ $settings->web_push_enabled ? 'online-dot' : '' }}"></span>
                            {{ $settings->web_push_enabled ? 'Enabled' : 'Disabled' }}
                        </span>
                    </div>
                    <div class="s-card-body">
                        <div class="s-info-box">
                            <i class="fa fa-info-circle"></i>
                            <p>Web Push uses the VAPID protocol. Generate a key pair below, or use keys from your push service (OneSignal, Firebase, etc.). Private keys are stored encrypted.</p>
                        </div>
                        <form action="{{ route('admin.settings.webpush.update') }}" method="POST">
                            @csrf @method('PUT')
                            <div class="s-form-group">
                                <label class="s-label">Application Name</label>
                                <div class="s-input-group">
                                    <i class="fa fa-tag s-input-group-icon"></i>
                                    <input type="text" class="s-input" name="push_app_name" value="{{ $settings->push_app_name ?? $settings->name }}" placeholder="My News App">
                                </div>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">VAPID Public Key</label>
                                <textarea class="s-textarea" name="vapid_public_key" rows="3" id="vapidPublic" placeholder="BNtBxxxxx... (VAPID public key)">{{ $settings->vapid_public_key }}</textarea>
                            </div>
                            <div class="s-form-group">
                                <label class="s-label">VAPID Private Key <span class="hint-badge">Encrypted</span></label>
                                <textarea class="s-textarea" name="vapid_private_key" rows="3" id="vapidPrivate" placeholder="Leave blank to keep current key">{{ '' }}</textarea>
                                <div style="font-size:.75rem;color:var(--set-muted);margin-top:4px;">
                                    @if($settings->vapid_private_key) <i class="fa fa-lock text-success"></i> Private key is saved and encrypted. Leave blank to keep it. @else Not set yet. @endif
                                </div>
                            </div>
                            <div class="s-toggle-group mb-4">
                                <div class="s-toggle-info">
                                    <h6>Enable Web Push Notifications</h6>
                                    <p>Allow visitors to subscribe to push notifications</p>
                                </div>
                                <label class="s-toggle">
                                    <input type="checkbox" name="web_push_enabled" value="1" {{ $settings->web_push_enabled ? 'checked' : '' }}>
                                    <span class="s-toggle-slider"></span>
                                </label>
                            </div>
                            <button type="submit" class="s-btn s-btn-primary"><i class="fa fa-save"></i> Save Push Settings</button>
                        </form>
                    </div>
                </div>

                <div>
                    {{-- VAPID Key Generator --}}
                    <div class="s-card mb-4">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon green"><i class="fa fa-key"></i></div>
                                <div>
                                    <div class="s-card-title">VAPID Key Generator</div>
                                    <div class="s-card-subtitle">Generate new key pair</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            <div class="s-info-box warning">
                                <i class="fa fa-exclamation-triangle"></i>
                                <p>Generating new keys will invalidate all existing push subscriptions. All users must re-subscribe.</p>
                            </div>
                            <button type="button" class="s-btn s-btn-warning w-100 mb-3" onclick="generateVapidKeys()">
                                <i class="fa fa-refresh"></i> Generate New VAPID Keys
                            </button>
                            <div id="generatedKeys" style="display:none;">
                                <div class="s-section-title"><i class="fa fa-check-circle text-success"></i> Generated Keys</div>
                                <div class="s-form-group">
                                    <label class="s-label">Public Key</label>
                                    <div class="vapid-key-display" id="genPublic">—</div>
                                </div>
                                <div class="s-form-group">
                                    <label class="s-label">Private Key</label>
                                    <div class="vapid-key-display" id="genPrivate">—</div>
                                </div>
                                <button type="button" class="s-btn s-btn-info s-btn-sm" onclick="copyVapidToForm()">
                                    <i class="fa fa-clipboard"></i> Copy to Form
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Push Service Guides --}}
                    <div class="s-card">
                        <div class="s-card-header">
                            <div class="s-card-header-left">
                                <div class="s-card-icon teal"><i class="fa fa-book"></i></div>
                                <div>
                                    <div class="s-card-title">Push Services Guide</div>
                                    <div class="s-card-subtitle">Popular push notification providers</div>
                                </div>
                            </div>
                        </div>
                        <div class="s-card-body">
                            @php
                            $services = [
                                ['name'=>'OneSignal',  'url'=>'https://onesignal.com',  'desc'=>'Free plan, easy setup', 'icon'=>'fa-bell'],
                                ['name'=>'Firebase FCM','url'=>'https://firebase.google.com','desc'=>'Google\'s push service','icon'=>'fa-google'],
                                ['name'=>'Pusher Beams','url'=>'https://pusher.com/beams','desc'=>'Simple API, scalable','icon'=>'fa-bolt'],
                                ['name'=>'Vapid.io',   'url'=>'https://vapid.io',       'desc'=>'Standard VAPID implementation', 'icon'=>'fa-key'],
                            ];
                            @endphp
                            @foreach($services as $svc)
                            <a href="{{ $svc['url'] }}" target="_blank" style="text-decoration:none;">
                                <div class="s-toggle-group mb-2">
                                    <div class="s-toggle-info">
                                        <h6><i class="fa {{ $svc['icon'] }}" style="margin-right:6px;"></i>{{ $svc['name'] }}</h6>
                                        <p>{{ $svc['desc'] }}</p>
                                    </div>
                                    <i class="fa fa-external-link" style="color:var(--set-muted);"></i>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end settings-body --}}
</div>{{-- end settings-page --}}

{{-- ═══════════════════════════════════════════════════════════════
     JAVASCRIPT
═══════════════════════════════════════════════════════════════ --}}
<script>
// ── Tab Switching ──
document.querySelectorAll('.nav-tab').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.nav-tab').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
        // Remember tab
        localStorage.setItem('settingsActiveTab', btn.dataset.tab);
    });
});
// Restore last tab
(function() {
    var last = localStorage.getItem('settingsActiveTab');
    if (last) {
        var btn = document.querySelector('[data-tab="' + last + '"]');
        if (btn) btn.click();
    }
})();

// ── Image Preview ──
function previewImg(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ── Password Toggle ──
function togglePassword(inputId, btn) {
    var input = document.getElementById(inputId);
    var icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fa fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fa fa-eye';
    }
}

// ── VAPID Key Generation ──
function generateVapidKeys() {
    var btn = event.target;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Generating...';

    fetch('{{ route("admin.settings.webpush.generate-vapid") }}', {
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('genPublic').textContent  = data.vapid_public  || data.public_key  || 'Error';
        document.getElementById('genPrivate').textContent = data.vapid_private || data.private_key || 'Error';
        document.getElementById('generatedKeys').style.display = 'block';
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-refresh"></i> Generate New VAPID Keys';
    })
    .catch(err => {
        alert('Error generating keys: ' + err.message);
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-refresh"></i> Generate New VAPID Keys';
    });
}

function copyVapidToForm() {
    var pub  = document.getElementById('genPublic').textContent;
    var priv = document.getElementById('genPrivate').textContent;
    document.getElementById('vapidPublic').value  = pub;
    document.getElementById('vapidPrivate').value = priv;
    alert('Keys copied to form! Review and save the settings.');
}
</script>

@include('admin.inc.footer')
