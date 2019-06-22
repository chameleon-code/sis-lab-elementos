$(document).ready(function() {
    //gestion
    url = "/graphics/management/" + 1;
    $('#management').empty();
    $.get(url, function(response, state) {
        if (response.length > 0) {
            var aprobados = 0;
            var reprobados = 0;
            //console.log(response);
            consulta = response;
            consulta.forEach(function(element) {
                // console.log("anadido: " + element.url);
                if (element.score > 50) {
                    aprobados = aprobados + 1;
                } else {
                    reprobados = reprobados + 1;
                }
            });

            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'quantity'],
                    ['Notas mayores a 51', aprobados],
                    ['Notas menores a 51', reprobados]
                ]);

                var options = {
                    title: 'Porcentaje de notas mayores y menores a 51'
                };

                var chart = new google.visualization.PieChart(document.getElementById('management'));

                chart.draw(data, options);
            }
        } else {
            $('#management').append('<p class="alert alert-success m-5">No existe notas disponibles aun</p>');
        }
    });

    $("#managements").change(function(event) {
        url = "/graphics/management/" + event.target.value;
        $('#management').empty();
        $.get(url, function(response, state) {
            if (response.length > 0) {
                var aprobados = 0;
                var reprobados = 0;
                //console.log(response);
                consulta = response;
                consulta.forEach(function(element) {
                    // console.log("anadido: " + element.url);
                    if (element.score > 50) {
                        aprobados = aprobados + 1;
                    } else {
                        reprobados = reprobados + 1;
                    }
                });

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'quantity'],
                        ['Notas mayores a 51', aprobados],
                        ['Notas menores a 51', reprobados]
                    ]);

                    var options = {
                        title: 'Porcentaje de notas mayores y menores a 51'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('management'));

                    chart.draw(data, options);
                }
            } else {
                $('#management').append('<p class="alert alert-success m-5">No existe notas disponibles aun</p>');
            }
        });
    });
    //materia

    url = "/graphics/subjectMatter/" + 1;
    $('#subjectMatter').empty();
    $.get(url, function(response, state) {
        if (response.length > 0) {
            var aprobados = 0;
            var reprobados = 0;
            //console.log(response);
            consulta = response;
            consulta.forEach(function(element) {
                // console.log("anadido: " + element.url);
                if (element.score > 50) {
                    aprobados = aprobados + 1;
                } else {
                    reprobados = reprobados + 1;
                }
            });

            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'quantity'],
                    ['Notas mayores a 51', aprobados],
                    ['Notas menores a 51', reprobados]
                ]);

                var options = {
                    title: 'Porcentaje de notas mayores y menores a 51'
                };

                var chart = new google.visualization.PieChart(document.getElementById('subjectMatter'));

                chart.draw(data, options);
            }
        } else {
            $('#subjectMatter').append('<p class="alert alert-success m-5">No existe notas disponibles aun</p>');
        }
    });

    $("#subjectMatters").change(function(event) {
        url = "/graphics/subjectMatter/" + event.target.value;
        $('#subjectMatter').empty();
        $.get(url, function(response, state) {
            if (response.length > 0) {
                var aprobados = 0;
                var reprobados = 0;
                //console.log(response);
                consulta = response;
                consulta.forEach(function(element) {
                    // console.log("anadido: " + element.url);
                    if (element.score > 50) {
                        aprobados = aprobados + 1;
                    } else {
                        reprobados = reprobados + 1;
                    }
                });

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'quantity'],
                        ['Notas mayores a 51', aprobados],
                        ['Notas menores a 51', reprobados]
                    ]);

                    var options = {
                        title: 'Porcentaje de notas mayores y menores a 51'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('subjectMatter'));

                    chart.draw(data, options);
                }
            } else {
                $('#subjectMatter').append('<p class="alert alert-success m-5">No existe notas disponibles aun</p>');
            }
        });
    });
    //grupos
    url = "/graphics/group/" + 1;
    $('#group').empty();
    $.get(url, function(response, state) {
        if (response.length > 0) {
            var aprobados = 0;
            var reprobados = 0;
            //console.log(response);
            consulta = response;
            consulta.forEach(function(element) {
                // console.log("anadido: " + element.url);
                if (element.score > 50) {
                    aprobados = aprobados + 1;
                } else {
                    reprobados = reprobados + 1;
                }
            });

            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'quantity'],
                    ['Notas mayores a 51', aprobados],
                    ['Notas menores a 51', reprobados]
                ]);

                var options = {
                    title: 'Porcentaje de notas mayores y menores a 51'
                };

                var chart = new google.visualization.PieChart(document.getElementById('group'));

                chart.draw(data, options);
            }
        } else {
            $('#group').append('<p class="alert alert-success m-5">No existe notas disponibles aun</p>');
        }
    });
    $("#groups").change(function(event) {
        url = "/graphics/group/" + event.target.value;
        $('#group').empty();
        $.get(url, function(response, state) {
            if (response.length > 0) {
                var aprobados = 0;
                var reprobados = 0;
                //console.log(response);
                consulta = response;
                consulta.forEach(function(element) {
                    // console.log("anadido: " + element.url);
                    if (element.score > 50) {
                        aprobados = aprobados + 1;
                    } else {
                        reprobados = reprobados + 1;
                    }
                });

                google.charts.load('current', { 'packages': ['corechart'] });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'quantity'],
                        ['Notas mayores a 51', aprobados],
                        ['Notas menores a 51', reprobados]
                    ]);

                    var options = {
                        title: 'Porcentaje de notas mayores y menores a 51'
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('group'));

                    chart.draw(data, options);
                }
            } else {
                $('#group').append('<p class="alert alert-success m-5">No existe notas disponibles aun</p>');
            }
        });
    });
});