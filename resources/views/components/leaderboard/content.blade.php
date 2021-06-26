@if (isset($headerActions))

    {{ $headerActions }}
    <div class="clearfix"></div>
    </br>

@endif
<div class="card">
    @if (isset($header))

        <div class="card-header">
            <h3 class="card-title">
                Leaderboard Table
                {{-- {{ $header }} --}}
            </h3>

        </div>
    @endif

    @if (isset($body))
        <livewire:leaderboard.index />
    @endif

    @if (isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div><!--card-->
