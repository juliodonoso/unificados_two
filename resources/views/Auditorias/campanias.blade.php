@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
          <form name="f03" id="f03" action="{{ route('ciaedit') }}" method="POST"> 
            {{ csrf_field() }} 
              <div class="card-head ">               
                  <p class="card-category"><b> <i class="nc-icon nc-bell-55 text-success"></i>  Atencion: </b> Modificar la Campaña, modificara el nombre de las auditorias historicas registradas </p>	 
                            
                <hr>
                <div id="botn">                     
                    <a href="{{ route('newcia') }}" class="btn btn-warning" ><i class="fa fa-user" aria-hidden="true"></i> Nuevo</a>                
                    <div id="bqrut">        
                    <input type="text" class="form-control" name="inputUno" id="search" placeholder="Buscar">              
                </div> 
            </div>      
              </div>
              <div class="card-body table-full-width table-responsive">
                <table class="table table-hover" id="tb01">
                  <thead>
                    <th>ID</th>
                    <th>Campaña</th> 
                    <th>Sponsor</th>                                     
                    <th>Editar</th>             
                  </thead>                 
                    @csrf
                    <tbody  style="margin: 0;padding: 0">
                        @foreach($operad as $resp)
                          <tr>                               
                            <td>{!! $resp->id !!}</td>
                            <td>{!! $resp->name !!}</td> 
                            <td>{!! $resp->nombre !!}</td>                        
                            <td style="padding: 0;"> <button name ="bt01" value ="{{$resp->id}}"  class="btn btn-info btn-link btn-wd"><i class="fa fa-edit"></i></button></td>
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

<style>
  
    table td {
        font-size: 10px;
        padding:0;
        margin:0;
    }

    #botn {
            display:inline;       
        }
    #bqrut {
        display:flex; 
        margin-right: 5px;
        float: right;
    }

    #bt01 {
        padding: 0;
    }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- BUSQUEDA  -->
<script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            _this = this;
            $.each($("#tb01 tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>