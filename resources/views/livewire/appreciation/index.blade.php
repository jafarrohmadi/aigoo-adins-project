<div class="card-body">
    <div class="card-body p-0">
        <div class="row">
        <div class="form-group col-md-3" wire:ignore>
            <label>Start Date : </label>
            <input type="text"  id="datepicker" class="form-control"  placeholder="Start Date"  autocomplete="off">
        </div>


        <div class="form-group col-md-3" wire:ignore>
            <label>End Date :</label>
            <input type="text"  id="datepicker2" class="form-control" placeholder="End Date" autocomplete="off">
        </div>
        </div>
        <br>
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>
            <x-tables.no-responsive-table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th width="10" class="sorting">
                            No.
                        </th>
                        <th class="sorting">
                            Assessor
                        </th>
                        <th class="sorting">
                            User
                        </th>
                        <th class="sorting">
                            Date
                        </th>
                        <th class="sorting">
                            Appreciation
                        </th>
                        <th class="sorting">
                            Nilai
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">

                    @forelse ($assessment as $key => $assessments)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($assessment->firstItem() - 1)}}</td>
                            <td>
                                {{ $assessments->assessor ? ($assessments->assessor->name . ' ('. $assessments->assessor->department .')') : ''}}
                            </td>
                            <td>
                                {{ $assessments->user ? ($assessments->user->name. ' ('. $assessments->user->department .')') : '' }}
                            </td>
                            <td>
                                {{ date('d F Y', strtotime($assessments->created_at))  }}
                            </td>
                            <td>
                                {{$assessments->assessment_info ?? ''}}
                            </td>
                            <td>
                                {{$assessments->value ?? ''}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>

            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$assessment"/>

                <x-tables.pagination :data="$assessment"/>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal" id="infomodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodal1">History appreciation
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-tables.no-responsive-table>
                        <x-slot name="thead_tfoot">
                            <tr>
                                <th>
                                    No
                                </th>
                                <th class="sorting">
                                    Appreciation
                                </th>
                                <th class="sorting">
                                    Nilai
                                </th>
                                <th>
                                    Created At
                                </th>
                            </tr>
                        </x-slot>

                        <x-slot name="tbody">
                            @if($assessmentData)
                                @forelse ($assessmentData as $key => $assessments)
                                    <tr class="@if($loop->odd) odd @endif">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $assessments->assessment_info  ?? ''}}
                                        </td>
                                        <td>
                                            {{ $assessments->value  ?? ''}}
                                        </td>
                                        <td>
                                            {{$assessments->created_at}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No results.</td>
                                    </tr>
                                @endforelse
                            @endif
                        </x-slot>

                    </x-tables.no-responsive-table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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
                @this.set('startDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
                }
            });

            $('#datepicker2').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'dd MM yy',
                onClose: function (dateText, inst) {
                    $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
                @this.set('endDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay));
                }
            });
        })
    </script>
@endpush