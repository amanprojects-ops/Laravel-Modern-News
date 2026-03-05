@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Files</h2>
            </div>
        </div>
    </div>

    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><a href="{{ route('admin.attachements.create') }}" class="btn cur-p btn-primary"><i
                                        class="fa fa-plus"></i> New</a>
                            </h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>File Title</th>
                                        <th>Slug</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($files->count() == 0)
                                        <tr>
                                            <td colspan="5" class="text-center">No files found</td>
                                        </tr>
                                    @endif
                                    @foreach ($files as $file)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $file->file_title }}</td>
                                            <td><a href="{{ $file->slug }}" target="_blank">Click Here</a></td>
                                            <td>{{ $file->created_at }}</td>
                                            <td>
                                                <form action="{{ route('admin.attachements.destroy', $file->id) }}"
                                                    method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn cur-p btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

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
