@extends('includes.admin.base')
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Project</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/project/edit" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="title" class="form-control col-md-7 col-xs-12" value="{{$project->title}}" required>
                                    </div>
                                </div>

                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="id" value="{{$project->id}}">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="cat_id">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" @if($project->cat_id == $category->id) selected @endif> {{$category->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="sub_cat_id">
                                            @foreach($subCategories as $subCategory)
                                                <option value="{{$subCategory->id}}" @if($project->sub_cat_id == $subCategory->id) selected @endif> {{$subCategory->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">File</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control col-md-7 col-xs-12" onchange="selectImage(this)" name="file" accept="image/*" />
                                        <input type="hidden" name="default_file" value="{{$project->media}}" id="default-image"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" name="location" value="{{$project->location}}" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" class="form-control col-md-7 col-xs-12" name="due_date" value="{{$project->due_date}}" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">People Required</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" class="form-control col-md-7 col-xs-12" name="people_required" value="{{$project->people_required}}" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Budget</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" class="form-control col-md-7 col-xs-12" name="budget" value="{{$project->budget}}" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Posted By</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-center mt-5" style="font-size: 16">
                                        <a href="/admin/user/edit/{{$project->user->id}}">{{$project->user->name}}</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Assigned To</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                                        @if($project->assigned_to !== null)
                                            <a href="/admin/user/edit/{{$project->assigned_to}}">User {{$project->assigned_to}}</a>
                                        @else
                                            <h3> - </h3>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control col-md-7 col-xs-12" name="description">{{$project->description}}</textarea>
                                    </div>
                                </div>

                                <div class="ln_solid" style="margin-top: 25%"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success" id="submit-button">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <img class="ml-3" id="user-image"
                                 src="
                                    @if($project->media == null)
                                     /images/category/dummy.png
                                    @else
                                     /images/project/{{$project->media}}
                                    @endif
                                     "
                                 alt="project files" height="250" width="250"/>
                            <div class="remove-image" @if($project->media == null) style="display: none" @endif>
                                <a href="#" onclick="removeMedia()">Remove Media</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function removeMedia() {
            $('.remove-image').css('display', 'none');
            $('#user-image').attr('src', "/images/category/dummy.png");
            $('#default-image').val(null);
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
