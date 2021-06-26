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
                            Name
                        </th>
                        <th  class="sorting">
                            Active
                        </th>
                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($department as $key => $departments)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $departments->name }}
                            </td>
                            <td>
                                {{ $departments->is_active ? 'Ya' : 'Tidak' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>

            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$department"/>

                <x-tables.pagination :data="$department"/>
            </div>
        </div>
    </div>
</div>