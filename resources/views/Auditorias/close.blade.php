@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form id="formedit" name="formedit" action="" method="POST">  
                {{ csrf_field() }} 
                <div class="card-head ">               
                  <p class="card-category">Sponsors Registrados en el sistema</p>	              
                    <hr>
                </div>
                <div id="botn">                     
                    <a href="" class="btn btn-warning" ><i class="nc-icon nc-money-coins"></i> Nuevo</a>                              
                </div> 
               
              </div>
              <div class="card-body table-full-width table-responsive">
                <table class="table table-hover" id="tb01">
                  <thead>
                    <th>ID</th>                 
                    <th>Sponsor</th>
                    <th>Periodo activo</th> 
                    <th>Status</th>                   
                    <th>Editar</th>             
                  </thead>                 
                    @csrf
                    <tbody  style="margin: 0;padding: 0">
                        @foreach($sponsors as $resp)
                          <tr>                               
                            <td>{!! $resp->id !!}</td>
                            <td>{!! $resp->name !!}</td> 
                            <td>{!! $resp->mes !!}/{!! $resp->anio !!} </td>                           
                            @if($resp->is_act == 1)
                            <td>ACTIVO</td>    
                            @else 
                            <td>INACTIVO</td>
                            @endif                      
                            <td class="text-left">
                                <a href="{{ route('editarsponsor',array('lid' =>$resp->id,'lstatus'=>$resp->is_act)) }}"><i class="fa fa-edit text-success" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>              
                </table>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endauth
