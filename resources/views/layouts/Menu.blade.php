@auth
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png')}}">    
    <link rel="icon" type="image/png" href="{!! asset('img/LOGOVC.png') !!}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Unificados</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=2.0.1')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" />   
</head>

<body class="sidebar-mini">
    <div class="wrapper">
        <div class="sidebar" data-color="orange" data-image="{{ asset('assets/img/sidebar-5.jpg')}}">
            <div class="sidebar-wrapper">
                <div class="logo">                   
                    <a href="{{ url('/home') }}" class="simple-text logo-normal">                      
                        <img src="{{ asset('img/Logo_Unificados.webp') }}" alt="Unifif" width=180 height=70>                       
                    </a>
                </div>
                <ul class="nav"> 
                    <!-- Inicio              -->
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ url('/home') }}">
                                <i class="nc-icon nc-layers-3"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                    <!-- Calidad  -->
                    @if(Auth::user()->idtype  == 1 or Auth::user()->idtype  == 2 or Auth::user()->idtype  == 3)                  
                        <li class="nav-item">
                            <p class="logo"></p>                 
                            <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                                <i class="nc-icon nc-paper-2"></i>
                                <p>
                                    Calidad
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse " id="componentsExamples">
                                <ul class="nav">                                
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('buscar') }}">                                       
                                            <span class="sidebar-normal"><i class="nc-icon nc-zoom-split"></i>Busqueda</span>
                                        </a>
                                    </li>                               
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('duplic') }}">                                      
                                            <span class="sidebar-normal"><i class="nc-icon nc-tag-content"></i>Duplicidad</span>
                                        </a>
                                    </li>
                                    @if(Auth::user()->idtype  == 1 or Auth::user()->idtype  == 2) 
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('upgestion') }}">                                      
                                                <span class="sidebar-normal"><i class="nc-icon nc-refresh-02"></i>Actualizar Gestion</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user()->idtype  == 1 or Auth::user()->idtype  == 2 or Auth::user()->idtype  == 3) 
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('importreg') }}">                                      
                                                <span class="sidebar-normal"><i class="nc-icon nc-cloud-upload-94"></i>Importar</span>
                                            </a>
                                        </li>                                   
                                    @endif
                                    @if(Auth::user()->idtype  == 1 or Auth::user()->idtype  == 2)                                      
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('periodo') }}">                                        
                                                <span class="sidebar-normal"><i class="nc-icon nc-key-25"></i>Cierre Periodo</span>
                                            </a>
                                        </li>                                   
                                    @endif                              
                                </ul>
                            </div>                      
                        </li>                      
                    @endif
                    <!-- Reportes de Calidad  -->
                    @if(Auth::user()->idtype  == 1 or Auth::user()->idtype  == 4 or Auth::user()->idtype  == 5 or Auth::user()->idtype  == 2)                      
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                                <i class="nc-icon nc-single-copy-04"></i>
                                <p>
                                    Reportes
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse " id="formsExamples">
                                <ul class="nav">                                   
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('repgestion') }}">                                       
                                            <span class="sidebar-normal"><i class="nc-icon nc-chart-pie-36"></i>Gestion</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('superv') }}">                                       
                                            <span class="sidebar-normal"><i class="nc-icon nc-paper-2"></i>Supervisor</span>
                                        </a>
                                    </li>  
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('devsup') }}">                                       
                                            <span class="sidebar-normal"><i class="nc-icon nc-paper-2"></i>Dev x Supervisor</span>
                                        </a>
                                    </li>   
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('repconcep') }}">                                       
                                            <span class="sidebar-normal"><i class="nc-icon nc-bullet-list-67"></i>Conceptos</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('diario') }}">                                       
                                            <span class="sidebar-normal"><i class="nc-icon nc-time-alarm"></i>Diario</span>
                                        </a>
                                    </li> 
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('txt') }}">                                       
                                            <span class="sidebar-normal"><i class="fa fa-file-text" aria-hidden="true"></i>TxT-PAT</span>
                                        </a>
                                    </li>                                                                   
                                </ul>
                            </div>                         
                        </li>  
                    @endif 
                    <!-- Auditoria  -->                       
                    @if(Auth::user()->idtype  == 6 or Auth::user()->idtype  == 7 or Auth::user()->idtype  == 1 or Auth::user()->idtype  == 1 ) 
                        <li class="nav-item">                        
                            <p class="logo"></p>
                            <a class="nav-link" data-toggle="collapse" href="#tablesaudir">
                                <i class="nc-icon nc-headphones-2"></i>
                                <p>
                                    Auditoria
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse " id="tablesaudir">                                
                                
                                <ul class="nav">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('ingresoaudit') }}">                                       
                                            <span class="sidebar-normal"> <i class="nc-icon nc-zoom-split"></i>Auditar</span>
                                        </a>
                                    </li>                             
                                </ul>
                            </div>
                        </li>
                    @endif   
                    <!-- Reportes de Auditoria                         -->
                    @if(Auth::user()->idtype  == 7 or Auth::user()->idtype  == 1 or Auth::user()->idtype  == 8)
                        <li class="nav-item">    
                            <a class="nav-link" data-toggle="collapse" href="#Reportesaudit">
                                <i class="nc-icon nc-single-copy-04"></i>
                                <p>
                                    Reportes
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse " id="Reportesaudit">
                                @if(Auth::user()->idtype  == 7 or Auth::user()->idtype  == 1)     
                                    <ul class="nav">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('indexsponsor') }}">                                       
                                                <span class="sidebar-normal"> <i class="nc-icon nc-money-coins"></i>Sponsor</span>
                                            </a>
                                        </li>                             
                                    </ul>
                                    <ul class="nav">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('indexejecut') }}">                                       
                                                <span class="sidebar-normal"> <i class="nc-icon nc-single-02"></i>Ejecutivos</span>
                                            </a>
                                        </li>                             
                                    </ul>
                                @endif
                                @if(Auth::user()->idtype  == 7 or Auth::user()->idtype  == 1 or Auth::user()->idtype  == 8)  
                                    <ul class="nav">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('conceptos') }}">                                       
                                                <span class="sidebar-normal"> <i class="nc-icon nc-settings-gear-64"></i>Conceptos</span>
                                            </a>
                                        </li>                             
                                    </ul>
                                @endif
                            </div>
                        </li>
                    @endif                     
                    <!-- LLamadas  -->                       
                    @if(Auth::user()->idtype  == 5 or Auth::user()->idtype  == 1) 
                        <!-- <li class="nav-item">
                        <p class="logo"></p>
                                <a class="nav-link" data-toggle="collapse" href="#Call">
                                    <i class="fa fa-phone"></i>
                                    <p>
                                        LLamadas
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <div class="collapse " id="Call">
                                    <ul class="nav">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('call') }}">                                       
                                                <span class="sidebar-normal"> <i class="nc-icon nc-money-coins"></i> Gestion</span>
                                            </a>
                                        </li> 
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('callsacs') }}">                                       
                                                <span class="sidebar-normal"> <i class="nc-icon nc-money-coins"></i>SACS</span>
                                            </a>
                                        </li>                                 
                                    </ul>
                                </div>                          
                            </li>   -->
                    @endif  
                    <!-- Campañas  -->
                    @if(Auth::user()->idtype  == 5 or Auth::user()->idtype  == 1) 
                        <!-- <li class="nav-item">
                            <p class="logo"></p>
                                <a class="nav-link" data-toggle="collapse" href="#Camp">
                                <i class="nc-icon nc-grid-45"></i> 
                                    <p>
                                        Campañas
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <div class="collapse " id="Camp">
                                    <ul class="nav">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('call') }}">                                       
                                                <span class="sidebar-normal"> <i class="nc-icon nc-money-coins"></i>Expansion</span>
                                            </a>
                                        </li> 
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('callsacs') }}">                                       
                                                <span class="sidebar-normal"><i class="nc-icon nc-money-coins"></i>Auto</span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('callsacs') }}">                                       
                                                <span class="sidebar-normal"><i class="nc-icon nc-money-coins"></i>Siniestros</span>
                                            </a>
                                        </li>                                 
                                    </ul>
                                </div>                          
                            </li>   -->
                    @endif  
                    <!-- Mantenimiento  -->
                    @if(Auth::user()->idtype  == 1 or Auth::user()->idtype  == 7) 
                        <li class="nav-item">
                            <p class="logo"></p>
                            <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
                                <i class="nc-icon nc-settings-tool-66"></i>
                                <p>
                                    Mantenimiento
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse " id="tablesExamples">
                                <ul class="nav">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('editusers') }}">                                       
                                            <span class="sidebar-normal"> <i class="nc-icon nc-single-02"></i> Usuarios</span>
                                        </a>
                                    </li>                             
                                </ul>                               
                                <ul class="nav">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('teleop') }}">                                       
                                            <span class="sidebar-normal"> <i class="nc-icon nc-badge"></i>Teleoperadores</span>
                                        </a>
                                    </li>                             
                                </ul>
                                <ul class="nav">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('companias') }}">                                       
                                            <span class="sidebar-normal"> <i class="nc-icon nc-bag"></i>Campañas</span>
                                        </a>
                                    </li>                             
                                </ul>
                                @if(Auth::user()->idtype  == 1) 
                                    <ul class="nav">
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ route('pdfindex') }}">                                        
                                                <span class="sidebar-normal"><i class="nc-icon nc-key-25"></i>Importar pdf</span>
                                            </a>
                                        </li> 
                                    </ul>  
                                @endif  
                            </div>                                
                        </li>
                    @endif             
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon d-none d-lg-block">
                                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                            </button>
                        </div>
                        @isset($titulo)
                            <a class="navbar-brand" href="#pablo"> {{$titulo}} </a>
                        @else
                            <a class="navbar-brand" href="#pablo"></a>
                        @endif
                    </div>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <ul class="navbar-nav">                            
                            <li class="dropdown nav-item"> <i class="fa fa-user-circle-o text-warning" aria-hidden="true">:</i>                              
                                <a id="navbarDropdown" class="dropdown-toggle nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}  
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                        <i class="nc-icon nc-button-power"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>                            
                        </ul>
                    </div>
                </div>
            </nav>           
            <div class="content">
                @yield('content')            
            </div>
            <br>   
        </div> 
    </div>
