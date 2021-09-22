<div class="card-body">
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <label>Filter Department :</label>
                    <select wire:model="filterByDepartment" class="form-control form-control-md bg-primary"
                            style="border-radius: 16px;">
                        <option selected>Filter By Department</option>
                        @foreach($department as $key => $division)
                            @if($division != '')
                                <option value="{{ $key }}">{{ $division }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3" wire:ignore>
                    <label>Start Date : </label>
                    <input type="text"  id="datepicker" class="form-control" placeholder="Start Date" autocomplete="off">
                </div>


                <div class="form-group col-md-3" wire:ignore>
                    <label>End Date :</label>
                    <input type="text"  id="datepicker2" class="form-control" placeholder="End Date" autocomplete="off">
                </div>
            </div>
            <br>
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>

            <x-tables.no-responsive-table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th class="sorting">No</th>
                        <th class="sorting">Total Point</th>
                        <th class="sorting">Name</th>
                        <th class="sorting">Team</th>
                        <th class="sorting">Department</th>
                        <th class="sorting">Date</th>
                    </tr>
                </x-slot>
                >
                <x-slot name="tbody">

                    @forelse ($vwLeadeboard as $key =>  $leaderboard)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($vwLeadeboard->firstItem() - 1) }}</td>
                            <td>{{ $leaderboard->total_points  ?? ''}}</td>
                            <td>{{ $leaderboard->user->name ?? '' }}</td>
                            <td>{{ $leaderboard->team_id ?? ''}}</td>
                            <td>{{ $leaderboard->department->name ?? '' }}</td>
                            <td>{{ $leaderboard->date  ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$vwLeadeboard"/>

                <x-tables.pagination :data="$vwLeadeboard"/>
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
                    dateFormat: 'MM yy',
                    onClose: function (dateText, inst) {
                        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                        @this.set('selectDate', new Date(inst.selectedYear, inst.selectedMonth, 2));
                    }
                });

                $('#datepicker2').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'MM yy',
                    onClose: function (dateText, inst) {
                        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    @this.set('endDate', new Date(inst.selectedYear, inst.selectedMonth, 2));
                    }
                });
            })
        </script>
    @endpush
</div>

