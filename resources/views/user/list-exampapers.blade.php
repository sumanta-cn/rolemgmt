@include('common.header')

@include('common.topbar')


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <div class="pt-4 pr-4 pb-4">
                <a href="{{ route('viewexams') }}" class="btn btn-secondary btn-icon-split">
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
            <h6 class="m-0 font-weight-bold text-primary">Exam Details</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Exampaper Code</th>
                            <th>Subject Code</th>
                            <th>Question</th>
                            <th>Option A</th>
                            <th>Option B</th>
                            <th>Option C</th>
                            <th>Option D</th>
                            <th>Answer</th>
                            <th>Marks Given</th>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($listexampapers) > 0)
                            @php($sl = 1)
                                @foreach ($listexampapers as $paper)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $paper->exam_paper_code }}</td>
                                        <td>{{ $paper->subject_code }}</td>
                                        <td>{{ $paper->ques_title }}</td>
                                        <td>{{ $paper->opt_A }}</td>
                                        <td>{{ $paper->opt_B }}</td>
                                        <td>{{ $paper->opt_C }}</td>
                                        <td>{{ $paper->opt_D }}</td>
                                        <td>{{ $paper->answer }}</td>
                                        <td>{{ $paper->marks_given }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-circle" data-toggle="modal"
                                                data-target="#editexampaper{{ $paper->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal"
                                                data-target="#deleteexampaper{{ $paper->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php($sl++)
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11" class="text-center">No data Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($listexampapers as $paper)

            <!-- Modal -->
            <div class="modal fade" id="editexampaper{{ $paper->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Exampaper Details
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="user" method="POST" action="{{ url('update-exampapers') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        @if ($getsubj = $paper->getsubjects($paper->subject_code))
                                            <input type="text" class="form-control col-md-12 mb-3"
                                                value="{{ $getsubj->subject_name }} ({{ $getsubj->subject_code }})"
                                                readonly required>
                                            <input type="hidden" name="subject" value="{{ $getsubj->subject_code }}">
                                        @endif
                                        <textarea class="form-control mb-3" name="ques_title" placeholder="Question Title" required>{{ $paper->ques_title }}</textarea>
                                        <div class="card-body mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" id="selectChoice1{{ $paper->id }}"
                                                    type="radio" name="choicename" value="single" @if ($paper->choice_type == 'single') checked @endif>
                                                <label class="form-check-label col-sm-4" for="selectChoice1">Single
                                                    Choice</label>
                                                <input class="form-check-input" id="selectChoice2{{ $paper->id }}"
                                                    type="radio" name="choicename" value="multiple" @if ($paper->choice_type == 'multiple') checked @endif>
                                                <label class="form-check-label col-sm-6" for="selectChoice2">Multiple
                                                    Choice</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control mb-3" name="optA" placeholder="Option A"
                                            value="{{ $paper->opt_A }}" required>
                                        <input type="text" class="form-control mb-3" name="optB" placeholder="Option B"
                                            value="{{ $paper->opt_B }}" required>
                                        <input type="text" class="form-control mb-3" name="optC" placeholder="Option C"
                                            value="{{ $paper->opt_C }}" required>
                                        <input type="text" class="form-control mb-3" name="optD" placeholder="Option D"
                                            value="{{ $paper->opt_D }}" required>

                                        <div class="card-body mb-3" id="selectSingleChoice{{ $paper->id }}">
                                            <h6>Choose Answer :</h6>
                                            <div class="form-check">
                                                @php($answer = explode(', ', $paper->answer))

                                                <input class="form-check-input" id="singleAnswer1" type="radio" name="singleanswer" value="A"
                                                @foreach($answer as $ans) @if(($ans == 'A') && ($paper->choice_type == 'single')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="singleAnswer1">A</label>
                                                <input class="form-check-input" id="singleAnswer2" type="radio" name="singleanswer" value="B"
                                                @foreach($answer as $ans) @if(($ans == 'B') && ($paper->choice_type == 'single')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="singleAnswer2">B</label>
                                                <input class="form-check-input" id="singleAnswer3" type="radio" name="singleanswer" value="C"
                                                @foreach($answer as $ans) @if(($ans == 'C') && ($paper->choice_type == 'single')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="singleAnswer3">C</label>
                                                <input class="form-check-input" id="singleAnswer4" type="radio" name="singleanswer" value="D"
                                                @foreach($answer as $ans) @if(($ans == 'D') && ($paper->choice_type == 'single')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="singleAnswer4">D</label>
                                            </div>
                                        </div>

                                        <div class="card-body mb-3" id="selectMultipleChoice{{ $paper->id }}">
                                            <h6>Choose Answer :</h6>
                                            <div class="form-check">
                                                @php($answer = explode(', ', $paper->answer))

                                                <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="A"
                                                @foreach($answer as $ans) @if(($ans == 'A') && ($paper->choice_type == 'multiple')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="multipleAnswer">A</label>
                                                <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="B"
                                                @foreach($answer as $ans) @if(($ans == 'B') && ($paper->choice_type == 'multiple')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="multipleAnswer">B</label>
                                                <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="C"
                                                @foreach($answer as $ans) @if(($ans == 'C') && ($paper->choice_type == 'multiple')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="multipleAnswer">C</label>
                                                <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="D"
                                                @foreach($answer as $ans) @if(($ans == 'D') && ($paper->choice_type == 'multiple')) checked @endif @endforeach>
                                                <label class="form-check-label col-sm-2" for="multipleAnswer">D</label>
                                            </div>
                                        </div>

                                        <input type="text" class="form-control col-md-6 m-2" name="marks_given"
                                            placeholder="Marks For Question" value="{{ $paper->marks_given }}" required>
                                    </div>
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="examid" value="{{ $paper->exam_details_id }}">
                                    <input type="hidden" name="exampapercode" value="{{ $paper->exam_paper_code }}">
                                    <input type="hidden" name="paperid" value="{{ $paper->id }}">
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
            <div class="modal fade" id="deleteexampaper{{ $paper->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Delete Exampaper Details
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="user" method="POST" action="{{ url('delete-exampapers') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <p>Are sure want to delete?</p>
                                        <input type="hidden" name="paperid" value="{{ $paper->id }}">
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
                $(document).ready(function() {

                    $("#selectSingleChoice{{ $paper->id }}").css('display', 'none');
                    $("#selectSingleChoice{{ $paper->id }} input[type=radio]").attr('disabled', true);
                    $("#selectMultipleChoice{{ $paper->id }}").css('display', 'none');
                    $("#selectMultipleChoice{{ $paper->id }} input[type=checkbox]").attr('disabled', true);

                    if ($("#selectChoice1{{ $paper->id }}").is(":checked")) {

                        $("#selectSingleChoice{{ $paper->id }}").css('display', 'block');
                        $("#selectSingleChoice{{ $paper->id }} input[type=radio]").attr('disabled', false);
                    }

                    if ($("#selectChoice2{{ $paper->id }}").is(":checked")) {

                        $("#selectMultipleChoice{{ $paper->id }}").css('display', 'block');
                        $("#selectMultipleChoice{{ $paper->id }} input[type=checkbox]").attr('disabled', false);
                    }
                });

                $("#selectChoice1{{ $paper->id }}").on('click', function() {

                    $("#selectMultipleChoice{{ $paper->id }}").css('display', 'none');
                    $("#selectMultipleChoice{{ $paper->id }} input[type=checkbox]").attr('disabled', true);
                    $("#selectSingleChoice{{ $paper->id }}").css('display', 'block');
                    $("#selectSingleChoice{{ $paper->id }} input[type=radio]").attr('disabled', false);

                });

                $("#selectChoice2{{ $paper->id }}").on('click', function() {

                    $("#selectSingleChoice{{ $paper->id }}").css('display', 'none');
                    $("#selectSingleChoice{{ $paper->id }} input[type=radio]").attr('disabled', true);
                    $("#selectMultipleChoice{{ $paper->id }}").css('display', 'block');
                    $("#selectMultipleChoice{{ $paper->id }} input[type=checkbox]").attr('disabled', false);
                });
            </script>

        @endforeach

        @include('common.footer')
