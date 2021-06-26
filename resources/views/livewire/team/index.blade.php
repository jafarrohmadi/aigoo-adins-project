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
                            Name
                        </th>
                        <th class="sorting">
                            Avatar
                        </th>
                        <th class="sorting">
                            Locked
                        </th>
                        <th class="sorting">
                            Members
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($team as $key => $teams)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $teams->name }}
                            </td>
                            <td>
                                {{ $teams->avatar }}
                            </td>
                            <td>
                                {{ $teams->locked == 1 ? 'Ya' : 'Tidak'}}
                            </td>
                            <td>@forelse($teams->members as $members) {{ $members }}
                                @empty
                                    No Member
                                @endforelse
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
                <x-tables.entries-data :data="$team"/>

                <x-tables.pagination :data="$team"/>
            </div>
        </div>
    </div>
</div>