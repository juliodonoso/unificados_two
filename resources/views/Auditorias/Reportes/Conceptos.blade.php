@if($total > 0)
            <div class="col-md-12">
                <div class="card "> 
                    <div class="card-header"> 
                        <div id="botn">                
                            <a href="{{ route('excelejecut',array('a' => $a,'b' => $b, 'c' => $c, 'd' => $d, 'e' => $e)) }}" class="btn btn-success" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Excel</a>                
                            <div id="bqrut">        
                                <input type="text" class="form-control" name="inputUno" id="search" placeholder="Buscar">              
                            </div> 
                        </div> 
                    </div>                                
                    <div class="card-body ">            
                        <form method="POST" id="formedit" name="formedit" action="">  
                            {{ csrf_field() }} 
                            <table class="table table-hover" id="tb01">
                                <thead> 
                                    <th data-field="name" data-sortable="true">Sponsor</th> 
                                    <th data-field="name" data-sortable="true">Canal</th>                               
                                    <th data-field="name" data-sortable="true">Campaña</th>
                                    <th data-field="name" data-sortable="true">Operador</th>
                                    <th data-field="name" data-sortable="true">Alertas</th> 
                                    <th data-field="name" data-sortable="true">Cumple</th>  
                                    <th data-field="name" data-sortable="true">% Parcial</th> 
                                    <th data-field="name" data-sortable="true">% Final</th>                             
                                    <th data-field="name" data-sortable="true">total</th>
                                    <th data-field="name" data-sortable="true">% Cumpli</th>
                                    <th data-field="name" data-sortable="true">Audit</th>                             
                                </thead>
                                <tbody>
                                    @foreach($ejecutivos as $resp)                                                                                                                
                                        <tr>
                                            <td>{!! $resp->nombres !!}</td> 
                                            <td>{!! $resp->canal !!}</td> 
                                            <td>{!! $resp->campania !!}</td> 
                                            <td>{!! $resp->nombre !!}</td> 
                                            <td class="tdsp">{!! $resp->alerta !!}</td> 
                                            <td class="tdsp">{!! $resp->cumple !!}</td> 
                                            <td class="tdsp2">{!! round($resp->tparcial) !!} %</td> 
                                            <td class="tdsp4">{!! round($resp->tfinal) !!} %</td>                                   
                                            <td class="tdsp3">{!! $resp->cant !!}</td>                 
                                            <td class="tdsp">{!! $resp->npcumple / $resp->cant !!} %</td> 
                                            <td>{!! $resp->auditor !!}</td>                                                                                                  
                                        </tr>                                        
                                    @endforeach
                                </tbody>                     
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        @else 
            <div class="card">
                <div class="col-md-12"><br>
                    <div class="alert alert-danger alert-with-icon" data-notify="container" id="cumple">                    
                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                        <span><b> Atencion: </b> No existen Registros que mostrar.</span>
                    </div> 
                </div>  
            </div> 
        @endif
    @endsection
@endauth
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">