<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total Score per Department</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Score Timeline</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div id="chartdiv" style="width:100%; height:500px; max-width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.0/dist/chart.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/spiritedaway.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        async function changeFilter(filter) {
            await window.livewire.emit('changeFilter', filter);
        }

        window.addEventListener("livewire:update", event => {
            setDivisionChart();
            dailyChart();
        });

        $( document ).ready(function() {
            (function () {
                const value = 'month';
                changeFilter(value);
            }());
        });

        function setDivisionChart() {
            let divisions = @this.data.divisions;
            let divisionAggregate = @this.data.divisionAggregate;

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: divisions,
                    datasets: [{
                        label: 'Total Score',
                        data: divisionAggregate,
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

        function random_rgba() {
            var o = Math.round, r = Math.random, s = 255;
            return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
        }

        function dailyChart()
        {
            am4core.ready(function() {
                let dataDaily = @this.data.daily;
                am4core.useTheme(am4themes_animated);

                var chart = am4core.create("chartdiv", am4charts.XYChart);
                chart.paddingRight = 20;

                chart.data = dataDaily;

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.tooltip.disabled = true;
                valueAxis.title.text = "Total Score";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.dateX = "date";
                series.dataFields.valueY = "value";
                series.tooltipText = "Score: [bold]{valueY}[/]";
                series.fillOpacity = 0.3;
                series.strokeWidth = 2;
                series.minBulletDistance = 15;

                // Make bullets grow on hover
                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 4;
                bullet.circle.fill = am4core.color("#fff");

                var bullethover = bullet.states.create("hover");
                bullethover.properties.scale = 1.3;

                chart.cursor = new am4charts.XYCursor();
                chart.cursor.lineY.opacity = 0;
                chart.scrollbarX = new am4charts.XYChartScrollbar();
                chart.scrollbarX.series.push(series);

                dateAxis.start = 0.9;
                dateAxis.keepSelection = true;
            });
        }
    </script>
@endsection
