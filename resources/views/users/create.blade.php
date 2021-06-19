<div>
@section('title')
    Create New User
@endsection

@section('content-header')
<x-content-header>
    Create New User
</x-content-header>
@endsection

<x-savings.content>
    <x-slot name="card_header">
        <h3 class="card-title">Create New User</h3>
        <a href="{{ route('users.index') }}" class="float-right">Back</a>
    </x-slot>

    <x-slot name="card_body">
        <form method="POST" wire:submit.prevent="store">
            @csrf
            <label for="user.email"/>{{ trans('validation.attributes.email') }}</label>
            <x-inputs.email key="user.email" required="required" placeholder="{{ trans('validation.attributes.email') }}" autofocus />

            <label for="user.email"/>{{ trans('validation.attributes.name') }}</label>
            <x-inputs.text key="user.name" required="required" placeholder="{{ trans('validation.attributes.name') }}" autofocus />

            <label for="user.email"/>Employee level</label>
            <x-inputs.text key="user.employee_level_id" required="required" placeholder="Employee level" autofocus />

            <label for="user.email"/>Roles</label>
            <x-inputs.dropdown key="user.roles" :options="$roles" textField="name" required="required" />

            <div class="row">
                <div class="offset-8 col-4">
                    <x-inputs.button text="Save" class="btn-success" />
                </div>
            </div>
        </form>

    </x-slot>
</x-savings.content>
