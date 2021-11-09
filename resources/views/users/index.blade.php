<div>
    @section('title')
        Users
    @endsection

    @section('content-header')
        <x-content-header>
            Users
        </x-content-header>
    @endsection

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Users</h3>
                    {{--                    @can('for-route', ['users.create'])--}}
                    {{--                        <a href="{{ route('users.create') }}" class="float-right">Add New</a>--}}
                    {{--                    @endcan--}}
                </div>

                <div class="card-body" x-data="{showModal : false, deleteId : false}">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <select wire:model="filterByDepartment" class="form-control form-control-md bg-primary"
                                        style="border-radius: 16px;">
                                    <option selected>Filter by Department</option>
                                    @foreach($departmentData as $key => $division)
                                        @if($division != '')
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endif
                                    @endforeach
                                    <option value="7">Others</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <x-tables.per-page/>

                            <x-tables.search/>
                        </div>

                        <x-tables.no-responsive-table>
                            <x-slot name="thead_tfoot">
                                <tr>
                                    <th class="sorting">
                                        No
                                    </th>
                                    <th class="sorting">
                                        Email
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Department
                                    </th>
                                    <th>
                                        Role
                                    </th>
                                    <th>
                                        Team
                                    </th>
                                    <th>
                                        avatar
                                    </th>
                                    <th class="sorting">
                                        Created
                                    </th>

                                    <th>Last Login</th>
                                    <th class="sorting">
                                        Action
                                    </th>
                                    {{--                                    <th class="sorting">--}}
                                    {{--                                        Delete--}}
                                    {{--                                    </th>--}}
                                </tr>
                            </x-slot>

                            <x-slot name="tbody">
                                @forelse($users as $user)
                                    <tr class="@if($loop->odd) odd @endif">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->department }}</td>
                                        <td>{{$user->roles}}</td>
                                        <td>{{ $user->departments->team_name }}</td>
                                        <td><img src="{{ $user->change_avatar ? (asset('img/profile_picture') .'/') . $user->change_avatar: (asset('img/profile_picture') .'/') .$user->avatar }}" width="100" height="100"></td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td>{{$user->last_login_at}}</td>
                                        <td>

                                            @can('for-route', ['users.edit', $user])
                                                @if(!$user->isHimself(auth()->user()))
                                                    <button type="button" wire:click="edit({{ $user->id }})"
                                                            class="btn btn-warning btn-sm" data-toggle="modal"
                                                            data-target="#editmodal"><i
                                                                class="far fa-edit"></i> Edit
                                                    </button>
                                                    {{--                                                    <a href="{{ route('users.edit', $user) }}"><span--}}
                                                    {{--                                                                class="fas fa-edit"></a></span>--}}
                                                @endif
                                            @endcan
                                        </td>
                                        {{--<td>
                                             <livewire:delete-user-component :user="$user" :key="'user-'.$user->id"/>
                                         </td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No results.</td>
                                    </tr>
                                @endforelse
                            </x-slot>

                        </x-tables.no-responsive-table>

                        <div class="row">
                            <x-tables.entries-data :data="$users"/>

                            <x-tables.pagination :data="$users"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal" id="editmodal" role="dialog" aria-labelledby="editmodal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">User Edit
                        <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">
                    <input type="hidden" wire:model="userId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Department <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="department_id"
                                                class="form-control @error('department_id') mb-4 is-invalid state-invalid @enderror custom-select select2">
                                            <option>--Select--</option>
                                            @if($department)
                                                @foreach($department as $key => $departments)
                                                    <option value="{{$departments->id}}">{{$departments->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('category')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Roles<span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="roles"
                                                class="form-control @error('roles') mb-4 is-invalid state-invalid @enderror custom-select select2">
                                            <option>--Select--</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Managerial">Managerial</option>
                                            <option value="BOD">BOD</option>
                                        </select>
                                        @error('category')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Akses Admin</label>
                                    <div class="col-md-9">
                                        <input type="radio" wire:model="admin_access" value="1"> Yes
                                        <input type="radio" wire:model="admin_access" value="0"> No
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@section('scripts')
    <script>
        document.addEventListener("livewire:load", function (event) {
            window.livewire.hook('afterDomUpdate', () => {
                $('.select2').select2();
            });
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
