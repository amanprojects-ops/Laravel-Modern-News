@php
    use Illuminate\Support\Facades\Request;
    use Illuminate\Support\Facades\DB;

    // Get clean URLs and request information
    $url = filter_var(Request::getSchemeAndHttpHost(), FILTER_SANITIZE_URL);
    $requestUrl = filter_var(Request::fullUrl(), FILTER_SANITIZE_URL);
    $page = basename(Request::path());
    $key = basename(Request::url());
    $settings = \App\Models\Setting::first();
    // SEO metadata handler
    function generateSEOMetadata($data, $url)
    {
        return [
            'title' => $data['title'] ?? '',
            'keywords' => $data['keywords'],
            'description' => substr($data['description'], 0, 160),
            'favicon' => $url . 'storage/images/' . ($data['favicon'] ?? 'default.ico'),
            'image' => $url . 'storage/' . ($data['image_path'] ?? 'storage/' . $data['image']),
            'canonical' => $url . ($data['canonical_path'] ?? ''),
        ];
    }

    // Handle different page types
    switch ($page) {
        case 'post':
            $category_name = Str::of($key)->replace('-', ' ')->trim();
            $postdata = DB::table('categories')->where('status', 1)->where('name', $category_name)->first();

            $seo = generateSEOMetadata(
                [
                    'title' => Str::slug(ucwords($postdata->category_name)) . ' | ' . ucwords($postdata->categoryTitle),
                    'keywords' => $postdata->category_name . ', ' . $postdata->title,
                    'description' => $postdata->title,
                    'image_path' => 'storage/category_images/' . $settings->image,
                    'canonical_path' => '/post/' . $key,
                ],
                $url,
            );
            break;

        case 'view-post':
            $postdata = DB::table('posts')->where('status', 1)->where('id', $key)->first();

            $seo = generateSEOMetadata(
                [
                    'title' => $postdata->title,
                    'keywords' => $postdata->post_keywords,
                    'description' => $postdata->short_description,
                    'image_path' => 'post_images/' . $postdata->image,
                    'canonical_path' => "/view-post/{$key}",
                ],
                $url,
            );
            break;

        default:
            $domain = parse_url($url, PHP_URL_HOST);
            $extension = pathinfo($domain, PATHINFO_EXTENSION);

            $seo = generateSEOMetadata(
                [
                    'title' => sprintf(
                        '%s | %s.%s | %s',
                        $settings['name'],
                        strtolower($settings['name']),
                        $extension,
                        $settings['title'],
                    ),
                    'keywords' => $settings['keywords'],
                    'description' => $settings['description'],
                    'image_path' => 'storage/images/' . $settings['image'],
                    'canonical_path' => '/' . $key,
                ],
                $url,
            );
    }

    // Assign SEO variables
    $title = $seo['title'];
    $keywords = $seo['keywords'];
    $description = $seo['description'];
    $favicon = $seo['favicon'];
    $postImage = $seo['image'];
    $pageUrl = $seo['canonical'];

    // Helper function for settings cache
    function getCachedSettings()
    {
        static $settings = null;
        if ($settings === null) {
            $settings = DB::table('settings')->first();
        }
        return $settings;
    }
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? ucwords($settings->name) }}</title>
    <link rel='index' title='{{ $settings->name }}' href='{{ asset('') }}'>
    <link rel='canonical' href='{{ $pageUrl }}'>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="subject" content="{{ $settings['title'] }}">
    <meta name="copyright" content="{{ $settings['name'] }}">
    <meta name="robots" content="index,follow">
    <meta name="topic"
        content="Government Exam Update, Jobs, Results, Admit Card, Answerkey, Notification,farmers related schemes">
    <meta name="url" content="{{ asset('') }}">
    <meta name="identifier-URL" content="{{ asset('') }}">
    <meta name="directory" content="submission">
    <meta name="pagename" content="{{ $title }}">
    <meta name="category" content="News">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta name="revisit-after" content="Daily">
    <meta name="subtitle" content="{{ $settings['title'] }}">
    <meta name="target" content="all">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="medium" content="blog">
    <meta name="pageKey" content="guest-home">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="news_keywords" content="{{ $title }}">
    <meta name="Classification" content="Daily News">
    <meta name="theme-color" content="#ab183d">
    <!-- Mobile-first CSS -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/mobile-first.css">
    <!-- Keeping original CSS for backward compatibility -->
    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ asset('') }}manifest.json">
    <link rel="shortcut icon" href="{{ asset('uploads/' . $settings->favicon) }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('') }}/assets/web-kits/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('') }}/assets/web-kits/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('') }}/assets/web-kits/favicon-16x16.png">
    <link rel="mask-icon" href="{{ asset('') }}assets/web-kits/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta name="msapplication-TileColor" content="#2e67d9">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $pageUrl }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $postImage }}">
    <meta property="og:site_name" content="{{ $settings['name'] }}">
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $pageUrl }}">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $postImage }}">
    <meta name="twitter:site" content="{{ $settings['name'] }}">
    <!-- Base URL -->
    <base href="{{ $url }}">
