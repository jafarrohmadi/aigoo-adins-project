@extends('layouts.app')

@section('title', __('Dashboard'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        LeaderBoard
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')

    <x-leaderboard.content>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => auth()->user()->name])
        </x-slot>

        <x-slot name="body">

        </x-slot>
    </x-leaderboard.content>
@endsection