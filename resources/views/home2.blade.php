@extends('layouts.menu')
@auth
@section('content')

<!-- <div class="col-md-12"> -->
    <!-- <div class="card ">                                 -->
        <!-- <div class="card-body ">             -->
            <form method="POST" id="formedit" name="formedit" action="">  
                {{ csrf_field() }} 
                <div class="col-md-12">    
                    <p class="card-category">Gestion de Auditoria</p>  
                </div>                      
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
                                                <p class="card-category" id="bv1">1042</p>
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
                                                <p class="card-category" id="bv1">17</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> Devoluciones
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
                                                <!-- <i class="fa fa-file-o text-warning" aria-hidden="true"></i> -->
                                                <i class="nc-icon nc-ambulance text-danger"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category" id="bv1">5</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> Propuestas Pendientes
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
                                                <i class="nc-icon nc-money-coins text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category" id="bv1">1020</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> Propuestas a Procesar
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <!-- Gestion de Llamadas -->
                <div class="col-md-12">    
                    <p class="card-category">Gestion de Llamadas</p>  
                </div>             
                <div class="container-fluid">  
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">                                   
                                                <!-- <i class="fa fa-file-o text-warning" aria-hidden="true"></i> -->
                                                <i class="fa fa-phone text-warning" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                <p class="card-category" id="bv1">1020</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i>Total Reg para LLamadas
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
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
                                                 <p class="card-category" id="bv2">125</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>No Contacto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">                                              
                                                <i class="nc-icon nc-fav-remove text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                 <p class="card-category" id="bv3">10</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                    Rechaz/Renuncia
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center icon-warning">                                   
                                                <i class="nc-icon nc-watch-time text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                 <p class="card-category" id="bv4">10</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                         Sin Gestion
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
                                                <i class="nc-icon nc-satisfied text-primary"></i>                                           
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="numbers">
                                                 <p class="card-category" id="bv5">875</p>
                                                <h4 class="card-title"></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>Total Buenas Ventas
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Graficos -->
                <div class="container-fluid"> 
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
                                        </p>                    
                                    </div>                        
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
                    </div>
                </div>
            </form>
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->
@endsection
@endauth

<style>

#divcum {
        /* background-color: red; */
        height: 408px;
        
    }

    #bv1,#bv5 {
        font-size: 45px;
    }
    #bv2,#bv3,#bv4 {
        font-size: 25px;
    }
</style>
