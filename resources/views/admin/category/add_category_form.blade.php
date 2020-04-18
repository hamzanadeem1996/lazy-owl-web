@extends('includes.admin.base')
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Category</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/category/add" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="name" class="form-control col-md-7 col-xs-12" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input  type="file" class="form-control col-md-7 col-xs-12" onchange="selectImage(this)" name="image" accept="image/*" />
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
