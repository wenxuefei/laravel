@extends('layouts.admin')

@section('css')
    <link href="{{asset('backend/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/starrr/dist/starrr.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Elements</h3>
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
                        <h2>添加权限</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                        <br/>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br/>

                        <form action="{{url('admin/permission')}}" method="post" id="demo-form2"
                              class="form-horizontal form-label-left">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">权限
                                    <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name" name="name" value="{{old('name')}}"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="{{url()->previous()}}" class="btn btn-primary">Cancel</a>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- iCheck -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>
    <script src="{{asset('backend/vendors/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('backend/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
    <script src="{{asset('backend/vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
    <script src="{{asset('backend/vendors/google-code-prettify/src/prettify.js')}}"></script>
    <script src="{{asset('backend/vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <script src="{{asset('backend/vendors/switchery/dist/switchery.min.js')}}"></script>
    <script src="{{asset('backend/vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/vendors/parsleyjs/dist/parsley.min.js')}}"></script>
    <script src="{{asset('backend/vendors/autosize/dist/autosize.min.js')}}"></script>
    <script src="{{asset('backend/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>
    <script src="{{asset('backend/vendors/starrr/dist/starrr.js')}}"></script>
@endsection
