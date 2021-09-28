<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta</title>
      <h5>{{ $lasunto }}</h5>
</head>
<body>
<div class="container-fluid" >  
  <div class="container" id="container">
    <!-- Control the column width, and how they should appear on different devices -->
    <div class="row">
      <div class="col-sm-6" style="background-color:red;">ALERTA</div>     
    </div>    
    <div class="row">
      <div class="col-tit">Tipo de Campaña</div>
      <div class="col-descrip">ONLINE</div>     
    </div>
    <div class="row">
      <div class="col-tit">Campaña</div>
      <div class="col-descrip">{{$camp}}</div>     
    </div>
    <div class="row">
      <div class="col-tit">Canal de Venta</div>
      <div class="col-descrip">SOEX</div>     
    </div>
    <div class="row">
      <div class="col-tit">Teleoperador</div>
      <div class="col-descrip">{{$eje}}</div>     
    </div>
    <div class="row">
      <div class="col-tit">Fecha de Venta</div>
      <div class="col-descrip">{{date('d-m-Y', strtotime($venta))}} </div>     
    </div>
    <div class="row">
      <div class="col-tit">Grabacion</div>
      <div class="col-descrip">{{$grab}}</div>     
    </div>
    <div class="row">
      <div class="col-sm-6" style="background-color:red;">OBSERVACIONES</div>     
    </div>   
    <div class="row">           
      <div class="col-observ">{{$observ}}</div>     
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