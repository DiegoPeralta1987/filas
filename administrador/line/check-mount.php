<html>
<?php
	if(isset($_POST["documento"]) && isset($_POST["amount"])  && isset($_POST["cc"]) ){
		$json=array();
		
			$documento		=	$_POST['documento'];
			$amount = $_POST['amount'];
			$cc = $_POST['cc'];
			$currency = 'PYG';
			if($cc==3){
			$description = 'Diezmos recibidos vía www.cfa.org.py';
			}
			else if($cc==4){
			$description = 'Ofrendas recibidos vía www.cfa.org.py';
			}
			header ("Location: http://172.17.0.78:89/ws004.php?documento=$documento&amount=$amount&cc=$cc&currency=$currency&description=$description".$process_id);
			
			
	}else
		printf("Falta algun dato\n");
	
	
?>
</html>