<div class="card-body">
    <div class="card-body p-0">
        <div class="table-responsive">
            <div class="row">
                <x-tables.per-page/>

                <x-tables.search/>
            </div>
            <br>

            <x-tables.no-responsive-table>
                <x-slot name="thead_tfoot">
                    <tr>
                        <th class="sorting">No</th>
                        <th class="sorting">Name</th>
                        <th>Quiz</th>
                        <th>Attempt</th>
                        <th>Date</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($daily as $dailyAttempt)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($daily->firstItem() - 1)}}</td>
                            <td>{{ $dailyAttempt->user->name  ?? ''}}</td>
                            <td>{{ $dailyAttempt->quiz->name ?? ''}}</td>
                            <td>{{$dailyAttempt->attempt}}</td>
                            <td>{{ date("d F Y", strtotime($dailyAttempt->date)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No results.</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-tables.no-responsive-table>
            <div class="row">
                <x-tables.entries-data :data="$daily"/>

                <x-tables.pagination :data="$daily"/>
            </div>
        </div>
    </div>
</div>
