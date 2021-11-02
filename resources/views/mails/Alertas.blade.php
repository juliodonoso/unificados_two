<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>ALERTA</title>
      <h5>{{ $lasunto }}</h5>
</head>
  <body style="font-family: 'calibri', Garamond, 'Comic Sans'; font-size: 16px">
    <div class="container-fluid" style="width: 70%" >  
      <div class="container" id="container" style=" width:70%;">       
        <div class="row" style="background-color: #f4f9f8" >
          <div class="col-sm-6" style="text-align: center; color:red;">ALERTA</div>     
        </div>    
        <br>    
        <div class="container">
          <div class="row">
            <div class="col-tit" >Tipo de Campaña: ONLINE</div>      
          </div>      
          <div class="row">
            <div class="col-tit">Campaña: {{$camp}} </div>    
          </div>    
          <div class="row">
            <div class="col-tit">Canal de Venta: {{$lcanal}}</div>    
          </div>         
          <div class="row">
            <div class="col-tit">Teleoperador: {{$eje}}</div>          
          </div>
          <div class="row">
            <div class="col-tit">Fecha de Venta : {{date('d-m-Y', strtotime($venta))}}</div>       
          </div>
          <div class="row">
            <div class="col-tit">ID Grabacion: {{$grab}}</div>        
          </div>
          <br>
          <div class="row">
            <div class="col-sm-6" style="background-color: #f4f9f8;">OBSERVACIONES : {{$observ}} </div>     
          </div>           
          <br>
          <div class="row" style="background-color:  #f4f9f8 "> 
            <div class="col-sm-6" style="text-align: left;">AUDITADO POR : {{$lname}} </div>                           
          </div>   
        </div>
      </div>   
    </div>    
  </body>
</html>
<style>




.row {
    display:flex;
}

#container {
  width:70%;



}
.col-sm-6 {
  width:100%;
  font-size:12px;
  padding:10px;
  color:white;
  border: 1px solid black;
  text-align: center; 

}
.col-tit {
  width:20%;
  font-size:12px;
  padding:10px;
  color:black;
  border: 1px solid black;
  text-align: left;
  font-weight: bold;
}
.col-descrip{
  width:80%;
  font-size:12px;
  padding:10px;
  color:black;
  border: 1px solid;
  text-align: left;
}
.col-observ {
  width:100%;
  font-size:12px;
  padding:10px;
  color:black;
  border: 1px solid;
  text-align: left;
}

body {
    font-family: Verdana;

}



</style>