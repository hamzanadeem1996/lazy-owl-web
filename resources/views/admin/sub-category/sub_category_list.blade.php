@extends('includes.admin.base')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Sub Categories</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$categoryType}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Parent Category</th>
                                <th>Created Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->category->name}}</td>
                                    <td>{{$category->created_at}}</td>
                                    <td class="text-right">
                                        <a href="/admin/sub-category/edit/{{$category->id}}"><i data-toggle="tooltip" title="Edit" class="fa fa-edit"></i></a>
                                        @if($categoryType == 'Disabled Sub Categories')
                                            <a href="" onclick="disableModal({{$category->id}})" data-toggle="modal" data-target="#disableModal"><i data-toggle="tooltip" title="Activate" class="fa fa-check"></i></a>
                                        @else
                                            <a href="" onclick="disableModal({{$category->id}})" data-toggle="modal" data-target="#disableModal"><i data-toggle="tooltip" title="Disable" class="fa fa-trash"></i></a>
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
                        @if($categoryType == 'Disabled Sub Categories')
                            Activate Sub Category
                        @else
                            Disable Sub Category
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($categoryType == 'Disabled Sub Categories')
                        <h4>Are you sure you want to activate this sub category?</h4>
                    @else
                        <h4>Are you sure you want to disable this sub category?</h4>
                    @endif
                    <form id="disable-form" method="POST" action="/admin/sub-category/disable">
                        <input type="hidden" name="id" id="disable-user-id">
                        @csrf
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if($categoryType == 'Disabled Sub Categories')
                            <button type="button" onclick="disableForm()" class="btn btn-success" id="submitButton">Activate Sub Category</button>
                        @else
                            <button type="button" onclick="disableForm()" class="btn btn-danger" id="submitButton">Disable Sub Category</button>
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
