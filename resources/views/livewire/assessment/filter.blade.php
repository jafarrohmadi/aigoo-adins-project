<div class="row col-md-12">
    <div class="form-group col-md-3" wire:ignore>
        <label>Start Date:</label>
        <input  type="text" id="datepicker" class="form-control" autocomplete="off">
    </div>

    <div class="form-group col-md-3" wire:ignore>
        <label>End Date:</label>
        <input  type="text" id="datepicker2" class="form-control" autocomplete="off">
    </div>

    <div class="form-group col-md-3" wire:ignore>
        <label>User:</label>
        <select class="select2 form-control" name="selectName" id="select2" required>
            <option value="">Select User</option>
            @foreach($user as $users)
                <option value="{{$users->id}}"> {{$users->name . ' ('. $users->department . ')' }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <button class="btn btn-info" wire:click="updateAssessmentData" type="submit" style="margin-top: 32px">Submit
        </button>
    </div>
</div>

@push('js')
    <script>
        $(function () {
            $('#datepicker').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd MM yy',
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
                }
            });

            $('#datepicker').on('change', function (e) {
                var data = $('#datepicker').val();
            @this.set('selectDate', data)
            });

            $('#datepicker2').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd MM yy',
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
                }
            });

            $('#datepicker2').on('change', function (e) {
                var data = $('#datepicker2').val();
            @this.set('endDate', data)
            });
        })

            $(document).ready(function () {
                $('#select2').select2();
                $('#select2').on('change', function (e) {
                    var data = $('#select2').select2("val");
                @this.set('selectName', data)
                });
            })
    </script>
@endpush
