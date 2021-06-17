@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Permissions</h6>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="p-4">
                        <form class="user" method="POST" action="{{ url('add-permissions') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control" name="permission_name" placeholder="Permission Name">
                                    <input type="hidden" name="action" value="create">
                                </div>

                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 8%">Serial No</th>
                                <th style="width: 90%">Permission Name</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($permissions) > 0)
                            @php($sl = 1)

                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $permission->permission_name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#editpermission{{ $permission->id }}">
                                            <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editpermission{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Permission
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="user" method="POST" action="{{ url('update-permissions') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                                        <input type="text" class="form-control" name="permission_name" value="{{ $permission->permission_name }}">
                                                                        <input type="hidden" name="permissionid" value="{{ $permission->id }}">
                                                                        <input type="hidden" name="action" value="update">
                                                                    </div>

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
                                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deletepermission{{ $permission->id }}">
                                            <i class="fas fa-trash"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deletepermission{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Permission
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="user" method="POST" action="{{ url('delete-permissions') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                                        <p>Are sure want to delete?</p>
                                                                        <input type="hidden" name="permissionid" value="{{ $permission->id }}">
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
