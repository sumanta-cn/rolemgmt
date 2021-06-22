@include('common.header')

    @include('common.topbar')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Exampaper Details</h6>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="p-4">
                        <a href="{{ route('viewexampaper') }}" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Create Exampaper</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 8%">Serial No</th>
                                <th>Exam Paper Code</th>
                                <th>Subject Code</th>
                                <th>Question Type</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($allexampaper) > 0)
                            @php($sl = 1)

                                @foreach ($allexampaper as $paper)
                                    <tr>

                                        <td>
                                            <a href="#" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#edituser{{ $paper->id }}">
                                            <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="edituser{{ $paper->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteuser{{ $paper->id }}">
                                            <i class="fas fa-trash"></i>
                                            </a>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteuser{{ $paper->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Delete Exampaper
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
                                                                        <input type="hidden" name="userid" value="{{ $paper->id }}">
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
                                    <td colspan="7" class="text-center">No data Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@include('common.footer')
