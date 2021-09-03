<div class="card-body">
    <div class="card-body p-0">
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
                            Detail
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
                                {{ $assessments->assessment_year_month  }}
                            </td>
                            <td>
                                <div class="btn-list">
                                    <button type="button" wire:click="getAssessment({{ $assessments->assessor_id }} , {{$assessments->user_id}}, '{{$assessments->assessment_year_month}}')"
                                            class="btn btn-info btn-sm" data-toggle="modal" data-target="#infomodal"><i
                                                class="far fa-eye"></i> View
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No results.</td>
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
                                        <td colspan="3">No results.</td>
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