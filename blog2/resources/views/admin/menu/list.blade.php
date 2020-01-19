@extends('layouts.admin')
@section('css')
    <!-- iCheck -->
    <link href="{{asset('backend/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{asset('backend/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{asset('backend/vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    <!-- nestable -->
    <link href="{{asset('backend/vendors/jquery-nestable/jquery.nestable.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/layer/layer.css')}}" rel="stylesheet">
@endsection
@inject('menus','App\Repositories\Presenters\MenuPresenter')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>菜单管理</h3>
            </div>
        </div>

        <div class="clearfix"></div>
        @include('flash::message')
        <div class="row">
            <!-- left panel -->
            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Pop Overs <small>Sessions</small></h2>
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
                    <div class="x_content bs-example-popovers">
                        <div class="dd" id="nestable_list_3">

                            <ol class="dd-list">
                                {!! $menus->getMenuList($menusList) !!}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end left panel -->
            <!-- right panel -->
            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>菜单数据</h2>
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
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <br/>
                        <form class="form-horizontal form-label-left" id="menuForm" action="{{url('admin/menu')}}"
                              method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单名称</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control"
                                           placeholder="名称">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单图标</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="icon" value="{{old('icon')}}" class="form-control"
                                           placeholder="图标">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">父级菜单</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="pid" name="parent_id" class="select2_single form-control" tabindex="-1">

                                        {!! $menus->getMenu($menu) !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单链接</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="url" value="{{old('url')}}" class="form-control"
                                           placeholder="链接">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单权限</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="slug" value="{{old('slug')}}" class="form-control"
                                           placeholder="链接">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单高亮</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="heightlight_url" value="{{old('heightlight_url')}}"
                                           class="form-control" placeholder="菜单高亮">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单高亮</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" name="sort" value="{{old('sort')}}" class="form-control"
                                           placeholder="菜单顺序">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- end right panel -->
        </div>
    </div>
@endsection
@section('js')
    <!-- Select2 -->
    <script src="{{asset('backend/vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/vendors/select2/src/js/wrapper.end.js')}}"></script>

    <!-- nestable -->
    <script src="{{asset('backend/vendors/jquery-nestable/jquery.nestable.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/vendors/layer/layer.js')}}"></script>

    <script>


        var menuList = function () {
            var menuInit = function () {
                // Select2
                $(".select2_single").select2({
                    placeholder: "Select a state",
                    allowClear: true
                });

                // nestable
                $('#nestable_list_3').nestable({
                    'maxDepth': 2
                });

                // 添加按钮事件
                $(document).on('click', '.createMenu', function () {
                    $("#method").remove();
                    $('input[name=id]').remove()
                    $('#menuForm').attr('action', '/admin/menu')
                    $('#menuForm input.form-control').val('')
                    var pid = $(this).attr('data-pid');
                    $("#pid").val(pid).trigger("change");
                })

                // 修改菜单按钮事件
                $(document).on('click', '.editMenu', function () {
                    var _url = $(this).attr('data-href');
                    $.ajax({
                        url: _url,
                        dataType: 'json',
                        beforeSend: function () {
                            // loading
                            layer.load(1);
                        },
                        success: function (menu) {
                            layer.closeAll('loading');
                            menuFun.initAttribute(menu);
                            layer.msg(menu.msg, {icon: 6})
                        }

                    })



                })

                $(document).on('click', '.destroyMenu', function () {
                    var _delete = $(this).attr('data-id')
                    layer.confirm('确定要删除菜单？', {
                        btn: ['确定', '取消']
                    }, function () {
                        $('form[name=delete_item' + _delete + ']').submit()
                    })
                })

                var menuFun = function () {
                    var menuAttribute = function (menu) {
                        $('input[name=name]').val(menu.name)
                        $('input[name=icon]').val(menu.icon)
                        $('input[name=url]').val(menu.url)
                        $('input[name=slug]').val(menu.slug)
                        $("#pid").val(menu.parent_id).trigger("change");
                        $('input[name=heightlight_url]').val(menu.heightlight_url)
                        $('input[name=sort]').val(menu.sort)
                        $('#menuForm').attr('action', menu.update)
                        $('#menuForm').append('<input type="hidden" id="method" name="_method" value="PATCH">')
                        $('#menuForm').append('<input type="hidden" name="id" value="' + menu.id + '">')
                    }

                    return {
                        initAttribute: menuAttribute
                    }
                }()
            }

            return {
                init: menuInit
            }

        }()
        $(document).ready(function () {
            menuList.init();
        });
    </script>
@endsection
