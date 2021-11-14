<div class="card-body">
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    <div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                @if($user_count > 0)
                    <h3>{{$user_have_assessment .'('. round(($user_have_assessment/ $user_count) * 100, 2) . ' %)'}}</h3>
                @else
                    <h3>0</h3>
                @endif
                <p>User Melakukan Asessment</p>
            </div>
            <div class="icon">
                <i class="fas fa-address-book"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                @if($user_count > 0)
                    <h3>{{$user_dont_have_assessment .'('. round(($user_dont_have_assessment/ $user_count) * 100, 2) . ' %)'}}</h3>
                @else
                    <h3>0</h3>
                @endif

                <p>User Tidak Melakukan Asessment</p>
            </div>
            <div class="icon">
                <i class="fas fa-address-book"></i>
            </div>
        </div>
    </div>
    </div>
    <div class="form-group col-md-3" wire:ignore>
        <label>Pilih Bulan : </label>
        <input type="text"  id="datepicker" class="form-control" placeholder="Pilih Bulan" autocomplete="off">
    </div>
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
                            Department
                        </th>
                        <th>
                            Role
                        </th>
                        <th>
                            Email
                        </th>

                    </tr>
                </x-slot>

                <x-slot name="tbody">
                    @forelse ($user as $key => $users)
                        <tr class="@if($loop->odd) odd @endif">
                            <td>{{ $loop->iteration + ($user->firstItem() - 1)}}</td>
                            <td>
                                {{ $users->name  ?? ''}}
                            </td>
                            <td>
                                {{ $users->department ?? '' }}
                            </td>

                            <td>
                                {{ $users->roles  ?? ''}}
                            </td>
                            <td>
                                {{ $users->email ?? '' }}
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
                <x-tables.entries-data :data="$user"/>

                <x-tables.pagination :data="$user"/>
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
                    dateFormat: 'MM yy',
                    onClose: function (dateText, inst) {
                        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    @this.set('date', new Date(inst.selectedYear, inst.selectedMonth, 2));
                    }
                });
            })
        </script>
    @endpush
</div>


