
@section('content')

<div class="card ">
        <div class="card-header"> 
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats" style="background-color:#11BFE3">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5"style="color:white;">
                                    <div class="icon-big text-center icon-warning" style="color:white;">                                   
                                        <i class="nc-icon nc-satisfied "></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category" style="color:white;">Cumple</p>
                                        <h4 class="card-title" style="color:white; font-size;24px;">{{$lscumple}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr style="color:white;">
                            <div class="stats" style="color:white;"> 
                                <i class="fa fa-check" aria-hidden="true" ></i> Auditorias satisfactorias
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats" style="background-color:red;">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">                                         
                                        <i class="nc-icon nc-simple-remove" style="color:white;"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers" style="color:white;">
                                        <p class="card-category" style="color:white;">Alertas</p>
                                        <h4 class="card-title"style="color:white;" >{{$lsalertas}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats" style="color:white;">
                                <i class="fa fa-check"></i> Auditorias en Alerta
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card card-stats" style="background-color:#FF9510;">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-paper-2" style="color:white;"></i>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category" style="color:white;">Total Auditorias</p>
                                        <h4 class="card-title" style="color:white;">{{$lcounta}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats" style="color:white;">
                                <i class="fa fa-check"></i> Total
                            </div>
                        </div>
                    </div>
                </div>          
            </div>          
        </div> 
 </div>
 @if($lcounta > 0)
    @if($emp_type == 7 or $emp_type == 8)
        <div class="card ">
            <div class="col-md-12" id="grafic">            
                <div class="col-lg-6 col-sm-6">
                <div class="card-header ">
                    <h5 class="card-title">Gestion de Auditorias</h5>
                    <p class="card-category">Expresado en Auditorias</p>
                </div>
                    <canvas id="myChart" width="600" height="400"></canvas>
                </div>       
                <div class="col-lg-6 col-sm-6">
                <div class="card-header ">
                    <h5 class="card-title">Evaluaciones</h5>
                    <p class="card-category">Expresado en %</p>
                </div>
                    <canvas id="myChart2" width="600" height="400"></canvas>
                </div>    
            </div>
        </div>
        <div class="card ">
            <div class="col-md-12"> 
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-header ">
                                <h5 class="card-title">Ejecutivos</h5>
                                <p class="card-category">Detalle x Ejecutivo</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table" >
                                    <thead>
                                        <th data-field="name" data-sortable="true">Ejecutivo</th>
                                        <th data-field="salary" data-sortable="true">Alertas</th>
                                        <th data-field="salary" data-sortable="true">% Alertas</th>
                                        <th data-field="salary" data-sortable="true">Cumple</th>
                                        <th data-field="salary" data-sortable="true">% Cumple</th>
                                        <th data-field="salary" data-sortable="true">Total</th>                                                                          
                                    </thead>
                                    <tbody>
                                        @foreach($ejecutivos as $ejecu)
                                            <tr>                                       
                                                <td>{{ $ejecu->ejec }}</td>
                                                <td class="tdeje">{{ $ejecu->alerta }}</td>
                                                <td class="tdeje">{{ round(($ejecu->alerta / $ejecu->cant)*100) }}%</td>  
                                                <td class="tdeje">{{ $ejecu->cumple }}</td>
                                                <td class="tdeje">{{ round(($ejecu->cumple / $ejecu->cant)*100) }}%</td>  
                                                <td class="tdeje">{{ $ejecu->cant }}</td>                                                                       
                                            </tr>
                                        @endforeach      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-header ">
                                <h5 class="card-title">Sponsor y Campañas</h5>
                                <p class="card-category">Detalle x Sponsor y Campaña</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th data-field="name" data-sortable="true">Sponsor</th>
                                        <th data-field="salary" data-sortable="true">Campaña</th>
                                        <th data-field="salary" data-sortable="true">Cant</th>                                                                                         
                                    </thead>
                                    <tbody>
                                        @foreach($ltop as $top)
                                            <tr>                                       
                                                <td>{{ $top->sponsor }}</td>
                                                <td class="ttop">{{ $top->cia }}</td>                 
                                                <td class="ttop">{{ $top->cant }}</td>                                                                       
                                            </tr>
                                        @endforeach      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    @endif
@else                
<div class="card">
    <div class="col-md-12"><br>
        <div class="alert alert-danger alert-with-icon" data-notify="container" id="cumple">                    
            <span data-notify="icon" class="nc-icon nc-bell-55"></span>
            <span><b> Atencion: </b> No existen Registros que mostrar.</span>
        </div> 
    </div>  
</div>   
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<!-- GRAFICOS  -->
<script>
    var sites = {!! json_encode($infograb) !!};  
    var ctx = document.getElementById('myChart').getContext('2d');   
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [ 'Alertas', 'Cumple','Total'],
            datasets: [{
                label: '# de Auditorias',               
                data: [sites[0],sites[1],sites[2]],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,           
        }
        
    });
</script>

<script>
    var sites2 = {!! json_encode($infograb2) !!};  
    var ctx = document.getElementById('myChart2').getContext('2d');
    ctx.canvas.width = 400;
    ctx.canvas.height = 350;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [ '% Nota Parcial', '% Nota Final','% Cumpl'],
            datasets: [{
                label: '% Promedio',
                data: [sites2[0],sites2[1],sites2[2]],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
        }
    });

</script>


<style>
    .tdeje {
        text-align: center;
    }

    #grafic {
        display:flex;
    }
    .table td {
        font-size:12px;
    }
</style>

@endsection