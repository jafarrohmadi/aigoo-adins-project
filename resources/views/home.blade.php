@extends('layouts.app')

@section('title')
    Home
@endsection
@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$user_count}}</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$department_count}}</h3>

                        <p>Department</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$played_today}}</h3>

                        <p>Played Today</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$total_coins_today}}</h3>

                        <p>Total Score Today</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-cocktail"></i>
                    </div>
                </div>
            </div>

        </div>
       <livewire:dashboard.chart/>
        <!-- /.row (main row) -->
    </div>
@endsection

@section('scripts')
    @yield('js')
@endsection
