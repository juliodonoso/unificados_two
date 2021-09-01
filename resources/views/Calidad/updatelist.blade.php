@extends('layouts.menu')
@section('content')

<?php
$sep = implode(",", $lrarray);
?>
<div class="col-md-12">
<div class="card card-stats">
    <div class="card card-plain table-plain-bg">
        <div class="card-header ">
            <p class="card-category">Registros Actualizados: {{$lregup}} de: {{$loArray}}</p>    
                   
        </div>     
        <div class="card-body table-full-width table-responsive">
            <table class="table table-hover" id="tb01">
                <thead>     
                <tr>                                        
                    <th data-field="id" class="text-center">Clinica</th>
                    <th data-field="name" data-sortable="true">Periodo</th>
                    <th data-field="salary" data-sortable="true">Rut</th>
                    <th data-field="country" data-sortable="true">Asegurado</th>            
                    <th data-field="gt">Gestion</th>
                    <th data-field="gt">TpAud</th>
                    <th data-field="gt">GtCall</th>
                    <th data-field="gt">TpCall</th>
                    <th data-field="gt">SubTipif</th>
                    <th class="text-right">Obs</th>
                    </tr>
                </thead>
                <tbody>
                @csrf 
                    @foreach($lsarray as $resp2)    
                        @foreach($resp2 as  $resp)                      
                            <tr>                                             
                                <td>{!! $resp->clinica !!}</td>
                                <td>{!! $resp->mes !!} / {!! $resp->anio !!}</td>
                                <td>{!! $resp->rutcar !!}</td>
                                <td>{!! $resp->nom !!} {!! $resp->pat !!}  {!! $resp->mat !!}</td>
                                <td>{!! $resp->gt !!}</td>
                                <td>{!! $resp->tp !!}</td>
                                <td>{!! $resp->gtcall !!}</td>
                                <td>{!! $resp->tpcall !!}</td>
                                <td>{!! $resp->subtp !!}</td>
                                <td>{!! $resp->observaciones !!}</td>                        
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer "> 
    <hr>
        <div class="input__row">
        <a href="{{ route('pdfup',array('sep' =>$sep)) }}" class="btn btn-info" target="_blank" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Pdf</a>         
        </div>    
      </div>  
        </div>
    </div>
</div>
</div>

<style>

table td {
  /* border: 1px solid #000; */
  /* text-align: left; */
  /* padding: 5px; */
  /* Alto de las celdas */
  /* height: 0px; */
  font-size: 10px;
}



table th {
    text-align: center;
    font-size: 10px;
}


</style>
@endsection