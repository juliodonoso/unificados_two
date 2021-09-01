@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">                                
        <div class="card-body ">            
            <form method="POST" id="formedit" name="formtxt" action="{{ route('gentxt') }}">  
                {{ csrf_field() }} 
                <div class="col-sm-6">
                <label for="exampleFormControlSelect1">Mes de Archivo</label>                    
                    <select multiple data-title="Seleccione los Meses"  id="mes"  name="mes[]"  class="selectpicker" multiple data-size="6" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">                                                
                        <option value=1>ENERO</option>
                        <option value=2>FEBRERO</option> 
                        <option value=3>MARZO</option>
                        <option value=4>ABRIL</option>
                        <option value=5>MAYO</option> 
                        <option value=6>JUNIO</option>
                        <option value=7>JULIO</option> 
                        <option value=8>AGOSTO</option>
                        <option value=9>SEPTIEMBRE</option>
                        <option value=10>OCTUBRE</option> 
                        <option value=11>NOVIEMBRE</option>
                        <option value=12>DICIEMBRE</option>                                                                                                             
                    </select>
                </div>
                    <div class="card-footer ">
                <hr>             

                <div class="stats">                   
                <button type="submit" class="btn btn-fill btn-warning">Generar</button>
                    <!-- <a href="" class="btn btn-warning" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Generar Reporte</a>   -->
                </div>
            </div>  


            </form>
        </div>
    </div>
</div>
@endsection
@endauth