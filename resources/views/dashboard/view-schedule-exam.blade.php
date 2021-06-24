@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">
                <div class="pt-4 pr-4 pb-4">
                    <a href="{{ route('listscheduledexam') }}" class="btn btn-secondary btn-icon-split">
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
                <h6 class="m-0 font-weight-bold text-primary">Add Exam Details</h6>
            </div>

            <div class="row">
                <div class="col-sm-8 col-md-12">
                    <div class="p-4">
                        <form class="user" method="POST" action="{{ url('schedule-exam') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-3 p-2">
                                    <select class="form-control" name="subject" id="choosesubj" required>
                                        <option value="--Select Subject--">--Select Subject--</option>
                                        @foreach ($subjects as $subj)
                                            <option value="{{ $subj->id }}">{{ $subj->subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 p-2">
                                    <input type="text" class="form-control" name="semester" id="getsem" placeholder="Select Subject First" readonly required>
                                    <input type="hidden" name="semid" id="getsemid">
                                </div>
                                <div class="col-md-3 p-2">
                                    <input type="text" class="form-control" name="department" id="getdept" placeholder="Select Subject First" readonly required>
                                    <input type="hidden" name="deptid" id="getdeptid">
                                </div>
                                <div class="col-md-3 p-2">
                                    <select class="form-control" name="section" required>
                                        <option value="--Select Section--">--Select Section--</option>
                                        <option value="A">Section A</option>
                                        <option value="B">Section B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3 p-2">
                                    <input type="text" class="form-control @error('pass_marks') is-invalid @enderror" name="pass_marks" placeholder="Pass Marks" required>

                                    @error('pass_marks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-3 p-2">
                                    <input type="text" class="form-control @error('full_marks') is-invalid @enderror" name="full_marks" placeholder="Full Marks" required>

                                    @error('full_marks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 p-2">
                                    <input type="text" class="form-control @error('total_question') is-invalid @enderror" name="total_question" placeholder="Total Number of Questions" required>

                                    @error('total_question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 p-2">
                                    <input type="date" class="form-control" name="exam_date" placeholder="Exam Date" required>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="create">

                            <div class="form-group row mb-0">
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Schedule') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        $("#choosesubj").on('change', function() {
            var subid = $("#choosesubj").val();
            if(subid == '--Select Subject--') {
                alert('Please select a subject!');
            }
            else {

                $.ajax({

                    url: "{{ url('get-subj-details') }}",
                    type: "get",
                    data: { subjid: subid },
                    dataType: "json",
                    complete: function(data) {
                        var getdata = JSON.parse(JSON.stringify(data));
                        $("#getsem").val(getdata.responseJSON.getdata.semesters[0].semester_no);
                        $("#getsemid").val(getdata.responseJSON.getdata.sem_id);
                        $("#getdept").val(getdata.responseJSON.getdata.departments[0].dept_name);
                        $("#getdeptid").val(getdata.responseJSON.getdata.dept_id);
                    }
                });
            }
        });
    </script>

@include('common.footer')
