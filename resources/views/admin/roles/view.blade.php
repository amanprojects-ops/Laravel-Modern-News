@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Role</h2>
            </div>
        </div>
    </div>

    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><a href="{{ route('admin.roles.create') }}" class="btn cur-p btn-primary"><i
                                        class="fa fa-plus"></i> New</a>
                            </h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Role Name</th>
                                        <th>Status</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($roles->count() > 0)
                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucwords($role->role) }}</td>
                                                <td>
                                                    <form action="{{ route('admin.roles.updateStatus', $role->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" name="status"
                                                            value="{{ $role->status == 1 ? 0 : 1 }}"
                                                            class="btn btn-sm {{ $role->status == 0 ? 'btn-danger' : 'btn-success' }}"
                                                            onclick="return confirm('Are you sure you want to {{ $role->status == 0 ? 'activate' : 'deactivate' }} this role?')">
                                                            {{ $role->status == 0 ? 'Deactivated' : 'Activated' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($role->updated_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">No roles found</td>
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
