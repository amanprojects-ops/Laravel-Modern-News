<?php $__env->startSection('content'); ?>
    <style>
        .single-post table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            background: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
        }

        .single-post th,
        .single-post td {
            padding: 12px 16px;
            text-align: left;
        }

        .single-post th {
            background: #f1f3f6;
            color: #333;
            font-weight: 600;
            width: 150px;
        }

        .single-post td.post-td {
            color: #444;
            background: #fff;
        }

        .color-red {
            color: #e74c3c;
        }

        .social-media ul {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            list-style: none;
            padding: 0;
            margin: 16px 0 20px 0;
            justify-content: flex-start;
        }

        .social-media li {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
        }

        .social-media li:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
        }

        .bg-green {
            background: #25d366;
        }

        .bg-blue {
            background: #1877f2;
        }

        .bg-red {
            background: #ff3b30;
        }

        .bg-purpal {
            background: #833ab4;
        }

        .bg-dark {
            background: #222;
        }

        .social-media a {
            color: #fff;
            font-size: 1.3em;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .social-media a:focus,
        .social-media a:hover {
            color: #fff200;
            outline: none;
        }

        .post-description {
            margin: 20px 0;
            font-size: 1em;
            line-height: 1.6;
            color: #222;
            background: #f7fafd;
            padding: 16px;
            border-radius: 8px;
        }

        .group-links table {
            width: 100%;
            border-collapse: collapse;
            margin: 16px 0;
            background: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
        }

        .group-links th,
        .group-links td {
            padding: 10px 14px;
            text-align: left;
        }

        .group-links th {
            background: #f1f3f6;
            color: #333;
            font-weight: 600;
        }

        .group-links td span {
            padding: 5px 12px;
            border-radius: 6px;
            color: #fff;
            font-weight: 500;
            display: inline-block;
        }

        .group-links .bg-blue {
            background: #1877f2;
        }

        .group-links .bg-green {
            background: #25d366;
        }

        .group-links .bg-red {
            background: #ff3b30;
        }

        .post-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 16px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .post-disclaimer {
            font-size: 0.9em;
            background: #fff3f3;
            border-left: 4px solid #e74c3c;
            padding: 10px 16px;
            border-radius: 6px;
            margin: 16px 0;
            max-width: 100%;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 10px;
            }

            .single-post {
                width: 100%;
                padding-top: 3rem;
            }

            .single-post th {
                width: 120px;
                font-size: 0.9em;
            }

            .single-post td {
                font-size: 0.9em;
            }

            .social-media ul {
                gap: 10px;
            }

            .social-media li {
                width: 36px;
                height: 36px;
            }
        }

        @media (max-width: 480px) {
            .single-post th {
                width: 100px;
                font-size: 0.85em;
            }

            .post-description {
                font-size: 0.9em;
                padding: 12px;
            }
        }
    </style>
    <div class="container">
        <div class="single-post">
            <div class="post-header animate__animated animate__fadeIn">
                <h1 class="post-title"><?php echo e($post->title); ?></h1>
                <p class="post-subtitle"><?php echo e($post->short_description); ?></p>
                <div class="post-meta">
                    <span class="post-date animate__animated animate__fadeInRight">
                        <i class="fa-regular fa-calendar-alt"></i>
                        <?php echo e(date('d M, Y H:i:s', strtotime($post->created_at))); ?>

                    </span>
                </div>
                <style>
                    .post-header {
                        background: linear-gradient(to right, #f8f9fa, #ffffff);
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
                        margin-bottom: 25px;
                    }

                    .post-title {
                        color: #333;
                        font-size: 28px;
                        margin-bottom: 10px;
                        font-weight: 700;
                        border-bottom: 2px solid #f1f1f1;
                        padding-bottom: 8px;
                    }

                    .post-subtitle {
                        color: #555;
                        font-size: 16px;
                        margin-bottom: 15px;
                        line-height: 1.5;
                    }

                    .post-meta {
                        display: flex;
                        align-items: center;
                    }

                    .post-date {
                        color: #666;
                        font-size: 14px;
                        display: inline-flex;
                        align-items: center;
                        gap: 5px;
                        background: #f1f3f6;
                        padding: 5px 10px;
                        border-radius: 20px;
                    }
                </style>
            </div>
            <?php
                $settings = App\Models\Setting::selectRaw('tgChannel, wpGroup, ytChannel, fbPage, disclaimer')->first();
                $slug = $post->slug == null ? Str::slug($post->title) : $post->slug;
                $share_links = [
                    'whatsappUrl' =>
                        'https://api.whatsapp.com/send?text=' .
                        urlencode('Check out this post: ' . route('view-blog', $slug)),
                    'telegramUrl' => 'https://t.me/share/url?url=' . urlencode(route('view-blog', $slug)),
                    'facebookUrl' =>
                        'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(route('view-blog', $slug)),
                    'twitterUrl' => 'https://twitter.com/intent/tweet?url=' . urlencode(route('view-blog', $slug)),
                    'linkedinUrl' =>
                        'https://www.linkedin.com/shareArticle?url=' . urlencode(route('view-blog', $slug)),
                ];
            ?>
            <div class="social-media">
                <h4 class="share-title">Share This Post</h4>
                <ul class="share-icons">
                    <li class="bg-green animate__animated animate__pulse"><a href="<?php echo e($share_links['whatsappUrl']); ?>"
                            title="Share on WhatsApp" aria-label="Share on WhatsApp"><i
                                class="fa-brands fa-whatsapp"></i></a></li>
                    <li class="bg-blue animate__animated animate__pulse animate__delay-1s"><a
                            href="<?php echo e($share_links['telegramUrl']); ?>" title="Share on Telegram"
                            aria-label="Share on Telegram"><i class="fa-brands fa-telegram"></i></a></li>
                    <li class="bg-blue animate__animated animate__pulse animate__delay-2s"><a
                            href="<?php echo e($share_links['facebookUrl']); ?>" title="Share on Facebook"
                            aria-label="Share on Facebook"><i class="fa-brands fa-facebook"></i></a></li>
                    <li class="bg-blue animate__animated animate__pulse animate__delay-3s"><a
                            href="<?php echo e($share_links['twitterUrl']); ?>" title="Share on Twitter"
                            aria-label="Share on Twitter"><i class="fa-brands fa-twitter"></i></a></li>
                    <li class="bg-blue animate__animated animate__pulse animate__delay-4s"><a
                            href="<?php echo e($share_links['linkedinUrl']); ?>" title="Share on LinkedIn"
                            aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin"></i></a></li>
                </ul>
                <style>
                    .social-media {
                        padding: 15px;
                        background: #f8f9fa;
                        border-radius: 10px;
                        margin: 20px 0;
                        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
                    }

                    .share-title {
                        font-size: 18px;
                        margin-bottom: 12px;
                        color: #444;
                        text-align: center;
                        font-weight: 600;
                    }

                    .share-icons {
                        justify-content: center !important;
                    }

                    .social-media li {
                        transition: all 0.3s ease !important;
                        cursor: pointer;
                    }

                    .social-media li:hover {
                        transform: translateY(-5px) scale(1.1) !important;
                    }

                    .social-media a {
                        position: relative;
                        overflow: hidden;
                    }

                    .social-media a:after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(255, 255, 255, 0.2);
                        border-radius: 50%;
                        transform: scale(0);
                        transition: transform 0.3s ease;
                    }

                    .social-media a:hover:after {
                        transform: scale(1);
                    }
                </style>
            </div>

            <div class="post-description animate__animated animate__fadeIn">
                <div class="post-content">
                    <?php echo $post->description; ?>

                </div>
                <div class="post-separator">
                    <span class="separator-icon"><i class="fa fa-star"></i></span>
                </div>
            </div>

            <div class="group-links">
                <div class="social-button-container">
                    <a href="<?php echo e($settings->tgChannel); ?>" class="social-button telegram">
                        <i class="fa-brands fa-telegram"></i>
                        <span class="button-text">Subscribe</span>
                    </a>

                    <a href="<?php echo e($settings->wpGroup); ?>" class="social-button whatsapp">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span class="button-text">Join Now</span>
                    </a>

                    <a href="<?php echo e($settings->ytChannel); ?>" class="social-button youtube">
                        <i class="fa-brands fa-youtube"></i>
                        <span class="button-text">Subscribe</span>
                    </a>

                    <a href="<?php echo e($settings->fbPage); ?>" class="social-button facebook">
                        <i class="fa-brands fa-facebook"></i>
                        <span class="button-text">Follow Us</span>
                    </a>
                </div>
            </div>
            <?php
                if (Storage::disk('public')->exists($post->image)) {
                    $post_image = asset('storage/' . $post->image);
                } else {
                    $post_image = asset('storage/post_images/' . $post->image);
                }
            ?>
            <div class="post-image-container">
                <img class="post-image-animated" src="<?php echo e($post_image); ?>" alt="<?php echo e($post->title); ?>" loading="lazy">
            </div>
            <style>
                .social-button-container {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 12px;
                    justify-content: center;
                    margin: 20px 0;
                }

                .social-button {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    padding: 10px 16px;
                    border-radius: 30px;
                    color: white;
                    font-weight: 500;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .social-button:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
                }

                .social-button i {
                    font-size: 1.2em;
                }

                .telegram {
                    background: linear-gradient(135deg, #0088cc, #0077b5);
                }

                .whatsapp {
                    background: linear-gradient(135deg, #25d366, #128C7E);
                }

                .youtube {
                    background: linear-gradient(135deg, #ff0000, #c4302b);
                }

                .facebook {
                    background: linear-gradient(135deg, #3b5998, #4267B2);
                }

                .post-image-container {
                    text-align: center;
                    margin: 24px 0;
                    overflow: hidden;
                    border-radius: 12px;
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
                }

                .post-image-animated {
                    max-width: 100%;
                    height: auto;
                    transition: transform 0.5s ease;
                    display: block;
                    margin: 0 auto;
                }

                .post-image-animated:hover {
                    transform: scale(1.02);
                }

                @media (max-width: 576px) {
                    .social-button-container {
                        flex-direction: column;
                    }

                    .social-button {
                        width: 100%;
                        justify-content: center;
                    }
                }
            </style>
        </div>
    </div>
    <p class="post-disclaimer">
        <span class="disclaimer-title">Disclaimer:</span>
        <?php echo e($settings->disclaimer); ?>

    </p>
    <style>
        .post-disclaimer {
            background-color: #fff8f8;
            border-left: 4px solid #ff3b30;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 0 8px 8px 0;
            font-size: 14px;
            line-height: 1.6;
            color: #555;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .disclaimer-title {
            display: block;
            font-weight: 700;
            color: #ff3b30;
            margin-bottom: 8px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\www\modern-news\resources\views/frontend/view-post.blade.php ENDPATH**/ ?>