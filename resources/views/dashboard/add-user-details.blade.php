@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">
                <div class="pt-4 pr-4 pb-4">
                    <a href="{{ route('viewuser') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add User Details</h6>
            </div>

            <div class="row">
                <div class="col-sm-8 col-md-12">
                    <div class="p-4">
                        <form class="user" method="POST" action="{{ url('add-user-details') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-6 p-2">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 p-2">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 p-2">
                                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no" placeholder="Contact Number" required>

                                    @error('contact_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 p-2">
                                    <select class="form-control" name="department" required>
                                        <option value="--Select Department--">--Select Department--</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->dept_name }}">{{ $dept->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="card col-md-5 m-3 p-2 border-left-primary">
                                    <div class="card-body">
                                        <h5>Select a Role :</h5>
                                        <hr>
                                        @foreach ($roles as $key => $role)
                                            <div class="form-check">
                                                <input class="form-check-input" id="selectRole{{ $key }}" type="radio" name="rolename" value="{{ $role->role_name }}">
                                                <label class="form-check-label" for="selectRole{{ $key }}">
                                                    {{ ucfirst($role->role_name) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="card col-md-5 m-3 p-2 border-left-primary">
                                    <div class="card-body">
                                        <h5>Select Permissions :</h5>
                                        <hr>
                                        @foreach ($permissions as $key => $perm)
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

@include('common.footer')
