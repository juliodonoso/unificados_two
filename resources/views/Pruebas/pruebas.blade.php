   
@extends('layouts.menu')
@auth
@section('content')   
    <div class="form-group row">
        <label for="faculty" class="col-md-4 col-form-label text-md-right">Canal</label>

        <div class="col-md-6">
            <select id="faculty" name="faculty_id" class="form-control">
                @foreach($canal as  $select4)
                    <option value="{{ $select4->id }}" id="canal_id">{{ $select4->name }}</option>                                   
                @endforeach
            </select>                 
        </div>
    </div>

    <div class="form-group row">
        <label for="career" class="col-md-4 col-form-label text-md-right">Operadores</label>
        <div class="col-md-6">
            <select id="career" data-old="" name="oper_id" class="form-control"></select>        
        </div>
    </div>
@endsection
@endauth

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

$(document).ready(function() {
    $('#faculty').on('change',function(){
        var canalid = $(this).val();
        // alert(canalid);
        if($.trim(canalid) !='') {
            $.get('pruebas',{canalid: canalid}, function(operadores) {
                $('#career').empty();
                $('#career').append("<option value=''>seleccione Operador</option>");
                
            });
        }
       
        
    })

});



</script>
