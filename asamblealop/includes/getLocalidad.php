<?php
	require '../conexion.php';
	
	//$cantid= $_POST['cantidad'];
	

$cantidad =  $_POST['cantidad'];
 if($cantidad>0){ ?>
<br /><br />
<form method="POST">


  <table  class="table table-striped" >
  <thead>
  <tr>
    <th>No.</th>
    <th>Documento</th>
    <th>Datos Personales</th>
    <th>Telefono</th>
    <th>Correo</th>
    <th>Direcccion</th>
    <th>Responsable de la reserva</th>
  </tr>
  </thead>
  <?php




 $cantidad=1;


 While($cantidad<=$_POST['cantidad']){ 
  ?>
<tbody>
  <tr>
    <td><?php echo "$cantidad"; ?></td>
    <td><input type="text" name="documento<?php echo "$cantidad";?>" required="required"></td>
    <td><input type="text" name="nombre<?php echo "$cantidad";?>" required="required"></td>
    <td><input type="text" name="correo<?php echo "$cantidad";?>" required="required"></td>
    <td><input type="text" name="telefono<?php echo "$cantidad";?>" required="required"></td>
    <td><input type="text" name="direccion<?php echo "$cantidad";?>" required="required"></td>
    <td><input type="radio" name="titular"  required="required"><br></td>
  
    
    
    
 <input name="num<?php echo "$cantidad"; ?>" type="hidden">
 <input name="ci<?php echo "$cantidad"; ?>" type="hidden">
 <input name="cantidad" type="hidden" id="cantidad" value="<?php echo "$_POST[cantidad]"; ?>" />

<?php
$cantidad++;
}
?>

  </tr>
  </tbody>
  <tr>
   <td colspan="6" align="right">
   <input class="" type="submit" value="Registrar" />
   <button onclick="location.href='index.html'"   >Volver</button>
   </td>
<?php } ?>  
  </tr>
  </tbody>
</table>
</form>