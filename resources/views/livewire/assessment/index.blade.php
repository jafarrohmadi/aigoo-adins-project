<div>
    @if($userData != null || $date != null)
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
                            Role
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
                                @if($assessments->user->id == $assessments->assessor->id)
                                    Diri Sendiri
                                @else
                                    @if($assessments->assessor->id == $assessments->user->supervisor_id)
                                        Atasan
                                    @endif

                                    @if($assessments->assessor->supervisor_id == $assessments->user->id)
                                        Bawahan
                                    @endif

                                    @if($assessments->user->department == $assessments->assessor->department)
                                        Satu Tim
                                    @endif

                                    @if($assessments->user->department != $assessments->assessor->department)
                                        Beda Tim
                                    @endif
                                @endif
                            </td>
                            <td>
                                {{ $assessments->user ? ($assessments->user->name. ' ('. $assessments->user->department .')') : '' }}
                            </td>
                            <td>
                                {{ date('d F Y', strtotime($assessments->created_at))  }}
                            </td>
                            <td>
                                <div class="btn-list">
                                    <button type="button"
                                            wire:click="getAssessment({{ $assessments->assessor_id }} , {{$assessments->user_id}}, '{{$assessments->assessment_year_month}}')"
                                            class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#infomodal"><i
                                                class="far fa-eye"></i> View
                                    </button>
                                </div>
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


        <div wire:ignore.self class="modal" id="infomodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editmodal1">History assessor
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-striped table-hover" role="grid">

                                    <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th class="sorting">
                                            Question
                                        </th>
                                        <th class="sorting">
                                            Answer
                                        </th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                    @if($assessmentData)
                                        @forelse ($assessmentData as $key => $assessments)
                                            <tr class="@if($loop->odd) odd @endif">
                                                <td>{{ $loop->iteration }}</td>
                                                <td >
                                                    {{ $assessments->question->content ?? ''}}
                                                </td>
                                                <td>
                                                    {{ $assessments->value ?? ''}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No results.</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                    </tbody>

                                    {{--            <tfoot>--}}
                                    {{--                {{ $thead_tfoot }}--}}
                                    {{--            </tfoot>--}}
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
