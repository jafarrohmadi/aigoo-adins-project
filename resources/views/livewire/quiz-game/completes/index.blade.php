<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">

            <div class="row">
                <div class="col">
                    <select wire:model="paginate"class="form-control form-control-md w-auto">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col">
                    <input wire:model="search" type="text" class="form-control form-control-md" placeholder="Search by question">
                </div>
            </div>

            <br>

            <table class="table table-hover card-table table-vcenter text-nowrap">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-white">No</th>
                        <th class="text-white">Difficulty</th>
                        <th class="text-white">Question</th>
                        <th class="text-white">Choice 1</th>
                        <th class="text-white">Choice 2</th>
                        <th class="text-white">Choice 3</th>
                        <th class="text-white">Choice 4</th>
                        <th class="text-white">Choice 5</th>
                        <th class="text-white">Choice 6</th>
                        <th class="text-white">Answer</th>
                        <th class="text-white">Created at</th>
                        <th class="text-white">Updated at</th>
                        <th class="text-white" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($questionsCompletes as $question)
                    @php
                        $no++;
                    @endphp
                    <tr>
                        <td>{{ $no }}</th>
                        <td style="text-align: center;">{{ $question->difficulty }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->choice1 }}</td>
                        <td>{{ $question->choice2 }}</td>
                        <td>{{ $question->choice3 }}</td>
                        <td>{{ $question->choice4 }}</td>
                        <td>{{ $question->choice5 }}</td>
                        <td>{{ $question->choice6 }}</td>
                        <td style="text-align: center;">{{ $question->answer }}</td>
                        <td>{{ date("d F Y H:i:s", strtotime($question->created_at)) }}</td>
                        <td>{{ date("d F Y H:i:s", strtotime($question->updated_at)) }}</td>
                        <td>
                            <div class="btn-list" style="display: flex; justify-content: center; align-items: center;">
                                <button type="button" wire:click="getQuestionComplete({{ $question->id }})" class="btn btn-warning" data-toggle="modal" data-target="#editmodal"><i class="far fa-edit"></i> Edit</button>
                                <button type="button" onclick="deleteModal({{ $question->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            {{ $questionsCompletes->links() }}

            @if ($totalData)
                <div>Showing 1 to {{ $questionsCompletes->count() }} of {{ $totalData }} entries</div>
            @else
                <div>Showing 0 to {{ $questionsCompletes->count() }} of {{ $totalData }} entries</div>
            @endif
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">Edit Questions Complete <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
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
                                    <label class="col-md-3 form-label">Difficulty  <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="difficulty" class="form-control @error('difficulty') mb-4 is-invalid state-invalid @enderror custom-select select2">
                                            <option>--Select--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        @error('difficulty')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Question <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="question" class="form-control @error('question') mb-4 is-invalid state-invalid @enderror">
                                        @error('question')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 1 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice1" class="form-control @error('choice1') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice1')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 2 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice2" class="form-control @error('choice2') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice2')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 3 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice3" class="form-control @error('choice3') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice3')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 4 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice4" class="form-control @error('choice4') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice4')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 5 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice5" class="form-control @error('choice5') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice5')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Choice 6 <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice6" class="form-control @error('choice6') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice6')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Answer  <span class="text-red">*</span></label>
                                    <div class="custom-controls-stacked col-md-9">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model="answer" value="1">
                                            <span class="custom-control-label">Choice 1</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model="answer" value="2">
                                            <span class="custom-control-label">Choice 2</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model="answer" value="3">
                                            <span class="custom-control-label">Choice 3</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model="answer" value="4">
                                            <span class="custom-control-label">Choice 4</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model="answer" value="5">
                                            <span class="custom-control-label">Choice 5</span>
                                        </label>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model="answer" value="6">
                                            <span class="custom-control-label">Choice 6</span>
                                        </label>
                                        @error('answer')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
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
