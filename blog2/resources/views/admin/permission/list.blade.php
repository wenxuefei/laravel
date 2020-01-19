@extends('layouts.admin')
@section('css')
    <!-- Datatables -->
    <link href="{{asset('backend/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('backend/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('backend/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}"
          rel="stylesheet">
@endsection
@section('content')
    <!-- page content -->

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Users <small>Some examples to get you started</small></h3>
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
                        <h2>权限列表</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            @can('admin.permissions.create')
                                <li><a href="{{url('admin/permission/create')}}" class="btn btn-default"><i
                                            class="fa fa-plus"></i>添加</a>
                            @endcan
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @include('flash::message')
                        <table id="datatable-responsive"
                               class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>权限</th>
                                <th>guard_name</th>
                                <th>is_hide</th>
                                <th>创建时间</th>
                                <th>修改时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /page content -->
@endsection


@section('js')
    <script src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-scroller/js/datatables.scroller.min.js')}}"></script>
    <script src="{{asset('backend/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('backend/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/vendors/pdfmake/build/vfs_fonts.js')}}"></script>


    <!-- Datatables -->
    <script>

        var PermissionList = function () {
            var permissionInit = function () {
                $('#datatable-responsive').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "searchDelay": 800,
                    "search": {
                        regex: true,
                    },
                    "ajax": {
                        'url': '/admin/permission/ajaxIndex',
                        'data': function (d) {
                            d.name = ''
                        }
                    },
                    "columns": [{
                        "data": "id",
                        "name": "id",
                    }, {
                        "data": "name",
                        "name": "name"
                    }, {
                        "data": "guard_name",
                        "name": "guard_name"
                    }, {
                        "data": "is_hide",
                        "name": "is_hide"
                    }, {
                        "data": "created_at",
                        "name": "created_at"
                    }, {
                        "data": "updated_at",
                        "name": "updated_at"
                    }]
                })
            }

            return {
                init: permissionInit
            }
        }()
        $(document).ready(function () {
            PermissionList.init();
            // var handleDataTableButtons = function () {
            //     if ($("#datatable-buttons").length) {
            //         $("#datatable-buttons").DataTable({
            //             dom: "Bfrtip",
            //             buttons: [
            //                 {
            //                     extend: "copy",
            //                     className: "btn-sm"
            //                 },
            //                 {
            //                     extend: "csv",
            //                     className: "btn-sm"
            //                 },
            //                 {
            //                     extend: "excel",
            //                     className: "btn-sm"
            //                 },
            //                 {
            //                     extend: "pdfHtml5",
            //                     className: "btn-sm"
            //                 },
            //                 {
            //                     extend: "print",
            //                     className: "btn-sm"
            //                 },
            //             ],
            //             responsive: true
            //         });
            //     }
            // };
            //
            // TableManageButtons = function () {
            //     "use strict";
            //     return {
            //         init: function () {
            //             handleDataTableButtons();
            //         }
            //     };
            // }();
            //
            // $('#datatable').dataTable();
            //
            // $('#datatable-keytable').DataTable({
            //     keys: true
            // });
            //
            // $('#datatable-responsive').DataTable();
            //
            // $('#datatable-scroller').DataTable({
            //     ajax: "js/datatables/json/scroller-demo.json",
            //     deferRender: true,
            //     scrollY: 380,
            //     scrollCollapse: true,
            //     scroller: true
            // });
            //
            // $('#datatable-fixed-header').DataTable({
            //     fixedHeader: true
            // });
            //
            // var $datatable = $('#datatable-checkbox');
            //
            // $datatable.dataTable({
            //     'order': [[1, 'asc']],
            //     'columnDefs': [
            //         {orderable: false, targets: [0]}
            //     ]
            // });
            // $datatable.on('draw.dt', function () {
            //     $('input').iCheck({
            //         checkboxClass: 'icheckbox_flat-green'
            //     });
            // });
            //
            // TableManageButtons.init();
        });
    </script>
@endsection
