@extends('layouts.menu')
@auth
@section('content')        
<div class="col-md-12">
    <form method="POST" action="{{ route('buscarP') }}">
    @csrf
    <div class="card ">
        <div class="card stacked-form">
            <div class="card-header ">
                <h4 class="card-title">Busqueda por:</h4>
            </div>    
            <div class="card-body ">     
                <div class="form-group" id="div01b" >
                    <!-- <select name="sel01b" id="sel01b" class="selectpicker" data-title="Seleccione su busqueda" data-style="btn-default btn-outline" data-menu-style="dropdown-blue"> -->
                    <select data-title="Seleccione su Busqueda" name="sel01b" id="sel01b" class="selectpicker" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                        <option value="rut">Rut</option>
                        <option value="propuesta">Propuesta</option>
                        <option value="telf">Telefono</option>
                        <option value="email">email</option>
                        <option value="nrocta">N° Cuenta</option>
                        <option value="ejecutivo">Ejecutivo</option>
                        <option value="supervisor">Supervisor</option>                              
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">       
                        <div class="col-sm-10">
                            <input type="text" id="objb" name="objb" placeholder="Ingrese objeto a buscar" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="card-footer ">
                <button type="submit" class="btn btn-fill btn-warning">Buscar</button>
            </div>
        </div>       
    </div>
</div>
@endsection
@endauth
<style>

#div01b {
    width: 83%;
}
</style>