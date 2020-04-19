@extends('includes.admin.base')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Queries</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Project Queries</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Project Title</th>
                                <th>Answered</th>
                                <th>Query Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($queries as $query)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$query->user->name}}</td>
                                    <td id="user-email-{{$query->id}}">{{$query->user->email}}</td>
                                    <td id="task-title-{{$query->id}}">{{$query->project->title}}</td>
                                    <td>
                                        @if($query->is_answered == 0)
                                            <span class="badge badge-danger">Pending</span>
                                        @else
                                            <span class="badge badge-success">Answered</span>
                                        @endif
                                    </td>
                                    <td>{{$query->created_at}}</td>
                                    <td class="hide" id="hidden-query-{{$query->id}}">{{$query->query}}</td>
                                    
                                    <td class="text-right">
                                        <a href="#" onclick="detailModal({{$query->id}})" data-toggle="modal" data-target="#detailModal"><i data-toggle="tooltip" title="Details" class="fa fa-eye"></i></a>
                                        
                                        <a href="#" onclick="replyModal({{$query->id}})" data-toggle="modal" data-target="#replyModal"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
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

    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="disableModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Query Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="width: 100%; padding: 5%; border: 1px solid light-grey; height: 400px; overflow-y: scroll" id="query-details">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="disableModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Reply To Query
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/project/query/reply" method="POST" id="query-reply-form">
                        @csrf
                        <div class="form-group">
                            <label>User Email</label>
                            <input class="form-control" type="text" name="user_email" id="user-email" readonly>
                            <input type="hidden" name="query_id" id="query-id">
                            <input type="hidden" name="task_title" id="task-title">
                        </div>
                        <div class="form-group">
                            <label>Reply</label>
                            <textarea class="form-control" name="reply" id="reply" rows="8"></textarea>
                        </div>
                    </form>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="sendReply()" data-dismiss="modal">Send Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function sendReply(){
            $('#query-reply-form').submit();
        }

        function replyModal(id){
            let userEmail = $(`#user-email-${id}`).html();
            let taskTitle = $(`#task-title-${id}`).html();
            $('#user-email').val(userEmail);
            $('#query-id').val(id);
            $('#task-title').val(taskTitle);
        }

        function detailModal(id){
           let details = $(`#hidden-query-${id}`).html();
           console.log(details);
            $('#query-details').html(details);
        }
    </script>

@stop
