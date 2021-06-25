@extends('layouts.app')

@section('title', __('Activity Logs'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        Activity Log
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Activity Logs
            </h3>
        </div>

        <livewire:activity-logs.index/>
    </div><!--card-->
@endsection
