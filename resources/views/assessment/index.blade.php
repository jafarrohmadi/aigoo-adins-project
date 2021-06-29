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

        <livewire:assessment.index/>
    </div><!--card-->
@endsection
