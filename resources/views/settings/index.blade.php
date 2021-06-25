@extends('layouts.app')

@section('title', __('Settings'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        Setting Level
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')
    <x-settings.content>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => auth()->user()->name])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-settings.content>
@endsection

@section('scripts')
    <script>
        window.livewire.on('closeCreateModalSuccess', () => {
            swal(
                'Success!',
                'Your data has been insert.',
                'success'
            )
        });

        window.livewire.on('closeCreateModalFailed', () => {
            swal(
                'Oops...!',
                'Insert data Failed!',
                'error'
            )
        });

        window.livewire.on('closeEditModalSuccess', () => {

            swal(
                'Success!',
                'Your data has been update.',
                'success'
            )
        });

        window.livewire.on('closeEditModalFailed', () => {
            swal(
                'Oops...!',
                'Edit data failed!',
                'error'
            )
        });

        window.livewire.on('displayAlertDeleteSuccess', () => {
            swal(
                'Success!',
                'Your data has been deleted.',
                'success'
            )
        });

        window.livewire.on('displayAlertDeleteFailed', () => {
            swal(
                'Oops...!',
                'Delete data failed!',
                'error'
            )
        });
    </script>
@endsection
