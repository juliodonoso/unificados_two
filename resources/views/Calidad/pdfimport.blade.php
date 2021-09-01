@extends('layouts.menu')
@auth
  @section('content')
    <form action="{{ route('pdfcarga') }}" method="POST" enctype="multipart/form-data" name="f02" id="f02">
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
                    <input  id="file_1" name="urlpdf" id="file" class="upload" type="file" accept=".pdf">                  
                  </div>
                </div>                     
            </div>          
          </div> 
          <br>
          <input  type="hidden" name="propbq" id="propbq" value ="" class="propid">
          <div style="display:none;" id="divprop">
            <div class="col-5">
              <p class="card-category" id="pprop">Prueba</p>  
            </div>
          </div>

          <!-- </form>       -->
          <div class="card-footer "> 
          <br>          
            <div class="input__row">
              <input class="btn btn-info btn-wd"   value="Importar" id="bt01" onclick='f_import();'>          
            </div>         
          </div>   
        </div>
      </div>

    </form>
    <!-- Tabla de propuestas Cargadas  -->
    <input type="hidden" name="propbq" id="propbq" value ="" class="propid">

    <div class="col-md-12">
      <div class="card strpied-tabled-with-hover">  
        <!-- <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center"> -->
            <!-- <p class="card-category">Detalle de los ultimos 15 Archivos Importados</p>						 -->
            <!-- <input type="submit" class="btn btn-danger submitBtn" name="bt03" id="bt03" Value="Eliminar" onclick='f_delete();' disabled />        -->
          <!-- </div>
        </div> -->
        <div class="card-body table-full-width table-responsive">
          <table class="table table-hover">
            <thead>
              <th>ID</th>            
              <th>Propuesta</th>
              <th>Rut</th>
              <th>Asegurado</th>
              <th>Archivo</th>
              <th>Fecha :: hora</th>             
              <th>Scanner</th>
              <th>Selec</th>
              <th>Borrar</th>
             
            </thead>      
            <form name="f03" id="f03" action="{{ route('Mnto') }}" method="POST">
              @csrf
              <tbody>
                @foreach($pdfup as $resp)
                    <tr data-id = "{{$resp->id}}">                               
                        <td>{!! $resp->id !!}</td>
                        <td>{!! $resp->propuesta!!}</td>
                        <td>{!! $resp->rutcar !!}</td>
                        <td>{!! $resp->pat!!} {!! $resp->mat!!} {!! $resp->nom!!}</td>
                        <td>{!! $resp->pdfscanner !!}</td>    
                        <td>{!! $resp->created_at !!} </td>                     
                        <td><button type="button" class="btn btn-info" onclick="showFile('{{$resp->id}}')">Ver</button></td>
                 
                        <td><button type="button" class="btn btn-success" onclick="selectprop('{{$resp->id}}')">Sel</button></td>
                        <td><button type="button" class="btn btn-danger" onclick="delprop('{{$resp->id}}')">Borr</button></td>
                        <!-- <td><a href="" data-toggle="modal" class="btn btn-link btn-danger like"><i class="fa fa-trash"></i></a></td> -->
                        <!-- <td><input type="checkbox" class="checkbox" name="checks[]" id="ckBox" value="{{$resp->id}}"></td>                                         -->
                    </tr>
                @endforeach
              </tbody>
            </form>
          </table>
        </div>   
      </div>
    </div>
    <!-- Boton seleccionar  -->
    <form action="POST" action="{{route('pdfsee')}}" id='form'>
        @csrf
        <input type="hidden" name="rutbq" id="rutbq" value ="" class="input_valores_provisionales">
    </form> 
  
   
 
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

<script>

function fileexist() {
$ruta = 

}


</script>





<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Funcion para ver los pdf  -->
<script>
  function showFile(id){  
    $('.input_valores_provisionales').val(id) 
    var pdfview = "";
      $.ajax({
          url: "{{route('pdfsee')}}",      
          method: 'POST',
          data: $("#form").serialize()  
      }).done(function(data){
        var arreglo = JSON.parse(data);                                                                   
            for (var  x = 0; x < arreglo.length; x++){
              var todo = arreglo[x].pdfscanner;
              var pdfview = todo; 
              window.open('propuestas/'+pdfview,'_blank');          
            }                
        });  
    }
</script>



<!-- Funcion para seleccionar la Propuesta a ser cargada  -->
 <script>
  function selectprop(id) {
    $('#propbq').val(id);    
    document.getElementById("pprop").innerHTML = "Propuesta: "+id;
    $("#divprop").show(); 
  }
 </script>
<!-- Funcion para borrar los pdf cargados de las propuestas -->

<script>

function delprop(id) {

}

</script>

<style>

table td {
  font-size: 10px;
}
</style>
