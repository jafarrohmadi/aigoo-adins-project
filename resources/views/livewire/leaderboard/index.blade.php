<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <select wire:model="filterByDepartment" class="form-control form-control-md bg-primary"
                            style="border-radius: 16px;">
                        <option selected>Filter by Department</option>
                        @foreach($department as $division)
                            <option value="{{ $division }}">{{ $division }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-md-3">
                    <select wire:model="filterByGame" class="form-control form-control-md bg-primary"
                            style="border-radius: 16px;">
                        <option selected>Filter by Game ID</option>
                        <option value="1" class="bg-white">1</option>
                        <option value="2" class="bg-white">2</option>
                    </select>
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
                        <th class="sorting">Game ID</th>
                    </tr>
                </x-slot>
                >
                <x-slot name="tbody">

                    @forelse ($vwLeadeboard as $key =>  $leaderboard)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $leaderboard->total_score }}</td>
                            <td>{{ $leaderboard->user->name }}</td>
                            <td>{{ $leaderboard->team_id }}</td>
                            <td>{{ $leaderboard->department_id }}</td>
                            <td>{{ $leaderboard->game_id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No results.</td>
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

</div>
