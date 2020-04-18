@extends('includes.admin.base')
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Project</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/project/add" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="title" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>

                                <input type="hidden" name="user_id" value="{{Auth::id()}}">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="cat_id">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"> {{$category->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="sub_cat_id">
                                            @foreach($subCategories as $subCategory)
                                                <option value="{{$subCategory->id}}"> {{$subCategory->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">File</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="file" class="form-control col-md-7 col-xs-12" onchange="selectImage(this)" name="file" accept="image/*" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control col-md-7 col-xs-12" name="location" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" class="form-control col-md-7 col-xs-12" name="due_date" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">People Required</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" class="form-control col-md-7 col-xs-12" name="people_required" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Budget</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" class="form-control col-md-7 col-xs-12" name="budget" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="form-control col-md-7 col-xs-12" name="description"></textarea>
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
                            <img class="ml-3" id="user-image" src="/images/category/dummy.png" alt="user image" height="250" width="250"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
