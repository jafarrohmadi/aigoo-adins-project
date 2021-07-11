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
                        <th class="sorting">
                            No
                        </th>
                        <th class="sorting">
                            Category
                        </th>
                        <th class="sorting">
                            <a href="#" wire:click.prevent="sortBy('title')">Title</a>
                        </th>
                        <th class="sorting">
                            Content
                        </th>
                        <th class="sorting">
                            Level
                        </th>
                        <th class="sorting">
                            <a href="#" wire:click.prevent="sortBy('created_at')">Created</a>
                        </th>
                        <th class="sorting">
                            <a href="#" wire:click.prevent="sortBy('updated_at')">Updated</a>
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($question as $key => $questions)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $questions->nameCategory }}</td>
                            <td>{{ $questions->title }}</td>
                            <td>{{ $questions->content }}</td>
                            <td>{{ $questions->level }}</td>
                            <td>{{ $questions->created_at->format('d/m/Y') }}</td>
                            <td>{{ $questions->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-list">
                                    <button type="button" wire:click="getQuestion({{ $questions->id }})"
                                            class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editmodal">
                                        <i
                                                class="far fa-edit"></i> Edit
                                    </button>
                                    <button type="button" onclick="deleteModal({{ $questions->id }})"
                                            class="btn btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>

            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$question"/>

                <x-tables.pagination :data="$question"/>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">Edit Questions Choices
                        <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">
                    <input type="hidden" wire:model="questionId">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Category <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="category"
                                                class="form-control @error('category') mb-4 is-invalid state-invalid @enderror">
                                            <option>--Select--</option>
                                            <option value="dna">DNA</option>
                                            <option value="core-value">Core Value</option>
                                            <option value="create-collaboration">Create and Collaboration</option>
                                        </select>
                                        @error('category')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Title <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="title"
                                               class="form-control @error('title') mb-4 is-invalid state-invalid @enderror">
                                        @error('title')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Content <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="content"
                                               class="form-control @error('content') mb-4 is-invalid state-invalid @enderror">
                                        @error('content')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Level <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="level"
                                                class="form-control @error('level') mb-4 is-invalid state-invalid @enderror">
                                            <option>--Select--</option>
                                            <option value="staff">Staff</option>
                                            <option value="managerial">Managerial</option>
                                        </select>
                                        @error('level')
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