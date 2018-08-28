<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'en'))">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title', config('app.name', 'AdminLTE'))</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  @section('styles')
  <link href="{{ mix('/css/admin-lte.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('images/log.png') }}}">
    <link href="/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/css/datatables.bootstrap.css" rel="stylesheet">
    <link href="/css/selectize.css" rel="stylesheet">
    <link href="/css/selectize.bootstrap3.css" rel="stylesheet">
    <link href="/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/print.css" type="text/css" media="print">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  {{-- @show --}}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @stack('head')

  @yield('styles')
</head>

<body class="hold-transition skin-{{ config('admin-lte.skin', 'blue') }} {{ config('admin-lte.layout', 'sidebar-mini') }}">
  <div id="app" class="wrapper">

    <!-- Main Header -->
    @include('admin-lte::layouts.main-header.main')
    <!-- Left side column. contains the logo and sidebar -->
    @include('admin-lte::layouts.main-sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    @include('admin-lte::layouts.content-wrapper.main')

    <!-- Main Footer -->
    @include('admin-lte::layouts.main-footer.main')

    <!-- Flash Notification -->
    {{-- @include('layouts._flash') --}}
    <!-- Control Sidebar -->
    {{-- @include('admin-lte::layouts.control-sidebar.main') --}}
  </div>
  @section('scripts')
  <script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/admin-lte.js') }}" charset="utf-8"></script>
    <script src="/js/jquery.datatables.min.js"></script>
    <script src= "/js/Chart.min.js"></script>
    
    <script src="/js/datatables.bootstrap.js"></script>
    <script src="/js/selectize.min.js"></script>
    <script src= "/js/custom.js"></script>
    
    <script src="/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/bootstrap-datepicker.id.min.js"></script>
    <script src="/js/image-modal.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
    </script>

    <script>
        $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            daysOfWeekHighlighted: "0,6",
            language: "id",
            autoclose: true,
            todayHighlight: true
        });

         $('#datepicker1').datepicker({
            format: "yyyy-mm-dd",
            daysOfWeekHighlighted: "0,6",
            language: "id",
            autoclose: true,
            todayHighlight: true
        });
    </script>

    <script>
        $('#monthpicker').datepicker({
            format: "yyyy-mm",
            language: "id",
            minViewMode: 1,
            autoclose: true
        });
    </script>
  @stack('body')
  
  @yield('scripts')
</body>
</html>
