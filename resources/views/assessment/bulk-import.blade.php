@extends('layouts.app')

@section('title', __('Assessment Bulk Import'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        Assessment Export
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Assessment Export
            </h3>
        </div>

        <div class="card-body">
            <div class="card-body p-0">
                <livewire:assessment.bulk-import/>
            </div>
        </div>
    </div><!--card-->
@endsection

@section('scripts')
    @stack('js')
@endsection
