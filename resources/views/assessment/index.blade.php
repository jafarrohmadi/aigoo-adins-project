@extends('layouts.app')

@section('title', __('Assessment'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        Assessment
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Assessment
            </h3>
        </div>

        <div class="card-body">
            <div class="card-body p-0">
                <livewire:assessment.filter/>
                <br>
                <livewire:assessment.chart/>
                <br>
                <livewire:assessment.index/>
            </div>
        </div>
    </div><!--card-->
@endsection

@section('scripts')
    @stack('js')
@endsection