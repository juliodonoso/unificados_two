@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">                                   
                                    <i class="fa fa-file-o text-warning" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Total Propuestas</p>
                                    <h4 class="card-title">{{$PropCount}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Propuestas Mes Activo
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">                                  
                                    <i class="fa fa-calendar text-success"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Propuestas Gestionadas</p>
                                    <h4 class="card-title">{{$Propgt}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i> Gestiones Realizadas hoy
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                    <p class="card-category">Propuestas Devueltas</p>
                                    <h4 class="card-title">{{$PropdevCount}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Rechazos
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-favourite-28 text-primary"></i>
                                </div>
                            </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Propuestas Buenas Ventas</p>
                                <h4 class="card-title">{{$PropbvCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> Gestiones Exitosas
                    </div>
                </div>
            </div>
        </div>
                
    </div>  
      
<!-- </div>  -->

 @if($ldash == 1)
    <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Grafico de Gestiones</h4>
                        <p class="card-category">Representado en Porcentaje (%)</p>
                    </div>
                    <div class="card-body ">
                        <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Buenas ventas
                            <i class="fa fa-circle text-danger"></i> Devoluciones 
                            <i class="fa fa-circle" id="c01"></i> Sin gestion             
                            <i class="fa fa-circle text-warning"></i> Otras Gestiones
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>                                
            <div class="col-md-6" >
                <div class="card " id="divcum">
                    <div class="card-header ">
                        <h4 class="card-title">Cumplimiento</h4>
                        <p class="card-category">Representado en Porcentaje (%)</p>
                    </div>
                    <div class="card-body ">
                        <div id="main">                        
                            <p class="text-muted" id="p01">
                                {{ $cumpl}}
                            </p>                    
                        </div>                        
                    </div> 
                                      
                </div>
            </div>                        
        </div>
    <!-- </div> -->
    @if($tareasCount >0)
        <div class="container-fluid">   
            <div class="col-md-12">
                <div class="card  card-tasks">
                    <div class="card-header ">
                        <h4 class="card-title">Tareas</h4>
                        <p class="card-category">Propuestas por Gestion administrativa</p>
                    </div>
                    <div class="card-body ">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                @foreach($ptareas as $resp)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>                                    
                                        <td>{{$resp->observaciones}}</td>
                                        <td class="td-actions text-right">
                                            <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-link">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-link">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach                            
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else 
    
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tareas</h4>           
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>
                                <small>Panel de Tareas:</small>
                            </h5>
                            <div class="alert alert-info alert-with-icon" data-notify="container">                       
                                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                <span data-notify="message">NO existen Tareas Notificadas para realizar gestion administrativa.</span>
                            </div>
                        </div>
                    
                    </div>           
                </div>
            </div>
        </div>
    @endif
@else 
<div class="col-md-12">                          
    <div class="alert alert-warning alert-with-icon" data-notify="container">                       
        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
        <span data-notify="message">NO hay Periodos Abiertos.</span>
    </div>
</div>               
@endif
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/demo.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {        
        demo.showNotification();       
    });
    $(document).ready(function() {
    var dataPreferences = {
            series: [
                [25, 30, 20, 25]
            ]
        };       
     
        var optionsPreferences = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false,
                offset: 0
            },
            height: 245
        };
        var optionsPreferences2 = {
            donut: true,
            donutWidth: 40,
            startAngle: 0,
            total: 100,
            showLabel: false,
            axisX: {
                showGrid: false,
                offset: 0
            },
            height: 1245
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);
        var sites = {!! json_encode($info) !!};
        Chartist.Pie('#chartPreferences', {
            labels: [sites[0], sites[1], sites[2], sites[3]],
            series: [sites[0], sites[1], sites[2], sites[3]]
        });
        Chartist.Pie('#chartPreferences2', dataPreferences, optionsPreferences2);
        var sites = {!! json_encode($info) !!};
        Chartist.Pie('#chartPreferences2', {
            labels: [sites[0], sites[1]],
            series: [sites[0], sites[1]]
        });

    });




   

</script>


<style>
    #c01 {
        color: #8e44ad ;
    }

    #divcum {
        /* background-color: red; */
        height: 400px;
        
    }

    #main {
        margin: auto;
    width: 70%;
    /* border: 3px solid green; */
    padding: 25px;

    }

    #p01 {
        font-size:90px;
        text-decoration: underline;
        
    }
</style>

@endsection