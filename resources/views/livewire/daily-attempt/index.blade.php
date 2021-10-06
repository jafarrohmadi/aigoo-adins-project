<div class="card-body">
    <div class="card-body p-0">
        <div class="row">
            <div class="form-group col-md-3" wire:ignore>
                <label>Start Date:</label>
                <input type="text" id="datepicker" class="form-control" autocomplete="off">
            </div>

            <div class="form-group col-md-3" wire:ignore>
                <label>End Date:</label>
                <input type="text" id="datepicker2" class="form-control" autocomplete="off">
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>
            <br>

            <x-tables.no-responsive-table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th class="sorting">No</th>
                        <th class="sorting">Name</th>
                        <th>Quiz</th>
                        <th>Attempt</th>
                        <th>Date</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($daily as $dailyAttempt)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($daily->firstItem() - 1)}}</td>
                            <td>{{ $dailyAttempt->user ? $dailyAttempt->user->name .' (' . $dailyAttempt->user->department .')': ''}}</td>
                            <td>{{ $dailyAttempt->quiz->name ?? ''}}</td>
                            <td>{{$dailyAttempt->attempts}}</td>
                            <td>{{ date("d F Y", strtotime($dailyAttempt->date)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$daily"/>

                <x-tables.pagination :data="$daily"/>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('#datepicker').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd MM yy',
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
                @this.set('selectDate', new Date(inst.selectedYear, inst.selectedMonth,  inst.selectedDay));
                }
            });

            $('#datepicker2').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd MM yy ',
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth,  inst.selectedDay));
                @this.set('endDate', new Date(inst.selectedYear, inst.selectedMonth,  inst.selectedDay));
                }
            });
        })
    </script>
@endpush