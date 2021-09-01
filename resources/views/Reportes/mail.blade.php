@foreach($propuestas as $resp)
<div class="modal fade bd-example-modal-lg" id="PlaceModal-{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> 
             <h5>Servicios e Inversiones Unificados ltda</h5>             
             <h5  id="tit01" class="modal-title" id="myModalLabel"> Detalle de Propuesta #  {{$resp->propuesta}} </h5>                         
            </div>
            <hr>
            <div class="modal-body">            
                <div class="row" id="det01">                           
                    <div class="col-sm-8" >Rut-Tit : {{$resp->ruttit}}  /  Rut-Car : {{$resp->rutcar}}</div>
                </div>
                <div class="row" id="det01">
                    <div class="col-sm-8" >Nombre : {{$resp->pat}} {{$resp->mat}} {{$resp->nom}}</div>                           
                </div> 
                <div class="row" id="det01">  
                    <div class="col-sm-12" >Fecha Nac :{{date('d-m-Y', strtotime($resp->fnac))}}</div> 
                </div>                          
                <div class="row" id="det01">  
                    <div class="col-sm-12" >Clinica : {{$resp->clinica}}</div> 
                </div>              
                <div class="row" id="det01">                             
                    <div class="col-sm-6" >Telefono : {{$resp->telf}}  /  e-mail : {{$resp->email}}</div>
                </div>                 
                <div class="row" id="det01">
                    <div class="col-sm-12" >Pre-existencias: {{$resp->obs}} </div>
                </div>            
                <hr>
                <div class="row" id="det01">
                    @if(empty($resp->nombreter)) 
                        <div class="col-sm-12" >Pagador : 'TITULAR' </div>
                    @else
                        <div class="col-sm-12" >Pagador : {{$resp->nombreter}} </div>
                    @endif
                </div>               
                <hr>
                <div class="row" id="det01">
                    <div class="col-sm-12" > Fecha Vta: {{date('d-m-Y', strtotime($resp->fechavta))}} /  Ejecutiva de Ventas : {{$resp->ejecutiva}} / Supervisor: {{$resp->supervisor}} </div>
                </div> 
                <hr>  
                <div class="row" id="det01">
                    <div class="col-sm-12" > Observaciones: {{$resp->observaciones}}</div>
                </div>                
            </div>           
        </div>
    </div>
</div> 
@endforeach 

<style>

@font-face {
        font-family: 'Helvetica';
        /* font-family: 'Questrial'; */
        font-weight: normal;
        font-style: normal;
        font-variant: normal;  
        /* src: url('{{asset('/fonts/Questrial-Regular.tff')}}'); */
        src: url("https://fonts.googleapis.com/css?family=Montserrat:400,700,200");
      }

</style>