@extends('includes.user.base')
@section('content')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-lg-6" style="text-align: right">
                        <div
                            @if(Auth::user()->role == 3)
                                style="display: none"
                            @endif
                        >
                            <button 
                                class="btn btn-primary" data-backdrop="static" 
                                data-toggle="modal" data-target="#deleteServiceModal">Post a Task</button>
                        </div>
                    </div>
                </div>
                <div class="separator mb-5"></div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Active Tasks</h6>
                                <h1 style="font-size: 40; color: #922c88">{{$projects['active']}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Assigned Tasks</h6>
                                <h1 style="font-size: 40; color: #922c88">{{Auth::user()->role == 3 ? $projects['active']: $projects['assigned']}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Awaiting Payment</h6>
                                <h1 style="font-size: 40; color: #922c88">{{$projects['assigned']}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Completed</h6>
                                <h1 style="font-size: 40; color: #922c88">{{$projects['completed']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <div class="card dashboard-progress">
                            <div class="position-absolute card-top-buttons">
                                <button class="btn btn-header-light icon-button">
                                    <i class="simple-icon-refresh"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Profile Status</h5>
                                <div class="mb-4">
                                    <p class="mb-2">Basic Information
                                        <span class="float-right text-muted">12/18</span>
                                    </p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="66" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-2">Portfolio
                                        <span class="float-right text-muted">1/8</span>
                                    </p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="12" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-2">Billing Details
                                        <span class="float-right text-muted">2/6</span>
                                    </p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-2">Interests
                                        <span class="float-right text-muted">0/8</span>
                                    </p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-2">Legal Documents
                                        <span class="float-right text-muted">1/2</span>
                                    </p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Notifications</h5>
                                <div class="scroll dashboard-logs">
                                    <table class="table table-sm table-borderless">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                            </td>
                                            <td>
                                                <span class="font-weight-medium">New user registiration</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="log-indicator border-theme-2 align-middle"></span>
                                            </td>
                                            <td>
                                                <span class="font-weight-medium">New sale: Soufflé</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="log-indicator border-danger align-middle"></span>
                                            </td>
                                            <td>
                                                <span class="font-weight-medium">14 products added</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="log-indicator border-theme-2 align-middle"></span>
                                            </td>
                                            <td>
                                                <span class="font-weight-medium">New sale: Napoleonshat</span>
                                            </td>
                                            <td class="text-right">
                                                <span class="text-primary text-small font-weight-medium d-none d-sm-block">09.04.2018</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 mb-4">
                <div class="card dashboard-filled-line-chart">
                    <div class="card-body ">
                        <div class="float-left float-none-xs">
                            <div class="d-inline-block">
                                <h5 class="d-inline">Website Visits</h5>
                                <span class="text-muted text-small d-block">Unique Visitors</span>
                            </div>
                        </div>
                        <div class="btn-group float-right float-none-xs mt-2">
                            <button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                This Week
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Last Week</a>
                                <a class="dropdown-item" href="#">This Month</a>
                            </div>
                        </div>
                    </div>
                    <div class="chart card-body pt-0">
                        <canvas id="visitChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-4">
                <div class="card dashboard-filled-line-chart">
                    <div class="card-body ">
                        <div class="float-left float-none-xs">
                            <div class="d-inline-block">
                                <h5 class="d-inline">Conversion Rates</h5>
                                <span class="text-muted text-small d-block">Per Session</span>
                            </div>
                        </div>
                        <div class="btn-group float-right mt-2 float-none-xs">
                            <button class="btn btn-outline-secondary btn-xs dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                This Week
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Last Week</a>
                                <a class="dropdown-item" href="#">This Month</a>
                            </div>
                        </div>
                    </div>
                    <div class="chart card-body pt-0">
                        <canvas id="conversionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reviews</h5>

                        <div class="scroll dashboard-list-with-user">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l.jpg" alt="Mayra Sibley" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <h6 class="font-weight-medium mb-0">Mayra Sibley</h6>
                                        <p>This is review text</p>
                                        <p class="text-muted mb-0 text-small">09.08.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-7.jpg" alt="Mimi Carreira" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <h6 class="font-weight-medium mb-0">Mayra Sibley</h6>
                                        <p>This is review text</p>
                                        <p class="text-muted mb-0 text-small">05.08.2018 - 10:20</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-6.jpg" alt="Philip Nelms" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <h6 class="font-weight-medium mb-0">Mayra Sibley</h6>
                                        <p>This is review text</p>
                                        <p class="text-muted mb-0 text-small">05.08.2018 - 09:12</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-3.jpg" alt="Terese Threadgill" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <h6 class="font-weight-medium mb-0">Mayra Sibley</h6>
                                        <p>This is review text</p>
                                        <p class="text-muted mb-0 text-small">01.08.2018 - 18:20</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-5.jpg" alt="Kathryn Mengel" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <h6 class="font-weight-medium mb-0">Mayra Sibley</h6>
                                        <p>This is review text</p>
                                        <p class="text-muted mb-0 text-small">27.07.2018 - 11:45</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-4.jpg" alt="Esperanza Lodge" class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3 pr-2">
                                    <a href="#">
                                        <h6 class="font-weight-medium mb-0">Mayra Sibley</h6>
                                        <p>This is review text</p>
                                        <p class="text-muted mb-0 text-small">24.07.2018 - 15:00</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<style>
    .task-posted {
        background-color: #f8fafb;
        padding: 10px;
        border-bottom: 2px solid #dfe3ef;
    }

    .task-posted .msg {
        font-size: 15px;
        margin-left: 10px;
        color: #000;
    }

    .task-posted .icon {
        float: right;
        background-color: #922C88;
        color: #fff;
        margin: 35px 20px 0 0;
        padding: 5px;
        border: 1px solid;
        border-radius: 50%;
    }

    .fa-2x {
        font-size: 1.5em;
    }

</style>
<div class="modal fade modal-right" id="deleteServiceModal" tabindex="-1" role="dialog" aria-labelledby="deleteServiceModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #922C88">
                <h5 class="modal-title white" id="exampleModalLabel">
                    Post a Task
                </h5>
                <button type="button" class="close white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div id="page-1">
                        <input type="hidden" name="user_id" id="user-id" value="{{Auth::id()}}">
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
                            <button type="button" class="btn btn-primary" style="float: right" onclick="nextPage('page-2', 'page-3')">Post
                                &nbsp;&nbsp;<i class="iconsmind-Arrow-OutRight" id="submit-icon"></i>
                            </button>
                            <button type="button" class="btn btn-primary" style="float: left" onclick="nextPage('page-2', 'page-1')">Prev
                                &nbsp;&nbsp;<i class="iconsmind-Arrow-OutLeft"></i>
                            </button>
                        </div>
                    </div>

                    <div id="page-3" style="display: none">
                        <div class="task-posted">
                            <img src="https://supertasker.pk/images/post_task_icon.png" alt="task posted" width="100" height="100">
                            <span class="msg">Task Posted!</span>
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

<script>
    function nextPage(pageId, nextPageId){
        let title = $('#title').val();
        let category = $('#category').val();
        let subCategory = $('#sub-category').val();
        let description = $('#description').val();
        let location = $('#location').val();
        let dueDate  = $('#due-date').val();
        let peopleRequired = $('#people-required').val();   
        let budget = $('#budget').val();

        if (nextPageId === 'page-3'){
            
            let lcoationFlag = true;
            let dueDateFlag = true;
            let peopleRequiredFlag = true;
            let budgetFlag = true;

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
                formData.append('file', file.files[0]);
                
                $.post({
                    url: '/user/project/add',
                    data: formData,
                    processData: false,
                    contentType: false,
                }).then((response) => {
                    let data = JSON.parse(response);
                    if (data['status'] === 200){
                        $(`#${pageId}`).css('display', 'none');
                        $(`#${nextPageId}`).css('display', 'block');
                    }else{
                        $('#error-page-2').html('Internal Server Error');
                    }
                })
                
            }else{
                $('#error-page-2').html('Please enter the required fields');
            }
        }
        
        if (nextPageId === 'page-2'){
            
            let titleFlag = true; 
            let categoryFlag = true; 
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
</script>
@stop
