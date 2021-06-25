<div>
    <div class="modal-header">
        <h5 class="modal-title" id="editmodal1">EXP Table <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
    </div>
    <form class="form-horizontal" wire:submit.prevent="updateExpTable">
        <div class="modal-body">
            <div class="row">
                @for($i = 1; $i < 41; $i++)
                <div class="col-lg-6 col-md-6">
                    <div class="form-group row">
                        <label class="col-md-1 form-label">{{ ${'name'.$i} }} <span class="text-red">*</span></label>
                        <div class="col-md-10">
                            <input type="number" wire:model="expTable{{$i}}"
                                   class="form-control @error("expTable$i") mb-4 is-invalid state-invalid @enderror">
                            @error('expTable'.$i)
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
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    <div class="modal-header">
        <h5 class="modal-title" id="editmodal1">Game Settings <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div></h5>
    </div>
    <form class="form-horizontal" wire:submit.prevent="updateGameSettings">
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group row">
                        <label class="col-md-2 form-label">{{ $nameGameSetting }} <span class="text-red">*</span></label>
                        <div class="col-md-10">
                            <input type="number" wire:model="valueGameSetting"
                                   class="form-control @error('valueGameSetting') mb-4 is-invalid state-invalid @enderror">
                            @error('valueGameSetting')
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
</div>
