@extends('layouts.menu')
@auth
  @section('content')
    <form action="{{ route('Cargaprop') }}" method="POST" enctype="multipart/form-data" name="f02" id="f02">
      @csrf 
      <div class="col-md-12">
        <div class="card card-stats">
          <div class="card-body ">
            <div class="row">         
                <div class="col-5"><p class="card-category">Seleccione Archivo:</p>           
                  <div class="input__row uploader" id="divx2">              
                    <div id="inputval" class="input-value" placeholder="Seleccione archivo..." required>
                    </div>
                    <label for="file_1"></label>                
                    <input  id="file_1" name="file" id="file" class="upload" type="file" accept="text/plain, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                  </div>
                </div>      
            </div>
          </div> 
          </form>      
          <div class="card-footer "> 
          <br>   
          @if($pCount == 1)
            <div class="input__row">
              <input class="btn btn-info btn-wd"   value="Importar" id="bt01" onclick='f_import();' disabled>          
            </div>
          @else
            <div class="alert alert-danger alert-with-icon" data-notify="container">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                <span data-notify="message">No se pueden Cargar Movimientos - No hay Periodos Abiertos.</span>
            </div> 
          @endif
          </div>   
        </div>
      </div>
    </form>
    <!-- Tabla de Movientos Cargados  -->
    <!-- Boton seleccionar  -->
    <script>   
        $(document).ready(function(){       
            $('input[type=checkbox]').click(function() {  
                if($('input[type=checkbox]').is(':checked')) {               
                    document.getElementById('bt03').disabled = false; 
                    $('input[type=checkbox]').val();                    
                } else {             
                    document.getElementById('bt03').disabled = true; 
                    $('input[type=checkbox]').val();
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
    <div class="col-md-12">
      <div class="card strpied-tabled-with-hover">  
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <p class="card-category">Detalle de los ultimos 15 Archivos Importados</p>						
            <input type="submit" class="btn btn-danger submitBtn" name="bt03" id="bt03" Value="Eliminar" onclick='f_delete();' disabled />       
          </div>
        </div>
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
                        <td>{!! $resp->noreg !!}</td>    
                        <td>{!! $resp->count !!}</td>                                           
                        <td>{!! $resp->created_at !!} </td> 
                        <td>{!! $resp->eje !!}</td>  
                        <td><input type="checkbox" class="checkbox" name="checks[]" id="ckBox" value="{{$resp->id}}"></td>                                        
                    </tr>
                @endforeach
              </tbody>
            </form>
          </table>
        </div>   
      </div>
    </div>
  @endsection
@endauth
<style>

  #BtnSeleccionar { 
          border: none;  
          padding: 0px 0px;  
          cursor: pointer; 
      }
      #bt03 {
        border: none;  
          margin-left:10px;
          position: relative;
          display: flex;
      }

  table td{
    color:  #85929e ;
  }
    #divx2 {
      border-radius: 10px 10px;
    }

    /* Upload button */
    .upload {
      display: none;
    }
    .uploader {
      border: 1px solid #ccc;
      width: 500px;
      position: relative;
      height: 40px;
      display: flex;
    }
    .uploader .input-value{
      width: 250px;
      padding: 5px;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 25px;
      font-family: sans-serif;
      font-size: 16px;
    }
    .uploader label {
      cursor: pointer;
      margin: 0;
      width: 30px;
      height: 40px;
      position: absolute;
      right: 0;
      background: #f39c12 url('https://www.interactius.com/wp-content/uploads/2017/09/folder.png') no-repeat center;
     
      border-radius:  5px;
    }



    .submitbtn:hover + span.form-arrow::before {
      border: 2px solid #c3e3fc;
      border-bottom-color: transparent;
      border-left-color: transparent;
    }
  #bt01:disabled {
    background: #ccd1d1;
  }
    #bt01:hover {
        background: #f39c12;
    }
</style>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  
<!-- Validar que el input este con archivo -->
<script>
  $(document).ready(function() {
    $('#file_1').on('change',function(){
      var fileName = $(this).val().split("\\").pop();
        $(this).siblings('#inputval').addClass("selected").html(fileName);
    });
  });
  // Validar archivo a importar
  $(document).ready(function() {
    var $submit = $('#bt01');
    $submit.prop('disabled', true);
    $('input[type="file"]').on('input change', function() { //'input change keyup paste'
        $submit.prop('disabled', !$(this).val().length);
    });
  });
</script>

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
              document.f02.submit() 
            } else {
                swal("Cancelado", "No se Cargaron los Datos", "error");
            }
        });
    }
</script>

<!-- Salir -->
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
