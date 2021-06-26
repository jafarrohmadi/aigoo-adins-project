<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <div class="col-3">
                    <select wire:model="filterByDepartment" class="form-control form-control-md bg-primary"
                            style="border-radius: 16px;">
                        <option selected>Filter by Department</option>
                        @foreach($department as $division)
                            <option value="{{ $division }}">{{ $division }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <select wire:model="filterByGame" class="form-control form-control-md bg-primary"
                            style="border-radius: 16px;">
                        <option selected>Filter by Game ID</option>
                        <option value="1" class="bg-white">1</option>
                        <option value="2" class="bg-white">2</option>
                        <option value="3" class="bg-white">3</option>
                        <option value="4" class="bg-white">4</option>
                    </select>
                </div>

                <x-tables.search/>
            </div>

            <br>

            <x-tables.table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th class="sorting">No</th>
                        <th class="sorting">Total Point</th>
                        <th class="sorting">Display Name</th>
                        <th class="sorting">Game ID</th>
                    </tr>
                </x-slot>
                >
                <x-slot name="tbody">

                    @foreach ($vwLeadeboard as $key =>  $leaderboard)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $leaderboard->total_score }}</td>
                            <td>{{ $leaderboard->user->name }}</td>
                            <td>{{ $leaderboard->game_id }}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="4">No results.</td>
                            </tr>
                        @endforelse
                </x-slot>
            </x-tables.table>
            <div class="row">
                <x-tables.entries-data :data="$vwLeadeboard"/>

                <x-tables.pagination :data="$vwLeadeboard"/>
            </div>

        </div>
    </div>

</div>
