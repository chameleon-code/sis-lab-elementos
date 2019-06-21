@extends('components.sections.professorSection')
@section('userContent')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
</div>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var aprobados=0;
        var reprobados=0;
        $(document).ready(function() {
            var str;
            var consulta = [];
            // $('#buscar').on('click', function(e) {
            //     e.preventDefault();
                // $('#coleccion').empty();
                // str = $('#palabla').val();
                // str = str.toLowerCase();
                url = "/graphics/group/" + 4;
                $.get(url, function(response, state) {
                    console.log(response);
                    consulta = response;
                    consulta.forEach(function(element) {
                        // console.log("anadido: " + element.url);
                        if(element.score > 50){
                            aprobados=aprobados+1;
                        }else{
                            reprobados=reprobados+1;
                        }
                        // $('#coleccion').append('<a href="' + element.url + '" class="stretched-link">' + element.name_doc + '</a> <hr>');
                    });
                    console.log(aprobados);
            console.log(reprobados);
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Notas mayores a 51',     aprobados],
                ['Notas menores a 51',  reprobados]
                ]);

                var options = {
                title: 'Porcentaje de Notas Mayores y menores a 51'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
                });
                });
            // });
            
        
    </script>
@endsection
