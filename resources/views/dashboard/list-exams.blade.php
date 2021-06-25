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
                                            @foreach ($exam->semesters as $sem)
                                                {{ $sem->semester_no }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($exam->subjects as $subj)
                                                {{ $subj->subject_name }}
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($exam->departments as $dept)
                                                {{ $dept->dept_name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $exam->section }}</td>
                                        <td>{{ $exam->pass_marks }}</td>
                                        <td>{{ $exam->full_marks }}</td>
                                        <td>{{ $exam->exam_date }}</td>
                                        <td>{{ $exam->total_question }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#editexam{{ $exam->id }}">
                                            <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteexam{{ $exam->id }}">
                                            <i class="fas fa-trash"></i>
                                            </a>
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

    @foreach ($listexams as $exam)

        <!-- Modal -->
        <div class="modal fade" id="editexam{{ $exam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Exam Details
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
                                    <select class="form-control mb-3" name="subject" id="choosesubj{{ $exam->id }}" required>
                                        <option value="--Select Subject--">--Select Subject--</option>
                                        @foreach ($subjects as $subj)
                                        @foreach ($exam->subjects as $sub)
                                            <option value="{{ $subj->id }}"
                                                @if($subj->id == $sub->id)
                                                selected
                                                @endif>
                                                {{ $subj->subject_name }}
                                            </option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control mb-3" name="semester" id="getsem{{ $exam->id }}" placeholder="Select Subject First"
                                    @foreach ($exam->semesters as $sem)
                                        value="{{ $sem->semester_no }}"
                                    @endforeach
                                    readonly required>
                                    <input type="hidden" name="semid" id="getsemid{{ $exam->id }}">

                                    <input type="text" class="form-control mb-3" name="department" id="getdept{{ $exam->id }}" placeholder="Select Subject First"
                                    @foreach ($exam->departments as $dept)
                                        value="{{ $dept->dept_name }}"
                                    @endforeach
                                    readonly required>
                                    <input type="hidden" name="deptid" id="getdeptid{{ $exam->id }}">

                                    <select class="form-control mb-3" name="section" required>
                                        <option value="--Select Section--">--Select Section--</option>
                                        <option value="A" @if($exam->section == "A")
                                            selected @endif>Section A</option>
                                        <option value="B" @if($exam->section == "B")
                                            selected @endif>Section B</option>
                                    </select>
                                    <input type="text" class="form-control mb-3 @error('pass_marks') is-invalid @enderror" name="pass_marks" placeholder="Pass Marks" value="{{ $exam->pass_marks }}" required>

                                    @error('pass_marks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input type="text" class="form-control mb-3 @error('full_marks') is-invalid @enderror" name="full_marks" placeholder="Full Marks" value="{{ $exam->full_marks }}" required>

                                    @error('full_marks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input type="text" class="form-control mb-3 @error('total_question') is-invalid @enderror" name="total_question" placeholder="Total Number of Questions"
                                    value="{{ $exam->total_question }}" required>

                                    @error('total_question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input type="date" class="form-control mb-3" name="exam_date" placeholder="Exam Date" value="{{ $exam->exam_date }}" required>

                                    <input type="hidden" name="examid" value="{{ $exam->id }}">
                                    <input type="hidden" name="action" value="update">
                                </div>
                                <br>
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

        <!-- Modal -->
        <div class="modal fade" id="deleteexam{{ $exam->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Exam Details
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

        <script>
            $("#choosesubj{{ $exam->id }}").on('change', function() {
                var subid = $("#choosesubj{{ $exam->id }}").val();
                if(subid == '--Select Subject--') {
                    alert('Please select a subject!');
                    $("#getsem{{ $exam->id }}").val('');
                    $("#getsemid{{ $exam->id }}").val('');
                    $("#getdept{{ $exam->id }}").val('');
                    $("#getdeptid{{ $exam->id }}").val('');
                }
                else {

                    $.ajax({

                        url: "{{ url('get-subj-details') }}",
                        type: "get",
                        data: { subjid: subid },
                        dataType: "json",
                        complete: function(data) {
                            var getdata = JSON.parse(JSON.stringify(data));
                            $("#getsem{{ $exam->id }}").val(getdata.responseJSON.getdata.semesters[0].semester_no);
                            $("#getsemid{{ $exam->id }}").val(getdata.responseJSON.getdata.sem_id);
                            $("#getdept{{ $exam->id }}").val(getdata.responseJSON.getdata.departments[0].dept_name);
                            $("#getdeptid{{ $exam->id }}").val(getdata.responseJSON.getdata.dept_id);
                        }
                    });
                }
            });
        </script>

    @endforeach

@include('common.footer')
