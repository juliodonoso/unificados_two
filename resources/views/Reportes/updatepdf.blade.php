<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizacion</title>
        <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" />
        <div class="logo" id="l01">                   
            <a href="" class="simple-text logo-normal">                      
                <img src="{!! asset('img/iso.png') !!}" alt="iso" width=100 height=100>
            </a>
        </div>
        <div class="logo">                   
            <a href="" class="simple-text logo-normal">                      
                <img src="{!! asset('img/unif.png') !!}" alt="Unifif" width=180 height=70>
            </a>
        </div>
        <div id="p02"> 
                <p class="text-muted" >  
                Fecha de Reporte: {{$officialDate}}         
                </p>               
            </div>
        <div class="container">
            <div >     
                <p class="text-muted" id="p01">            
                <strong>Departamento de Calidad: </strong>Reporte de Actualizacion de Gestion          
                </p>
            </div>
            <hr id="hr01" class="hr01c">        
        </div>
    </head>
    <body>   
        <div class="col-md-12">
            <div class="card card-stats">
                <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover" id="tb01">
                            <thead>  
                            <tr>                                                                                        
                                <th data-field="id" class="text-center">Clinica</th>
                                <th data-field="name" data-sortable="true">Periodo</th>
                                <th data-field="salary" data-sortable="true">Rut</th>
                                <th data-field="country" data-sortable="true">Asegurado</th>            
                                <th data-field="gt">Gestion</th>
                                <th data-field="gt">Tipificacion</th>
                                <th class="text-right">Obs</th>
                                </tr>                
                            </thead>
                            <tbody>        
                                @foreach($propuestas as $resp2)    
                                    @foreach($resp2 as  $resp)                      
                                        <tr>                                             
                                            <td>{!! $resp->clinica !!}</td>
                                            <td>{!! $resp->mes !!} / {!! $resp->anio !!}</td>
                                            <td>{!! $resp->rutcar !!}</td>
                                            <td>{!! $resp->nom !!} {!! $resp->pat !!}  {!! $resp->mat !!}</td>
                                            <td>{!! $resp->gt !!}</td>
                                            <td>{!! $resp->tp !!}</td>
                                            <td>{!! $resp->observaciones !!}</td>                        
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <style>
        tr {
        border-bottom: 1pt solid black;
        }

        #p02 {
            float: right;   
            color: grey; 
        }    

        #l01 {
            float: right;  
        }

        table td {
        /* border: 1px solid #000; */
        text-align: left;
        padding: 5px; 
        font-size: 11px;
        color: #85929e ;
        
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        #p01 {
            color: grey;
        }

        .hr01c {
            border-top: 1px dashed;
            color:  #d6dbdf ;
        }
    </style> 
</html>