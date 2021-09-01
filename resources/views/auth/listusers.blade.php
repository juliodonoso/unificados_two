@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-8">
    <!-- <div class="card ">                                 -->
        <div class="card-body ">            
     
                {{ csrf_field() }} 
                <div class="card strpied-tabled-with-hover">  
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <p class="card-category">Usuarios Registrados en el sistema</p>	        
          </div>
        </div>
        <div class="card-body table-full-width table-responsive">
          <table class="table table-hover">
            <thead>
              <th>ID</th>
              <th>Usuario</th>
              <th>Email</th>             
              <th>Editar</th>             
            </thead>      
            <form name="f03" id="f03" action="{{ route('usersedit') }}" method="POST"> 
              @csrf
              <tbody>
                @foreach($lusers as $resp)
                    <tr>                               
                        <td>{!! $resp->id !!}</td>
                        <td>{!! $resp->name !!}</td>
                        <td>{!! $resp->email !!}</td> 
                        <td>
                        <!-- <a class="pull-left" href="" data-toggle="modal" > <i class="fa fa-edit"></i></a>   -->
                        <td><button name ="bt01" value ="{{$resp->id}}"><i class="fa fa-edit"></i></button></td>                                                            
                        </td>                     
                    </tr>
                @endforeach
              </tbody>
            </form>
          </table>
        </div>   
      </div>
            <!-- </form> -->
        </div>
    <!-- </div> -->
</div>
@endsection
@endauth