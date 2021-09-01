@extends('layouts.menu')
@auth
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
                                <p class="card-category" id="bv1">{{$total}}</p>
                                    <h4 class="card-title"></h4>
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
                                    <i class="nc-icon nc-simple-remove text-danger"></i>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="numbers">
                                <p class="card-category" id="bv1">{{$dev}}</p>
                                    <h4 class="card-title"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar-o"></i> Devoluciones
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-12">
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
                                <p class="card-category" id="bv1">{{$bv}}</p>
                                    <h4 class="card-title"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Buenas Ventas
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
                                    <i class="nc-icon nc-satisfied text-success"></i>
                                </div>
                            </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category" id="bv1">{{$pcbv}}%</p>
                                <h4 class="card-title"></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> % Gestion de Llamadas
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="card " id="divgrf">
                <div class="card-header ">
                    <h4 class="card-title">Propuestas por Clinica</h4>
                    <!-- <p class="card-category">Representado en Porcentaje (%)</p> -->
                </div>
                <div class="card-body ">
                    <table class="table table-hover" id="tbale">
                        <thead>           
                            <th>Clinica</th>                          
                            <th>Cant</th>
                            <th>Ing</th> 
                            <th>%ing</th>
                            <th>BV</th>     
                            <th>%BV</th>   
                            <th>NCIng</th> 
                            <th>DV</th>
                            <th>%DV</th>                               
                        </thead>              
                        <tbody>
                            @foreach($Propmes as $resp2)
                                <tr>                                                  
                                    <td >{!! $resp2->clin !!}</td>                                  
                                    <td class="sum">{!! $resp2->count_nro!!}</td> 
                                    <td class="sum">{!! $resp2->ing!!}</td> 
                                    <td class="sum">{!! round(($resp2->ing/$resp2->count_nro)*100)!!}%</td>     
                                    <td class="sum">{!! $resp2->bv!!}</td> 
                                    <td class="sum">{!! round(($resp2->bv/$resp2->count_nro)*100)!!}%</td>          
                                    <td class="sum">{!! $resp2->ingBV!!}</td> 
                                    <td class="sum">{!! $resp2->devol!!}</td>
                                    <td class="sum">{!! round(($resp2->devol/$resp2->count_nro)*100)!!}%</td>  
                                </tr>
                            @endforeach
                            <tr>
                                <td class="Total">TOTAL</td>            
                                <td class="Total A">{{$total}}</td>
                                <td class="Total F">{{$totaling}}</td>
                                <td class="Total E">{{round(($totaling/$total)*100)}}%</td>
                                <td class="Total D">{{$bv}}</td>
                                <td class="Total E">{{round(($bv/$total)*100)}}%</td>          
                                <td class="Total F">{{$NCing}}</td>
                                <td class="Total B">{{$dev}}</td>
                                <td class="Total C">{{round(($dev/$total)*100)}}%</td>
                            
                            </tr>                        
                        </tbody>         
                    </table>  
                </div>
                <div class="card-footer ">
                    <div class="legend">
                        <!-- <i class="fa fa-circle text-info"></i> Buenas ventas
                        <i class="fa fa-circle text-danger"></i> Devoluciones
                        <i class="fa fa-circle text-warning"></i> Total                         -->
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-6" id="divgrf">
            <div class="card " id="divgrf">
                <div class="card-header ">
                    <h4 class="card-title">Grafico por Clinica</h4>     
                </div>
                <div class="card-body ">
                    <div id="chartActivity2" class="ct-chart"></div>          
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Buenas ventas
                            <i class="fa fa-circle text-danger"></i> Devoluciones
                            <i class="fa fa-circle text-warning"></i> Total                        
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card " >
                    <div class="card-header ">
                        <h4 class="card-title">UF por Clinica</h4>
                        <!-- <p class="card-category">Representado en Porcentaje (%)</p> -->
                    </div>
                    <div class="card-body ">
                        <table class="table table-hover">
                            <thead>           
                                <th>Clinica</th>                          
                                <th>Neg</th> 
                                <th>UF</th>
                                <th>UF Prom</th>
                                <th>UF Anual</th>     
                                <th>UF A/S-iva</th>            
                            </thead>              
                            <tbody>
                                @foreach($mesUF as $resp2)
                                    <tr>                                                  
                                        <td >{!! $resp2->clin !!}</td>                                  
                                        <td class="sum">{!! $resp2->count_nro!!}</td> 
                                        <td class="sum">{!! $resp2->UF!!}</td>
                                        <td class="sum">{!! round(($resp2->UF/$resp2->count_nro),3)!!}</td>
                                        <td class="sum">{!! round(($resp2->UF)*12,3)!!}</td>
                                        <td class="sum">{!! round((($resp2->UF)*12)/1.190,3)!!}</td>
                                    </tr>
                                @endforeach
                                <!-- <tr>
                                    <td class="Total">TOTAL</td>            
                                    <td class="Total A">{{$total}}</td>
                                    <td class="Total B">{{$dev}}</td>
                                    <td class="Total C">{{round(($dev/$total)*100)}}%</td>
                                    <td class="Total D">{{$bv}}</td>
                                    <td class="Total E">{{round(($bv/$total)*100)}}%</td>           
                                </tr>                         -->
                            </tbody>         
                        </table>  
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <!-- <i class="fa fa-circle text-info"></i> Buenas ventas
                            <i class="fa fa-circle text-danger"></i> Devoluciones
                            <i class="fa fa-circle text-warning"></i> Total                         -->
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card " >
                    <div class="card-header ">   
                    <p class="card-category">Gestion de Auditoria</p>                     
                    </div>
                    <div class="card-body ">
                    <table class="table table-hover" id="tbale">
                        <thead>           
                            <th>Gestion</th>                          
                            <th>tipificacion</th>
                            <th>Cant</th>     
                        </thead>              
                        <tbody>
                            @foreach($detalle as $resp2)
                                <tr>                                
                                    <td class="sum">{!! $resp2->gt!!}</td> 
                                    <td class="sum">{!! $resp2->tp!!}</td> 
                                    <td class="sum">{!! $resp2->count_nro!!}</td>                                     
                                </tr>
                            @endforeach
                            <!-- <tr>
                                <td class="Total">TOTAL</td>            
                                <td class="Total A">{{$total}}</td>
                                <td class="Total F">{{$totaling}}</td>
                                <td class="Total E">{{round(($totaling/$total)*100)}}%</td>
                                <td class="Total D">{{$bv}}</td>
                                <td class="Total E">{{round(($bv/$total)*100)}}%</td>          
                                <td class="Total F">{{$NCing}}</td>
                                <td class="Total B">{{$dev}}</td>
                                <td class="Total C">{{round(($dev/$total)*100)}}%</td>                            
                            </tr>                         -->
                        </tbody>         
                    </table> 
                    </div>
                    <div class="card-footer ">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card " >
                    <div class="card-header "> 
                    <p class="card-category">Gestion de Llamadas</p>                       
                    </div>
                    <div class="card-body ">
                    <table class="table table-hover" id="tbale">
                        <thead>           
                            <th>Gestion</th>                     
                            <th>Cant</th>     
                        </thead>              
                        <tbody>
                            @foreach($detallecall as $resp3)
                                <tr>                                
                                    <td class="sum">{!! $resp3->gt!!}</td>                                   
                                    <td class="sum">{!! $resp3->count_nro!!}</td>                                     
                                </tr>
                            @endforeach
                            <!-- <tr>
                                <td class="Total">TOTAL</td>            
                                <td class="Total A">{{$total}}</td>
                                <td class="Total F">{{$totaling}}</td>
                                <td class="Total E">{{round(($totaling/$total)*100)}}%</td>
                                <td class="Total D">{{$bv}}</td>
                                <td class="Total E">{{round(($bv/$total)*100)}}%</td>          
                                <td class="Total F">{{$NCing}}</td>
                                <td class="Total B">{{$dev}}</td>
                                <td class="Total C">{{round(($dev/$total)*100)}}%</td>                            
                            </tr>                         -->
                        </tbody>         
                    </table> 
                    </div>
                    <div class="card-footer ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth


<style>



    #bv1,#bv5 {
        font-size: 45px;
    }
    #bv2,#bv3,#bv4 {
        font-size: 25px;
    }
 #divgrf {
    /* background-color: red; */
    height: 428px;
 }


#tbale td {
    font-size: 10px;
}
</style>
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>

<!-- Grafico de barras -->
<script type="text/javascript">
  $(document).ready(function() {
    var sites = {!! json_encode($info) !!};   
    var sites2 = {!! json_encode($info2) !!};  
    var sites3 = {!! json_encode($info3) !!};  
    var data = {
            labels: ['DV', 'IND', 'SM', 'RS', 'CON'],
            series: [
                [sites[0], sites[1], sites[2], sites[3],sites[4]],
                [sites2[0], sites2[1], sites2[2], sites2[3],sites2[4]],
                [sites3[0], sites3[1], sites3[2], sites3[3],sites3[4]],               
            ]
        
        };

        var options = {
            seriesBarDistance: 10,
            axisX: {
                showGrid: true
            },
            height: "245px",
            showLabel: true,
        };

        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];
       
        var chartActivity = Chartist.Bar('#chartActivity2', data, options, responsiveOptions);
    });

</script>