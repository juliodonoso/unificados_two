<?php
$rut = $_POST['rut'];
$lsrut = proposal::select('proposals.*')   
->where('rutcar',$rut)              
->get();  
$arr[] = $lsrut;
echo json_encode($dat);
dd($arr);

?>