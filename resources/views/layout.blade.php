<!doctype html>
<html lang="en">
<head>
{{--    @include("components.head")--}}
    <x-head/>
{{--    // thay đổi cho include tên file trong component--}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <x-nav/>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <x-aside/>
    <!-- Content Wrapper. Contains page content -->
    <x-footer/>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
    <x-script/>
</body>
</html>
