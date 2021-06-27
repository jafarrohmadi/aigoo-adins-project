@if (isset($headerActions))

    {{ $headerActions }}
    <div class="clearfix"></div>
    </br>

@endif
<div class="card">
    @if (isset($header))

        <div class="card-header">
            <h3 class="card-title">
                Category Table
                {{-- {{ $header }} --}}
            </h3>
            <div class="float-right">
                <livewire:category.create/>
            </div>

        </div>
    @endif

    @if (isset($body))
        <livewire:category.index />
    @endif

    @if (isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div><!--card-->
