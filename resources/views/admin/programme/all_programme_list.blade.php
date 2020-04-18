@extends('includes.admin.base')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Programmes</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Active Programmes</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Parent Degree</th>
                                <th>Created Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($programmes as $programme)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$programme->title}}</td>
                                    <td>{{$programme->degree->title}}</td>
                                    <td>{{$programme->created_at}}</td>
                                    <td class="text-right">
                                        <a href="/admin/programme/edit/{{$programme->id}}"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                        @if($programmeType == 'Disabled Programme')
                                        <a href="" onclick="disableModal({{$programme->id}})" data-toggle="modal" data-target="#disableModal"><i data-toggle="tooltip" title="Disable" class="fa fa-check"></i></a>
                                            @else
                                            <a href="" onclick="disableModal({{$programme->id}})" data-toggle="modal" data-target="#disableModal"><i data-toggle="tooltip" title="Disable" class="fa fa-trash"></i></a>

                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-labelledby="disableModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if($programmeType == 'Disabled Programme')
                                Activate Programme
                            @else
                                Disable Programme
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($programmeType == 'Disabled Programme')
                            <h4>Are you sure you want to activate this programme?</h4>
                        @else
                            <h4>Are you sure you want to disable this programme?</h4>
                        @endif
                        <form id="disable-form" method="POST" action="/admin/programme/disable">
                            <input type="hidden" name="id" id="disable-user-id">
                            @csrf
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            @if($programmeType == 'Disabled Programme')
                                <button type="button" onclick="disableForm()" class="btn btn-success" id="submitButton">Activate Programme</button>
                            @else
                                <button type="button" onclick="disableForm()" class="btn btn-danger" id="submitButton">Disable Programme</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        function disableForm() {
            $('#disable-form').submit();
        }
        function disableModal(userID) {
            $('#disable-user-id').val(userID);
        }
    </script>

@stop
