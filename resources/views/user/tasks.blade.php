@extends('includes.user.base')
@section('content')
<main>
    <div class="container-fluid disable-text-selection">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Active Tasks</h1>
                </div>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 list" data-check-all="checkAll">
                <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" onclick="showTab('first')" id="first-tab" data-toggle="tab" href="#first" role="tab"
                            aria-controls="first" aria-selected="true">ACTIVE</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " onclick="showTab('second')" id="second-tab" data-toggle="tab" href="#second" role="tab"
                            aria-controls="third" aria-selected="false">COMPLETED</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " onclick="showTab('third')" id="third-tab" data-toggle="tab" href="#third" role="tab"
                            aria-controls="third" aria-selected="false">DISCARDED</a>
                    </li>
                </ul>
                <div class="card d-flex flex-row mb-3" style="background-color: #922C88;">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" style="color: white">
                                Title
                            </a>
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Budget</p>
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Due Date</p>
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Assigned</p>
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Status</p>
                            <p class="mb-1 w-15 w-xs-100" style="color: white">Actions</p>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-content mb-4">
                    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                        @if (count($projects['active_projects']) > 0)
                            @foreach ($projects['active_projects'] as $task)
                                <div class="card d-flex flex-row mb-3">
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="Layouts.Details.html">
                                                {{$task->title}}
                                            </a>
                                            <p class="mb-1 w-15 w-xs-100">RS {{$task->budget}}</p>
                                            <p class="mb-1 w-15 w-xs-100">{{$task->due_date}}</p>
                                            <div class="w-15 w-xs-100">
                                                @if ($task->assigned_to !== null)
                                                    <span class="badge badge-pill badge-success">Assigned</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">Not Assigned</span>
                                                @endif 
                                            </div>
                                            
                                            <div class="w-15 w-xs-100">
                                                @if ($task->completed == 0)
                                                    <span class="badge badge-pill badge-primary">Not Completed</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">Completed</span>
                                                @endif 
                                            </div>
            
                                            <div class="w-15 w-xs-100">
                                                <i class="fa fa-eye" id="edit-icon" onclick="getTaskDetails({{$task->id}}, 'view')" data-toggle="modal" data-target="#viewTaskModal"></i>
                                                <i class="fa fa-edit" id="edit-icon" onclick="getTaskDetails({{$task->id}}, 'edit')" data-toggle="modal" data-target="#editTaskModal"></i>
                                                @if($task->assigned_to != null)
                                                    <i class="fa fa-check" id="edit-icon" onclick="completeTask({{$task->id}})" data-toggle="modal" data-target="#completeTaskModal"></i>
                                                @endif
                                                @if($task->assigned_to == null)
                                                    <i class="fa fa-gavel" id="edit-icon" onclick="getTaskBids({{$task->id}})" data-toggle="modal" data-target="#taskBidModal"></i>
                                                    <i class="fa fa-trash" id="edit-icon" onclick="deleteTask({{$task->id}})" data-toggle="modal" data-target="#deleteTaskModal"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card d-flex flex-row mb-3">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                        <h1>No Data Available</h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>

                <div class="tab-content mb-4">
                    <div class="tab-pane" id="second" role="tabpanel" aria-labelledby="second-tab" style="display: none">
                        @if (count($projects['completed_projects']) > 0)
                            @foreach ($projects['completed_projects'] as $task)
                                <div class="card d-flex flex-row mb-3">
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="Layouts.Details.html">
                                                {{$task->title}}
                                            </a>
                                            <p class="mb-1 w-15 w-xs-100">RS {{$task->budget}}</p>
                                            <p class="mb-1 w-15 w-xs-100">{{$task->due_date}}</p>
                                            <div class="w-15 w-xs-100">
                                                @if ($task->assigned_to !== null)
                                                    <span class="badge badge-pill badge-success">Assigned</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">Not Assigned</span>
                                                @endif 
                                            </div>
                                            
                                            <div class="w-15 w-xs-100">
                                                @if ($task->completed == 0)
                                                    <span class="badge badge-pill badge-primary">Not Completed</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">Completed</span>
                                                @endif 
                                            </div>
            
                                            <div class="w-15 w-xs-100">
                                                <i class="fa fa-eye" id="edit-icon" onclick="getTaskDetails({{$task->id}}, 'view')" data-toggle="modal" data-target="#viewTaskModal"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card d-flex flex-row mb-3">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                        <h1>No Data Available</h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="tab-content mb-4">
                    <div class="tab-pane" id="third" role="tabpanel" aria-labelledby="third-tab" style="display: none">
                        @if (count($projects['discarded_projects']) > 0)
                            @foreach ($projects['discarded_projects'] as $task)
                                <div class="card d-flex flex-row mb-3">
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                            <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="Layouts.Details.html">
                                                {{$task->title}}
                                            </a>
                                            <p class="mb-1 w-15 w-xs-100">RS {{$task->budget}}</p>
                                            <p class="mb-1 w-15 w-xs-100">{{$task->due_date}}</p>
                                            <div class="w-15 w-xs-100">
                                                @if ($task->assigned_to !== null)
                                                    <span class="badge badge-pill badge-success">Assigned</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">Not Assigned</span>
                                                @endif 
                                            </div>
                                            
                                            <div class="w-15 w-xs-100">
                                                @if ($task->completed == 0)
                                                    <span class="badge badge-pill badge-primary">Not Completed</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">Completed</span>
                                                @endif 
                                            </div>
            
                                            <div class="w-15 w-xs-100">
                                                <i class="fa fa-eye" id="edit-icon" onclick="getTaskDetails({{$task->id}}, 'view')" data-toggle="modal" data-target="#viewTaskModal"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card d-flex flex-row mb-3">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                        <h1>No Data Available</h1>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="completeTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalContentLabel">Complete Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>Are you sure you want to mark this task completed?</h2>
            </div>
            <form action="/user/project/complete" method="POST" id="complete-task-form">
                @csrf
                <input type="hidden" name="id" id="complete-task-id">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="completeTaskSubmit()" class="btn btn-success">Complete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalContentLabel">Delete Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>Are you sure you want to delete this task?</h2>
            </div>
            <form action="/user/project/delete" method="POST" id="delete-task-form">
                @csrf
                <input type="hidden" name="id" id="task-id">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="deleteTaskSubmit()" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-right" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #922C88">
                <h5 class="modal-title white" id="exampleModalLabel">
                    Edit Task
                </h5>
                <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div id="page-1">
                        <input type="hidden" name="user_id" id="user-id" value="{{Auth::id()}}">
                        <input type="hidden" name="id" id="project-id">
                        <div class="form-group">
                            <label style="color: #922C88">Task Title *</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Example: Car Service">
                        </div>
    
                        <div class="form-group">
                            <label style="color: #922C88">Category *</label>
                            <select id="category" name="cat_id" class="form-control" onchange="getSubCategories(this.value)">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label style="color: #922C88">Sub Category *</label>
                            <select id="sub-category" name="sub_cat_id" class="form-control" id="sub-category">
                                <option value="" id="temp-sub-category">Select Category First</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label style="color: #922C88">Attachment</label>
                            <input type="file" id="file" name="file" class="form-control">
                            <input type="hidden" id="hidden-media">
                        </div>
    
                        <div class="form-group">
                            <label style="color: #922C88">Details *</label>
                            <textarea id="description" placeholder="Please enter details that defines your task" name="description" class="form-control" rows="2"></textarea>
                        </div>
    
                        <div>
                            <p id="error" style="color: red"></p>
                            <button id="next-button" type="button" class="btn btn-primary" style="float: right" onclick="nextPage('page-1', 'page-2')">Next
                                &nbsp;&nbsp;<i class="iconsmind-Arrow-OutRight"></i>
                            </button>
                        </div>
                    </div>

                    <div id="page-2" style="display: none;">
                        <div class="form-group">
                            <label style="color: #922C88">Location of Task *</label>
                            <input type="text" id="location" name="location" class="form-control" placeholder="House#, Society, City">
                        </div>

                        <div class="form-group">
                            <label style="color: #922C88">Due Date *</label>
                            <input type="date" class="form-control" id="due-date" name="due_date" placeholder="30/02/2020">
                        </div>

                        <div class="form-group">
                            <label style="color: #922C88">How many people you need for your task? *</label>
                            <input type="number" class="form-control" name="people_required" id="people-required" placeholder="3">
                        </div>

                        <div class="form-group">
                            <label style="color: #922C88">Estimated Budget *</label>
                            <input type="number" id="budget" name="budget" class="form-control" placeholder="4000">
                        </div>
                        <p id="error-page-2" style="color: red"></p>
                        <div style="margin-top: 45%">
                            <button type="button" class="btn btn-primary" style="float: right" onclick="nextPage('page-2', 'page-3')">Edit
                                &nbsp;&nbsp;<i class="iconsmind-Arrow-OutRight" id="submit-icon"></i>
                            </button>
                            <button type="button" class="btn btn-primary" style="float: left" onclick="prevPage('page-2', 'page-1')">Prev
                                &nbsp;&nbsp;<i class="iconsmind-Arrow-OutLeft"></i>
                            </button>
                        </div>
                    </div>

                    <div id="page-3" style="display: none">
                        <div class="task-posted">
                            <img src="https://supertasker.pk/images/post_task_icon.png" alt="task posted" width="100" height="100">
                            <span class="msg">Task Edited!</span>
                            <span class="simple-icon-check fa-2x icon"></span>
                        </div>
                        <br>
                        <br>
                        <div class="text-center">
                            <div class="container fluid">
                                <h2>Pick an offer</h2>
                                <p>Now tasker can ask questions and make offers to do your task - make sure you check back on it regularly!</p>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
                        <button class="btn btn-primary btn-block" style="margin-top: 5%">Review Offers</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="viewTaskModal" tabindex="-1" role="dialog" aria-labelledby="viewTaskModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #922C88">
                <h5 class="modal-title white" id="exampleModalLabel">
                    Task Details
                </h5>
                <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div id="page-1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h4 style="color: #922C88">Task Title :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Category :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Sub Category :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Due Date :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">People Required :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Estimated Budget :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Location :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Attachment :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Assigned to :</h4>
                                        <br><br>
                                        <h4 style="color: #922C88">Details :</h4>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 id="view-title"></h4>
                                        <br><br>
                                        <h4 id="view-category"></h4>
                                        <br><br>
                                        <h4 id="view-sub-category"></h4>
                                        <br><br>
                                        <h4 id="view-due-date"></h4>
                                        <br><br>
                                        <h4 id="view-people-required"></h4>
                                        <br><br>
                                        <h4 id="view-estimated-budget"></h4>
                                        <br><br>
                                        <h4 id="view-location"></h4>
                                        <br><br>
                                        <h4><a id="view-attachment" href="" download></a></h4>
                                        <br><br>
                                        <h4><a id="assigned-to-user" href=""></a></h4>
                                        <br><br>
                                        <h4 id="view-details"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="taskBidModal" tabindex="-1" role="dialog" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);" aria-labelledby="viewTaskModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 900px">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #922C88">
                <h5 class="modal-title white" id="exampleModalLabel">
                    Bids on this Task
                </h5>
                <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body menu-default show-spinner" style="max-height: 800px; overflow-y: scroll">
                <form>
                    <div id="page-1">
                        <div class="row">
                            <div class="col-lg-12" id="bids-list">
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function getTaskBids(id){
        $.get(`/active/task/bids/${id}`).then((response) => {
            let data = JSON.parse(response);
            if (data.length > 0){
                $('#bids-list').html('');
                data.forEach(element => {
                    console.log(element);
                    let rowToInsert = `<div class="card d-flex flex-row mb-3">
                        <div class="d-flex flex-grow-1 min-width-zero">
                            <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                <a class="list-item-heading mb-1 truncate w-40 w-xs-100" href="/active/task/bidder/${element.user.id}">
                                    ${element.user.name}
                                </a>
                                <p class="mb-1 text-muted text-small w-15 w-xs-100">PKR ${element.amount}</p>
                                <p class="mb-1 text-muted text-small w-15 w-xs-100">${element.created_at}</p>
                                <div class="w-15 w-xs-100">
                                    <a href="/active/task/accept-bit/${element.id}"><span class="badge badge-pill badge-primary">Accept Offer</span></a>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    $('#bids-list').append(rowToInsert);
                });
                
            }else{
                $('#bids-list').html('');
                let noDataRow = `<h1>No Data Available</h1>`;
                $('#bids-list').append(noDataRow);
            }
        });
    }
    function completeTaskSubmit(){
        $('#complete-task-form').submit();
    }

    function deleteTaskSubmit(){
        $('#delete-task-form').submit();
    }

    function showTab(tabName){
        if (tabName === 'first'){
            $('#first').css('display', 'block');
            $('#second').css('display', 'none');
            $('#third').css('display', 'none');
        }else if (tabName === 'second'){
            $('#first').css('display', 'none');
            $('#second').css('display', 'block');
            $('#third').css('display', 'none');
        }else if(tabName === 'third'){
            $('#first').css('display', 'none');
            $('#second').css('display', 'none');
            $('#third').css('display', 'block');
        }
    }

    function nextPage(pageId, nextPageId){
        let title           = $('#title').val();
        let category        = $('#category').val();
        let subCategory     = $('#sub-category').val();
        let description     = $('#description').val();
        let location        = $('#location').val();
        let dueDate         = $('#due-date').val();
        let peopleRequired  = $('#people-required').val();   
        let budget          = $('#budget').val();
        let projectId       = $('#project-id').val();

        if (nextPageId === 'page-3'){
            
            let lcoationFlag        = true;
            let dueDateFlag         = true;
            let peopleRequiredFlag  = true;
            let budgetFlag          = true;

            if (!location){
                $('#location').css('border-color', 'red');
                lcoationFlag = false;
            }else{
                $('#location').css('border-color', '#d7d7d7');
            }

            if (!dueDate){
                $('#due-date').css('border-color', 'red');
                dueDateFlag = false;
            }else{
                $('#due-date').css('border-color', '#d7d7d7');
            }

            if (!peopleRequired){
                $('#people-required').css('border-color', 'red');
                peopleRequiredFlag = false;
            }else{
                $('#people-required').css('border-color', '#d7d7d7');
            }

            if (!budget){
                $('#budget').css('border-color', 'red');
                budgetFlag = false;
            }else{
                $('#budget').css('border-color', '#d7d7d7');
            }

            if (location && dueDate && peopleRequired && budget){
                $('#submit-icon').attr('class', 'fa fa-circle-o-notch fa-spin');
                
                var formData = new FormData();
                let userId = $('#user-id').val();
                let file = document.getElementById('file');
                let fileData;
                if (file.files[0]){
                    fileData = file.files[0];
                    formData.append('file', fileData);
                }
                else{
                    fileData = $('#hidden-media').val();
                }
                
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('user_id', userId);
                formData.append('title', title);
                formData.append('cat_id', category);
                formData.append('sub_cat_id', subCategory);
                formData.append('description', description);
                formData.append('location', location);
                formData.append('due_date', dueDate);
                formData.append('budget', budget);
                formData.append('people_required', peopleRequired);
                
                formData.append('id', projectId);
                
                $.post({
                    url: '/user/project/edit',
                    data: formData,
                    processData: false,
                    contentType: false,
                }).then((response) => {
                    let data = JSON.parse(response);
                    if (data['status'] === 200){
                        $(`#${pageId}`).css('display', 'none');
                        $(`#${nextPageId}`).css('display', 'block');
                        setTimeout(function(){
                            window.location.reload(true);
                        }, 1000);
                    }else{
                        $('#error-page-2').html('Internal Server Error');
                    }
                })
                
            }else{
                $('#error-page-2').html('Please enter the required fields');
            }
        }
        
        if (nextPageId === 'page-2'){
            let titleFlag       = true; 
            let categoryFlag    = true; 
            let subCategoryFlag = true; 
            let descriptionFlag = true;
            
            if(!title){
                $('#title').css('border-color', 'red');
                titleFlag = false;
            }else{
                $('#title').css('border-color', '#d7d7d7');
            }

            if(!category){
                $('#category').css('border-color', 'red');
                categoryFlag = false;
            }else{
                $('#category').css('border-color', '#d7d7d7');
            }

            if(!subCategory){
                $('#sub-category').css('border-color', 'red');
                subCategoryFlag = false;
            }else{
                $('#sub-category').css('border-color', '#d7d7d7');
            }

            if(!description){
                $('#description').css('border-color', 'red');
                descriptionFlag = false;
            }else{
                $('#description').css('border-color', '#d7d7d7');
            }

            if (titleFlag && categoryFlag && subCategoryFlag && descriptionFlag){
                $(`#${pageId}`).css('display', 'none');
                $(`#${nextPageId}`).css('display', 'block');
            }else{
                $('#error').html('Please enter the required fields');
            }
        }
        
    }

    function prevPage(pageId, nextPageId){
        $(`#${pageId}`).css('display', 'none');
        $(`#${nextPageId}`).css('display', 'block');
    }

    function getSubCategories(categoryId){
        $.get(`/admin/sub-categories/${categoryId}`).then((response) => {
            let data = JSON.parse(response);
            $('#temp-sub-category').css('display', 'none');
            $('#sub-category').attr('disabled', false);
            $('#sub-category').html('');
            if (data.length > 0){
                data.forEach((element) => {                        
                    let option = `<option value="${element.id}">${element.name}</option>`;
                    $('#sub-category').append(option);
                })
                $('#next-button').attr('disabled', false);

            }else{
                let option = `<option value="">No data available</option>`;
                $('#sub-category').append(option);
                $('#next-button').attr('disabled', true);
            }
        });
    }

    function getTaskDetails(id, type){
        $.get(`/user/project/${id}`).then((response) => {
            let data = JSON.parse(response);
            console.log(data);
            let subCategories = data.all_sub_categories;
            if (type === 'view'){ 
                $('#view-title').html(data.title);
                $('#view-category').html(data.category);
                $('#view-sub-category').html(data.sub_category);
                $('#view-due-date').html(data.due_date);
                $('#view-people-required').html(data.people_required);
                $('#view-estimated-budget').html(data.budget);
                $('#view-location').html(data.location);
                $('#view-attachment').attr('href', data.media);
                $('#view-attachment').html(data.media);
                $('#view-details').html(data.description);
                $('#assigned-to-user').html(data.assigned_to_user);
                $('#assigned-to-user').attr('href', data.assigned_to_user_url);
            }else{ 
                if (subCategories.length > 0){
                    $('#temp-sub-category').css('display', 'none');
                    let selected = '';
                    subCategories.forEach((element) => { 
                        if (element.id === data.sub_cat_id) selected = 'selected';                       
                        let option = `<option value="${element.id}" ${selected}>${element.name}</option>`;
                        $('#sub-category').append(option);
                    });
                }else{
                    let option = `<option value="">No data available</option>`;
                    $('#sub-category').append(option);
                }
                setTimeout(function(){
                    $('#title').val(data.title);
                    $('#project-id').val(data.id);
                    $('#category').val(data.cat_id);
                    $('#due-date').val(data.due_date);
                    $('#people-required').val(data.people_required);
                    $('#budget').val(data.budget);
                    $('#location').val(data.location);
                    $('#description').html(data.description);
                    $('#hidden-media').val(data.media);
                }, 1000);
            }
        });
    }

    function deleteTask(id){
        $('#task-id').val(id);
    }

    function completeTask(id){
        $('#complete-task-id').val(id);
    }
</script>
@stop