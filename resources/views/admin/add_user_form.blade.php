@extends('includes.admin.base')
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add User</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/user/add" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Full Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" pattern="[A-Za-z\s]{1,20}" name="name" class="form-control col-md-7 col-xs-12" required>
                                        <input type="hidden" name="role" value="2">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" name="email" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="role">
                                                <option value="2">User</option>
                                                <option value="3">Service Provider</option>
                                                <option value="4">Consultant</option>
                                            </select>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="gender">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="phone" pattern="[0-9]{11}" name="phone" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  type="file" class="form-control col-md-7 col-xs-12" onchange="selectImage(this)" name="image" accept="image/*" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="address" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="password" class="form-control col-md-7 col-xs-12" onkeyup="validatePassword()" id="password" required>
                                        <div>
                                            <p id="password-error"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password<span class="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" class="form-control col-md-7 col-xs-12" onkeyup="validateConfirmPassword()" id="confirm-password" required>
                                        <div>
                                            <p id="confirm-password-error"></p>
                                        </div>
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success" id="submit-button">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <img class="ml-3" id="user-image" src="/images/user/dummy.png" alt="user image" height="250" width="250"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function validatePassword() {
            if($('#password').val().length < 8){
                $('#password-error').css('color', 'red');
                $('#password-error').text('Password must be of 8 characters');
                $('#submit-button').attr('disabled', true);
            }else{
                $('#password-error').text(' ');
                $('#submit-button').attr('disabled', false);
            }
        }

        function validateConfirmPassword() {
            if ($('#password').val() !== $('#confirm-password').val()){
                $('#confirm-password-error').css('color', 'red');
                $('#confirm-password-error').text('Password do not match');
                $('#submit-button').attr('disabled', true);
            }else{
                $('#confirm-password-error').text(' ');
                $('#submit-button').attr('disabled', false);
            }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#user-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function selectImage(parameter){
            readURL(parameter);
        }
    </script>
@stop
