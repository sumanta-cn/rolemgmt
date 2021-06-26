@include('student.student-header')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Exam Details</h6>
                        </div>

                        <div class="row">
                            <div class="col-sm-8 col-md-12">
                                <div class="p-4">
                                    <form class="user" method="POST" action="{{ url('create-exampaper') }}">
                                        @csrf

                                        @php($qno = 1)
                                        @foreach($examdetails as $exam)

                                            <div class="form-group row">
                                                <div class="col-md-12 p-2">
                                                    <h5 class="m-3">{{ $qno }}. {{ $exam->ques_title }}</h5>

                                                    <h6 class="m-3">{{ $exam->opt_A }}</h6>
                                                    <h6 class="m-3">{{ $exam->opt_B }}</h6>
                                                    <h6 class="m-3">{{ $exam->opt_C }}</h6>
                                                    <h6 class="m-3">{{ $exam->opt_D }}</h6>

                                                    @if($exam->choice_type == 'single')
                                                    <div class="card-body mb-3" id="selectSingleChoice{{ $exam->id }}">
                                                        <h6 class="mb-3">Choose Answer :</h6>
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="singleAnswer1" type="radio" name="singleanswer" value="A">
                                                            <label class="form-check-label col-lg-1" for="singleAnswer1">A</label>

                                                            <input class="form-check-input" id="singleAnswer2" type="radio" name="singleanswer" value="B">
                                                            <label class="form-check-label col-lg-1" for="singleAnswer2">B</label>

                                                            <input class="form-check-input" id="singleAnswer3" type="radio" name="singleanswer" value="C">
                                                            <label class="form-check-label col-lg-1" for="singleAnswer3">C</label>

                                                            <input class="form-check-input" id="singleAnswer4" type="radio" name="singleanswer" value="D">
                                                            <label class="form-check-label col-lg-1" for="singleAnswer4">D</label>
                                                        </div>
                                                    </div>
                                                    @elseif($exam->choice_type == 'multiple')
                                                    <div class="card-body mb-3" id="selectMultipleChoice{{ $exam->id }}">
                                                        <h6 class="mb-3">Choose Answer :</h6>
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="A"
                                                            >
                                                            <label class="form-check-label col-lg-1" for="multipleAnswer">A</label>
                                                            <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="B"
                                                            >
                                                            <label class="form-check-label col-lg-1" for="multipleAnswer">B</label>
                                                            <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="C"
                                                            >
                                                            <label class="form-check-label col-lg-1" for="multipleAnswer">C</label>
                                                            <input class="form-check-input" id="multipleAnswer" type="checkbox" name="multipleanswer[]" value="D"
                                                            >
                                                            <label class="form-check-label col-lg-1" for="multipleAnswer">D</label>
                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>

                                            @php($qno++)
                                        @endforeach

                                        {{ $examdetails->links() }}
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <script>
                    $(document).ready(function(){

                        $(document).on('click', function(event){
                            event.preventDefault();
                            var page = $(this);
                            console.log(page);
                        });
                    });
                </script>

@include('student.student-footer')
