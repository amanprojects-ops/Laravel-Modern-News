@include('admin.inc.header')
<!-- dashboard inner -->
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-file yellow_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $posts }}</p>
                            <p class="head_couter">Posts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-file-text blue1_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $drafts }}</p>
                            <p class="head_couter">Drafts Posts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-newspaper-o green_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $active }}</p>
                            <p class="head_couter">Active Posts</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div>
                            <i class="fa fa-eye-slash red_color"></i>
                        </div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no">{{ $rejected }}</p>
                            <p class="head_couter">Rejected Posts</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row column3">
            <!-- testimonial -->
            <div class="col-md-6">
                <div class="dark_bg full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Top 10 Posts</h2>
                        </div>
                    </div>
                    <div class="full graph_revenue">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content testimonial">
                                    <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for carousel items -->
                                        <div class="carousel-inner">
                                            @foreach ($recentPosts as $post)
                                                <div class="item carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <div class="img-box"><img
                                                            src="{{ asset('storage/post_images/' . $post->image) }}"
                                                            alt="{{ $post->title }}"></div>
                                                    <p class="testimonial">{{ Str::limit($post->title, 100) }}</p>
                                                    <p class="overview">
                                                        <b>{{ $post->writer_name }}</b>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Carousel controls -->
                                        <a class="carousel-control left carousel-control-prev"
                                            href="#testimonial_slider" data-slide="prev">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                        <a class="carousel-control right carousel-control-next"
                                            href="#testimonial_slider" data-slide="next">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end testimonial -->
            <!-- progress bar -->
            <div class="col-md-6">
                <div class="dash_blog">
                    <div class="dash_blog_inner">
                        <div class="dash_head">
                            <h3>
                                <span>
                                    <i class="fa fa-file"></i> Latest Posts
                                </span>
                                <span class="plus_green_bt">
                                    <a href="{{ route('admin.posts.create') }}">+</a>
                                </span>
                            </h3>
                        </div>
                        @php
                            $latestPosts = App\Models\Post::latest()->take(5)->get();
                        @endphp
                        <div class="task_list_main">
                            <ul class="task_list">
                                @foreach ($latestPosts as $post)
                                    <li>
                                        <a href="#">{{ $post->title }}</a>
                                        <br>
                                        <strong>{{ $post->created_at->diffForHumans() }}</strong>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="read_more">
                            <div class="center"><a class="main_bt read_bt" href="{{ route('admin.posts.view') }}">Read
                                    More</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end progress bar -->
        </div>
    </div>
</div>
<!-- end dashboard inner -->

@include('admin.inc.footer')
