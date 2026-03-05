@extends('layouts.app')
@section('content')
    <style>
        h1 {
            color: #6c2eb7;
            font-size: 2.2rem;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        hr {
            border: 0;
            border-top: 2px solid #eee;
            margin-bottom: 18px;
        }

        ul.post-list {
            list-style: none;
            padding: 0;
        }

        ul.post-list li {
            margin: 18px 0;
            padding: 14px 18px;
            background: #f7f3fa;
            border-radius: 8px;
            transition: background 0.2s;
        }

        ul.post-list li:hover {
            background: #e8dff7;
        }

        a.post-link {
            font-weight: 700;
            color: #6c2eb7;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        a.post-link:hover {
            color: #3e1763;
        }

        span.arrows {
            margin-right: 10px;
            font-size: 1.2em;
        }

        span.post-date {
            color: #555;
            font-size: 0.98em;
            margin-left: 18px;
            font-weight: 400;
        }
    </style>
    <div class="container">
        <table cellspacing="0" cellpadding="0" style="width:100%;">
            <thead>
                <tr>
                    <th>
                        <h1>{{ Str::upper($category) }}</h1>
                        <hr>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <ul class="post-list">
                            @forelse($posts as $post)
                                <li>
                                    <a class="post-link"
                                        href="{{ route('view-blog', $post->slug == null ? Str::slug($post->title) : $post->slug) }}">
                                        <span>
                                            <span class="arrows">&#10148;</span>
                                            <span title="{{ $post->meta_title }}">{{ Str::limit($post->title, 100) }}</span>
                                        </span>
                                        <span class="post-date">Updated At: {{ date('d M Y', strtotime($post->updated_at)) }}
                                        </span>
                                    </a>
                                </li>
                            @empty
                                <li>No {{ ucwords($category) }} Posts found.</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination-wrapper">
            <ul class="pagination">
                <li class="pagination-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                    <a class="pagination-link" href="{{ $posts->previousPageUrl() }}" aria-label="@lang('pagination.previous')">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
                @for ($i = 1; $i <= $posts->lastPage(); $i++)
                    <li class="pagination-item {{ $posts->currentPage() == $i ? 'active' : '' }}">
                        <a class="pagination-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="pagination-item {{ $posts->currentPage() == $posts->lastPage() ? 'disabled' : '' }}">
                    <a class="pagination-link" href="{{ $posts->nextPageUrl() }}" aria-label="@lang('pagination.next')">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </div>

        <style>
            .pagination-wrapper {
                display: flex;
                justify-content: center;
                margin-top: 15px;
            }

            .pagination {
                display: flex;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .pagination-item {
                margin: 0 5px;
            }

            .pagination-item.disabled a {
                color: #ddd;
                cursor: not-allowed;
            }

            .pagination-link {
                font-size: 1.2em;
                display: block;
                width: 40px;
                height: 40px;
                line-height: 40px;
                text-align: center;
                border-radius: 50%;
                background-color: #f5f5f5;
                color: #333;
                transition: all 0.3s ease;
            }

            .pagination-link:hover {
                background-color: #ddd;
            }

            .pagination-link.active {
                background-color: #333;
                color: #fff;
            }
        </style>


    </div>
@endsection