</body>
     
<footer class="footer">            
    <div class="container" id="ctfoot">
        <nav>
            <p class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="https://www.unificadosgroup.com/">Unificados</a>
            </p>
        </nav>
    </div>
</footer>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('assets/js/plugins/bootstrap-switch.js')}}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="{{ asset('assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!--  jVector Map  -->
<script src="{{ asset('assets/js/plugins/jquery-jvectormap.js')}}" type="text/javascript"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
<!--  DatetimePicker   -->
<script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js')}}"></script>
<!--  Sweet Alert  -->
<script src="{{ asset('assets/js/plugins/sweetalert2.min.js')}}" type="text/javascript"></script>
<!--  Tags Input  -->
<script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js')}}" type="text/javascript"></script>
<!--  Sliders  -->
<script src="{{ asset('assets/js/plugins/nouislider.js')}}" type="text/javascript"></script>
<!--  Bootstrap Select  -->
<script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}" type="text/javascript"></script>
<!--  jQueryValidate  -->
<script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}" type="text/javascript"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
<!--  Bootstrap Table Plugin -->
<script src="{{ asset('assets/js/plugins/bootstrap-table.js')}}"></script>
<!--  DataTable Plugin -->
<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<!--  Full Calendar   -->
<script src="{{ asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=2.0.1')}}" type="text/javascript"></script>
<!-- Light Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('assets/js/demo.js')}}"></script>
<!-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
        // demo.showNotification();
        demo.initVectorMap();
    });
</script>
 

</html>
@endauth


<script>



    function f_salir() {  
        swal({
            title: "Estas Seguro de Salir?",
            text: "Logout del Sistema de gestion Unificados",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Salir!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
              document.f02.submit() 
            } 
        });
    }
</script>

<style>



.logo {
        text-align:center;
    }



.footer {
    bottom: 0;
    clear: both;
    padding:0px;
}

#ctfoot {
   height:10px;/*importante*/
 
 
}

#hraudit {
    color:#fefefe ;
}

</style>