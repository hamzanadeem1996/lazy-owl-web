@extends('includes.admin.base')
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Service Provider Profile</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <div id="user-profile-section">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="@if($user->image != null) /images/user/{{$user->image}} @else /images/user/dummy.png @endif" alt="user image"/>
                                    </div>
                                </div>
                                <h3>{{$user->name}}</h3>
                                <p class="ratings">
                                    @if(count($user->ratings) >0)
                                    @foreach($user->ratings as $rating)
                                    <a>{{$rating->rating}}.0</a>
                                    <a href="#"><span class="{{$rating->rating >= 1 ? 'fa fa-star': 'fa fa-star-o'}}"></span></a>
                                    <a href="#"><span class="{{$rating->rating >= 2 ? 'fa fa-star': 'fa fa-star-o'}}"></span></a>
                                    <a href="#"><span class="{{$rating->rating >= 3 ? 'fa fa-star': 'fa fa-star-o'}}"></span></a>
                                    <a href="#"><span class="{{$rating->rating >= 4 ? 'fa fa-star': 'fa fa-star-o'}}"></span></a>
                                    <a href="#"><span class="{{$rating->rating >= 5 ? 'fa fa-star': 'fa fa-star-o'}}"></span></a>
                                     @endforeach
                                        @else
                                        <a>0.0</a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                        <a href="#"><span class="fa fa-star-0"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                    @endif
                                </p>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-envelope user-profile-icon"></i> {{$user->email}}
                                    </li>

                                    <li>
                                        <i class="fa fa-phone user-profile-icon"></i> {{$user->phone}}
                                    </li>

                                    <li>
                                        <i class="fa fa-genderless user-profile-icon"></i> {{$user->gender}}
                                    </li>

                                    <li>
                                        <i class="fa fa-star user-profile-icon"></i>
                                        @if($user->status == 0)
                                            <span class="label label-danger">Disbaled</span>
                                        @else
                                            <span class="label label-success">Active</span>
                                        @endif
                                    </li>

                                    <li>
                                        <i class="fa fa-ticket user-profile-icon"></i>
                                        @if($user->email_verified_at == null)
                                            <span class="label label-danger">Not Verified</span>
                                        @else
                                            <span class="label label-success">Verified</span>
                                        @endif
                                    </li>

                                    <li>
                                        <i class="fa fa-map-pin user-profile-icon"></i> {{$user->address}}
                                    </li>
                                </ul>
                                <a class="btn btn-success" onclick="showEditSection()"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                <br />
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Reviews</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Services</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                            <!-- start recent activity -->
                                            @if(count($user->reviews) > 0)
                                            <ul class="messages">
                                                <?php $i=1; ?>
                                                @foreach($user->reviews as $review)
                                                <li>
                                                    <img src="@if($review->user->image == null) /images/user/dummy.png @else /images/user/{{$review->user->image}} @endif" class="avatar" alt="Avatar">
                                                    <div class="message_date">
                                                        <p class="month">
                                                            {{$review->created_at}}
                                                        </p>
                                                        <a href="" onclick="deleteComment({{$review->id}})" style="color: red;" data-toggle="modal" data-target="#deleteModal">
                                                            Delete
                                                        </a>

                                                    </div>
                                                    <div class="message_wrapper">
                                                        <h4 class="heading">{{$review->user->name}}</h4>
                                                        <blockquote class="message">{{$review->review}}</blockquote>
                                                        <br />
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @else
                                                <h4>No reviews added</h4>
                                            @endif
                                            <!-- end recent activity -->

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                            <!-- start user projects -->
                                            @if(count($user->services) > 0)
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category</th>
                                                    <th>Sub-Category</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=1; ?>
                                                @foreach($user->services as $service)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{$service->category->name}}</td>
                                                        <td>{{$service->sub_category->name}}</td>
                                                        <td>
                                                            @if($service->status  == 1)
                                                                <span class="label label-success">Active</span>
                                                                @else
                                                                <span class="label label-danger">Disabled</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="" onclick="deleteServiceModal({{$service->id}})" style="color: red;" data-toggle="modal" data-target="#deleteServiceModal">
                                                                <span class="label label-danger">Delete</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                                </tbody>
                                            </table>
                                                @else
                                            <h4>No services added</h4>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="user-profile-edit-section" style="display: none;">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <h3>Basic Information</h3>
                                <br/>
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/user/edit" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" pattern="[A-Za-z\s]{1,20}" name="name" class="form-control col-md-7 col-xs-12" value="{{$user->name}}" required>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="{{$user->id}}">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" name="email" class="form-control col-md-7 col-xs-12" value="{{$user->email}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="gender">
                                                <option @if($user->gender == 'Male') selected @endif>Male</option>
                                                <option @if($user->gender == 'Female') selected @endif>Female</option>
                                                <option @if($user->gender == 'Other') selected @endif>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="phone" pattern="[0-9]{11}" name="phone" class="form-control col-md-7 col-xs-12" value="{{$user->phone}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input  type="file" class="form-control col-md-7 col-xs-12" id="user-image-value" onchange="selectImage(this)" name="image" value="{{$user->image}}" />
                                            <input type="hidden" name="default_image" value="{{$user->image}}" id="default-image"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea name="address" class="form-control">{{$user->address}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-danger" type="button" onclick="showUserProfile()">Cancel</button>
                                            <button type="submit" class="btn btn-success" id="submit-button">Save</button>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                </form>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <img class="ml-3" id="user-image" src="@if($user->image != null) /images/user/{{$user->image}} @else /images/user/dummy.png @endif" alt="user image" height="250" width="250"/>
                                <div class="remove-image" @if($user->image == null) style="display: none" @endif>
                                    <a href="#" onclick="removeImage()">Remove Image</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h3>Add Services</h3>
                                    <br/>
                                    <form id="demo-form3" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/service-provider/services/edit" enctype="multipart/form-data">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <div id="service-container">
                                                <div id="initial-div">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control" name="service_cat_id[]">
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" value="0" id="div-count">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="form-control" name="service_sub_cat_id[]">
                                                                @foreach($sub_categories as $sub_category)
                                                                    <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <a id="add-button" class="btn btn-success" type="button" onclick="appendServices()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                                                    <a id="remove-button" style="display: none" class="btn btn-danger cross-button" type="button" onclick="deleteService()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                        <button type="submit" class="btn btn-success" id="submit-button-services">Save</button>
                                                    </div>
                                                </div>
                                                <div class="ln_solid"></div>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none">
        <div id="add-section">
            <div class="ln_solid"></div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="service_cat_id[]">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="service_sub_cat_id[]">
                        @foreach($sub_categories as $sub_category)
                            <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                       Delete Comment
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to delete this comment?</h4>
                    <form id="delete-form" method="POST" action="/admin/user/comment/delete">
                        <input type="hidden" name="id" id="comment-id">
                        @csrf
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="deleteForm()" class="btn btn-danger" id="submitButton">Delete Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteServiceModal" tabindex="-1" role="dialog" aria-labelledby="deleteServiceModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Delete Service
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to delete this service?</h4>
                    <form id="delete-service-form" method="POST" action="/admin/service-provider/service/delete">
                        <input type="hidden" name="id" id="service-id">
                        @csrf
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onclick="deleteServiceForm()" class="btn btn-danger" id="submitButton">Delete Service</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteServiceForm() {
            $('#delete-service-form').submit();
        }

        function deleteServiceModal(id) {
            $('#service-id').val(id);
        }

        function showEditSection() {
            $('#user-profile-section').css('display', 'none');
            $('#user-profile-edit-section').css('display', 'block');
        }

        function showUserProfile() {
            $('#user-profile-section').css('display', 'block');
            $('#user-profile-edit-section').css('display', 'none');
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#user-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            $('.remove-image').css('display', 'block');
        }

        function selectImage(parameter){
            readURL(parameter);
        }

        function removeImage() {
            $('.remove-image').css('display', 'none');
            $('#user-image').attr('src', "/images/user/dummy.png");
            $('#default-image').val(null);
        }

        function deleteComment(id) {
            $('#comment-id').val(id);
        }

        function deleteForm() {
            $('#delete-form').submit();
        }

        //TODO: dynamic services according to service provider package
        function appendServices() {
            var count = $('#div-count').val();
            if (count < 2){
                count = parseInt(count) + 1;
                $('#div-count').val(count);
                var newDiv = `<div id='div-${count}'></div>`;
                $('#initial-div').append(newDiv);
                $(`#div-${count}`).css('margin-top', '10%');
                var content = $('#add-section').html();
                $(`#div-${count}`).append(content);

            }
            if (count <= 0){
                $('#remove-button').css('display', 'none');
            }else{
                $('#remove-button').css('display', 'inline');
            }
            if (count >= 2){
                $('#add-button').css('display', 'none');
            }else{
                $('#add-button').css('display', 'inline');
            }
        }

        function deleteService() {
            var count = $('#div-count').val();
            $('#div-count').val(count - 1);
            $(`#div-${count}`).remove();
            if ($('#div-count').val() >= 2){
                $('#add-button').css('display', 'none');
            }else{
                $('#add-button').css('display', 'inline');
            }
            if (count <= 1){
                $('#remove-button').css('display', 'none');
            }else{
                $('#remove-button').css('display', 'inline');
            }
        }
    </script>
@stop
