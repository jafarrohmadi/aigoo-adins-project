<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>
            <x-tables.no-responsive-table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th width="10" class="sorting">
                            No.
                        </th>
                        <th  class="sorting">
                            Name
                        </th>
                        <th  class="sorting">
                            Team Name
                        </th>
                        <th>
                            Team Icon
                        </th>
                        <th>
                            Team Leader
                        </th>

                        <th  class="sorting">
                            Active
                        </th>
                        <th>Action</th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($department as $key => $departments)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($department->firstItem() - 1)}}</td>
                            <td>
                                {{ $departments->name }}
                            </td>
                            <td>
                                {{ $departments->team_name }}
                            </td>
                            <td>
                                <img src="{{ $departments->team_icon  ? (asset('img/profile_picture').'/').$departments->team_icon: ''}}" width="100" height="100" >
                            </td>
                            <td>
                                {{ $departments->leader->name  ?? ''}}
                            </td>
                            <td>
                                {{ $departments->is_active ? 'Ya' : 'Tidak' }}
                            </td>
                            <td>
                                <button type="button" wire:click="edit({{ $departments->id }})"
                                        class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editmodal"><i
                                            class="far fa-edit"></i> Edit
                                </button>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>

            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$department"/>

                <x-tables.pagination :data="$department"/>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">Team Leader
                        <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">
                    <input type="hidden" wire:model="departmentId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Team Leader <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="team_leader"
                                                class="form-control @error('team_leader') mb-4 is-invalid state-invalid @enderror">
                                            <option>--Select--</option>
                                            @if($userDepartment)
                                            @foreach($userDepartment as $key => $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                                @endif
                                        </select>
                                        @error('category')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
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
