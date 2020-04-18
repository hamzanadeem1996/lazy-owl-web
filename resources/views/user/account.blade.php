@extends('includes.user.base')
@section('content')

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Account</h1>
                <div class="separator mb-5"></div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <img id="user-image" style="border-radius: 5%" src="@if($user->image)/images/user/{{$user->image}} @else /images/user/dummy.png @endif" alt="user-image" width="200" height="200">
                                        @if($user->image)
                                            <div class="change-image" onclick="openDialogue()">
                                                <h4>Change Image</h4>
                                            </div>
                                        @else
                                            <div class="change-image" onclick="openDialogue()">
                                                <h4>Upload Image</h4>
                                            </div>
                                        @endif
                                        <form action="user/image/" method="POST" enctype="multipart/form-data">
                                            <input onchange="selectImage(this)" name="image" type="file" id="imgupload" style="display:none" accept="image/*"/> 
                                        </form>
                                    </div>

                                    <div class="col-lg-6">
                                        <input type="hidden" id="user-id" value="{{Auth::id()}}" />
                                        <div>
                                            <h5 class="mb-4" style="display: inline-block; color: #73236B">Basic Information</h5>
                                            <i id="edit-icon-basic-info" onclick="openEditSection('basic-info')" style="margin-left: 2%" class="simple-icon-pencil"></i>
                                            <i id="cross-icon-basic-info" onclick="openInfoSection('basic-info')" style="margin-left: 2%; display: none;" class="simple-icon-close"></i>
                                            <hr>
                                            <div id="basic-info">
                                                <div class="container fluid">
                                                    <h3>{{ $user->name }}</h3>
                                                    <br>
                                                    <h6>
                                                        <i style="margin-right: 1%" class="simple-icon-social-dropbox"></i>
                                                        {{$user->email}}
                                                        @if ($user->email_verified_at)
                                                        <span class="badge badge-success">Verified</span>
                                                        @else
                                                        <span class="badge badge-danger" style="padding: 3px">Un-verified</span>
                                                        @endif
                                                    </h6>
                                                    <h6>
                                                        <i style="margin-right: 1%" class="simple-icon-phone"></i>
                                                        @if($user->phone)
                                                            {{$user->phone}}
                                                        @else
                                                            No phone number added.
                                                        @endif
                                                    </h6>
                                                    <h6> 
                                                        <i style="margin-right: 1%" class="simple-icon-location-pin"></i>
                                                        @if($user->phone)
                                                            {{ $user->city }}
                                                        @else
                                                            No city added.
                                                        @endif 
                                                    </h6>
                                                    <h6>
                                                        <i style="margin-right: 1%" class="simple-icon-home"></i>
                                                        @if($user->phone)
                                                            {{ $user->address }}
                                                        @else
                                                            No address added.
                                                        @endif 
                                                    </h6>
                                                    
                                                    <h6>
                                                        @if($user->gender)
                                                            @if ($user->gender == 'Female')
                                                            <i style="margin-right: 1%" class="simple-icon-symbol-female"></i>
                                                            @else
                                                            <i style="margin-right: 1%" class="simple-icon-symbol-male"></i>
                                                            @endif
                                                            
                                                            {{$user->gender}}
                                                        @else
                                                            <i style="margin-right: 1%" class="simple-icon-symbol-male"></i>
                                                            No gender added.
                                                        @endif 
                                                        
                                                    </h6>
                                                    <h6>
                                                        <i style="margin-right: 1%" class="simple-icon-book-open"></i>
                                                        @if($user->description)
                                                            {{ $user->description }}
                                                        @else
                                                            No description added.
                                                        @endif 
                                                    </h6>
                                                </div>
                                            </div>
                                            <div id="basic-info-edit" style="display: none;">
                                                <div class="col-lg-12">
                                                    <form id="basic-info-form" method="POST" action="/user/edit">
                                                        <div class="form-group">
                                                            <label for="phone">Name</label>
                                                            <input type="text" class="form-control" name="name" onkeyup="validateName()" id="name" value="{{$user->name}}" placeholder="Enter Name" required>
                                                            <div id="name-error-div" style="display: none">
                                                                <p style="color: red" id="name-error"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control" name="phone" onkeyup="validatePhone()" id="phone" value="{{$user->phone}}" placeholder="Enter Phone" required>
                                                            <div id="phone-error-div" style="display: none">
                                                                <p style="color: red" id="phone-error"></p>
                                                            </div>
                                                        </div>
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="city">City</label>
                                                            <input type="text" class="form-control" name="city" id="city" onkeyup="validateCity()" value="{{$user->city}}" placeholder="Enter city" required>
                                                            <div id="city-error-div" style="display: none">
                                                                <p style="color: red" id="city-error"></p>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id" id="user-id" value="{{$user->id}}">
                                                        <input type="hidden" name="default_image" id="default-image" value="{{$user->image}}">
                                                        <div class="form-group">
                                                            <label for="city">Address</label>
                                                            <input type="text" class="form-control" name="address" id="address" value="{{$user->address}}" placeholder="Enter address" required>
                                                            <div id="address-error-div" style="display: none">
                                                                <p style="color: red" id="address-error"></p>
                                                            </div>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <select class="form-control" name="gender">
                                                                <option value="Male" @if($user->gender == "Male") selected @endif>Male</option>
                                                                <option value="Female" @if($user->gender == "Female") selected @endif>Female</option>
                                                            </select>
                                                        </div>
            
                                                        <div class="form-group">
                                                            <label for="city">About</label>
                                                            <textarea class="form-control" id="about" name="description">{{$user->description}}</textarea>
                                                            <div id="about-error-div" style="display: none">
                                                                <p style="color: red" id="about-error"></p>
                                                            </div>
                                                        </div>
                        
                                                        <button type="submit" onclick="validateBasicInformation()" class="btn btn-primary mb-0">Submit</button>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="mb-4" style="display: inline-block; color: #73236B">Academic Background</h5>
                                    <i id="edit-icon-education" onclick="openEditSection('education')" style="margin-left: 2%" class="simple-icon-pencil"></i>
                                    <i id="cross-icon-education" onclick="openInfoSection('education')" style="margin-left: 2%; display: none;" class="simple-icon-close"></i>
                                    <hr>
                                </div>
                                <div class="row" style="margin-top: 3%">
                                    <div id="education" class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h3>Degree :</h3>
                                                <br>
                                                <h3>Programe :</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>
                                                    @if (isset($user->degree))
                                                        {{$user->degree->degree->title}}
                                                    @else
                                                        No Data Available
                                                    @endif
                                                </h3>
                                                <br>
                                                <h3>
                                                    @if (isset($user->degree))
                                                        {{$user->degree->programme->title}}
                                                    @else
                                                        No Data Available
                                                    @endif
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="education-edit" class="col-lg-6" style="display: none">
                                        <form method="POST" action="/user/qualification">
                                            @csrf
                                            <div class="form-group">
                                                <label for="gender">Degree</label>
                                                <select class="form-control" name="degree" id="degree" onchange="getProgrammes(this.value)">
                                                    <option value="">Select</option>
                                                    @foreach ($degrees as $degree)
                                                        <option value="{{$degree->id}}"
                                                            @if (isset($user->degree) && ($user->degree->id == $degree->id))
                                                                selected
                                                            @endif
                                                            >
                                                            {{$degree->title}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender">Programe</label>
                                                <select class="form-control" name="programme" id="programme">
                                                    <option value="" id="temp-programme">Select Degree</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <button type="submit" class="btn btn-primary mb-0" id="qualification-button">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="mb-4" style="display: inline-block; color: #73236B">Portfolio</h5>
                                    <i id="edit-icon-portfolio" onclick="openEditSection('portfolio')" style="margin-left: 2%" class="simple-icon-pencil"></i>
                                    <i id="cross-icon-portfolio" onclick="openInfoSection('portfolio')" style="margin-left: 2%; display: none;" class="simple-icon-close"></i>
                                    <hr>
                                </div>
                                <div class="row" style="margin-top: 3%">
                                    <div id="portfolio" class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h3>Portfolio :</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <h3>
                                                    @if ($user->portfolio)
                                                        <a href="/portfolio/{{$user->portfolio->media}}" download>
                                                            {{$user->portfolio->media}}
                                                        </a>
                                                    @else
                                                        No Data Available
                                                    @endif
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="portfolio-edit" class="col-lg-6" style="display: none">
                                        <form method="POST" action="/user/portfolio" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="file" name="portfolio" class="form-control" accept="application/msword, 
                                                                                                            application/vnd.ms-excel, 
                                                                                                            application/vnd.ms-powerpoint,
                                                                                                            text/plain, 
                                                                                                            application/pdf, 
                                                                                                            images/*">
                                            </div>
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <button type="submit" class="btn btn-primary mb-0">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" 
                    @if(Auth::user()->role !== 3)    
                        style="display: none"
                    @endif
                >
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <h5 class="mb-4" style="display: inline-block; color: #73236B">Services</h5>
                                    <i id="edit-icon-services" onclick="openEditSection('services')" style="margin-left: 2%" class="simple-icon-pencil"></i>
                                    <i id="cross-icon-services" onclick="openInfoSection('services')" style="margin-left: 2%; display: none;" class="simple-icon-close"></i>
                                    <hr>
                                </div>
                                <div class="row" style="margin-top: 3%">
                                    <div id="services" class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                @foreach ($user->services as $service)
                                                    <h3>{{$service->category->name}} :</h3>
                                                @endforeach
                                            </div>
                                            <div class="col-lg-6">
                                                @foreach ($user->services as $service)
                                                    <h3>{{$service->sub_category->name}}</h3>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div id="services-edit" class="col-lg-12" style="display: none">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                @foreach ($user->services as $service)
                                                    <h3> 
                                                        <i  id="delete-service-icon" 
                                                            class="simple-icon-trash" 
                                                            onclick="deleteServiceModal({{$service->id}})"
                                                            data-toggle="modal" 
                                                            data-target="#deleteServiceModal"
                                                        >
                                                        </i> 
                                                        {{$service->category->name}} :
                                                    </h3>
                                                @endforeach
                                            </div>
                                            <div class="col-lg-6">
                                                @foreach ($user->services as $service)
                                                    <h3>{{$service->sub_category->name}}</h3>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form style="margin-top: 5%" method="POST" action="/user/services" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="gender">Category</label>
                                                        <select class="form-control" name="service_cat_id[]" id="category" onchange="getSubCategories(this.value)">
                                                            <option value="">Select Category</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{$category->id}}">
                                                                    {{$category->name}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender">Sub Category</label>
                                                        <select class="form-control" name="service_sub_cat_id[]" id="sub-category">
                                                            <option value="" id="temp-sub-category">Select Category First</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <button type="submit" class="btn btn-primary mb-0" id="service-button">Submit</button>
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
        </div>
    </div>
</main>

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
    @if($user->degree)
        window.onload = getUserData();
        
        function getUserData(){
            let degreeId = null;
            if (degree) { 
                degreeId = {!! json_encode($user->degree->id) !!};
                if (degreeId) {
                    setTimeout(function(){
                        getProgrammes(degreeId);
                    }, 1000)
                }
            }
        }
    @endif

    function deleteServiceModal(id) {
        $('#service-id').val(id);
    }

    function deleteServiceForm() {
        $('#delete-service-form').submit();
    }
    
    function getSubCategories(categoryId){
        $.get(`/admin/hamza/${categoryId}`).then((response) => {
            let data = JSON.parse(response);
            $('#temp-sub-category').css('display', 'none');
            $('#sub-category').attr('disabled', false);
            $('#sub-category').html('');
            if (data.length > 0){
                data.forEach((element) => {                        
                    let option = `<option value="${element.id}">${element.name}</option>`;
                    $('#sub-category').append(option);
                })
                $('#service-button').attr('disabled', false);

            }else{
                let option = `<option value="">No data available</option>`;
                $('#sub-category').append(option);
                $('#service-button').attr('disabled', true);
            }
        });
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
                $('#qualification-button').attr('disabled', false);

            }else{
                let option = `<option value="">No data available</option>`;
                $('#programme').append(option);
                $('#qualification-button').attr('disabled', true);
            }
        });
    }

    function openDialogue(){
        $('#imgupload').trigger('click');
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);

            let userId = $('#user-id').val();
            
            var fd = new FormData();
            var files = input.files[0];
            fd.append('file',files);
            fd.append('user_id', userId);
            fd.append("_token", "{{ csrf_token() }}");
            
            $.ajax({
                url: '/user/account/image',
                data: fd,
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(response) {
                    let imageData = JSON.parse(response);
                    $('#default-image').val(imageData.imageName);
                }       
            });
        }
    }

    function selectImage(parameter){
        readURL(parameter);

    }

    function openEditSection(section){
        $(`#${section}`).css('display', 'none');
        $(`#${section}-edit`).css('display', 'block');
        $(`#cross-icon-${section}`).css('display', 'block');
        $(`#edit-icon-${section}`).css('display', 'none');
    }

    function openInfoSection(section){
        $(`#${section}-edit`).css('display', 'none');
        $(`#${section}`).css('display', 'block');
        $(`#cross-icon-${section}`).css('display', 'none');
        $(`#edit-icon-${section}`).css('display', 'block');
    }

    function validatePhone(){
        let phone = $('#phone').val();
        
        if (/^\d{11}$/.test(phone)){
            $('#phone-error-div').css('display', 'none');
        }else{
            $('#phone-error-div').css('display', 'block');
            $('#phone-error').html('Phone number should only contains numbers and can not be less or greater than 11 digits');
        }
    }

    function validateCity(){
        let city = $('#city').val();
        if (/^[A-Za-z]+$/.test(city)){
            $('#city-error-div').css('display', 'none');
        }else{
            $('#city-error-div').css('display', 'block');
            $('#city-error').html('Name of city can not contains numbers');
        }
    }

    function validateName(){
        let name = $('#name').val();
        if (/^[A-Za-z]+$/.test(name)){
            $('#name-error-div').css('display', 'none');
        }else{
            $('#name-error-div').css('display', 'block');
            $('#name-error').html('Name can not contains numbers');
        }
    }

    function validateBasicInformation(){
        let phone = $('#phone').val();
        let city = $('#city').val();
        let address = $('#address').val();
        let about = $('#about').val();
        let name = $('#name').val();

        let phoneFlag, cityFlag, addressFlag, aboutFlag, nameFlag = false;

        if (phone.length == 0){
            $('#phone-error-div').css('display', 'block');
            $('#phone-error').html('Phone Number is required');
            phoneFlag = true;
        }

        if (name.length == 0){
            $('#name-error-div').css('display', 'block');
            $('#name-error').html('Name is required');
            nameFlag = true;
        }

        if (city.length == 0){
            $('#city-error-div').css('display', 'block');
            $('#city-error').html('City name is required');
            cityFlag = true;
        }

        if (address.length == 0){
            $('#address-error-div').css('display', 'block');
            $('#address-error').html('Address is required');
            addressFlag = true;
        }

        if (about.length == 0){
            $('#about-error-div').css('display', 'block');
            $('#about-error').html('About is required');
            aboutFlag = true;
        }else if (about.length < 20){
            $('#about-error-div').css('display', 'block');
            $('#about-error').html('About should be greater than 20 characters');
            aboutFlag = true;
        }

        if (!phoneFlag){
            $('#phone-error-div').css('display', 'none');
        }

        if (!cityFlag){
            $('#city-error-div').css('display', 'none');
        }

        if (!addressFlag){
            $('#address-error-div').css('display', 'none');
        }

        if (!aboutFlag){
            $('#about-error-div').css('display', 'none');
        }

        if (!nameFlag){
            $('#name-error-div').css('display', 'none');
        }

        if ((!phoneFlag) && (!cityFlag) && (!addressFlag) && (!aboutFlag) && (!nameFlag)){
            $('#basic-info-form').submit();
        }
    }
</script>

@stop