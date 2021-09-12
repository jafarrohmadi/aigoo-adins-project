<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>
            <br>

            <x-tables.table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th class="sorting">No</th>
                        <th class="sorting">Level</th>
                        <th class="sorting">Category</th>
                        <th class="sorting">Question</th>
                        <th class="sorting">Choice 1</th>
                        <th class="sorting">Choice 2</th>
                        <th class="sorting">Choice 3</th>
                        <th class="sorting">Choice 4</th>
                        <th class="sorting">Choice 5</th>
                        <th class="sorting">Choice 6</th>
                        <th class="sorting">Answer</th>
                        <th class="sorting">Created at</th>
                        <th class="sorting">Updated at</th>
                        <th class="sorting" style="text-align: center;">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($questionsCompletes as $question)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($questionsCompletes->firstItem() - 1) }}</td>
                            <td>{{ $question->level }}</td>
                            <td>{{ $question->nameCategory }}</td>
                            <td>{{ cut_sentence($question->question) }}</td>
                            <td>{{ $question->choice1 }}</td>
                            <td>{{ $question->choice2 }}</td>
                            <td>{{ $question->choice3 }}</td>
                            <td>{{ $question->choice4 }}</td>
                            <td>{{ $question->choice5 }}</td>
                            <td>{{ $question->choice6 }}</td>
                            <td style="text-align: center;">{{ cut_sentence($question->answer) }}</td>
                            <td>{{ date("d F Y H:i:s", strtotime($question->created_at)) }}</td>
                            <td>{{ date("d F Y H:i:s", strtotime($question->updated_at)) }}</td>
                            <td>
                                <div class="btn-list">
                                    <button type="button" wire:click="getQuestionComplete({{ $question->id }})"
                                            class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editmodal">
                                        <i
                                                class="far fa-edit"></i> Edit
                                    </button>
                                    <button type="button" onclick="deleteModal({{ $question->id }})"
                                            class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-tables.table>
            <div class="row">
                <x-tables.entries-data :data="$questionsCompletes"/>

                <x-tables.pagination :data="$questionsCompletes"/>
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
                                                    @if(str_contains( $levelData, 'Staff')) selected @endif >Staff
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
                                    <label class="col-md-3 form-label">Choice 6 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice6"
                                               class="form-control @error('choice6') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice6')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Answer <span class="text-red">*</span></label>
                                    <div class="custom-controls-stacked col-md-9">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror"
                                                   wire:model="answer" value="1">
                                            <span class="custom-control-label">Choice 1</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror"
                                                   wire:model="answer" value="2">
                                            <span class="custom-control-label">Choice 2</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror"
                                                   wire:model="answer" value="3">
                                            <span class="custom-control-label">Choice 3</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror"
                                                   wire:model="answer" value="4">
                                            <span class="custom-control-label">Choice 4</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror"
                                                   wire:model="answer" value="5">
                                            <span class="custom-control-label">Choice 5</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror"
                                                   wire:model="answer" value="6">
                                            <span class="custom-control-label">Choice 6</span>
                                        </label>
                                        @error('answer')
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
