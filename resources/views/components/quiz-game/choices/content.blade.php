@if (isset($headerActions))

    {{ $headerActions }}
    <div class="clearfix"></div>
    </br>

@endif
<div class="card">
    @if (isset($header))

        <div class="card-header">
            <h3 class="card-title">
                Quiz Choices Table
            </h3>
            <div class="float-right">
                <livewire:quiz-game.choices.create/>
            </div>
        </div>
    @endif

    @if (isset($body))
        <livewire:quiz-game.choices.index/>
    @endif

    @if (isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div><!--card-->
