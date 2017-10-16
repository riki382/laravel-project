@extends('admin/layouts/adminlayout')

@section('title')
    Edit Product
@endsection

@section('body_content')
<div class="right_col" role="main" style="min-height: 3576px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Product</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Field Information
                            <small>Please enter details</small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i
                                        class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form id="demo-form2" method="post" data-parsley-validate=""
                              class="form-horizontal form-label-left"
                              action="{{ route('product.update', $row->id) }}" novalidate="" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Title <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-6 col-xs-12">
                                    <input type="text" id="title" name="title" required="required"
                                           class="form-control col-md-7 col-xs-12"
                                           value="{{ $row->title }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Category <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-6 col-xs-12">
                                    <select name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $row->category_id) selected @endif>
                                            {{$category->title}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Brand <span
                                            class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-6 col-xs-12">
                                    <select name="brand_id" class="form-control">
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" @if($brand->id == $row->brand_id) selected @endif>
                                                {{$brand->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Price <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-6 col-xs-12">
                                    <input type="text" id="price" name="price" required="required"
                                           class="form-control col-md-7 col-xs-12"
                                           value="{{ $row->price }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Content <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-6 col-xs-12">
                                    <textarea id="content" name="content" required="required" class="form-control col-md-7 col-xs-12">{{ $row->content }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Image <span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-6 col-xs-12">
                                    <input id="title" type="file" name="image" class="form-control col-md-7 col-xs-12">
                                    <br /><br /><img src="{{  $row->image }}" height="60" width="60">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    @include('admin/layouts/scripts/form')
@endsection