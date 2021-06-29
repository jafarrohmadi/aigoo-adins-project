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
                        <th  class="sorting">
                            Assessor
                        </th>
                        <th class="sorting">
                            User
                        </th>
                        <th class="sorting">
                            Date
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($assessment as $key => $assessments)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $assessments->assessor ? ($assessments->assessor->name . ' ('. $assessments->assessor->department->name .')') : ''}}
                            </td>
                            <td>
                                {{ $assessments->user ? ($assessments->user->name. ' ('. $assessments->user->department->name .')') : '' }}
                            </td>
                            <td>
                                {{ $assessments->created_at  }}
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
</div>