</head>

<body>
    <div itemscope itemtype="https://schema.org/WebSite">
        <meta itemprop="url" content="{{ asset('') }}" />
        <meta itemprop="name" content="{{ $settings['name'] }}" />
    </div>
    <!-- SabkeBot PWA Installation Assistant -->
    <div id="sabkebot-container" class="sabkebot-container">
        <div class="sabkebot-content">
            <div class="sabkebot-header">
                <img src="{{ asset('assets/web-kits/android-chrome-192x192.png') }}" alt="EIBBot"
                    class="sabkebot-avatar">
                <div class="sabkebot-title">
                    <h3>SabkeBot</h3>
                    <small>Your TazBlog Assistant</small>
                </div>
                <button id="close-sabkebot" class="sabkebot-close" aria-label="Close SabkeBot">&times;</button>
            </div>
            <div class="sabkebot-message">
                <p>Welcome to {{ $settings['name'] }}! ðŸ‘‹</p>
                <p>For faster access to breaking news, add our app to your home screen!</p>
                <ul class="sabkebot-benefits">
                    <li>âœ“ Instant access anytime</li>
                    <li>âœ“ Smooth, app-like experience</li>
                    <li>âœ“ No need to open a browser</li>
                </ul>
                <button id="install-pwa-btn" class="sabkebot-install-btn">Install App</button>
            </div>
        </div>
    </div>

    <div itemscope itemtype="https://schema.org/Organization">
        <div class="container">
            <header class="heading">
                <a href="{{ url('home') }}" aria-label="{{ $settings['name'] }}">
                    <img class="heading-logo" src="{{ asset('uploads/' . $settings->logo) }}"
                        alt="{{ $settings['name'] }}" loading="lazy"
                        style="width: 150px; height: 50px; border-radius: 5%; object-fit: cover;">
                </a>
                <div class="web-content">
                    <h1 class="head-title font-bold tracking-wide text-lg md:text-2xl lg:text-3xl xl:text-4xl"
                        style="animation: fadeIn 0.5s ease-in-out; animation-fill-mode: backwards;color:white;">
                        {{ $settings['name'] ?? 'ExamInfoBlog' }}
                    </h1>
                </div>
            </header>

            <style>
                .navbar {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    align-items: center;
                    background: #222;
                    padding: 10px;
                    transition: all 0.3s ease;
                }

                .navbar ul {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    align-items: center;
                    list-style: none;
                    margin: 0;
                    padding: 0;
                    transition: all 0.3s ease;
                }

                .navbar li {
                    margin: 0 10px;
                    transition: all 0.3s ease;
                }

                .navbar a {
                    color: #fff;
                    text-decoration: none;
                    transition: all 0.3s ease;
                }

                .navbar a:hover {
                    color: #ff3b30;
                    transform: scale(1.1);
                }

                .nav-toggle {
                    display: none;
                    cursor: pointer;
                    font-size: 1.5rem;
                    color: #000000;
                    margin-left: auto;
                    transition: transform 0.3s ease;
                }

                .nav-toggle.active {
                    transform: rotate(90deg);
                }

                @media (max-width: 767px) {
                    .navbar {
                        flex-direction: column;
                    }

                    .navbar ul {
                        display: none;
                        flex-direction: column;
                    }

                    .navbar.active ul {
                        display: flex;
                        animation: fadeIn 0.3s ease-in-out;
                    }

                    .navbar li {
                        margin: 10px 0;
                    }

                    .nav-toggle {
                        display: block;
                    }

                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                        }

                        100% {
                            opacity: 1;
                        }
                    }
                }
            </style>
            <nav class="navbar" aria-label="Main Navigation">
                <button class="nav-toggle" aria-label="Toggle Navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <ul>
                    @php
                        $currentRouteName = Route::currentRouteName();
                        $activeClass = 'active';
                        $categorys = \App\Models\Categorie::whereRaw('main_nav = 1 && status = 1')->get();
                    @endphp
                    <li><a href="{{ route('home') }}" aria-label="Home Page">HOME</a></li>
                    @foreach ($categorys as $category)
                        <li>
                            <a href="{{ route('view-category', Str::slug($category->name)) }}"
                                aria-label="{{ $category->name }}">{{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        {{-- Content Area --}}
        @yield('content')
        {{-- Content Area end --}}

        <style>
            /* Add styles for mobile-first design */
            .footer {
                background: #222;
                color: #fff;
                padding: 40px 0 20px 0;
                font-family: 'Segoe UI', Arial, sans-serif;
            }

            .footer-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                max-width: 1100px;
                margin: 0 auto;
                gap: 30px;
            }

            .footer-col {
                flex: 1 1 250px;
                min-width: 220px;
            }

            .footer-col h4 {
                font-size: 1.1rem;
                margin-bottom: 18px;
                color: #ffb347;
                letter-spacing: 1px;
            }

            .footer-about {
                margin-bottom: 20px;
            }

            .footer-social {
                display: flex;
                gap: 12px;
                margin-top: 12px;
            }

            .social-whatsapp,
            .social-facebook,
            .social-youtube,
            .social-telegram {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 34px;
                height: 34px;
                border-radius: 50%;
                background: #333;
                color: #fff;
                font-size: 1.2rem;
                transition: background 0.2s, color 0.2s;
            }

            .social-whatsapp {
                background: #25d366;
            }

            .social-facebook {
                background: #1877f2;
            }

            .social-youtube {
                background: #ff0000;
            }

            .social-telegram {
                background: #0088cc;
            }

            .social-whatsapp:hover,
            .social-facebook:hover,
            .social-youtube:hover,
            .social-telegram:hover {
                background: #ffb347;
                color: #222;
            }

            .footer-bottom {
                text-align: center;
                margin-top: 30px;
                font-size: 0.95rem;
                color: #bbb;
            }

            .footer-bottom a {
                color: #ffb347;
                text-decoration: none;
                font-weight: bold;
            }

            @media (max-width: 800px) {
                .footer-container {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 30px;
                }
            }

            .back-to-top {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: #333;
                color: #fff;
                padding: 10px;
                border-radius: 50%;
                font-size: 1.2rem;
                cursor: pointer;
            }

            .back-to-top:hover {
                background: #ffb347;
                color: #222;
            }
        </style>

        <!-- Back to top button -->
        <a href="#" class="back-to-top" aria-label="Back to top"><i class="fas fa-chevron-up"></i></a>

        <footer class="footer">
            <div class="container">
                <div class="footer-container">
                    <div class="footer-col">
                        <h4>About Us</h4>
                        <div class="footer-about">
                            <a href="{{ asset('') }}" aria-label="Home Page"
                                class="text-secondary fw-bold">{{ strtoupper($settings['name']) }}</a>
                            {{ $settings['about'] }}
                        </div>
                        <div class="footer-social">
                            <a href="{{ $settings['wpGroup'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="{{ strtoupper($settings['name']) }} Whatsapp Channel"
                                class="social-whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="{{ $settings['fbPage'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="{{ strtoupper($settings['name']) }} Facebook Page"
                                class="social-facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $settings['ytChannel'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="{{ strtoupper($settings['name']) }} Youtube Channel"
                                class="social-youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="{{ $settings['tgChannel'] }}" target="_blank" rel="noopener noreferrer"
                                aria-label="{{ strtoupper($settings['name']) }} Telegram Channel"
                                class="social-telegram">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('sitemap') }}">Site Map</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Latest Updates</h4>
                        <ul>
                            @forelse(\App\Models\Post::where('status', 1)->latest()->take(8)->get() as $post)
                                <li><a href="{{ route('view-blog', $post->slug == null ? Str::slug($post->title) : $post->slug) }}"
                                        aria-label="{{ Str::limit($post->title, 30) }}">{{ Str::limit($post->title, 30) }}</a>
                                </li>
                            @empty
                                <li>No Record Found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2019-{{ date('Y') }} | {{ $settings['name'] }} | Created By
                        <a href="https://devbin.site/" aria-label="Website Creator Developer" target="_blank"
                            rel="noopener noreferrer">Technical Aman</a>
                    </p>
                </div>
            </div>
        </footer>

        <!-- JavaScript for mobile-first design -->
        <script src="{{ asset('assets/js/mobile-app.js') }}"></script>
        <!-- Font Awesome CDN (Version 5.5.0 example) -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
            integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
            crossorigin="anonymous">
    </div>
</body>

</html>

