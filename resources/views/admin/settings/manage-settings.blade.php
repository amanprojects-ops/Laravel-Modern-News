@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Manage Website Settings</h2>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Website Basic Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.general.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="name">Website Name <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="30"
                                    value="{{ $settings->name }}" required>
                                <div class="form-text">Name of your website</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Website Title <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $settings->title }}" maxlength="60" required>
                                <div class="form-text">Title of your website</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="url">Url <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" class="form-control" id="url" name="url"
                                    value="{{ $settings->url }}">
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Website Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.basic.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="about">About Us
                                    <span class="text-danger fs-5">*</span>
                                </label>
                                <textarea name="about" id="about" class="form-control" cols="30" rows="5">{{ $settings->about }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="keywords">Keywords
                                    <span class="text-danger fs-5">*</span>
                                </label>
                                <textarea name="keywords" id="keywords" class="form-control" cols="30" rows="10">{{ $settings->keywords }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Description
                                    <span class="text-danger fs-5">*</span>
                                </label>
                                <textarea name="description" class="form-control" cols="30" rows="5" required>{{ $settings->description }}</textarea>
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Social Media Links</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.social-media-settings.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="facebook">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook"
                                    value="{{ $settings->fbPage }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="telegram">Telegram</label>
                                <input type="text" class="form-control" id="telegram" name="telegram"
                                    value="{{ $settings->tgChannel }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="youtube">YouTube Channel</label>
                                <input type="text" class="form-control" id="youtube" name="youtube"
                                    value="{{ $settings->ytChannel }}">
                            </div>
                            <div class="mb-3">
                                <label for="wpGroup" class="form-label">Whatsapp Group</label>
                                <input type="text" class="form-control" id="wpGroup" name="wpGroup"
                                    value="{{ $settings->wpGroup }}">
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Logo & Favicon</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.images-update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo"
                                    onchange='document.getElementById("previewLogo").src = window.URL.createObjectURL(this.files[0])'>

                                {{-- show image --}}
                                <img id="previewLogo" src="{{ asset('storage/' . $settings->logo) }}" alt="Logo"
                                    class="img-fluid mt-2" style="max-width: 200px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="favicon">Favicon</label>
                                <input type="file" class="form-control" id="favicon" name="favicon"
                                    onchange="document.getElementById('previewFavicon').src = window.URL.createObjectURL(this.files[0])">

                                {{-- show image --}}
                                <img id="previewFavicon" src="{{ asset('storage/' . $settings->favicon) }}"
                                    alt="Favicon" class="img-fluid mt-2" style="max-width: 200px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="main_image">Main Image</label>
                                <input type="file" class="form-control" id="main_image" name="main_image"
                                    onchange="document.getElementById('previewMainImage').src = window.URL.createObjectURL(this.files[0])">

                                {{-- show image --}}
                                <img id="previewMainImage" src="{{ asset('storage/' . $settings->image) }}"
                                    alt="Main Image" class="img-fluid mt-2" style="max-width: 200px;">
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.inc.footer')
