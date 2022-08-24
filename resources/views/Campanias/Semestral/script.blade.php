@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">
        <div class="card-body ">
        <form method="POST" action="{{ route('upgt',array('lid' =>$ldid)) }}" name="formedit" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body ">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item" id="nav1c">
                            <a class="nav-link active" id="tbas4" href="#tab1" data-toggle="tab" role="tab" aria-controls="tab1" aria-selected="true">Script</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                            <p>Buenos dias / Tardes, Me podria comunicar con el <strong>EL ENCARGADO DE SEGUROS</strong> de la empresa </p>


                            <p>¡Un Gusto! Sr@: Mi nombre es <strong> {{ Auth::user()->name }} </strong> y l@ estoy llamando en nombre de
                                <strong>SANTANDER CORREDORA DE SEGUROS LIMITADA Y GALLAGHER CORREDORES DE SEGUROS </strong> </p>
                            <p> <strong>*** LE COMENTO QUE PARA SU TRANQUILIDAD Y MEJOR ATENCIÓN ESTA CONVERSACIÓN PODRÍA SER GRABADA *** </strong></p>
                            <p> Sr@  <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, me gustaria saber
                                <strong>¿COMO SE ENCUENTRA UD?</strong> <span style="color: #9cf395  ">*** Esperar Respuesta del cliente y responder en consecuencia ***</span> </p>
                            <p>QUE BUENO/ME ALEGRO</p>
                            <p>Sr@  <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>,
                                El motivo de mi llamado es para felicitarlo por la contratacion de su seguro <strong>{{$lgestion->ramo}}</strong>
                                que realizo el dia <strong>{{$lgestion->fcarga}}</strong> a traves de <strong>GALLAGHER CORREDORES DE SEGUROS </strong></p>
                            <p> <strong>¿ESTO ES CORRECTO?  OBLIGATORIO</strong> <span class="text-success">SI CLIENTE DICE QUE SI, SEGUIR CON EL PROTOCOLO</span></p>
                             <!-- Primera Pregunta  -->
                             <script>
                                $(document).on('change', '#exampleRadios1', function(){
                                    var id=$(this).val();
                                    if (id=="SI"){
                                        $("#NO-Acep").hide();
                                        $("#SI-Acep").show();
                                        $("#info1").show();
                                        }else{
                                        $("#NO-Acep").show();
                                        $("#NO-Acep2").hide();
                                        $("#SI-Acep").hide();
                                        $("#info1").hide();
                                    }
                                });
                            </script>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="exampleRadio" id="exampleRadios1" value="SI" checked>
                                    <span class="form-check-sign"></span>
                                    SI
                                </label>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="exampleRadio" id="exampleRadios1" value="NO">
                                    <span class="form-check-sign"></span>
                                    NO
                                </label>
                            </div>
                            <div id="SI-Acep">
                                <!-- Segunda pregunta -->
                                <script>
                                    $(document).on('change', '#exampleRadios2', function(){
                                        var id=$(this).val();
                                        if (id=="SI"){
                                            $("#NO-Acep2").hide();
                                            $("#SI-Acep2").show();
                                            $("#info1").show();
                                            }else{
                                            $("#NO-Acep2").show();
                                            $("#SI-Acep2").hide();
                                            $("#info1").hide();
                                        }
                                    });
                                </script>
                                <p> Sr@ <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, me gustaria consultarle,
                                     ¿Su poliza o certificado de cobertura fue recepcionado por usted de forma correcta?</p>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="exampleRadio2" id="exampleRadios2" value="SI" checked>
                                        <span class="form-check-sign"></span>
                                        SI
                                    </label>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="exampleRadio2" id="exampleRadios2" value="NO">
                                        <span class="form-check-sign"></span>
                                        NO
                                    </label>
                                </div>
                                <div id="SI-Acep2">
                                    <p>Sr@ <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, le recuerdo que las coberturas,
                                        condiciones y exclusiones de su seguro estan informados y detallados en esta poliza o certificado para su mayor conocimiento</p>

                                    <p>Tambien le recuerdo Sr@: <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong> que usted cuenta con la disponibilidad de su
                                        ejecutivo <strong>EJECUTIVO ESPECIALISTA DE GALLAGHER</strong> frente a cualquier duda, consulta o asistencia en siniestros que le pudiera ocurrir.</p>
                                    <p>Adicionalmente le informo que sera contactado por  GALLAGHER, cuando su poliza termine su vigencia, para acordar la renovacion de su seguro y asi continuar con la proteccion para su bien asegurado</p>
                                    <p><strong>¿USTED SABIA ESTO?</strong></p>

                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio3" id="exampleRadios3" value="SI" checked>
                                            <span class="form-check-sign"></span>
                                            SI
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio3" id="exampleRadios3" value="NO">
                                            <span class="form-check-sign"></span>
                                            NO
                                        </label>
                                    </div>
                                </div>
                                <div id="info1">
                                    <div class="alert alert-info alert-with-icon" data-notify="container" >
                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                            <i class="nc-icon nc-simple-remove"></i>
                                        </button>
                                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                        <span data-notify="message">RECUERDA - Si el cliente tiene alguna duda, tratar de responder en la punta, sin embargo si no es posible por la naturaleza de la pregunta se debera informar al cliente que su ejecutivo de GALLAGHER lo contactara para aclarar su consulta.</span>
                                    </div>
                                    <!-- tercera pregunta -->
                                    <script>
                                        $(document).on('change', '#exampleRadios4', function(){
                                            var id=$(this).val();
                                            if (id=="SI"){
                                                $("#NO-Acep4").hide();
                                                $("#SI-Acep4").show();
                                                }else{
                                                $("#NO-Acep4").show();
                                                $("#SI-Acep4").hide();
                                            }
                                        });
                                    </script>
                                    <p>Sr@ <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, con la finalidad de mejorar nuestro servicio,
                                        nos gustaria que nos respondiera una breve encuesta de 2 preguntas ¿<strong> LE PARECE?</strong></p>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio4" id="exampleRadios4" value="SI" checked>
                                            <span class="form-check-sign"></span>
                                            SI
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio4" id="exampleRadios4" value="NO">
                                            <span class="form-check-sign"></span>
                                            NO
                                        </label>
                                    </div>
                                    <div id="SI-Acep4">
                                        <!-- Encuesta -->
                                        <script>
                                            $(document).on('change', '#exampleRadios5', function(){
                                                var id=$(this).val();
                                                if (id<7){
                                                    $("#encuesta1").show();
                                                    $("#encuesta2").hide();
                                                    $("#encuesta3").hide();
                                                }
                                                if(id >=7 && id <=8 ){
                                                    $("#encuesta1").hide();
                                                    $("#encuesta2").show();
                                                    $("#encuesta3").hide();
                                                }
                                                if(id >=9 && id <=10 ){
                                                    $("#encuesta1").hide();
                                                    $("#encuesta2").hide();
                                                    $("#encuesta3").show();
                                                }
                                            });
                                        </script>
                                        <p>Estimado, en una escala del 0 al 10, donde "0" es que <strong>NO RECOMIENDA</strong> y 10 <strong> SI RECOMIENDA</strong> </p>
                                        <p><strong>¿Que tan dispuest@ estaria a recomendar la contratacion de este seguro a traves de GALLAGHER  a sus conocidos?</strong></p>
                                        <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="0">
                                            <span class="form-check-sign"></span>
                                            0
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="1">
                                            <span class="form-check-sign"></span>
                                            1
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="2">
                                            <span class="form-check-sign"></span>
                                            2
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="3">
                                            <span class="form-check-sign"></span>
                                            3
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="4">
                                            <span class="form-check-sign"></span>
                                            4
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="5">
                                            <span class="form-check-sign"></span>
                                            5
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="6">
                                            <span class="form-check-sign"></span>
                                            6
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="7">
                                            <span class="form-check-sign"></span>
                                            7
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="8">
                                            <span class="form-check-sign"></span>
                                            8
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="9">
                                            <span class="form-check-sign"></span>
                                            9
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="exampleRadio5" id="exampleRadios5" value="10" checked>
                                            <span class="form-check-sign"></span>
                                            10
                                        </label>
                                        <hr>
                                        <div>
                                            <p id="encuesta1" style="display:none"> <strong>¿Cuales son los motivos por el cual usted NO recomendaria la contratacion del seguro a traves de GALLAGHER?</strong></p>
                                            <p id="encuesta2" style="display:none"><strong>¿Que aspectos considera que debe mejorar SANTANDER CORREDORA DE SEGUROS y GALLAGHER en cuanto al proceso de contratacion para que usted recomiende con nota maxima?</strong></p>
                                            <p id="encuesta3"> <strong>¿Cuales son las razones por la que Ud recomendaria la contratacion del Seguro? </strong></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Observaciones</label>
                                            <textarea class="form-control" id="tt01" rows="4" name="observ" style="text-transform:uppercase; height: 90px;"></textarea>
                                        </div>
                                        <hr>
                                        <p>Para finalizar este llamado me gustaria confirmar algunos datos de contacto con usted:</p>
                                        <div class="row">
                                            <div class="col-md-6" style="">
                                                <div class="form-group" style="position: static;">
                                                    <label for="input-text-1">Nombre Completo</label>
                                                    <input type="text" class="form-control" id="input-id-1" placeholder="Enter nombre" name="name" value="{{$lgestion->contacto}}">
                                                </div>
                                                <div class="form-group" style="position: static;">
                                                    <label for="input-id-3">Rut</label>
                                                    <input type="text" class="form-control" id="input-id-3" placeholder="Enter Rut" name="rut" value="{{$lgestion->rut}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="">
                                                <div class="form-group" style="position: static;">
                                                    <label for="input-id-2">email</label>
                                                    <input type="email" class="form-control" id="input-id-2" placeholder="Enter email" name="mail" value="{{$lgestion->mail}}">
                                                </div>
                                                <div class="form-group" style="position: static;">
                                                    <label for="input-id-4">Telefono</label>
                                                    <input type="text" class="form-control" id="input-id-4" placeholder="Enter telefono"  name="telf" value="{{$lgestion->fono}}">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <p>Sr@ <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, <strong> SANTANDER CORREDORA DE SEGUROS </strong> en conjunto con <strong> GALLAGHER</strong>, agradece su confianza al habernos permitido proteger sus bienes</p>
                                        <p>¡Muchas Gracias!</p>
                                    </div>
                                    </div>
                                    <div id="NO-Acep4" style="display:none;">
                                        <p>¡No se preocupe, no hay problema!</p>
                                        <p>Sr@ <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, <strong> SANTANDER CORREDORA DE SEGUROS </strong> en conjunto con <strong> GALLAGHER</strong>, agradece su confianza al habernos permitido proteger sus bienes</p>
                                        <p>¡Muchas Gracias!</p>
                                    </div>
                                </div>
                            </div>
                            <div id="NO-Acep" style="display:none;">
                                <p> Sr@ <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, El seguro <strong> {{$lgestion->ramo}}</strong> que visualizo y que se contrato el dia {{$lgestion->fcarga}} por usted con el ejecutivo {{$lgestion->Ejegallagher}}</p>
                                <p>Debido a lo que menciona <strong>¿Confirma que NO reconoce la contratacion y que desea renunciar al seguro cuya poliza es {{$lgestion->poliza}}?</strong></p>
                                <div class="alert alert-info alert-with-icon" data-notify="container" >
                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                            <i class="nc-icon nc-simple-remove"></i>
                                        </button>
                                        <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                        <span data-notify="message">El cliente debe indicar de forma clara - SI ACEPTO</span>
                                    </div>
                                <p>Solicitaremos a GALLAGHER esta gestion, para la cual sera contactado dentro de los proximos dias (5 días habiles maximo)</p>
                                <p class="text-success">(Cuál es el plazo para contactar) (5 días habiles maximo)</p>
                                <p>Lamentamos mucho los inconvenientes y le gradecemos el tiempo destinado a esta llamada</p>
                                <p>¡Hasta Pronto!</p>
                            </div>
                            <!-- SECCION 3 DESPEDIDAS SI NO LLEGO LA POLIZA -->
                            <div id="NO-Acep2" style="display:none;">
                                <p>Sr@ <strong>(NOMBRE DEL ENCARGADO DE SEGUROS)</strong>, <strong> SANTANDER CORREDORA DE SEGUROS </strong> en conjunto con <strong> GALLAGHER</strong>, agradece su confianza al habernos permitido proteger sus bienes</p>
                                <p>Terminada la llamada solicitaremos a <strong> GALLAGHER</strong>
                                    que haga envio de su poliza o certificado de cobertura</p>
                                <p>¡Muchas gracias!</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <hr>
                            <div class="col-md-6">
                                <select name="gestion" id="gestion" class="selectpicker" data-title="Seleccione gestion" data-style="btn-default btn-outline" data-menu-style="dropdown-blue" required="true">
                                    <option value="1">VOLVER A LLAMAR</option>
                                    <option value="2">VENTA IMPERFECTA</option>
                                    <option value="3">BUENA VENTA</option>
                                    <option value="4">CONTACTO TERCERO</option>
                                </select>
                            </div>
                        </div>
                        <div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="1" name="conchk">
                                    <span class="form-check-sign"></span>
                                    Solicita Consulta de ejecutivo
                                </label>
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" value="1" name="enviopoliza">
                                    <span class="form-check-sign"></span>
                                    Solicita envio de poliza
                                </label>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <hr>
                            <button type="button" class="btn btn-warning btn-fill pull-right" onclick="f_validar()">Grabar</button>
                        </div>
                        </div>
                    </div>
                  </div>
            </form>
        </div>
    </div>
</div>
@endsection
@endauth
<script src="https://code.jquery.com/jquery-1.12.4.js"integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Funcion Grabar  -->
<script>
    function f_grabar() {
        swal({
            title: "Estas Seguro de Grabar la Gestion?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Grabar!",
            cancelButtonText: "No, Cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
              swal("Actualizado!", "Tu Registro se Actualizo.", "success");
              document.formedit.submit()
            } else {
                swal("Cancelado", "Proceso Cancelado", "error");
            }
        });
    }
</script>

<script>
    function f_validar(){
        var incompletos = false; // AQUI inicializamos la variable
        var ldato = "";
        $('#gestion').find("option:selected").each(function() {
        if ($(this).val().trim() == '') {
            incompletos = true;
            ldato = ldato+'Gestion';
        }
        });
        if(incompletos == true){
            swal("Ingrese Gestion!", "Debe agregar gestion para grabar ",'warning');
        } else {
            f_grabar();
        }
    };
</script>
