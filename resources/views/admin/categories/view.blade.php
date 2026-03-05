@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Category</h2>
            </div>
        </div>
    </div>

    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><a href="{{ route('admin.categories.create') }}" class="btn cur-p btn-primary"><i
                                        class="fa fa-plus"></i> New</a></h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Main Nav</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucwords($category->name) }}</td>
                                                <td>{{ ucwords($category->title) }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.categories.main-navigation', $category->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" name="main_nav"
                                                            class="btn btn-sm btn-{{ $category->main_nav == 1 ? 'success' : 'danger' }}"
                                                            value="{{ $category->main_nav == 1 ? 0 : 1 }}"
                                                            onclick="return confirm('Are you sure you want to {{ $category->main_nav == 0 ? 'Activate' : 'Deactivate' }} the main navigation?')">
                                                            {{ $category->main_nav == 1 ? 'Activated' : 'Deactivated' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.categories.status-update', $category->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" name="status"
                                                            class="btn btn-sm btn-{{ $category->status == 1 ? 'success' : 'danger' }}"
                                                            value="{{ $category->status == 1 ? 0 : 1 }}"
                                                            onclick="return confirm('Are you sure you want to {{ $category->status == 0 ? 'Activate' : 'Deactivate' }} the status?')">
                                                            {{ $category->status == 1 ? 'Activated' : 'Deactivated' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>{{ date('d M Y H:i A', strtotime($category->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                    <form
                                                        action="{{ route('admin.categories.destroy', $category->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No categories found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('admin.inc.footer')
