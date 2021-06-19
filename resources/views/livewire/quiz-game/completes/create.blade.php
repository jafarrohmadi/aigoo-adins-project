<div>
    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createmodal"><i class="fas fa-plus-circle"></i> Create Questions Completes </a>

        <!-- Create Modal -->
        <div wire:ignore.self class="modal fade" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="createmodal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createmodal1">Create Questions Completes <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="form-horizontal" wire:submit.prevent="store">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Difficulty  <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <select wire:model.defer="difficulty" class="form-control @error('difficulty') mb-4 is-invalid state-invalid @enderror custom-select select2">
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
                                            <input type="text" wire:model.defer="question" class="form-control @error('question') mb-4 is-invalid state-invalid @enderror">
                                            @error('question')
											<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Choice 1 <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.defer="choice1" class="form-control @error('choice1') mb-4 is-invalid state-invalid @enderror">
                                            @error('choice1')
											<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Choice 2 <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.defer="choice2" class="form-control @error('choice2') mb-4 is-invalid state-invalid @enderror">
                                            @error('choice2')
											<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Choice 3 <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.defer="choice3" class="form-control @error('choice3') mb-4 is-invalid state-invalid @enderror">
                                            @error('choice3')
											<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Choice 4 <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.defer="choice4" class="form-control @error('choice4') mb-4 is-invalid state-invalid @enderror">
                                            @error('choice4')
											<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Choice 5 <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.defer="choice5" class="form-control @error('choice5') mb-4 is-invalid state-invalid @enderror">
                                            @error('choice5')
											<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Choice 6 <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" wire:model.defer="choice6" class="form-control @error('choice6') mb-4 is-invalid state-invalid @enderror">
                                            @error('choice6')
											<div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Answer  <span class="text-red">*</span></label>
                                        <div class="custom-controls-stacked col-md-9">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model.defer="answer" value="1">
                                                <span class="custom-control-label">Choice 1</span>
                                            </label>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model.defer="answer" value="2">
                                                <span class="custom-control-label">Choice 2</span>
                                            </label>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model.defer="answer" value="3">
                                                <span class="custom-control-label">Choice 3</span>
                                            </label>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model.defer="answer" value="4">
                                                <span class="custom-control-label">Choice 4</span>
                                            </label>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model.defer="answer" value="5">
                                                <span class="custom-control-label">Choice 5</span>
                                            </label>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input @error('answer') mb-4 is-invalid state-invalid @enderror" wire:model.defer="answer" value="6">
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
</div>
