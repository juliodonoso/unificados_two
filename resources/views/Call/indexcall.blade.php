@extends('layouts.menu')
@auth
@section('content')

<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">       
            <div class="col-md-12"> 
            <form action="{{ route('callsf') }}" method="POST"> 
                <input id="bqfiltr" class="input_valores" type="hidden" value="">
            @csrf 
                <div class="col-sm-12" id="divfill">
                    <div class="col-sm-4">                                            
                        <select class="form-control" id="sel09" name="callgt">
                            <option value="" selected disabled>Seleccione Gestion</option>                            
                            <option value=5>BUENA VENTA</option>
                            <option value=6>VOLVER A LLAMAR</option> 
                            <option value=7>NO CONTACTADO</option> 
                            <option value=8>RECHAZA CONTRATACION</option> 
                            <option value=9>RENUNCIA</option> 
                            <option value=4>SIN GESTION</option>                                                                                                       
                        </select>                                              
                    </div>
                    <div class="col-sm-4">                                            
                        <select class="form-control" id="selfiltrar" name="selfiltrar">
                            <option value="" selected disabled>Seleccione Gestion</option>                            
                            <option value=5>BUENA VENTA</option>
                            <option value=6>VOLVER A LLAMAR</option> 
                            <option value=7>NO CONTACTADO</option> 
                            <option value=8>RECHAZA CONTRATACION</option> 
                            <option value=9>RENUNCIA</option> 
                            <option value=4>SIN GESTION</option>                                                                                                       
                        </select>                                              
                    </div>

                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-warning btn-wd">Filtro</button>   
                                       
                        <a href="{{ route('call') }}" class="btn btn btn-primary" id="a02">Limpiar</a>                     
                    </div>
                    <div class="col-sm-4">                      
                    </div>                   
                </div>     
                <div class="card-body table-full-width table-responsive">
                <table class="table table-hover" id="sortable">
                    <thead>                    
                        <th>Rut</th>
                        <th class="sortable">Telf</th>
                        <th>Asegurado</th>
                        <th>edad</th>                         
                        <th>Ter</th>
                        <th class="sortable">email</th> 
                        <th>Gestion</th> 
                        <th>V</th>
                        <th>C</th> 
                    </thead>        
                    <tbody>
                        @foreach($querycall as $resp)
                                @php                          
                                    $edad = Carbon\Carbon::parse($resp->fnac)->diff(Carbon\Carbon::now())->format("%y");   
                     
                                @endphp

                            <tr>                                           
                                <td>{!! $resp->rutcar!!}</td>
                                <td class="ejemplo" id="telf" >{!! $resp->telf !!}</td>    
                                <td>{!! $resp->pat !!} {!! $resp->mat !!} {!! $resp->nom !!} </td>     
                                <td>{!! $edad !!}</td>          
                                <td>{!! $resp->rutter !!}</td>                             
                                <td>{!! $resp->email !!}</td>  
                                @if($resp->llamada == "") 
                                    <td>SIN GESTION</td>
                                @else 
                                    <td>{!! $resp->llamada !!}
                                @endif                        
                                    <td><a id ="bview" href="{{ route('callgt',$ldid = $resp->id)}}"><i class="fa fa-search"></i></a></td>   
                                    <td><a id ="bcopy" onclick="f_copiar()"><i class="fa fa-phone"></i></a></td>                                                                                                                                           
                            </tr>
                        @endforeach
                    </tbody>       
                </table>
                </div>   
            </div>     
        </div>
    </div>
</div>
@endsection
@endauth

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<script>
    $(document).ready(function() {  
        $(function() {
            var tableRows4 = $("#sortable tbody tr"); 
            var elementos4 =  [];
            var repetidos4 = [];
            var temporal4 = [];
            tableRows4.each(function() {  
                var rowValue4 = $(this).find("td:eq(0)").text();
                elementos4.push(rowValue4);            
            });
        
            elementos4.forEach((value,index)=>{
            temporal4 = Object.assign([],elementos4); 
            temporal4.splice(index,1);       
            if(temporal4.indexOf(value)!=-1 && repetidos4.indexOf(value)==-1)      repetidos4.push(value);
            });
        
            tableRows4.each(function() {
                
                var rowValue4 = $(this).find("td:eq(0)").text();
                var coin4 = repetidos4.includes(rowValue4);         
                if(coin4 == true) {              
                    $(this).find("td:eq(0)").css("backgroundColor"," #ffc1ce ");
                    // $(this).find("td:eq(0)").css("color", " red ");                  
                } 
            });
        });
    });
