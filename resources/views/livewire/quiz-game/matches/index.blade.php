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
                        <th class="text-white">Wrong Question</th>
                        <th class="text-white">Answer</th>
                        <th class="text-white">Wrong Answer</th>
                        <th class="text-white">Created at</th>
                        <th class="text-white">Updated at</th>
                        <th class="text-white" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($questionsMatches as $question)
                    @php
                        $no++;
                    @endphp
                    <tr>
                        <td>{{ $no }}</th>
                        <td style="text-align: center;">{{ $question->difficulty }}</td>
                        <td>{{ $question->question }}</td>
                        <td>{{ $question->wrong_question }}</td>
                        <td>{{ $question->answer }}</td>
                        <td>{{ $question->wrong_answer }}</td>
                        <td>{{ date("d F Y H:i:s", strtotime($question->created_at)) }}</td>
                        <td>{{ date("d F Y H:i:s", strtotime($question->updated_at)) }}</td>
                        <td>
                            <div class="btn-list" style="display: flex; justify-content: center; align-items: center;">
                                <button type="button" wire:click="getQuestionMatch({{ $question->id }})" class="btn btn-warning" data-toggle="modal" data-target="#editmodal"><i class="far fa-edit"></i> Edit</button>
                                <button type="button" onclick="deleteModal({{ $question->id }})" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <br>

            {{ $questionsMatches->links() }}

            @if ($totalData)
                <div>Showing 1 to {{ $questionsMatches->count() }} of {{ $totalData }} entries</div>
            @else
                <div>Showing 0 to {{ $questionsMatches->count() }} of {{ $totalData }} entries</div>
            @endif
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">Edit Question Match <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
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
                                    <label class="col-md-3 form-label">Wrong Question <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="wrong_question" class="form-control @error('wrong_question') mb-4 is-invalid state-invalid @enderror">
                                        @error('wrong_question')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Answer <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="answer" class="form-control @error('answer') mb-4 is-invalid state-invalid @enderror">
                                        @error('answer')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Wrong Answer <span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="wrong_answer" class="form-control @error('wrong_answer') mb-4 is-invalid state-invalid @enderror">
                                        @error('wrong_answer')
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
