@extends('includes.admin.base')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$userType}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <td>Address</td>
                                <td>Verified</td>
                                <th>Registration Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->gender === 'Male')
                                            <span class="badge badge-dark">{{$user->gender}}</span>
                                        @else
                                            <span class="badge badge-light">{{$user->gender}}</span>
                                        @endif
                                    </td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>
                                        @if($user->email_verified_at === Null)
                                            <span class="badge badge-danger">Un-verified</span>
                                        @else
                                            <span class="badge badge-success">Verified</span>
                                        @endif
                                    </td>
                                    <td>{{$user->created_at}}</td>
                                    <td class="text-right">
                                        <a href="/admin/user/projects/{{$user->id}}"><i data-toggle="tooltip" title="Projects" class="fa fa-paper-plane"></i></a>
                                        <a href="/admin/user/edit/{{$user->id}}"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                        @if($userType == 'Disabled Users')
                                            <a href="" onclick="disableModal({{$user->id}})" data-toggle="modal" data-target="#disableModal"><i data-toggle="tooltip" title="Activate" class="fa fa-check"></i></a>
                                            @else
                                            <a href="" onclick="disableModal({{$user->id}})" data-toggle="modal" data-target="#disableModal"><i data-toggle="tooltip" title="Disable" class="fa fa-trash"></i></a>
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
                        @if($userType == 'Disabled Users')
                            Activate User
                        @else
                            Disable User
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($userType == 'Disabled Users')
                        <h4>Are you sure you want to activate this user?</h4>
                    @else
                        <h4>Are you sure you want to disable this user?</h4>
                    @endif
                    <form id="disable-form" method="POST" action="/admin/user/disable">
                        <input type="hidden" name="id" id="disable-user-id">
                        @csrf
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($userType == 'Disabled Users')
                            <button type="button" onclick="disableForm()" class="btn btn-success" id="submitButton">Activate User</button>
                        @else
                            <button type="button" onclick="disableForm()" class="btn btn-danger" id="submitButton">Disable User</button>
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
