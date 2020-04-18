@extends('includes.admin.base')
@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Sub Category</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="/admin/sub-category/edit" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="cat_id">
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}" @if($cat->id == $category->cat_id) selected @endif> {{$cat->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="{{$category->id}}">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="name" class="form-control col-md-7 col-xs-12" value="{{$category->name}}" required>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
