@extends('layouts.menu')
@auth
@section('content')
<form action="{{ route('Verifd') }}" method="POST" enctype="multipart/form-data" name="f02" id="f02">
  @csrf 
  <div class="col-md-12">
    <div class="card card-stats">
      <div class="card-body ">        
        <div class="form-group" id="div01b" >
                    <!-- <select name="sel01b" id="sel01b" class="selectpicker" data-title="Seleccione su busqueda" data-style="btn-default btn-outline" data-menu-style="dropdown-blue"> -->
                    <select data-title="Seleccione su Busqueda" name="sel01b" id="sel01b" class="selectpicker" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue">
                        <option value="rut">Rut</option>
                        <option value="telf">Telefono</option>
                        <option value="email">email</option>
                        <option value="nrocta">N° Cuenta</option>
                        <option value="ejecutivo">Ejecutivo</option>
                        <option value="supervisor">Supervisor</option>                              
                    </select>
                </div>
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
        <div class="input__row">
          <input class="btn btn-info btn-wd"   value="Verificar" id="bt01" onclick='f_gestion();' disabled>          
        </div>    
      </div>   
    </div>
  </div>
  <style>

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

  function f_gestion() {  
      swal({
          title: "Verificar Duplicidad del archivo seleccionado?",
          text: "Duplicidad de Propuestas",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si, Verificar!",
          cancelButtonText: "No, Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
      }, function(isConfirm) {
          if (isConfirm) {
            document.f02.submit() 
          } else {
              swal("Cancelado", "No se proceso el archivo", "error");
          }
      });
    }
</script>


@endsection
@endauth