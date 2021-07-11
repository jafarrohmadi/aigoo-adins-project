<div>
    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createmodal"><i class="fas fa-plus-circle"></i>
        Create </a>

    <!-- Create Modal -->
    <div wire:ignore.self class="modal" id="createmodal" tabindex="-1" role="dialog" aria-labelledby="createmodal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createmodal1">Create Assesment Questions
                        <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div>
                    </h5>
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
                                            <option value="Staff">Staff</option>
                                            <option value="Managerial">Managerial</option>
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
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
