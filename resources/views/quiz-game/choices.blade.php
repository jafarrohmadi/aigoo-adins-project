@extends('layouts.app')

@section('title', __('Dashboard'))

@section('page-header')
    <!--Page header-->
    <x-content-header>
        Quiz Game
    </x-content-header>
    <!--End Page header-->
@endsection

@section('content')
    <x-quiz-game.choices.content>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => auth()->user()->name])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-quiz-game.choices.content>
@endsection

@section('css')

    <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">

    <!--INTERNAL Select2 css -->
    <link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet"/>

    <!--- INTERNAL Sweetalert css-->
    <link href="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet"/>
@endsection

@section('js')
    <!-- INTERNAL Clipboard js -->
    <script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>

    <!-- INTERNAL Prism js -->
    <script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

    <!--INTERNAL Select2 js -->
    <script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>

    <!-- INTERNAL Popover js -->
    <script src="{{URL::asset('assets/js/popover.js')}}"></script>

    <!-- INTERNAL Sweet alert js -->
    <script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/sweet-alert.js')}}"></script>

    <script>
        window.livewire.on('closeCreateModalSuccess', () => {
            $('#createmodal').modal('hide');
            Swal.fire(
                'Success!',
                'Your data has been insert.',
                'success'
            )
        });

        window.livewire.on('closeCreateModalFailed', () => {
            $('#createmodal').modal('hide');
            Swal.fire(
                'Oops...!',
                'Insert data Failed!',
                'error'
            )
        });

        window.livewire.on('closeEditModalSuccess', () => {
            $('#editmodal').modal('hide');
            Swal.fire(
                'Success!',
                'Your data has been update.',
                'success'
            )
        });

        window.livewire.on('closeEditModalFailed', () => {
            $('#editmodal').modal('hide');
            Swal.fire(
                'Oops...!',
                'Edit data failed!',
                'error'
            )
        });

        function deleteModal(questionId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('deleteQuestionChoice', questionId)
                }
            })
        }

        window.livewire.on('displayAlertDeleteSuccess', () => {
            Swal.fire(
                'Success!',
                'Your data has been deleted.',
                'success'
            )
        });

        window.livewire.on('displayAlertDeleteFailed', () => {
            Swal.fire(
                'Oops...!',
                'Delete data failed!',
                'error'
            )
        });
    </script>
@endsection
