@include('common.header')

@include('common.topbar')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Roles</h6>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="p-4">
                    <form class="user" method="POST" action="{{ url('add-roles') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" class="form-control" name="role_name" placeholder="Role Name">
                                <input type="hidden" name="action" value="create">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="card col-md-12 m-0 p-2 border-left-primary">
                                <div class="card-body">
                                    <h5>Select Permissions :</h5>
                                    <hr>
                                    @foreach ($permissions as $perm)
                                        <div class="form-check">
                                            <input class="form-check-input" id="selectPermission" type="checkbox" value="{{ $perm->permission_name}}" name="permname[]">
                                            <label class="form-check-label" for="selectPermission">
                                                {{ ucfirst($perm->permission_name) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Serial No</th>
                                    <th style="width: 30%">Role Name</th>
                                    <th style="width: 60%">Permission Naame</th>
                                    <th colspan="2" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($roles) > 0)
                                    @php($sl = 1)

                                        @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $sl }}</td>
                                                <td>{{ $role->role_name }}</td>
                                                <td>
                                                    @if($role->permissions != '[]')
                                                        <ul type="disc">
                                                        @foreach ($role->permissions as $perm)
                                                            <li>{{ $perm->permission_name }}</li>
                                                        @endforeach
                                                        </ul>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary btn-circle" data-toggle="modal" data-target="#editrole{{ $role->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editrole{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Role
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="user" method="POST" action="{{ url('update-roles') }}">
                                                                        @csrf

                                                                        <div class="form-group row">
                                                                            <div class="col-sm-12 mb-3 mb-sm-0">
                                                                                <input type="text" class="form-control" name="role_name" value="{{ $role->role_name }}">
                                                                                <input type="hidden" name="roleid" value="{{ $role->id }}">
                                                                                <input type="hidden" name="action" value="update">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <div class="card col-md-10 m-2 p-2 border-left-primary">
                                                                                <div class="card-body">
                                                                                    <h5>Select Permissions :</h5>
                                                                                    <hr>
                                                                                    @foreach ($permissions as $perm)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" id="selectPermission" type="checkbox" value="{{ $perm->permission_name}}" name="permname[]">
                                                                                            <label class="form-check-label" for="selectPermission">
                                                                                                {{ ucfirst($perm->permission_name) }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
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
                                                    <a class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delete{{ $role->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="delete{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Role
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="user" method="POST" action="{{ url('delete-roles') }}">
                                                                        @csrf

                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                                                <p>Are sure want to delete?</p>
                                                                                <input type="hidden" name="roleid" value="{{ $role->id }}">
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
            </div>
        </div>



@include('common.footer')
