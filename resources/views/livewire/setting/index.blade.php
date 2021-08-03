<div>
    <div class="modal-header">
        <h5 class="modal-title" id="editmodal1">Game Settings <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
    </div>
    <form class="form-horizontal" wire:submit.prevent="updateGameSettings">
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">{{ $nameGameSettingDna }} <span class="text-red">*</span></label>
                        <div class="col-md-8">
                            <input type="number" wire:model="valueGameSettingDna"
                                   class="form-control @error('valueGameSettingDna') mb-4 is-invalid state-invalid @enderror">
                            @error('valueGameSettingDna')
                            <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">{{ $nameGameSettingCoreValue }} <span class="text-red">*</span></label>
                        <div class="col-md-8">
                            <input type="number" wire:model="valueGameSettingCoreValue"
                                   class="form-control @error('valueGameSettingCoreValue') mb-4 is-invalid state-invalid @enderror">
                            @error('valueGameSettingCoreValue')
                            <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 form-label">{{ $nameGameSettingCollaborate }} <span class="text-red">*</span></label>
                        <div class="col-md-8">
                            <input type="number" wire:model="valueGameSettingCollaborate"
                                   class="form-control @error('valueGameSettingCollaborate') mb-4 is-invalid state-invalid @enderror">
                            @error('valueGameSettingCollaborate')
                            <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                {{ $message }}</div>
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

    <div class="modal-header">
        <h5 class="modal-title" id="editmodal1">Title Level <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
    </div>
    <form class="form-horizontal" wire:submit.prevent="updateTitleLevel">
        <div class="modal-body">
            <div class="modal-body">
                <div class="row">
                    @for($i = 1; $i < 11; $i++)
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input type="text" wire:model="nameTitle{{$i}}"
                                           class="form-control @error("nameTitle$i") mb-4 is-invalid state-invalid @enderror">
                                    @error('nameTitle'.$i)
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="number" wire:model="titleLevel{{$i}}"
                                           class="form-control @error("titleLevel$i") mb-4 is-invalid state-invalid @enderror">
                                    @error('titleLevel'.$i)
                                    <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                        {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
