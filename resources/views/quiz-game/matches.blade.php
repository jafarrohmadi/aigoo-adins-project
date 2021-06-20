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
    <x-quiz-game.matches.content>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => auth()->user()->name])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-quiz-game.matches.content>
@endsection

@section('scripts')
    <script>
        window.livewire.on('closeCreateModalSuccess', () => {
            $('#createmodal').modal('hide');
            swal(
                'Success!',
                'Your data has been insert.',
                'success'
            )
        });

        window.livewire.on('closeCreateModalFailed', () => {
            $('#createmodal').modal('hide');
            swal(
                'Oops...!',
                'Insert data Failed!',
                'error'
            )
        });

        window.livewire.on('closeEditModalSuccess', () => {
            $('#editmodal').modal('hide');
            swal(
                'Success!',
                'Your data has been update.',
                'success'
            )
        });

        window.livewire.on('closeEditModalFailed', () => {
            $('#editmodal').modal('hide');
            swal(
                'Oops...!',
                'Edit data failed!',
                'error'
            )
        });

        function deleteModal(questionId) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }, function (result) {
                if (result) {
                    window.livewire.emit('deleteQuestionMatch', questionId)
                }
            })
        }

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
