@extends('includes.admin.base')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Projects</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$projectType}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Assigned</th>
                                <td>Category</td>
                                <td>Created Date</td>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$project->title}}</td>
                                    <td>
                                        @if($project->status == 1)
                                            <span class="label label-success">Active</span>
                                            @else
                                            <span class="label label-warning">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($project->assigned_to == null)
                                            <span class="label label-danger">Un Assigned</span>
                                        @else
                                            <span class="label label-success">Assigned</span>
                                        @endif
                                    </td>
                                    <td>{{ $project->category->name }}</td>
                                    <td>{{$project->created_at}}</td>
                                    <td class="text-right">
                                        <a href="/admin/project/edit/{{$project->id}}"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                        <a onclick="actionModal({{$project->id}})" data-toggle="modal" data-target="#actionModal"><i data-toggle="tooltip" title="Actions" class="fa fa-list"></i></a>
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

    <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Actions
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="action-form" method="POST" action="/admin/project/actions">
                        <input type="hidden" name="id" id="project-id">
                        <input type="hidden" name="project_type" value="{{$projectType}}">
                        <label class="form-group">Mark Project as</label>
                        <div class="form-group">
                            <select class="form-control" name="action_id">
                                @if($projectType == 'Active Projects')
                                    <option value="1">Completed</option>
                                    <option value="2">Discarded</option>
                                @elseif($projectType == 'Completed Projects')
                                    <option value="1">Activate</option>
                                    <option value="2">Discarded</option>
                                @elseif($projectType == 'Discarded Projects')
                                    <option value="1">Completed</option>
                                    <option value="2">Activate</option>
                                @endif
                            </select>
                        </div>
                        @csrf
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="actionForm()" class="btn btn-primary" id="submitButton">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function actionForm() {
            $('#action-form').submit();
        }
        function actionModal(projectID) {
            $('#project-id').val(projectID);
        }
    </script>

@stop
