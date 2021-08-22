<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title', '')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Bootstrap css -->
    <link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2-bootstrap4.min.css')}}" rel="stylesheet">

    <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <!--- INTERNAL Sweetalert css-->
    <link href="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet"/>

    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    @livewireStyles

    @yield('styles')
</head>
