@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <form method="POST" id="formedit" name="formedit" action="">  
        {{ csrf_field() }}       
        <div class="row">
            <div class="col-md-12">
                <div class="card " >
                    <div class="card-header ">
                        <h5 class="card-title">Detalle Supervisorxxxxx</h5>                     
                    </div>
                    <div class="card-body ">
                    <table class="table table-hover">
                        <thead> 
                            <th>Supervisor</th>
                            <th>Rutsup</th>                         
                            <th>Clinica</th>                          
                            <th>Neg</th> 
                            <th>devol</th> 
                            <th>%DV</th> 
                            <th>BV</th>
                            <th>%BV</th>  
                            <th>UF</th>                                    
                        </thead>              
                        <tbody>
                            @foreach($Propsup as $resp2)
                                <tr>                                                  
                                    <td class="sum">{!! $resp2->nombresup !!}</td>
                                    <td class="sum">{!! $resp2->superv !!}</td>                                   
                                    <td class="sum" >{!! $resp2->clinica!!}</td>                                  
                                    <td class="sum">{!! $resp2->count_nro!!}</td> 
                                    <td class="sum">{!! $resp2->devol!!}</td>
                                    <td class="sum">{!! round(($resp2->devol/$resp2->count_nro)*100)!!}%</td>    
                                    <td class="sum">{!! $resp2->bv!!}</td> 
                                    <td class="sum">{!! round(($resp2->bv/$resp2->count_nro)*100)!!}%</td> 
                                    <td class="sum">{!! $resp2->UF!!}</td>                                            
                                </tr>
                            @endforeach                                      
                        </tbody>         
                    </table>  
                </div>
                <div class="card-footer ">
                    <div class="legend">                      
                    </div> 
                </div>
            </div>
        </div>
        @if($lejecutivos == 1) 
        <div class="col-md-12">
            <div class="card " >
                <div class="card-header ">
                    <h5 class="card-title">Detalle Ejecutivos x Supervisor</h5>                      
                </div>
                <div class="card-body ">
                <table class="table table-hover">
                    <thead> 
                        <th>Ejecutivo</th>
                        <th>Rut</th>                                          
                        <th>Clinica</th>                          
                        <th>Neg</th> 
                        <th>devol</th> 
                        <th>%DV</th> 
                        <th>BV</th>
                        <th>%BV</th>  
                        <th>UF</th>                                    
                    </thead>              
                    <tbody>
                        @foreach($Propeje as $resp)
                            <tr>                                                  
                                <td class="sum">{!! $resp->nombreeje !!}</td>
                                <td class="sum">{!! $resp->rutsup !!}</td>                                             
                                <td class="sum" >{!! $resp->clinica!!}</td>                                  
                                <td class="sum">{!! $resp->count_nro!!}</td> 
                                <td class="sum">{!! $resp->devol!!}</td>
                                <td class="sum">{!! round(($resp->devol/$resp->count_nro)*100)!!}%</td>    
                                <td class="sum">{!! $resp->bv!!}</td> 
                                <td class="sum">{!! round(($resp->bv/$resp->count_nro)*100)!!}%</td> 
                                <td class="sum">{!! $resp->UF!!}</td>                                            
                            </tr>
                        @endforeach                                      
                    </tbody>         
                </table>  
            </div>
            <div class="card-footer ">
                <div class="legend">                       
                </div> 
            </div>
        </div>
        @endif   
    </form>  
</div>
@endsection
@endauth

<style>

.sum {
    font-size: 11px;
}
</style>
