@extends('includes.home.base')
@section('content')
<div class="content-container" id="home" style="background: #FFFFFF">
    <div class="section home subpage">
        <div class="container">
            <div class="row home-row">
                <div class="col-12 col-xl-5 col-lg-12 col-md-12">
                    <div class="home-text">
                        <div class="display-1">
                            {{$project->title}}
                        </div>
                        <p class="white mb-5">
                            
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a class="btn btn-circle btn-outline-semi-light hero-circle-button scrollTo" href="#content" id="homeCircleButton"><i
                class="simple-icon-arrow-down"></i></a>
    </div>

    <div class="section">
        <div class="container" id="content">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 offset-0 col-lg-8 offset-lg-2 text-center d-inline-block">
                            <h1>Task Details</h1>
                        </div>
                    </div>
        
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h3>Title:</h3>
                                    <br>
                                    <h3>Category: </h3>
                                    <br>
                                    <h3>Sub-Category:</h3>
                                    <br>
                                    <h3>Location:</h3>
                                    <br>
                                    <h3>Budget:</h3>
                                    <br>
                                    <h3>People Required:</h3>
                                    <br>
                                    <h3>Due Date:</h3>
                                    <br>
                                    <h3>Status:</h3>
                                    <br>
                                    <h3>Assigned:</h3>
                                    <br>
                                    <h3>Media:</h3>
                                    <br>
                                    <h3>Posted on:</h3>
                                    <br>
                                    <h3>Posted By:</h3>
                                </div>
                                <div class="col-lg-4">
                                    <h3 style="color: black">{{$project->title}}</h3>
                                    <br>
                                    <h3 style="color: black">{{$project->category}}</h3>
                                    <br>
                                    <h3 style="color: black">{{$project->sub_category}}</h3>
                                    <br>
                                    <h3 style="color: black">{{$project->location}}</h3>
                                    <br>
                                    <h3 style="color: black">PKR {{$project->budget}}</h3>
                                    <br>
                                    <h3 style="color: black">{{$project->people_required}}</h3>
                                    <br>
                                    <h3 style="color: black">{{$project->due_date}}</h3>
                                    <br>
                                    <h3>
                                        @if ($project->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Suspended</span>
                                        @endif
                                    </h3>
                                    <br>   
                                    <h3>
                                        @if ($project->assigned_to == null)
                                            <span class="badge badge-pill badge-secondary">Unassigned</span>
                                        @else
                                            <span class="badge badge-pill badge-primary">Assigned</span>
                                        @endif
                                    </h3>     
                                    <br>
                                    <h3 style="color: black">
                                        @if ($project->media)
                                            <a style="color: #922c88" href="/images/project/{{$project->media}}" download><i class="fa fa-download"></i></a></a> {{$project->media}}
                                        @else
                                            <small>(No Media)</small>
                                        @endif
                                    </h3>
                                    <br>
                                    <h3 style="color: black">{{$project->created_at}}</h3>
                                    <br>
                                    <h3>
                                        <a style="color: #922c88" href="/active/task/poster/{{$project->posted_by_id}}">{{$project->posted_by}}</a>
                                    </h3>
                                </div>
                                <div class="col-lg-4">
                                    <h2>Details</h2>
                                    <div class="row">
                                        <div id="">
                                            <div class="">
                                                <div style="width: 100%; border: 1px solid black" class="btn btn-block" data-toggle="collapse" data-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    Click to view details
                                                </div>
            
                                                <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                    <div class="p-4" style="overflow-y: scroll; max-height: 500px; width: 430px">
                                                        {{$project->description}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button style="border: 1px solid #922c88" class="btn btn-outline-primary btn-block mt-5" data-toggle="modal" data-target="#bidModal">Bid on this</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalContentLabel">Bid on this task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/active/task/bid" method="POST" id="bid-task-form">
                    @csrf
                    <div class="form-group">
                        <label for="bid" style="color: #922C88">Enter amount</label>
                        <input class="form-control" type="number" name="amount" id="bid-amount">
                        <div id="error" style="display: none">
                            <p style="color: red">Please enter amount</p>
                        </div>
                    </div>
                    <input type="hidden" name="project_id" id="task-id" value="{{$project->id}}">
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="bidSubmit()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function bidSubmit(){
        let amount = $('#bid-amount').val();
        if (amount){
            $('#bid-task-form').submit();
        }else{
            $('#error').css('display', 'block');
        } 
    }
</script>
@stop