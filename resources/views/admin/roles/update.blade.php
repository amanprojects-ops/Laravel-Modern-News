@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>Update Role</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid flex-grow-1 container-p-y">

        <!-- Layout Demo -->
        <div class="container my-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="col-xl">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Update Role</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label class="form-label" for="role_name">Role Name
                                            <span class="text-danger fs-5">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="role_name" name="role_name"
                                            value="{{ old('role_name', $role->role) }}" placeholder="Enter Role Name"
                                            required>
                                        @error('role_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Permissions <span
                                                class="text-danger fs-5">*</span></label>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" id="permission_all" class="form-check-input"
                                                onclick="toggleAllPermissions(this)">
                                            <label class="form-check-label fw-bold" for="permission_all">Allow
                                                All</label>
                                        </div>
                                        @php
                                            $modules = [
                                                'user' => 'User',
                                                'category' => 'Category',
                                                'role' => 'Role',
                                                'posts' => 'Posts',
                                                'settings' => 'Settings',
                                                'message' => 'Message',
                                                'comments' => 'Comments',
                                            ];
                                            $actions = [
                                                'view' => 'View',
                                                'create' => 'Create',
                                                'edit' => 'Edit',
                                                'delete' => 'Delete',
                                            ];
                                            $permissions = json_decode($role->permissions, true);
                                        @endphp
                                        <div class="row">
                                            @foreach ($modules as $moduleKey => $moduleName)
                                                <div class="col-md-6 mb-2">
                                                    <div class="fw-bold">{{ $moduleName }}</div>
                                                    <div class="ms-3">
                                                        @foreach ($actions as $actionKey => $actionName)
                                                            @php
                                                                $permValue = $moduleKey . '.' . $actionKey;
                                                                $isChecked =
                                                                    is_array($permissions) &&
                                                                    in_array($permValue, $permissions);
                                                            @endphp
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox"
                                                                    class="form-check-input permission-checkbox"
                                                                    name="role_permission[]"
                                                                    id="permission_{{ $moduleKey }}_{{ $actionKey }}"
                                                                    value="{{ $permValue }}"
                                                                    {{ $isChecked ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="permission_{{ $moduleKey }}_{{ $actionKey }}">
                                                                    {{ $actionName }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
    <script>
        function toggleAllPermissions(source) {
            let checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(cb => cb.checked = source.checked);
        }
    </script>
    @include('admin.inc.footer')
