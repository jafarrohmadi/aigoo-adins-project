@extends('layouts.app')

@section('title', __('Team'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        Setting Level
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')
    <x-team.content>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => auth()->user()->name])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-team.content>
@endsection