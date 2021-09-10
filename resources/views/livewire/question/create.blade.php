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
                                    <div class="col-md-9" wire:ignore>
                                        <select class="form-control @error('level') mb-4 is-invalid state-invalid @enderror select2" multiple id="select2">
                                            <option value="Staff">Staff</option>
                                            <option value="Managerial">Managerial</option>
                                            <option value="BOD">BOD</option>
                                            <option value="Non-staff">Non-Staff</option>
                                            <option value="None">None</option>
                                        </select>
                                        @error('level')
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
                                    <label class="col-md-3 form-label">Kriteria 1 <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice1"
                                               class="form-control @error('choice1') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice1')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point1" max="4" min="1"
                                               class="form-control @error('point1') mb-4 is-invalid state-invalid @enderror">
                                        @error('point1')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Kriteria 2 <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice2"
                                               class="form-control @error('choice2') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice2')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point2" max="4" min="1"
                                               class="form-control @error('point2') mb-4 is-invalid state-invalid @enderror">
                                        @error('point2')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Kriteria 3 <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice3"
                                               class="form-control @error('choice3') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice3')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point3" max="4" min="1"
                                               class="form-control @error('point3') mb-4 is-invalid state-invalid @enderror">
                                        @error('point3')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Kriteria 4 <span
                                                class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" wire:model="choice4"
                                               class="form-control @error('choice4') mb-4 is-invalid state-invalid @enderror">
                                        @error('choice4')
                                        <div class="bg-danger-transparent-2 text-danger px-4 py-2 br-3 mb-4"
                                             role="alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Point<span class="text-red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="number" wire:model="point4" max="4" min="1"
                                               class="form-control @error('point4') mb-4 is-invalid state-invalid @enderror">
                                        @error('point4')
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#select2').on('change', function (e) {
                var data = $('#select2').select2("val");
            @this.set('level', data);
            });
        });
    </script>
    @endpush