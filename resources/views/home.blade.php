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
                        @if($user_count > 0)
                        <h3>{{$user_have_assessment .'('. round(($user_have_assessment/ $user_count) * 100, 2) . ' %)'}}</h3>
                        @else
                            <h3>0</h3>
                            @endif
                        <p>User Melakukan Asessment</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <a href="{{ url('assessment/notFound') }}">
                <div class="small-box bg-info">
                    <div class="inner">

                        @if($user_count > 0)
                        <h3>{{$user_dont_have_assessment .'('. round(($user_dont_have_assessment/ $user_count) * 100, 2) . ' %)'}}</h3>
                        @else
                            <h3>0</h3>
                        @endif
                        <p>User Tidak Melakukan Asessment</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$nasionalEmployee}}</h3>

                        <p>Karyawan Point Tertinggi Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$departmentWinner}}</h3>

                        <p>Department Point Tertinggi Bulan Ini</p>
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
        </div>
       <livewire:dashboard.chart/>
        <!-- /.row (main row) -->
    </div>
@endsection

@section('scripts')
    @yield('js')
@endsection
