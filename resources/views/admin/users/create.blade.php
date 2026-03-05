@include('admin.inc.header')
<div class="container-fluid">
    <div class="row column_title">
        <div class="col-md-12">
            <div class="page_title">
                <h2>New User</h2>
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
                                <h5 class="mb-0">New User</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert" id="message" role="alert" style="display:none;"></div>
                                <form action="{{ route('admin.users.save') }}" id="addUser_form" method="POST"
                                    autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="Enter Username" aria-label="Enter Username"
                                                value="{{ old('username') }}">
                                            <button class="btn btn-outline-primary" type="button"
                                                id="verifyUsername">Verify Username</button>
                                        </div>
                                        <div class="form-text fw-bold" id="usernameStatus" style="display:none;"></div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="full_name">Full Name</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="text" class="form-control" id="full_name"
                                                        name="full_name" placeholder="Enter Full Name"
                                                        value="{{ old('full_name') }}"
                                                        @if (!old('full_name')) readonly @endif>
                                                    @error('full_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <div class="input-group">
                                                    <input type="email" id="email" name="email"
                                                        class="form-control" placeholder="email@example.com"
                                                        value="{{ old('email') }}"
                                                        @if (!old('email')) readonly @endif>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-text">You can use letters, numbers &amp; periods</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="mobile">Mobile No</label>
                                                <div class="input-group">
                                                    <input type="text" id="mobile" name="mobile" maxlength="10"
                                                        class="form-control phone-mask" placeholder="99999 99999"
                                                        value="{{ old('mobile') }}"
                                                        @if (!old('mobile')) readonly @endif>
                                                    @error('mobile')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-password-toggle mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password"
                                                placeholder="············" name="password"
                                                value="{{ old('password', '1234') }}"
                                                @if (!old('password')) readonly @endif>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @php
                                        $roles = \App\Models\Role::all();
                                    @endphp
                                    <div class="mb-3">
                                        <label class="form-label" for="role">User Role</label>
                                        <div class="input-group">
                                            <select class="form-control" id="role" name="role" disabled>
                                                @if ($roles->isNotEmpty())
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <option>Role not found</option>
                                                @endif
                                            </select>
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
        var username = document.getElementById('username');
        var usernameStatus = document.getElementById('usernameStatus');
        var verifyUsernameButton = document.getElementById('verifyUsername');
        var addUserButton = document.getElementById('addUser');
        var addUserForm = document.getElementById('addUser_form');
        var message = document.getElementById('message');
        var fullname = document.getElementById('full_name');
        var email = document.getElementById('email');
        var mobile = document.getElementById('mobile');
        var password = document.getElementById('password');
        var role = document.getElementById('role');
        verifyUsernameButton.addEventListener('click', function() {
            var usernameValue = username.value.trim();
            if (usernameValue === '') {
                message.textContent = 'Please enter a username.';
                message.className = 'alert alert-danger';
                message.style.display = 'block';
                usernameStatus.style.display = 'none';
                return;
            }
            fetch('{{ route('admin.users.checkUsername') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        verifyUsernameButton.disabled = true;
                        verifyUsernameButton.innerHTML =
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...';
                    },
                    body: JSON.stringify({
                        username: usernameValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.available === false) {
                        usernameStatus.textContent = 'Username is already taken.';
                        usernameStatus.className = 'text-danger fw-bold';
                        usernameStatus.style.display = 'block';
                        addUserButton.disabled = true;
                    } else {
                        usernameStatus.textContent = 'Username is available.';
                        usernameStatus.className = 'text-success fw-bold';
                        usernameStatus.style.display = 'block';
                        fullname.removeAttribute('readonly');
                        email.removeAttribute('readonly');
                        mobile.removeAttribute('readonly');
                        password.removeAttribute('readonly');
                        role.removeAttribute('disabled');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    @include('admin.inc.footer')
