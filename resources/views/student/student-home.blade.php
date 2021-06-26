@include('student.student-header')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 col-lg-12" style="padding: 0;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Exam Details</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td>Date</td>
                                                <td><b>{{ \Carbon\Carbon::parse($examdetails->exam_date)->format('d-m-Y') }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Subject</td>
                                                <td><b>{{ $examdetails->subjects[0]->subject_name }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Department</td>
                                                <td><b>{{ $examdetails->departments[0]->dept_name }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Section</td>
                                                <td><b>{{ $examdetails->section }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Full Marks</td>
                                                <td><b>{{ $examdetails->full_marks }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Pass Marks</td>
                                                <td><b>{{ $examdetails->pass_marks }}</b></td>
                                            </tr>
                                            <tr>
                                                <td>Total Question</td>
                                                <td><b>{{ $examdetails->total_question }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-body mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" id="confirmExam" type="checkbox" name="confirmexam">
                                        <label class="form-check-label" for="confirmExam">I have gone through the above details and accept to start the exam.</label>
                                    </div>
                                </div>

                                <div class="col-sm-2 mt-3">
                                    <form method="POST" action="{{ route('viewexmpage') }}">
                                        @csrf

                                        <input type="hidden" name="examid" value="{{ $examdetails->id }}">
                                        <button type="submit" class="btn btn-primary btn-block" id="startexam">
                                            {{ __('Start Exam') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

@include('student.student-footer')
