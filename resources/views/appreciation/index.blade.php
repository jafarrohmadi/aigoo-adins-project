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
                Appreciation
            </h3>
        </div>

        <livewire:appreciation.index/>
    </div><!--card-->
@endsection
