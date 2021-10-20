@extends('layouts.menu')
@auth
    @section('content')
        <div class="col-md-6">
        <form name="f04" id="f04" action="{{ route('upusers',$luserid) }}" method="POST"> 
        {{ csrf_field() }}
                <div class="card stacked-form">
                    <div class="card-header ">
                        <h4 class="card-title">Edicion de Usuarios</h4>
                    </div>
                
                    <div class="card-body ">                    
                            @foreach($ledit as $resp)                        
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="name"  name="bname" placeholder="Ingrese el Nombre" class="form-control" value = "{{$resp->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" placeholder="Ingrese email" class="form-control" value = "{{$resp->email}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="pwd01" placeholder="Password" class="form-control" value = "{{$resp->password}}" required>
                                </div>
                                <div class="form-group row">                         
                                <div class="col-md-6">
                                    <select name="opt01" id="opt01" class="form-control" >
                                        <option selected>Seleccione opcion ...</option>
                                        <option value="1">ADMINISTRADOR</option>
                                        <option value="2">SUPERVISOR CALIDAD</option>
                                        <option value="3">AGENTE CALIDAD</option>
                                        <option value="4">SUPERVISOR LLAMADAS</option>
                                        <option value="5">AGENTE LLAMADAS</option>
                                        <option value="6">AUDITOR</option> 
                                        <option value="7">SUPERVISOR DE AUDITORIA</option>                                       
                                    </select> 
                                </div> 
                            @endforeach                       
                    </div>                                   
                </div>
                </form>
                <div class="card-footer ">
                    <button name ="bt01" type="submit" class="btn btn-fill btn-info">Actualizar</button>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>
        <script>   
            $(document).ready(function() {  
                // tipo de Usuario
                const miVar = "<?php echo $resp->idtype ?>";
                $('#opt01').val(miVar).prop('selected', true);      
            });
        </script>   
    @endsection
@endauth