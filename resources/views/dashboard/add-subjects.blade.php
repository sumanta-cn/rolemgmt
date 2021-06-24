@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Subjects</h6>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="p-4">
                        <form class="user" method="POST" action="{{ url('add-subjects') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select class="form-control" name="department" required>
                                        <option value="--Select Department--">--Select Department--</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <select class="form-control" name="semester" required>
                                        <option value="--Select Semester--">--Select Semester--</option>
                                        @foreach ($semesters as $sem)
                                            <option value="{{ $sem->id }}">{{ $sem->semester_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control" name="subj_name" placeholder="Subject Name" required>
                                    <input type="hidden" name="action" value="create">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                            @if(Session::has('suberror') != null)
                                {{ Session::get('suberror') }}
                            @endif
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
                                <th>Department</th>
                                <th>Semester</th>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($subjects) > 0)
                            @php($sl = 1)

                                @foreach ($subjects as $subj)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        @foreach($subj->departments as $dept)
                                            <td>{{ $dept->dept_name }}</td>
                                        @endforeach

                                        @foreach($subj->semesters as $sem)
                                            <td>{{ $sem->semester_no }}</td>
                                        @endforeach

                                        <td>{{ $subj->subject_code }}</td>
                                        <td>{{ $subj->subject_name }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#editsubj{{ $subj->id }}">
                                            <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editsubj{{ $subj->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Subject
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="user" method="POST" action="{{ url('update-subjects') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                                                        <input type="text" class="form-control mb-3" name="subj_name" value="{{ $subj->subject_name }}">
                                                                        <select class="form-control mb-3" name="department" required>
                                                                            <option value="--Select Department--">--Select Department--</option>
                                                                            @foreach ($departments as $dept)
                                                                                <option value="{{ $dept->id }}"
                                                                                    @if($subj->dept_id == $dept->id)
                                                                                    selected
                                                                                    @endif>
                                                                                    {{ $dept->dept_name}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <select class="form-control mb-3" name="semester" required>
                                                                            <option value="--Select Semester--">--Select Semester--</option>
                                                                            @foreach ($semesters as $sem)
                                                                                <option value="{{ $sem->id }}"
                                                                                    @if($subj->sem_id == $sem->id)
                                                                                    selected
                                                                                    @endif>
                                                                                    {{ $sem->semester_no}}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <input type="text" class="form-control mb-3" value="{{ $subj->subject_code }}" readonly>

                                                                        <input type="hidden" name="subjid" value="{{ $subj->id }}">
                                                                        <input type="hidden" name="action" value="update">
                                                                    </div>

                                                                    <div class="col-sm-4 mt-3">
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
                                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deletesubj{{ $subj->id }}">
                                            <i class="fas fa-trash"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deletesubj{{ $subj->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Subject
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="user" method="POST" action="{{ url('delete-subjs') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                                        <p>Are sure want to delete?</p>
                                                                        <input type="hidden" name="subjid" value="{{ $subj->id }}">
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
                                    <td colspan="6" class="text-center">No data Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@include('common.footer')
