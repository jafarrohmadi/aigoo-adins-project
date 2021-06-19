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
                        <th class="text-white">Question</th>
                        <th class="text-white">Choice 1</th>
                        <th class="text-white">Choice 2</th>
                        <th class="text-white">Choice 3</th>
                        <th class="text-white">Choice 4</th>
                        <th class="text-white">Choice 5</th>
                        <th class="text-white">Answer</th>
                        <th class="text-white">Image</th>
                        <th class="text-white">Difficulty</th>
                        <th class="text-white">Created at</th>
                        <th class="text-white">Updated at</th>
                        <th class="text-white" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questionsChoices as $key => $question)
                    <tr>
                        <td>{{ $questionsChoices->firstItem() + $key }}</th>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->choice1 }}</td>
                        <td>{{ $question->choice2 }}</td>
                        <td>{{ $question->choice3 }}</td>
                        <td>{{ $question->choice4 }}</td>
                        <td>{{ $question->choice5 }}</td>
                        <td style="text-align: center;">{{ $question->answer }}</td>
                        <td>
                            @if ($question->image)
                                <img src="{{ asset('storage/' . $question->image) }}" width="100" height="100">
                            @else
                                <span class="tag tag-red">No Image</span>
                            @endif
                        </td>
                        <td style="text-align: center;">{{ $question->difficulty }}</td>
                        <td>{{ date("d F Y H:i:s", strtotime($question->created_at)) }}</td>
                        <td>{{ date("d F Y H:i:s", strtotime($question->updated_at)) }}</td>
                        <td>
                            <div class="btn-list" style="display: flex; justify-content: center; align-items: center;">
                                <button type="button" wire:click="getQuestionChoice({{ $question->id }})" class="btn btn-warning" data-toggle="modal" data-target="#editmodal"><i class="far fa-edit"></i> Edit</button>
                                <button type="button" onclick="deleteModal({{ $question->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            {{ $questionsChoices->links() }}

            @if ($totalData)
                <div>Showing 1 to {{ $questionsChoices->count() }} of {{ $totalData }} entries</div>
            @else
                <div>Showing 0 to {{ $questionsChoices->count() }} of {{ $totalData }} entries</div>
            @endif
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">Edit Questions Choices <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
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
                                    <label class="col-md-3 form-label">Answer <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <select wire:model="answer" class="form-control @error('answer') mb-4 is-invalid state-invalid @enderror custom-select select2">
                                            <option>--Select--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        @error('answer')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
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
                                        <input type="file" wire:model="image" class="form-control @error('image') mb-4 is-invalid state-invalid @enderror">
                                        @error('image')
                                            <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                        <div class="progress" style="margin-top: 5px;">
                                            <div wire:loading wire:target="image" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                <span style="line-height: 20px; font-size: 14px;">Uploading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Difficulty <span class="text-red">*</span></label>
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
