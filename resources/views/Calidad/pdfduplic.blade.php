<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unificados /Reporte de Ducplicidad</title>
    <link href="{{ asset('assets/css/demo.css')}}" rel="stylesheet" />  
    <!-- <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />  -->
    <!-- <link href="{{ asset('asset/css/demo.css')}}" rel="stylesheet" /> -->
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
            <strong>Departamento de Calidad: </strong>Reporte de Duplicidad          
            </p>
        </div>
        <hr id="hr01" class="hr01c">        
    </div>
</head>
<body>
    <div class="container">
        <table class="table table-hover" id="tb01">
            <thead>
                <tr>                                             
                    <th data-field="id" class="text-center">Clinica</th>
                    <th data-field="name" data-sortable="true">Periodo</th>
                    <th data-field="salary" data-sortable="true">Rut</th>
                    <th data-field="country" data-sortable="true">Asegurado</th>
                    <th data-field="city">Rel</th>
                    <th data-field="city">telf</th>
                    <th data-field="city">Cuenta</th>
                    <th data-field="city">Pagador</th>
                    <th data-field="gt">Ejecutiva</th> 
                </tr>                           
            </thead>                      
            <tbody>                            
                @foreach($propuestas as $resp3)                            
                    <tr>                                             
                        <td>{!! $resp3->clinica !!}</td>
                        <td>{!! $resp3->mes !!} / {!! $resp3->anio !!}</td>
                        <td>{!! $resp3->rutcar !!}</td>
                        <td>{!! $resp3->nom !!} {!! $resp3->pat !!}  {!! $resp3->mat !!}</td>
                        <td>{!! $resp3->rel !!}</td>
                        <td>{!! $resp3->telf !!}</td>
                        <td>{!! $resp3->nrocta !!}</td>                       
                        <td>{!! $resp3->nombreter !!}</td>
                        <td>{!! $resp3->ejecutiva !!}</td>                           
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </div> 
</body>
<footer>


</footer>

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


