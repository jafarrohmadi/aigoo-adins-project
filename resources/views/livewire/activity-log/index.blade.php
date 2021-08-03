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
                            Tanggal
                        </th>
                        <th  class="sorting">
                            Name Log
                        </th>
                        <th class="sorting">
                            ID
                        </th>
                        <th class="sorting">
                            Nama User
                        </th>
                        <th class="sorting">
                            Logs
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($activityLogs as $key => $logs)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $logs->created_at }}
                            </td>
                            <td>
                                {{ $logs->description ?? '' }}
                            </td>
                            <td>
                                ID  : {{ $logs->subject_id  ?? ''}}
                            </td>
                            <td>
                                {{ $logs->causer->name ?? '' }}
                            </td>
                            <td>
                                {{ $logs->changes  ?? ''}}
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
                <x-tables.entries-data :data="$activityLogs"/>

                <x-tables.pagination :data="$activityLogs"/>
            </div>
        </div>
    </div>
</div>