@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="p-4">
                        <a href="{{ route('adduserdetails') }}" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add User</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 8%">Serial No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users) > 0)
                            @php($sl = 1)

                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(count($user->roles) > 0)
                                                @foreach ($rolewithperms as $roles)
                                                    @if($user->hasRole($roles->role_name))
                                                        {{ $roles->role_name }}
                                                    @endif
                                                @endforeach
                                            @else
                                                No Role Given
                                            @endif
                                        </td>
                                        <td>
                                            <h5>Default Permissions: </h5>
                                            <ul>
                                                @foreach ($rolewithperms as $roles)
                                                    @foreach ($roles->permissions as $perms)
                                                        @if($user->hasPermissionThroughRole($perms))
                                                            <li>{{ $perms->permission_name }}</li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                            <br>
                                            @if(count($user->permissions) > 0)
                                                <h5>Additional Permissions: </h5>
                                                <ul>
                                                    @foreach($user->permissions as $perm)
                                                        <li>{{ $perm->permission_name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#edituser{{ $user->id }}">
                                            <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="edituser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit User Details
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="user" method="POST" action="{{ url('update-user-details') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                                        <input type="text" class="form-control col-lg-12 mb-3" name="username" value="{{ $user->name }}">
                                                                        <input type="email" class="form-control col-lg-12 mb-3" name="useremail" value="{{ $user->email }}">
                                                                        <div class="card col-md-10 m-3 p-2 border-left-primary">
                                                                            <div class="card-body">
                                                                                <h5>Roles :</h5>
                                                                                <hr>
                                                                                @foreach ($rolewithperms as $key => $rolenm)
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" id="selectRole{{ $key }}" type="radio" name="rolename" value="{{ $rolenm->role_name }}"
                                                                                        @if($user->hasRole($rolenm->role_name)) checked @endif>
                                                                                        <label class="form-check-label" for="selectRole{{ $key }}">
                                                                                            {{ ucfirst($rolenm->role_name) }}
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <div class="card col-md-10 m-3 p-2 border-left-primary">
                                                                            <div class="card-body">
                                                                                <h5>Default Permissions :</h5>
                                                                                <hr>
                                                                                @foreach ($permissions as $perm)
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" id="selectPermission" type="checkbox" value="{{ $perm->permission_name}}" name="permname[]"
                                                                                    @if($user->hasPermissionThroughRole($perm))
                                                                                    checked disabled
                                                                                    @elseif($user->hasPermission($perm->permission_name))
                                                                                    checked
                                                                                    @endif
                                                                                    >
                                                                                    <label class="form-check-label" for="selectPermission">
                                                                                        {{ ucfirst($perm->permission_name) }}
                                                                                    </label>
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="userid" value="{{ $user->id }}">
                                                                    </div>
                                                                    <br>
                                                                    <div class="col-sm-4">
                                                                        <button type="submit" class="btn btn-primary btn-block">
                                                                            {{ __('Save changes') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteuser{{ $user->id }}">
                                            <i class="fas fa-trash"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteuser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Delete User Details
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="user" method="POST" action="{{ url('delete-user-details') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                                        <p>Are sure want to delete?</p>
                                                                        <input type="hidden" name="userid" value="{{ $user->id }}">
                                                                        <input type="hidden" name="action" value="delete">
                                                                    </div>

                                                                    <div class="col-sm-4">
                                                                        <button type="submit" class="btn btn-primary btn-block">
                                                                            {{ __('Confirm') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php($sl++)
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">No data Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@include('common.footer')
