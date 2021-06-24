@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Exam Details</h6>
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
                                <th>Create Exampapers</th>
                                <th>View Exampapers</th>
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
                                            <div class="col-lg-12">
                                                <a href="{{ url('create-exampapers') .'/'. $exam->id }}" class="btn btn-primary btn-icon-split">
                                                    <span class="text">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-lg-12">
                                                <a href="{{ url('view-exampapers') .'/'. $exam->id }}" class="btn btn-primary btn-icon-split">
                                                    <span class="text">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                </a>
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
