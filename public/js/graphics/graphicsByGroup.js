$(document).ready( function() { 
    selectManagement();
});

function selectManagement() {
    $('#block-selector').empty();
    let display_blocks = []
    let no_blocks = true;
    for(let i=0 ; i<groups.length ; i++) {
        if( groups[i].management_id+"" == $('#management-selector')[0].value && !display_blocks.includes(groups[i].block_id) ) {
            $('#block-selector').append(
                `<option class="optional" value="${groups[i].block_id}"> ${ groups[i].block_name } ( ${ groups[i].subject.name } )</option>`
            );
            display_blocks.push(groups[i].block_id);
            no_blocks = false;
        }
    }
    if( no_blocks ) {
        $('#block-selector').append(
            `<option class="optional" value=""> Sin bloques </option>`
        );
    }
    selectBlock();
}

function selectBlock() {
    $('#group-selector').empty();
    let no_groups = true;
    for(let i=0 ; i<groups.length ; i++) {
        if( groups[i].management_id == $('#management-selector')[0].value && groups[i].block_id == $('#block-selector')[0].value ) {
            $('#group-selector').append(
                `<option class="optional" value="${groups[i].id}"> ${ groups[i].name } </option>`
            );
            no_groups = false;
        }
    }
    if( no_groups ) {
        $('#group-selector').append(
            `<option class="optional" value=""> Sin grupos </option>`
        );
    }
    selectGroup();
}

function selectGroup() {
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    loadAreaChart();
    loadDonutChart();
}

function loadAreaChart() {
    $('#chart-area-container').empty();
    $.ajax({
        url : "/professor/sesionsStatusByGroup/"+$('#management-selector').val()+"/"+$('#block-selector').val()+"/"+$('#group-selector').val(),
        success: function (response){
            if( response.sesions.length > 0 ) {
                let sesions = [];
                let commited_tasks_by_sesion = response.commited_tasks_by_sesion;
                for(let i=0 ; i<response.sesions.length ; i++) {
                    sesions.push( "S-"+response.sesions[i].number_sesion );
                }
                $('#chart-area-container').append(
                    `
                    <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="myAreaChart" style="display: block; height: 320px; width: 426px;" width="383" height="287" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="text-center mt-3" style="font-size: 0.9rem;"> Estudiantes: <b> ${ response.total_students_group } </b> </div>
                    `
                );
                var ctx = document.getElementById("myAreaChart");
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: sesions,
                        datasets: [{
                            label: "Entregas",
                            lineTension: 0.3,
                            backgroundColor: "rgba(78, 115, 223, 0.05)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointBorderColor: "rgba(78, 115, 223, 1)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: commited_tasks_by_sesion
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                left: 10,
                                right: 25,
                                top: 25,
                                bottom: 0
                            }
                        },
                        scales: {
                            xAxes: [{
                                time: {
                                    unit: 'Sesiones'
                                },
                                gridLines: {
                                    display: false,
                                    drawBorder: false
                                },
                                    ticks: {
                                    maxTicksLimit: sesions.length
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: parseInt( response.total_students_group ),
                                    padding: 10,
                                    callback: function(value, index, values) {
                                        return number_format(value);
                                    }
                                },
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                                }
                            }
                        }
                    }
                });
            } else {
                $('#chart-area-container').append(
                    `
                    <div class="alert alert-warning"> Aun no existen sesiones para el bloque del grupo </div>
                    `
                );
            }
        },
        error: function() {
            //
        }
    });
}

