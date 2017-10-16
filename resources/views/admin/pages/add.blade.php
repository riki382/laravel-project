<?php
/**
 * Created by PhpStorm.
 * User: riki
 * Date: 9/14/17
 * Time: 2:25 PM
 */
?>

@extends('admin/layouts/adminlayout')

@section('title')
    Add Pages
@endsection

@section('body_content')
    <div class="right_col" role="main" style="min-height: 3562px;">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Create New Pages</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input class="form-control" placeholder="Search for..." type="text">
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
                            <h2>Field Information <small>Please enter details</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench">
                                        </i></a>
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
                            <form id="demo-form2" data-parsley-validate="" method="post" class="form-horizontal form-label-left"
                                  action="{{route('product.store')}}" novalidate="" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                        <input id="title" name="title" required="required" class="form-control col-md-7 col-xs-12" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Content <span class="required">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-6 col-xs-12">
									<textarea id="content" name="content" required="required" class="form-control col-md-7 col-xs-12" type="text">
									</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Meta Keyword <span class="required">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                        <input id="meta_keyword" name="meta_keyword" required="required" class="form-control col-md-7 col-xs-12" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Meta Description <span class="required">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                        <input id="meta_description" name="meta_description" required="required" class="form-control col-md-7 col-xs-12" type="text">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Image <span class="required">*</span>
                                    </label>
                                    <div class="col-md-10 col-sm-6 col-xs-12">
                                        <input id="title" type="file" name="image" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary" type="button">Cancel</button>
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
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
