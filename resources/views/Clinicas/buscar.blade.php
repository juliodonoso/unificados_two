@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('resultb') }}">  
                {{ csrf_field() }} 
                <div class="row">
                    <div class="col-md-6" style="">
                        <div class="form-group" style="position: static;">
                            <label for="select-1">Criterio de Busqueda:</label>
                            <select class="form-control" id="select-1" name="select1">
                                <option value=""disabled selected>Seleccione opcion</option>
                                <option value="rut">Rut</option>               
                                <option value="propuesta">Propuesta</option>
                                <option value="telf">Telefono</option>
                                <option value="email">email</option>
                                <option value="nrocta">N° Cuenta</option>
                                <option value="ejecutivo">Ejecutivo</option>
                                <option value="supervisor">Supervisor</option> 
                            </select>                          
                        </div>
                    </div>
                    <div class="col-md-6" style="">
                        <div class="form-group" style="position: static;">
                            <label for="input-text-1">Informacion a Buscar:</label>
                            <input type="text" class="form-control" id="input-id-1"  name="buscar" placeholder="Ingrese datos a buscar">                           
                        </div>
                    </div>                   
                </div>
                <div class="card-footer ">
                    <hr style=" border-color:  #e7e7e7;">
                    <button type="submit" class="btn btn-fill btn-info" id="button">Buscar</button>
                </div> 
            </form>
        </div>
    </div>
</div>
<style>
    #button {
        position: relative;
        float: right;
    }
</style>
@endsection
@endauth

