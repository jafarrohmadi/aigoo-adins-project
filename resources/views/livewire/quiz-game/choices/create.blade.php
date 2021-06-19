<div>
    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createmodal"><i class="fas fa-plus-circle"></i> Create Questions Choices </a>

        <!-- Create Modal -->
        <div wire:ignore.self class="modal" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="createmodal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createmodal1">Create Questions Choices <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form class="form-horizontal" wire:submit.prevent="store" enctype="multipart/form-data">
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
                                        <label class="col-md-3 form-label">Answer  <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <select wire:model="answer" class="form-control @error('answer') mb-4 is-invalid state-invalid @enderror">
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
                                        <label class="col-md-3 form-label">Difficulty  <span class="text-red">*</span></label>
                                        <div class="col-md-9">
                                            <select wire:model="difficulty" class="form-control @error('difficulty') mb-4 is-invalid state-invalid @enderror">
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
</div>
