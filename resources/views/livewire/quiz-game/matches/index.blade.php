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
                        <th class="sorting">No</th>
                        <th class="sorting">Level</th>
                        <th class="sorting">Category</th>
                        <th class="sorting">Question</th>
                        <th class="sorting">Wrong Question</th>
                        <th class="sorting">Answer</th>
                        <th class="sorting">Wrong Answer</th>
                        <th class="sorting">Created at</th>
                        <th class="sorting">Updated at</th>
                        <th class="sorting" style="text-align: center;">Action</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">

                    @forelse ($questionsMatches as $question)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($questionsMatches->firstItem() - 1) }}</td>
                            <td>{{ $question->level }}</td>
                            <td>{{ $question->nameCategory }}</td>
                            <td>{{ cut_sentence($question->question) }}</td>
                            <td>{{ cut_sentence($question->wrong_question) }}</td>
                            <td>{{ cut_sentence($question->answer) }}</td>
                            <td>{{ cut_sentence($question->wrong_answer) }}</td>
                            <td>{{ date("d F Y H:i:s", strtotime($question->created_at)) }}</td>
                            <td>{{ date("d F Y H:i:s", strtotime($question->updated_at)) }}</td>
                            <td>
                                <div class="btn-list">
                                    <button type="button" wire:click="getQuestionMatch({{ $question->id }})"
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
                            <td colspan="10">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-tables.table>

            <div class="row">
                <x-tables.entries-data :data="$questionsMatches"/>

                <x-tables.pagination :data="$questionsMatches"/>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">Edit Question Match
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
                                        <select wire:model="level"
                                                class="form-control @error('level') mb-4 is-invalid state-invalid @enderror">
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
                                    <label class="col-md-3 form-label">Wrong Question <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="wrong_question"
                                               class="form-control @error('wrong_question') mb-4 is-invalid state-invalid @enderror">
                                        @error('wrong_question')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Answer <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="answer"
                                               class="form-control @error('answer') mb-4 is-invalid state-invalid @enderror">
                                        @error('answer')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Wrong Answer <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="wrong_answer"
                                               class="form-control @error('wrong_answer') mb-4 is-invalid state-invalid @enderror">
                                        @error('wrong_answer')
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
