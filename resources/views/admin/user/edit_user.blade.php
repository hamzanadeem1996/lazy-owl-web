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
                                    <img class="img-responsive avatar-view" src="@if($user->image != null) /images/user/{{$user->image}} @else /images/user/dummy.png @endif" alt="user image"/>
                                </div>
                            </div>
                            <h3>{{$user->name}}</h3>

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
                                        Disabled
                                    @else
                                        Active
                                    @endif
                                </li>

                                <li>
                                    <i class="fa fa-ticket user-profile-icon"></i>
                                    @if($user->email_verified_at == null)
                                        Not Verified
                                    @else
                                        Verified
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
                                    <li role="presentation" class="active"><a href="#tab_content1" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="education-tab" data-toggle="tab" aria-expanded="false">Qualifications</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="portfolio-tab" data-toggle="tab" aria-expanded="false">Portfolio</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="profile-tab">
                                        <table class="data table table-striped no-margin">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Project Name</th>
                                                <th>Client Company</th>
                                                <th class="hidden-phone">Hours Spent</th>
                                                <th>Contribution</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>New Company Takeover Review</td>
                                                <td>Deveint Inc</td>
                                                <td class="hidden-phone">18</td>
                                                <td class="vertical-align-mid">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="tab_content2" aria-labelledby="education-tab">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h2 class="green" style="margin-left: 5%">Degree</h2>
                                                    <h2 class="green" style="margin-left: 5%">Programme</h2>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h2>Bachelores</h2>
                                                    <h2>Computer Science</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade in" id="tab_content3" aria-labelledby="portfolio-tab">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h2 class="green" style="margin-left: 5%">Download File</h2>
                                                    <a href="" style="margin-left: 5%" download>File.docx</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="user-profile-edit-section" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h3 class="green" style="margin-bottom: 6%">Basic Information</h3>
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
    
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button class="btn btn-danger" type="button" onclick="showUserProfile()">Cancel</button>
                                                <button type="submit" class="btn btn-success" id="submit-button">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <img style="margin-top: 9%" class="ml-3" id="user-image" src="@if($user->image != null) /images/user/{{$user->image}} @else /images/user/dummy.png @endif" alt="user image" height="250" width="250"/>
                                    <div class="remove-image" @if($user->image == null) style="display: none" @endif>
                                        <a href="#" onclick="removeImage()">Remove Image</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top: 5%">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h3 class="green">Qualifications</h3>
                                    <form name="qualification-form" id="qualification-form" data-parsley-validate class="form-horizontal form-label-left" action="/admin/user/edit/qualification" method="POST">
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Degree</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="degree" id="degree" onchange="getProgrammes(this.value)">
                                                    <option value="">Select</option>
                                                    @foreach ($degrees as $degree)
                                                        <option value="{{ $degree->id }}">{{ $degree->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Programme</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" name="programme" id="programme" disabled>
                                                    <option value="" id="temp-programme">Select Degree</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button class="btn btn-danger" type="button" onclick="showUserProfile()">Cancel</button>
                                                <button type="button" class="btn btn-success" id="submit-button-qualificatio" onclick="sumitQualifications()" disabled>Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 5%">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h3 class="green">Portfolio</h3>
                                    <form name="portfolio-form" id="portfolio-form" data-parsley-validate class="form-horizontal form-label-left" action="/admin/user/edit/portfolio" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Portfolio</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input class="form-control" type="file" name="portfolio" id="portfolio" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, images/*" onchange="addPortfolio()">
                                            </div>
                                        </div>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button class="btn btn-danger" type="button" onclick="showUserProfile()">Cancel</button>
                                                <button type="submit" class="btn btn-success" id="submit-button-portfolio" disabled>Submit</button>
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

        function getProgrammes(degreeId){
            $.get(`/admin/user/programme/${degreeId}`).then((response) => {
                let data = JSON.parse(response);
                $('#temp-programme').css('display', 'none');
                $('#programme').attr('disabled', false);
                $('#programme').html('');
                if (data.length > 0){
                    data.forEach((element) => {                        
                        let option = `<option value="${element.id}">${element.title}</option>`;
                        $('#programme').append(option);
                    })
                    $('#submit-button-qualificatio').attr('disabled', false);
                }else{
                    let option = `<option value="">No data available</option>`;
                    $('#programme').append(option);
                }
            });
        }

        function sumitQualifications(){
            let degree = $('#degree').val();
            let programme = $('#programme').val();
            if (degree && programme){
                $('#qualification-form').submit();
            }
        }

        function addPortfolio(){
            $('#submit-button-portfolio').attr('disabled', false);
        }

    </script>
@stop
