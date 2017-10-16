<?php
/**
 * Created by PhpStorm.
 * User: riki
 * Date: 9/13/17
 * Time: 1:41 PM
 */
?>

@extends('admin/layouts/adminlayout')

@section('title')
    Featured Product List
@endsection

@section('body_content')
    <div class="right_col" role="main" style="min-height: 1161px;">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Featured Product List </h2>
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

                            <p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th>
                                            <div class="icheckbox_flat-green" style="position: relative;"><input
                                                        type="checkbox" id="check-all"
                                                        class="flat"
                                                        style="position: absolute; opacity: 0;">
                                                <ins class="iCheck-helper"
                                                     style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                            </div>
                                        </th>
                                        <th class="column-title">Id </th>
                                        <th class="column-title">Product </th>
                                        <th class="column-title">Discount </th>
                                        <th class="column-title">Start Date </th>
                                        <th class="column-title">End Date </th>
                                        <th class="column-title">Type </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                        class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($featured as $row)
                                        <tr class="even pointer">
                                            <td class="a-center ">
                                                <div class="icheckbox_flat-green" style="position: relative;"><input
                                                            type="checkbox" class="flat"
                                                            name="table_records"
                                                            style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper"
                                                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                            </td>
                                            <td class=" ">{{ $row->id }}</td>
                                            <td class=" ">{{ $row->ptitle }} </td>
                                            <td class=" ">{{ $row->discount }}</td>
                                            <td class=" ">{{ $row->start_date }}</td>
                                            <td class=" ">{{ $row->end_date }}</td>
                                            <td class=" ">{{ $row->type }}</td>
                                            <td class=" last">
                                                <a href="/admin/featured/{{ $row->id }}/edit" class="btn btn-primary">Edit</a>
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['featured.destroy', $row->id]]) }}
                                                {{ Form::hidden('id', $row->id) }}
                                                {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you Sure?")']) }}
                                                {{ Form::close() }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    @include('admin/layouts/scripts/table')
@endsection