</script>



<!-- Color a los telefonos Duplicados  -->
<script>
    $(document).ready(function() {  
        $(function() {
            var tableRows = $("#sortable tbody tr"); 
            var elementos =  [];
            var repetidos = [];
            var temporal = [];
            tableRows.each(function() {  
                var rowValue = $(this).find("td:eq(1)").text();
                elementos.push(rowValue);            
            });
        
            elementos.forEach((value,index)=>{
            temporal = Object.assign([],elementos); 
            temporal.splice(index,1);       
            if(temporal.indexOf(value)!=-1 && repetidos.indexOf(value)==-1)      repetidos.push(value);
            });
        
            tableRows.each(function() {
                
                var rowValue = $(this).find("td:eq(1)").text();
                var coin = repetidos.includes(rowValue);         
                if(coin == true) {              
                    // $(this).find("td:eq(2)").css("backgroundColor", "#bdfa5f");
                    $(this).find("td:eq(1)").css("color", " red ");                  
                } 
            });
        });
    });
</script>

<!-- Color a los correos duplicados  -->
<script>
    $(document).ready(function() {  
        $(function() {
            var tableRows2 = $("#sortable tbody tr"); 
            var elementos2 =  [];
            var repetidos2 = [];
            var temporal2 = [];
            tableRows2.each(function() {  
                var rowValue2 = $(this).find("td:eq(4)").text();
                elementos2.push(rowValue2);            
            });
        
            elementos2.forEach((value,index)=>{
            temporal2 = Object.assign([],elementos2); 
            temporal2.splice(index,1);       
            if(temporal2.indexOf(value)!=-1 && repetidos2.indexOf(value)==-1) 
                 repetidos2.push(value);
            });
        
            tableRows2.each(function() {
                
                var rowValue2 = $(this).find("td:eq(4)").text();
                var coin2 = repetidos2.includes(rowValue2);         
                if(coin2 == true) {              
                    // $(this).find("td:eq(2)").css("backgroundColor", "#bdfa5f");
                    $(this).find("td:eq(4)").css("color", " blue ");                  
                } 
            });
        });
    });
</script>

<!-- Color a los pagadores  -->
<script>
    $(document).ready(function() {  
        $(function() {
            var tableRows3 = $("#sortable tbody tr"); 
            var elementos3 =  [];
            var repetidos3 = [];
            var temporal3 = [];
            tableRows3.each(function() {  
                var rowValue3 = $(this).find("td:eq(4)").text();
                elementos3.push(rowValue3);            
            });
        
            elementos3.forEach((value,index)=>{
            temporal3 = Object.assign([],elementos3); 
            temporal3.splice(index,1);       
            if(temporal3.indexOf(value)!=-1 && repetidos3.indexOf(value)==-1)      repetidos3.push(value);
            });
        
            tableRows3.each(function() {
                
                var rowValue3 = $(this).find("td:eq(4)").text();
                var coin3 = repetidos3.includes(rowValue3);         
                if(coin3 == true) {              
                    // $(this).find("td:eq(2)").css("backgroundColor", "#bdfa5f");
                    $(this).find("td:eq(4)").css("color", " orange ");                  
                } 
            });
        });
    });
</script>

<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/demo.js')}}"></script>

<!-- Ordenar y paginas  -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#sortable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [1000, -1],
                [1000, "Todos"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Buscar registros",
            }  
        });       
    });
</script>

<!-- // copiar numero de telf -->
<script>
    function f_copiar() {       
        $('table tr td:last-child').click(function(){
            var valor = $(this).siblings('td:nth-child(2)').text();  
            var aux = document.createElement("input");   
            aux.setAttribute("value", valor);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);                     
            swal({
                title: "Telefono Copiado!",
                text: "Numero Copiado: " + valor,
                type: "success"           
            });
        })
    }
</script>



<!-- Filtrar por tipo de Gestion  -->

<script type="text/javascript">

$(document).ready(function() { 
    $('#selfiltrar').on('change', function(){  
        var value = $(this).val(); 
        $('.input_valores').val(value) 
        // alert(value);
        $.ajax({
            url: "{{route('filtrar')}}",
            method: 'POST',
            data: $("#form-{{$resp->rutcar}}").serialize()
        });
    });  
    
});


</script>


<!-- Estilos de la pagina  -->

<style>
    #divfill {
        display: flex;
    }

    table td {
    font-size:10px;
    }
</style>

