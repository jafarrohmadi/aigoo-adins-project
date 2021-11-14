@extends('layouts.app')

@section('title', __('Assessment Not Found'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        User Assessment Not Found
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')
    <x-assessment-not-found.content>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => auth()->user()->name])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-assessment-not-found.content>
@endsection