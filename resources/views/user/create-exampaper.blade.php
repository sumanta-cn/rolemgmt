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
                <h6 class="m-0 font-weight-bold text-primary">Create Exam Paper</h6>
            </div>

            <div class="row">
                <div class="col-sm-8 col-md-12">
                    <div class="p-4">
                        <form class="user" method="POST" action="{{ url('create-exampaper') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-6 p-2">
                                    <select class="form-control" name="subject" required>
                                        <option value="--Select Subject Code--">--Select Subject Code--</option>
                                        @foreach ($subjects as $sub)
                                            <option value="{{ $sub->subject_code }}">{{ $sub->subject_code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 p-2">
                                    <textarea class="form-control" name="ques_title" placeholder="Question Title" required></textarea>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" id="selectChoice1" type="radio" name="choicename" value="single">
                                            <label class="form-check-label col-lg-2" for="selectChoice1">Single Choice</label>
                                            <input class="form-check-input" id="selectChoice2" type="radio" name="choicename" value="multiple">
                                            <label class="form-check-label col-lg-2" for="selectChoice2">Multiple Choice</label>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control col-md-6 m-2" name="optA" placeholder="Option A" required>
                                    <input type="text" class="form-control col-md-6 m-2" name="optB" placeholder="Option B" required>
                                    <input type="text" class="form-control col-md-6 m-2" name="optC" placeholder="Option C" required>
                                    <input type="text" class="form-control col-md-6 m-2" name="optD" placeholder="Option D" required>

                                    <div class="card-body" id="selectChoice">
                                    </div>
                                </div>

                                <div class="col-md-4 p-2">
                                    <input type="text" class="form-control col-md-6 m-2" name="marks_given" placeholder="Marks For Question" required>
                                </div>
                            </div>
                            <input type="hidden" name="examid" value="{{ $examid }}">

                            <div class="form-group row mb-0 mt-5">
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Add Paper') }}
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
        $("#selectChoice1").on('click', function() {

            $("#selectChoice").html('');
            $("#selectChoice").append('<h6>Choose Answer :</h6><div class="form-check"><input class="form-check-input" id="singleAnswer1" type="radio" name="singleanswer" value="A"><label class="form-check-label col-lg-1" for="singleAnswer1">A</label><input class="form-check-input" id="singleAnswer2" type="radio" name="singleanswer" value="B"><label class="form-check-label col-lg-1" for="singleAnswer2">B</label><input class="form-check-input" id="singleAnswer3" type="radio" name="singleanswer" value="C"><label class="form-check-label col-lg-1" for="singleAnswer3">C</label><input class="form-check-input" id="singleAnswer4" type="radio" name="singleanswer" value="D"><label class="form-check-label col-lg-1" for="singleAnswer4">D</label></div>');
        });

        $("#selectChoice2").on('click', function() {

            $("#selectChoice").html('');
            $("#selectChoice").append('<h6>Choose Answer :</h6><div class="form-check"><input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="A"><label class="form-check-label col-lg-1" for="multipleAnswer">A</label><input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="B"><label class="form-check-label col-lg-1" for="multipleAnswer">B</label><input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="C"><label class="form-check-label col-lg-1" for="multipleAnswer">C</label><input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="D"><label class="form-check-label col-lg-1" for="multipleAnswer">D</label></div>');
        });
    </script>

@include('common.footer')
