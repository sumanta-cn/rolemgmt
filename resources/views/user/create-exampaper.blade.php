@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        {{-- <div class="row">
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

        </div> --}}

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
                                    <select class="form-control" name="department" required>
                                        <option value="--Select Subject Code--">--Select Subject Code--</option>
                                        @foreach ($subjects as $sub)
                                            <option value="{{ $sub->subject_code }}">{{ $sub->subject_code}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 p-2">
                                    <select class="form-control" name="department" required>
                                        <option value="--Select Question Type--">--Select Question Type--</option>
                                        <option value="ShortQuestion">Short Question</option>
                                        <option value="MCQ">Multiple Choice Question</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card col-md-12 m-0 p-2 border-left-primary">
                                <div class="card-body">
                                    <textarea class="form-control" name="ques_title" placeholder="Question Title" required></textarea>
                                    <br><br>
                                    <input type="text" class="form-control col-md-6 m-2" name="optA" placeholder="Option A" required>
                                    <input type="text" class="form-control col-md-6 m-2" name="optB" placeholder="Option B" required>
                                    <input type="text" class="form-control col-md-6 m-2" name="optC" placeholder="Option C" required>
                                    <input type="text" class="form-control col-md-6 m-2" name="optD" placeholder="Option D" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 p-2">
                                    <input type="text" class="form-control col-md-6 m-2" name="marks_given" placeholder="Marks For Question" required>
                                </div>
                            </div>

                            <div class="form-group row m-5 pr-5 pl-5  text-center">
                                <div class="col-md-3 offset-md-3">
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

@include('common.footer')
