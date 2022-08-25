@extends('layouts.menu')
@auth
@section('content')
<div class="col-md-12">
    <div class="card ">
        <div class="card-body ">
            <div class="row">
                <div class="col col-4">

                    <div class="form-group row">
                        <label for="rut" class="col-4 col-form-label">buscar por rut</label>
                        <div class="col col-6">
                            <div >
                            <input type="text" class="form-control" id="rut" placeholder="rut">
                            </div>
                        </div>

                        <div class="col col-2 text-left">
                            <button class="btn btn-success" onclick="_buscarRut()">Buscar</button>
                        </div>
                    </div>

                </div>
                <div class="col">
                    <div class="card-footer text-right">
                        <a href="{{ route('excelc1') }}" class="btn btn-success" ><i class="fa fa-file-excel-o" aria-hidden="true"></i>Excel</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body ">
                {{ csrf_field() }}
            <table class="table table-hover" id="tb01">
                <thead>
                    <th>id</th>
                    <th>Rut</th>
                    <th>Empresa</th>
                    <th>Fecha carga</th>
                    <th>Contacto</th>
                    <th>mail</th>
                    <th>Fono</th>
                    <th>Gestion</th>
                    <th>Ver</th>
                    <th>Copy</th>
                </thead>
                <tbody>
                    @foreach($datos as $resp)
                        <tr>
                            <td>{!! $resp->id!!}</td>
                            <td>{!! $resp->rut !!}</td>
                            <td>{!! $resp->Apellidop !!}</td>
                            <td>{!! $resp->created_at->format('Y/m/d') !!}</td>
                            <td>{!! $resp->contacto !!}</td>
                            <td>{!! $resp->mail !!}</td>
                            <td>{!! $resp->fono !!}</td>
                            @if($resp->Gestion =="")
                                <td style="color: orange;">S/GESTION</td>
                            @else
                                <td>{!! $resp->gtc1!!}</td>
                            @endif
                            <td><a id ="bview" href="{{ route('gtcamp',$ldid = $resp->id)}}"><i class="fa fa-search"></i></a></td>
                            <td><a id ="bcopy" onclick="f_copiar()"><i class="fa fa-phone"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10">
                            {{ $datos->links() }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@endauth

<style>

table td {
        font-size:9px;
    }


</style>


<script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/js/demo.js')}}"></script>

<script>
    function f_copiar() {
        $('table tr td:last-child').click(function(){
            var valor = $(this).siblings('td:nth-child(6)').text();
            var aux = document.createElement("input");
            aux.setAttribute("value", valor);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
            swal({
                title: "Telefono Copiado!",
                text: "Numero Copiado: " + valor,
                type: "success"
            });
        })
    }
     function _buscarRut(){
        if($("#rut").val().trim() !== ""){
            document.location.href="{{asset('home')}}"+"/"+$("#rut").val();
        }
     }

</script>
