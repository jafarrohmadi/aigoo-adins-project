<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>
            <br>

            <x-tables.no-responsive-table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th class="sorting">No</th>
                        <th class="sorting">Name</th>
                        <th class="sorting">Created at</th>
                        <th class="sorting">Updated at</th>
                        <th class="sorting" style="text-align: center;">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($category as $categories)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $categories->name }}</td>
                            <td>{{ date("d F Y H:i:s", strtotime($categories->created_at)) }}</td>
                            <td>{{ date("d F Y H:i:s", strtotime($categories->updated_at)) }}</td>
                            <td>
                                <div class="btn-list">
                                    <button type="button" wire:click="getCategory({{ $categories->id }})"
                                            class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editmodal"><i
                                                class="far fa-edit"></i> Edit
                                    </button>
                                    <button type="button" onclick="deleteModal({{ $categories->id }})"
                                            class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$category"/>

                <x-tables.pagination :data="$category"/>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">Edit Questions Complete
                        <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="form-horizontal" wire:submit.prevent="update">
                    <input type="hidden" wire:model="categoryId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Name <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="name"
                                               class="form-control @error('name') mb-4 is-invalid state-invalid @enderror">
                                        @error('name')
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
