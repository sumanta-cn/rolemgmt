@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Exam Details</h6>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="p-4">
                        <a href="{{ route('scheduleanexam') }}" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Scedule An Exam</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Semester</th>
                                <th>Subject</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Pass Marks</th>
                                <th>Full Marks</th>
                                <th>Date</th>
                                <th>Total Questions</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($listexams) > 0)
                            @php($sl = 1)
                                @foreach ($listexams as $exam)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>
                                            @foreach ($semesters as $sem)
                                                @if($exam->sem_id == $sem->id)
                                                    {{ $sem->semester_no }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($subjects as $subj)
                                                @if($exam->subject_id == $subj->id)
                                                    {{ $subj->subject_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($departments as $dept)
                                                @if($exam->dept_id == $dept->id)
                                                    {{ $dept->dept_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $exam->section }}</td>
                                        <td>{{ $exam->pass_marks }}</td>
                                        <td>{{ $exam->full_marks }}</td>
                                        <td>{{ $exam->exam_date }}</td>
                                        <td>{{ $exam->total_question }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#edituser{{ $exam->id }}">
                                            <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="edituser{{ $exam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                            <form class="user" method="POST" action="{{ url('update-sceduled-exam') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-12 mb-3 mb-sm-0">


                                                                        <input type="hidden" name="examid" value="{{ $exam->id }}">
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
                                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteuser{{ $exam->id }}">
                                            <i class="fas fa-trash"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteuser{{ $exam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                            <form class="user" method="POST" action="{{ url('delete-sceduled-exam') }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                                        <p>Are sure want to delete?</p>
                                                                        <input type="hidden" name="examid" value="{{ $exam->id }}">
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
                                    <td colspan="10" class="text-center">No data Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@include('common.footer')
