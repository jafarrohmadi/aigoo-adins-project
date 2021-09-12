@extends('layouts.app')

@section('title', __('Daily Attempt'))

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
                Daily Attempt
            </h3>
        </div>

        <livewire:daily-attempt.index/>
    </div><!--card-->
@endsection
