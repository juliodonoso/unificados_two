@extends('layouts.menu')
@auth
@section('content')
    @php
        $sep = implode(",", $larray);
    @endphp
    <div class="col-md-12">
        <div class="card card-stats">
            <div class="card card-plain table-plain-bg">
                <div class="card-header ">
                    <h5 class="card-title">Detalle de Duplicidad desde Archivo:</h5>
                    <p class="card-category">Se realizo la busqueda por :{{ strtoupper($lopcion) }} </p>
                </div>
                @if($lreg >0)
                    <div class="card-body">         
                        <a href="{{ route('exlduplic',array('sep' =>$sep,'lbuscar' =>$lbuscar,'lopcion' =>$lopcion)) }}" class="btn btn-success" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Excel</a>             
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover" id="tb01">
                            <thead> 
                                <tr>                            
                                    <th data-field="salary" data-sortable="true">Rut</th>
                                    <th data-field="country" data-sortable="true">Asegurado</th>                                                 
                                    <th>Det</th>
                                </tr> 
                            </thead>
                            <tbody>                        
                                @foreach($propuestas as $resp)    
                                    @foreach($resp as  $resp3) 
                                    <tr data-id ="{{ $resp3->rutcar }}">                          
                                        <td>{!! $resp3->rutcar !!}</td>
                                        <td>{!! $resp3->nom !!} {!! $resp3->pat !!}  {!! $resp3->mat !!}</td>
                                                                                                                                                                                                
                                        <td><a data-id="{{ $resp3->rutcar }}" class="btn-ver" id ="bview" href="#PlaceModal-{{$resp3->rutcar}}" data-target="#PlaceModal-{{$resp3->rutcar}}" data-toggle="modal"><i class="fa fa-search"></i></a></td>                                
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                @else 
                    <div class="col-md-12"> 
                        <br>                         
                        <div class="alert alert-warning alert-with-icon" data-notify="container">                       
                            <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                            <span data-notify="message">NO se encontraron Coincidencias.</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal  -->
    @foreach($propuestas as $resp3)
        @foreach($resp3 as  $resp)
        <div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$resp->rutcar}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
           
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Detalle Asegurado: {{$resp->nom}} {{$resp->pat}} {{$resp->mat}}</h5>
                    </div> 
                    @php 
                        $first = "";
                        $first = $resp->rutcar;                            
                        $ltrue = array_key_exists($first,$larr_actual);            
                        if($ltrue == true)  {
                            $datosc = $larr_actual[$first];               
                        } else {
                            $datosc = 'Pagador';
                        }
                    @endphp
                    <div class="modal-body">
                    <div class="row" id="det01">                           
                        <div class="col-sm-8" >Datos Propuesta Consultada : <strong>{{$datosc}}</strong></div>
                    </div> 
                    <div class="row" id="det01">                           
                        <div class="col-sm-8" >Rut-Tit : {{$resp->ruttit}}  /  Rut-Car : {{$resp->rutcar}}</div>
                    </div>
                    <br>
                        <table class="table table-hover" id="tablecoin" >
                            <thead>             
                                <th>Clinica</th>
                                <th>Plan</th>
                                <th>Periodo</th>
                                <th>Rut</th>
                                <th>Asegurado</th>
                                <th>Ejecutiv@</th> 
                                <th>Supervisor@</th> 
                                <th>rel</th> 
                                <th>FechaVta</th>
                                <th>Pagador</th>             
                            </thead>
                            <tbody id="t01-{{$resp->rutcar}}">                    
                            </tbody> 
                        </table>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        @endforeach    
    @endforeach
    <form action="POST" action="{{route('filtrar')}}" id='form-{{$resp->rutcar}}'>
                @csrf
                <input type="hidden" name="rutbq" id="rutbq" value ="" class="input_valores_provisionales">
            </form>
@endsection
@endauth

<style>

    table td {
    /* border: 1px solid #000; */
    text-align: left;
    padding: 5px;
    /* Alto de las celdas */
    height: 40px;
    font-size: 10px;
    }



    td {
    font-size: 11px;
    
    }

    .modal {
        font-size: 12px;
    }

    #tit01 {
        color: red;
    }

    #a01 {
        font-size: 12px;
        color: grey; 
    }
</style>

<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<!-- Script para Filtrar dentro del modal  -->             
<script>
    $(document).ready(function() {
        $('.btn-ver').click(function(){
            var row = $(this).parents('tr');
            var rut = row.data('id');                                         
            $('.input_valores_provisionales').val(rut) 
            $("#tablecoin tbody tr").remove();                                     
            $.ajax({
                url: "{{route('filtrar')}}",
                method: 'POST',
                data: $("#form-{{$resp->rutcar}}").serialize()
            }).done(function(res){
                var arreglo = JSON.parse(res);                                                                   
                for (var  x = 0; x < arreglo.length-1; x++){
                    var todo = '<tr><td>'+arreglo[x].clinica+'</td>';
                    todo+='<td>'+arreglo[x].numgru+'</td>';
                    todo+='<td>'+arreglo[x].mes+'-'+arreglo[x].anio+'</td>';
                    if(arreglo[x].rutcar == rut) {
                        todo+='<td><font color="#fa2015">'+arreglo[x].rutcar+'</font></td>';
                    }else {
                        todo+='<td>'+arreglo[x].rutcar+'</td>';
                    }
                    todo+='<td>'+arreglo[x].nom+' '+arreglo[x].pat+'</td>';
                    todo+='<td>'+arreglo[x].ejecutiva+'</td>';
                    todo+='<td>'+arreglo[x].supervisor+'</td>';
                    todo+='<td>'+arreglo[x].rel+'</td>';
                    todo+='<td>'+arreglo[x].fechavta+'</td>';
                    if(arreglo[x].rutter == rut) {
                        todo+='<td><font color="#fa2015">'+arreglo[x].rutter+'</font></td>';
                    } else {
                        todo+='<td>'+arreglo[x].rutter+'</td>';
                    }
                    todo+='<td></td></tr>';                            
                    $('#t01-'+rut).append(todo);                                    
                }                                
                
            });                       
        });
    });
</script>