<div>
    @if($assessment)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3><center>{{$name}}</center></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.0/dist/chart.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/spiritedaway.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        window.addEventListener("livewire:update", event => {
            setDivisionChart();
        });


        function setDivisionChart() {
            let label = @this.label;
            let datas = @this.datas;

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Average Assessment',
                        data: datas,
                        backgroundColor: 'rgba(0,255,127, 0.5)',
                        borderColor: 'rgba(0,255,127, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });
        }

        var resetCanvas = function(){
            $('#results-graph').remove(); // this is my <canvas> element
            $('#graph-container').append('<canvas id="results-graph"><canvas>');
            canvas = document.querySelector('#results-graph');
            ctx = canvas.getContext('2d');
            ctx.canvas.width = $('#graph').width(); // resize to parent width
            ctx.canvas.height = $('#graph').height(); // resize to parent height
            var x = canvas.width/2;
            var y = canvas.height/2;
            ctx.font = '10pt Verdana';
            ctx.textAlign = 'center';
            ctx.fillText('This text is centered on the canvas', x, y);
        };
    </script>
@endpush
