@extends('includes.admin.base')
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
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
                                        <img class="img-responsive avatar-view" src="@if($profile_data[0]->image != null) /images/user/{{$profile_data[0]->image}} @else /images/user/dummy.png @endif" alt="user image"/>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                <h3>{{$profile_data[0]->name}}</h3>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-envelope user-profile-icon"></i> {{$profile_data[0]->email}}
                                    </li>

                                    <li>
                                        <i class="fa fa-phone user-profile-icon"></i> {{$profile_data[0]->phone}}
                                    </li>

                                    <li>
                                        <i class="fa fa-genderless user-profile-icon"></i> {{$profile_data[0]->gender}}
                                    </li>

                                    <li>
                                        <i class="fa fa-star user-profile-icon"></i>
                                        @if($profile_data[0]->status == 0)
                                            Disabled
                                        @else
                                            Active
                                        @endif
                                    </li>

                                    <li>
                                        <i class="fa fa-ticket user-profile-icon"></i>
                                        @if($profile_data[0]->email_verified_at == null)
                                            Not Verified
                                        @else
                                            Verified
                                        @endif
                                    </li>

                                    <li>
                                        <i class="fa fa-map-pin user-profile-icon"></i> {{$profile_data[0]->address}}
                                    </li>
                                </ul>
                                <a class="btn btn-success" onclick="showEditSection()"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                <br />
                            </div>

                        </div>
                        <div id="user-profile-edit-section" style="display: none;">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/user/edit" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" pattern="[A-Za-z\s]{1,20}" name="name" class="form-control col-md-7 col-xs-12" value="{{$profile_data[0]->name}}" required>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="{{$profile_data[0]->id}}">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php if($profile_data[0]->role == 1){ ?>
                                            <input type="email" name="email" class="form-control col-md-7 col-xs-12"  value="{{$profile_data[0]->email}}" required>
                                        <?php }?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="phone" pattern="[0-9]{11}" name="phone" class="form-control col-md-7 col-xs-12" value="{{$profile_data[0]->phone}}" required>
                                        </div>
                                    </div>


                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-danger" type="button" onclick="showUserProfile()">Cancel</button>
                                            <button type="submit" class="btn btn-success" id="submit-button">Submit</button>
                                            <button type="button" data-toggle="modal"  data-target="#myModal" class="btn btn-info" >Update Password</button>
                                        </div>
                                    </div>
                                </form>

                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <form role="form" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{url('admin/update_password')}}" enctype="multipart/form-data">
                                            @csrf
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Password Change</h4>
                                            </div>
                                            <input type="hidden" name="password_from_database" id="password_from_database" value="{{$password[0]}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Current Passowrd <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="password" id="current_password" style="border-radius: 1rem !important;" name="current_password"  class="form-control col-md-7 col-xs-12"  required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >New Password <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="password"   name="new_password" pattern=".{8,}" style="border-radius: 1rem !important;" id="new_password" title="Must contain atleast 8 character" class="form-control col-md-7 col-sm-7 col-xs-12"  required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Confirm Passowrd <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="password"   name="confirm_password" pattern=".{8,}" style="border-radius: 1rem !important;" title="Must contain atleast 8 character" class="form-control col-md-7 col-xs-12"  required>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" id="update_button" class="btn btn-success" >Update</button>
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
    </div>
    <script>
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



    </script>
@stop
