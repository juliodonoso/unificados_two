@extends('layouts.menu')
@auth
  @section('content')
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <div class="col-md-12">
        <div class="card ">                                
          <div class="card-body ">            
            <form method="POST" id="formedit" name="formedit" action="{{ route('importprop') }}" enctype="multipart/form-data">  
                {{ csrf_field() }}                
                <div class="card-header">
                    <h4 class="card-title">Importacion de Datos</h4>
                    <p class="card-category">Seleccione Archivo a importar:</p>
                </div>
                <div class="card-body ">      
                  <div class="custom-file" id="inputval">                                   
                    <input type="file" id="fuSubirExcel" name="file" class="custom-file-input" accept=".xlsx" />                    
                    <label id="lblArchivo" class="custom-file-label" for="fuSubirExcel"></label> 
                  </div> 
                </div> 
                <hr>
                <div class="card-footer text-right">              
                    <button id="bt01" style="color:white;" type="button" class="btn btn-warning btn-fill pull-right" onclick="f_import()" disabled>Importar</button>                                        
                </div>         
            </form>
            
          </div>
        </div>
      </div>
      <!-- tabla de Importaciones  -->
      <div class="col-md-12">     
        <div class="card ">                                
          <div class="card-body ">
          <div class="card-body d-flex justify-content-between align-items-center">
            <p class="card-category">Detalle de los ultimos 15 Archivos Importados</p>						
            <input type="submit" class="btn btn-danger submitBtn" name="bt03" id="bt03"  style="display:none" Value="Eliminar" onclick='f_delete();' disabled />       
         
          </div>
          <hr>
          <div class="card-body table-full-width table-responsive">
          <table class="table table-hover">
            <thead>
              <th>ID</th>
              <th>Archivo</th>
              <th>N° Registros</th>
              <th>N° Propuestas</th>
              <th>Fecha :: hora</th>
              <th>Importado por:</th>
              <th>Borrar</th>
            </thead>      
            <form name="f03" id="f03" action="{{ route('Mnto') }}" method="POST">
              @csrf
              <tbody>
                @foreach($cargas as $resp)
                    <tr>                               
                        <td>{!! $resp->id !!}</td>
                        <td>{!! $resp->fileimp !!}</td>
                        <td class="alc">{!! $resp->noreg !!}</td>    
                        <td class="alc">{!! $resp->count !!}</td>                                           
                        <td>{!! $resp->created_at !!} </td> 
                        <td>{!! $resp->eje !!}</td>  
                        <td class="alc"><input type="checkbox" class="checkbox" name="checks[]" id="ckBox" value="{{$resp->id}}"></td>                                        
                    </tr>
                @endforeach
              </tbody>
            </form>
          </table>
        </div>  
          </div>
        </div>
      </div>
            
  @endsection
@endauth
<style>
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>
<!-- Funcion llenar input file  -->
<script>
  $(document).ready(function() {
    $("#fuSubirExcel").on('change', function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
    })
  });
</script>

<!-- Validar que el input este con archivo -->
<script> 
  $(document).ready(function() {
    var $submit = $('#bt01');
    $submit.prop('disabled', true);
    $('input[type="file"]').on('input change', function() { //'input change keyup paste'
        $submit.prop('disabled', !$(this).val().length);
    });
  });
</script>

<!-- Importar  -->
<script>
    function f_import() {  
        swal({
            title: "Estas Seguro de importar el archivo seleccionado?",
            text: "Carga de datos de Propuestas",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Importar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
              document.formedit.submit() 
            } else {
                swal("Cancelado", "No se Cargaron los Datos", "error");
            }
        });
    }
</script>

<!-- Boton para borrar  -->
<script>   
    $(document).ready(function(){       
        $('input[type=checkbox]').click(function() {  
            if($('input[type=checkbox]').is(':checked')) {               
                document.getElementById('bt03').disabled = false; 
                $('#bt03').show(); 
                $('input[type=checkbox]').val();                    
            } else {             
                document.getElementById('bt03').disabled = true; 
                $('input[type=checkbox]').val();
                $('#bt03').hide(); 
            }  
        }); 
    });   
    $(document).ready(function() {
        selected = true;
        $('#BtnSeleccionar').click(function() {     
        if (selected) {
            $('input[type=checkbox]').prop("checked", true);        
            $('#BtnSeleccionar').val('Deseleccionar');
            document.getElementById('bt03').disabled = false;        
        } else {
            $('input[type=checkbox]').prop("checked", false);
            $('#BtnSeleccionar').val('Seleccionar');
            document.getElementById('bt03').disabled = true;
        }
        selected = !selected;
        });
    });
</script>

<!-- Borrar  -->
<script> 
    function f_delete() {
    swal({
      title: "BORRADO DE REGISTROS!",
      text: "Desea eliminar los registros seleccionados?",       
      type: "warning",
      showCancelButton: true,       
      confirmButtonText: "ok",
      cancelButtonText: "No",
      closeOnConfirm: true,
      closeOnCancel: true,
    },
    function(isConfirm){
      if (isConfirm) {						
            document.f03.submit() 
      } 
    }
    );
  }
</script>

<style>
  table td {
    font-size:11px;
    color:grey;
    padding: 0px;
    height: 20px;
  }


  #ckBox {
    font-size: 12px;
    width:15px;
    height:15px;
  }
  .alc  {
  text-align: center; 
  padding: 0px;

  }
</style>

