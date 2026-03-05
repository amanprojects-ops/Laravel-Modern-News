@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>New Categories</h2>
            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">

        <!-- Layout Demo -->
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">New Category</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.categories.save') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name <span
                                                class="text-danger fs-5">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter Category Name">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="title">Title
                                            <span class="text-danger fs-5">*</span>
                                        </label>
                                        <textarea id="title" name="title" class="form-control" cols="30" rows="5"
                                            placeholder="Enter Category Title."></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.inc.footer')
