
{/* <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> */}

// Funcion para Auditorias/ingreso -----  Filtrar Combo de Canal 


$('#canal').on('change', function() {
 var params = {"_token": "{{ csrf_token() }}",
 "id" : this.value};  
  $.ajax({
    type: 'post',
    dataType: 'json',  
    url: "{{route('combos')}}",    
    data: params,
    success: function (response) {    
    },
    error: function(response) {
      alert('error');
    }
  });
});
