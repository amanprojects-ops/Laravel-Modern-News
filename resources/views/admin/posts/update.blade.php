@include('admin.inc.header')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Update Article</h2>
            </div>
        </div>
    </div>
    <div class='container-fluid flex-grow-1 container-p-y'>
        <div class='container my-5'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='col-xl'>
                        <div class='card mb-4'>
                            <div class='card-header d-flex justify-content-between align-items-center'>
                                <h5 class='mb-0'>Update Article</h5>
                            </div>
                            <div class='card-body'>
                                <form action='{{ route('admin.posts.update', $post->id) }}' method='POST'
                                    enctype='multipart/form-data'>
                                    @csrf
                                    @method('PUT')
                                    <div class='mb-3'>
                                        <label class='form-label' for='title'>Title <span
                                                class='text-danger fs-5'>*</span></label>
                                        <input type='text' class='form-control' id='title' name='title'
                                            value='{{ $post->title }}' required>
                                        <div class='form-text text-danger'>Title of the article under 60 characters
                                        </div>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='short_description'>Short Description
                                            <span class='text-danger fs-5'>*</span></label>
                                        <input type='text' class='form-control' id='short_description'
                                            name='short_description' value='{{ $post->short_description }}' required>
                                        <div class='form-text text-danger'>Short description of the article under 160
                                            characters
                                        </div>
                                    </div>
                                    <div class='mb-3'>
                                        <label class='form-label' for='keywords'>Keywords <span
                                                class='text-danger fs-5'>*</span></label>
                                        <input type='text' class='form-control' id='keywords' name='keywords'
                                            value='{{ substr($post->post_keywords, 0, 255) ?? $post->post_keywords }}'
                                            placeholder="Enter keywords" required>
                                        <div class='form-text text-danger'>Keywords for the article, separated by commas
                                            and no
                                            spaces under 255 characters</div>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='feature_image' class='form-label'>Feature Image
                                            <span class='text-danger fs-5'>*</span>
                                        </label>
                                        <input type='file' name='feature_image' class='form-control mb-4'
                                            id='feature_image' accept='image/*'
                                            onchange='document.getElementById("featuredimagepreview").src = window.URL.createObjectURL(this.files[0])'>

                                        <div class='card mb-4'>
                                            <img class='card-img' id='featuredimagepreview'
                                                style='width: 100%; height: auto; object-fit: cover;'
                                                src='{{ \App\Helpers\UploadHelper::url($post->image, 'post_images') }}'
                                                alt='{{ $post->title }}'>
                                        </div>
                                        <div class='form-text text-danger'>Upload a feature image for the
                                            article. Recommended size:
                                            1200x630 pixels.</div>
                                        <input type='hidden' name='old_category' value='{{ $post->id }}'>
                                    </div>

                                    <div class='mb-3'>
                                        <label for='category' class='form-label'>Category
                                            <span class='text-danger fs-5'>*</span>
                                        </label>
                                        @php
                                            $categories = DB::table('categories')
                                                ->where('status', 1)
                                                ->orderBy('name', 'asc')
                                                ->get();
                                        @endphp
                                        <select class='form-control' id='category' name='category'
                                            aria-label='Category' required>

                                            @if ($categories->count() > 0)
                                                @foreach ($categories as $category)
                                                    <option value='{{ $category->id }}'
                                                        @if ($category->id == $post->category_id) selected @endif>
                                                        {{ ucwords($category->name) }}</option>
                                                @endforeach
                                            @else
                                                <option selected>Categories not found</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class='mb-3'>
                                        <label class='form-label' for='Content'>Content
                                            <span class='text-danger fs-5'>*</span>
                                        </label>
                                        <textarea id='description' name='content' class='form-control' cols="30" rows="5" required>{{ $post->description }}</textarea>
                                    </div>
                                    <button type='submit' class='btn btn-primary'>Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.inc.footer')