function loadDonutChart() {
    $('#chart-donut-container').empty();
    $('#chart-donut-container-2').empty();
    $.ajax({
        url : "/professor/scoreTasksByGroup/"+$('#management-selector').val()+"/"+$('#block-selector').val()+"/"+$('#group-selector').val(),
        success: function (response){
            if( response.length > 0 ) {
                let students_without_deliveries = 0;
                let students_without_scores = 0;
                let students_with_scores = 0;
                for(let i=0 ; i<response.length ; i++) {
                    switch( response[i] ) {
                        case null:
                            students_without_deliveries++;
                            break;
                        case -1:
                            students_without_scores++;
                            break;
                        default:
                            students_with_scores++;
                    }
                }
                proportion_type_scores = [ parseFloat( Math.round( students_without_deliveries * 100 ) / response.length ).toFixed(2), parseFloat( Math.round( students_without_scores * 100 ) / response.length ).toFixed(2), parseFloat( Math.round( students_with_scores * 100 ) / response.length ).toFixed(2) ];
                $('#chart-donut-container').append(
                    `
                    <div class="chart-pie"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="myPieChart" width="257" height="227" class="chartjs-render-monitor" style="display: block; height: 253px; width: 286px;"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Ninguna entrega ( <b> ${ students_without_deliveries } </b> )
                        </span> <br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Sin calificaciones ( <b> ${ students_without_scores } </b> )
                        </span><br>
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Con calificaciones ( <b> ${ students_with_scores } </b> )
                        </span>
                    </div>
                    <div class="text-center mt-3" style="font-size: 0.9rem;"> Estudiantes: <b> ${ response.length } </b> </div>
                    `
                );
                var ctx = document.getElementById("myPieChart");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Ninguna entrega", "Sin calificaciones", "Con calificaciones"],
                        datasets: [{
                            //data: [55, 30, 15],
                            data: proportion_type_scores,
                            backgroundColor: ['#f6c23e', '#1cc88a', '#4e73df'],
                            hoverBackgroundColor: ['#F0B31A', '#17a673', '#2e59d9'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10
                        },
                            legend: {
                                display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
                let scores = []
                for(let i=0 ; i<response.length ; i++) {
                    if( response[i] && response[i] != -1 ) {
                        scores.push( response[i] );
                    }
                }
                let approval_scores = [];
                let reproval_scores = [];
                for(let i=0 ; i<scores.length ; i++) {
                    if( scores[i] >= 51 ) {
                        approval_scores.push( scores[i] );
                    } else {
                        reproval_scores.push( scores[i] );
                    }
                }
                if( scores.length > 0 ) {
                    $('#chart-donut-container-2').append(
                        `
                        <div class="chart-pie"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="myPieChart2" width="257" height="227" class="chartjs-render-monitor" style="display: block; height: 253px; width: 286px;"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> < 51 ( <b> ${ reproval_scores.length } </b> )
                            </span> <br>
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> ≥ 51 ( <b> ${ approval_scores.length } </b> )
                            </span>
                        </div>
                        <div class="text-center mt-3" style="font-size: 0.9rem;"> Estudiantes: <b> ${ scores.length } </b> </div>
                        `
                    );
                    var ctx2 = document.getElementById("myPieChart2");
                    var myPieChart2 = new Chart(ctx2, {
                        type: 'doughnut',
                        data: {
                            labels: ["< 51", "≥ 51"],
                            datasets: [{
                                data: [ parseFloat( Math.round( reproval_scores.length * 100 ) / scores.length ).toFixed(2), parseFloat( Math.round( approval_scores.length * 100 ) / scores.length ).toFixed(2) ],
                                backgroundColor: ['#f6c23e', '#4e73df'],
                                hoverBackgroundColor: ['#F0B31A', '#2e59d9'],
                                hoverBorderColor: "rgba(234, 236, 244, 1)",
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                            },
                                legend: {
                                display: false
                            },
                            cutoutPercentage: 80,
                        },
                    });
                } else {
                    $('#chart-donut-container-2').append(
                        `
                        <div class="alert alert-warning"> No hay tareas con calificaciones </div>
                        `
                    );
                }
            } else {
                $('#chart-donut-container').append(
                    `
                    <div class="alert alert-warning"> No hay estudiantes inscritos en este grupo </div>
                    `
                );
                $('#chart-donut-container-2').append(
                    `
                    <div class="alert alert-warning"> No hay tareas con calificaciones </div>
                    `
                );
            }
        },
        error: function() {
            //
        }
    });
}

// Chart functions

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}