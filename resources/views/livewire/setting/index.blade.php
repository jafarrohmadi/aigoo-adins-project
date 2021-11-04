<div>
    <div class="modal-header">
        <h5 class="modal-title" id="editmodal1">Game Settings
            <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div>
        </h5>
    </div>
    <form class="form-horizontal" wire:submit.prevent="updateGameSettings">
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    @foreach($category as $categories)
                        <div class="form-group row">
                            <label class="col-md-4 form-label">{{ $nameGameSetting[$categories->id] }} <span
                                        class="text-red">*</span></label>
                            <div class="col-md-8">
                                <input type="number" wire:model.lazy='valueGameSetting.{{$categories->id}}'
                                       class="form-control @error("valueGameSetting[$categories->id]") mb-4 is-invalid state-invalid @enderror">
                                @error("valueGameSetting[$categories->id]")
                                <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4" role="alert">
                                    {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    <div class="modal-header">
        <h5 class="modal-title" id="editmodal1">Title Level
            <div style="font-size: 12px;"><span class="text-red"> * Field wajib diisi</span></div>
        </h5>
    </div>
    <form class="form-horizontal" wire:submit.prevent="updateTitleLevel">
        <div class="modal-body">
            <div class="modal-body">
                    @for($i = 1; $i < 11; $i++)
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
                        </div>

                    @endfor
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
