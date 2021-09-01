
@extends('layouts.menu')
@section('content')
@auth
<form action="{{ route('Upgtexcel') }}" method="POST" enctype="multipart/form-data" name="f02" id="f02">
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
        <div class="input__row">
          <input class="btn btn-info btn-wd"   value="Actualizar" id="bt01" onclick='f_gestion();' disabled>          
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
          title: "Desea Actualizar la gestion a los registros?",
          text: "Actualizacion de Registros",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si,Actualizar!",
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
@endauth
@endsection

