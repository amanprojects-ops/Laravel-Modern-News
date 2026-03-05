@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>View Users</h2>
            </div>
        </div>
    </div>

    <div class="row column4 graph">
        <div class="white_shd full margin_bottom_30">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2><a href="{{ route('admin.users.create') }}" class="btn cur-p btn-primary"><i
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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Last Login</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->isNotEmpty())
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->mobile }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ ucwords($user->role_name) }}</td>
                                                <td>
                                                    <form action="{{ route('admin.users.updateStatus', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" name="status"
                                                            value="{{ $user->status == 1 ? 0 : 1 }}"
                                                            onclick="return confirm('Are you sure you want to {{ $user->status == 1 ? 'deactivate' : 'activate' }} this user?')"
                                                            class="btn btn-sm btn-{{ $user->status == 0 ? 'danger' : 'success' }}">
                                                            {{ $user->status == 0 ? 'Deactivated' : 'Activated' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                                <td>{{ $user->last_login ? date('d M Y H:i A', strtotime($user->last_login)) : 'Never' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">No users found.</td>
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
