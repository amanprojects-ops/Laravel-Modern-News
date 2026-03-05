@include('admin.inc.header')

<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>New Article</h2>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">New Article</h5>
                    <small class="text-muted float-end"><?php echo 'Technical Aman' . @$_SESSION['name']; ?></small>
                </div>
                <div class="card-body">
                    <div class="alert alert-dismissible" id="message" role="alert" style='display:none;'>

                    </div>
                    <form id="newPost" action="{{ route('admin.posts.save') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-post-title">Post Title <span
                                    class="text-danger fs-5">*</span></label>
                            <input type="text" class="form-control" name="post_title" value="{{ old('post_title') }}"
                                maxlength="60" placeholder="Enter Post Title">
                            <div class="form-text">Post title should be unique and descriptive. only allow upto 60
                                Characters</div>
                            @error('post_title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Short Description">Short Description
                                <span class="text-danger fs-5">*</span></label>
                            <input type="text" class="form-control" name="short_description"
                                value="{{ old('short_description') }}" maxlength="160"
                                placeholder="Enter Short Description.">
                            <div class="form-text">Short description should be unique and descriptive. only allow
                                upto 160 Characters</div>
                            @error('short_description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="post-keywords">Post Keywords <span
                                    class="text-danger fs-5">*</span></label>
                            <input type="text" class="form-control" name="post_keywords"
                                value="{{ old('post_keywords') }}" maxlength="255" placeholder="Enter Post Keywords.">
                            <div class="form-text">Post keywords should be unique and descriptive. only allow upto
                                255 Characters</div>
                            @error('post_keywords')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Feature Image
                                <span class="text-danger fs-5">*</span>
                            </label>
                            <input class="form-control mb-3" type="file" id="featureImage" name="featureImage">

                            @error('featureImage')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                            <script>
                                document.getElementById('featureImage').addEventListener('change', function() {
                                    const file = this.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            document.getElementById('featureImagePreview').src = e.target.result;
                                        }
                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>
                            <div class='card mb-4'>
                                <img class='card-img' id='featureImagePreview' src=""
                                    alt='Feature Image not selected preview not available'>
                            </div>
                            <div class="form-text">Feature image should be in jpg, jpeg, png, webp format and less than
                                2MB
                                in size.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Category
                                <span class="text-danger fs-5">*</span></label>
                            <select class="form-control" name="category" required>
                                <option selected disabled>Select Category</option>
                                @php
                                    $categories = DB::table('categories')
                                        ->where('status', 1)
                                        ->orderBy('name', 'asc')
                                        ->get();
                                    if ($categories->isEmpty()) {
                                        echo "<option value=''>No categories available</option>";
                                    }
                                @endphp
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ ucwords($category->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="basic-default-message">Post Content
                                <span class="text-danger fs-5">*</span>
                            </label>
                            <textarea name="content" id="description" class="form-control summernote"
                                placeholder="Exam Info Education Portal Create New Posts.">
                                 {{ old('content') ?? 'Exam Info Education Portal Create New Posts.' }}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.inc.footer')
