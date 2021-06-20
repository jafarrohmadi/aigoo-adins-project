<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>
            <x-tables.table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th class="sorting">
                            No
                        </th>
                        <th class="sorting">
                            <a href="#" wire:click.prevent="sortBy('question')">Question</a>

                        </th>
                        <th class="sorting">
                            Image
                        </th>
                        <th class="sorting">
                            Difficulty
                        </th>
                        <th class="sorting">
                            <a href="#" wire:click.prevent="sortBy('created_at')">Created</a>
                        </th>

                        <th>
                            Action
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($questionsChoices as $key => $question)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $question->question }}</td>
                            <td> @if ($question->image)
                                    <img src="{{ asset('storage/' . $question->image) }}" width="100" height="100">
                                @else
                                    <span class="tag tag-red">No Image</span>
                                @endif
                            </td>
                            <td>{{ $question->difficulty }}</td>
                            <td>{{ $question->created_at->format('d/m/Y') }}</td>

                            <td>
                                <div class="btn-list">
                                    <button type="button" wire:click="edit({{ $question->id }})"
                                            class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editmodal"><i
                                                class="far fa-edit"></i> Edit
                                    </button>
                                    <button type="button" onclick="deleteModal({{ $question->id }})"
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

            </x-tables.table>
            <div class="row">
                <x-tables.entries-data :data="$questionsChoices"/>

                <x-tables.pagination :data="$questionsChoices"/>
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
                                        <input type="text" wire:model="category"
                                               class="form-control @error('category') mb-4 is-invalid state-invalid @enderror">
                                        @error('category')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Level <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="level"
                                                class="form-control @error('answer') mb-4 is-invalid state-invalid @enderror">
                                            <option>--Select--</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Managerial">Managerial</option>
                                        </select>
                                        @error('level')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Question <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="question"
                                               class="form-control @error('question') mb-4 is-invalid state-invalid @enderror">
                                        @error('question')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 1 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice1"
                                               class="form-control @error('choice1') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice1')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 2 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice2"
                                               class="form-control @error('choice2') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice2')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 3 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice3"
                                               class="form-control @error('choice3') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice3')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 4 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice4"
                                               class="form-control @error('choice4') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice4')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 5 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice5"
                                               class="form-control @error('choice5') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice5')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Answer <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="answer"
                                                class="form-control @error('answer') mb-4 is-invalid state-invalid @enderror custom-select">
                                            <option>--Select--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        @error('answer')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Image</label>
                                    <div class="col-md-9">
                                        @if ($tempUrl)
                                            @if ($errors->first('image'))
                                                <div class="mb-4"></div>
                                            @else
                                                <div class="mb-4">
                                                    <img src="{{ $tempUrl }}" width="100" height="100">
                                                </div>
                                            @endif
                                        @elseif ($image)
                                            <div class="mb-4">
                                                <img src="{{ asset('storage/'.$image) }}" width="100" height="100">
                                            </div>
                                        @endif
                                        <input type="file" wire:model="image"
                                               class="form-control @error('image') mb-4 is-invalid state-invalid @enderror">
                                        @error('image')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                        <div class="progress" style="margin-top: 5px;">
                                            <div wire:loading wire:target="image"
                                                 class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                 role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 100%">
                                                <span style="line-height: 20px; font-size: 14px;">Uploading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Difficulty <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="difficulty"
                                                class="form-control @error('difficulty') mb-4 is-invalid state-invalid @enderror">
                                            <option>--Select--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        @error('difficulty')
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