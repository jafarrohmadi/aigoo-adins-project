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
        var myChart = '';
        window.addEventListener("updateChart", event => {
            setDivisionChart();
        });

        function setDivisionChart() {
            let label = @this.label;
            let datas = @this.datas;

            var ctx = document.getElementById('myChart').getContext('2d');
            if(myChart != '')
            {
                myChart.destroy();
            }
            myChart = new Chart(ctx, {
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


    </script>
@endpush
