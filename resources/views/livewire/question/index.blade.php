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
                            Content
                        </th>
                        <th class="sorting">
                            Level
                        </th>
                        <th class="sorting">
                            Created
                        </th>
                        <th class="sorting">
                            Updated
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($question as $key => $questions)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ ($loop->iteration) + ($question->firstItem() - 1) }}</td>
                            <td>{{ $questions->nameCategory }}</td>
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
                            <td colspan="8">No results.</td>
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
                        <span aria-hidden="true">??</span>
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
                                            @foreach($categoryList as $categories)
                                                <option value="{{$categories->id}}"> {{$categories->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Level <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select
                                                class="form-control @error('level') mb-4 is-invalid state-invalid @enderror"
                                                multiple id="select21">
                                            <option value="Staff"
                                                    @if(str_contains($levelData, 'Staff')) selected @endif >Staff
                                            </option>
                                            <option value="Managerial"
                                                    @if(str_contains($levelData ,'Managerial' )) selected @endif >
                                                Managerial
                                            </option>
                                            <option value="BOD" @if(str_contains($levelData, 'BOD' )) selected @endif >
                                                BOD
                                            </option>
                                        </select>
                                        @error('level')
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
                                    <label class="col-md-3 form-label">Kriteria 1 <span
                                                class="text-red">*</span></label>
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
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point1" max="4" min="1"
                                               class="form-control @error('point1') mb-4 is-invalid state-invalid @enderror">
                                        @error('point1')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Kriteria 2 <span
                                                class="text-red">*</span></label>
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
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point2" max="4" min="1"
                                               class="form-control @error('point2') mb-4 is-invalid state-invalid @enderror">
                                        @error('point2')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Kriteria 3 <span
                                                class="text-red">*</span></label>
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
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point3" max="4" min="1"
                                               class="form-control @error('point3') mb-4 is-invalid state-invalid @enderror">
                                        @error('point3')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Kriteria 4 <span
                                                class="text-red">*</span></label>
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
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point4" max="4" min="1"
                                               class="form-control @error('point4') mb-4 is-invalid state-invalid @enderror">
                                        @error('point4')
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

@push('scripts')
    <script>
        $(document).ready(function () {
            window.initSelectDrop = () => {
                $('#select21').select2({
                    allowClear: true
                });
            }

            $('#select21').on('change', function (e) {
                var data = $('#select21').val();
            @this.set('level', data);
            });

            initSelectDrop();

            window.livewire.on('select2', () => {
                initSelectDrop();
            });
        })

    </script>
@endpush