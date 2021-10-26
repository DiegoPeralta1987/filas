<?php
// CONSULTA PERSONA, PRIMERO EN BASE DE DATOS LOCAL, LUEGO EN SIGI
// LUEGO EN IDENTIFICACIONES. 
// SI ENCUENTRA EN SIGI, GUARDA EN BD LOCAL CON ID DE SIGI INCLUIDO
// SI ENCUENTRA EN IDENTIFICACIONES GUARDA EN SIGI Y EN BD LOCAL CON ID SIGI INCLUIDO

header('Content-Type:application/json'); 
 error_reporting(0);
	if(isset($_GET["documento"]) && isset($_GET["tipodocumento"])){
		$json=array();

		$documento		=	$_GET['documento'];
		$tipodocumento	=	$_GET['tipodocumento'];

		$mysqli = new mysqli('172.17.0.78', 'wordpressuser', '#S3rv2019$', 'filas');
		$mysqli->set_charset("utf8");
		if (!$mysqli) {
			die('No se pudo conectar: ' . mysql_error());
		}



			$res1 = $mysqli->query("SELECT * FROM `filas`.personas where ci_persona='$documento' ");
			$res1Array = $res1->fetch_object();
			$id			 = $res1Array->idpersonas;
			$ci			 = $res1Array->ci_persona;
			$doctype = $res1Array->doctype;
			$nombres = $res1Array->nombre;
			$phone = $res1Array->telefono;
			$email = $res1Array->correo;
			$direccion = $res1Array->direccion;
			$ciudad = $res1Array->ciudad;



			if ($ci == $documento) {
						
						$arr = array ('status'=>'ok','fuente'=>'BD LOCAL','id'=>$id,'Documento'=>$ci,'TipoDocumento'=>$doctype, 
						 'nombrecompleto'=>$nombres,'Correo'=>$email, 'Celular'=>$phone, 'Direccion'=>$direccion,'Ciudad'=>$ciudad);
						$json['persona']=$arr;
						echo json_encode($json);
						} 

			 else {

					//CONSULTA EN SIGI
						$ip="http://172.17.0.233:85";
					//	$ip="http://172.17.0.232:8080";

						$url = $ip.'/sngproductos-m/rest/pdw1065';
						$data_string = array(
							"cUsrCd" => "80030880-8",
							"cUsrPSW"=> "80030880-8",
							"aPrsCd"=> "$documento",
							"aPrsTdiId"=> "",
							"aPrsPaiId"=>""
						);
						$data= json_encode($data_string);
						$ch = curl_init($url);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
						curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$result = curl_exec($ch);
						$data = json_decode($result, true);
						
						//EXTRAE DATOS
						$nombres_sigi = $data["SDTClmPrs001"][0]["aPrsNms"];
						$apellidos_sigi = $data["SDTClmPrs001"][0]["aPrsAps"];
						$nacimiento_sigi = $data["SDTClmPrs001"][0]["aPrsNFc"];
						$direccion_sigi = $data["SDTClmPrs001"][0]["aPrsNLg"];
						$pais_sigi = $data["SDTClmPrs001"][0]["aPrsNPaiNm"];
						$idsigi_sigi = $data["SDTClmPrs001"][0]["aPrsId"];
						$nombrecompleto = $data["SDTClmPrs001"][0]["aPrsNm"];
						$correo_sigi =null;
						$celular_sigi=null;
						$doctype_sigi = $data["SDTClmPrs001"][0]["aPrsTdiId"];
						

						
							if($nombres_sigi!=null && $apellidos_sigi!=null){
							//IMPRIME
							$arr = array ('status'=>'ok','fuente'=>'SIGI','Documento'=>$documento, 'Pais'=>$pais_sigi, 
							'Nombre'=>$nombres_sigi,'Apellido'=>$apellidos_sigi, 'FechaNacimiento'=>$nacimiento_sigi,'nombrecompleto'=>$nombrecompleto,
							'Correo'=>$email_sigi, 'Celular'=>$phone_sigi, 'Direccion'=>$direccion_sigi );
							$json['persona']=$arr;
							echo json_encode($json);

						//	$nombres   = $nombres_sigi." ".$apellidos_sigi;
						
							//EXISTE EN SIGI, GUARDAR EN MI BD LOCAL
							$querySigi= "INSERT INTO `filas`.`personas`
										(`ci_persona`,`doctype`,`nombre`,`telefono`,`correo`,
										`direccion`,`idsigi`,`pais`)
										VALUES
										(
										'$documento','$doctype_sigi','$nombrecompleto','$celular_sigi',
										'$correo_sigi','$direccion_sigi','$idsigi_sigi','$pais_sigi');
										";
									$resInsert = $mysqli->query($querySigi);
							}

						//CONSULTA SI DATOS NO SON NULL -- SI SON NULL ES PORQUE NO EXISTE EN SIGI Y CONSULTA EN IDENTIFICACIONES
						if($nombres_sigi==null && $apellidos_sigi==null){

							//	$ip_ide="http://172.17.0.232:8080";  http://172.17.0.233:85/sngproductos-m/rest/pdw1027
									$ip="http://172.17.0.233:85";

								$url_ide = $ip.'/sngproductos-m/rest/pdw1027';
								$data_string_ide = array(
									"cUsrCd" => "80030880-8",
									"cUsrPSW"=> "80030880-8",
									"INaPrsCd"=> "$documento"
								);

								$data_ide= json_encode($data_string_ide);
								$ch_ide = curl_init($url_ide);
								curl_setopt($ch_ide, CURLOPT_POST, 1);
								curl_setopt($ch_ide, CURLOPT_POSTFIELDS, $data_ide);
								curl_setopt($ch_ide, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
								curl_setopt($ch_ide, CURLOPT_RETURNTRANSFER, true);
								$result_ide = curl_exec($ch_ide);
								$data_ide = json_decode($result_ide, true);
								
								//EXTRAE DATOS

								$nombres_ide = $data_ide["aPrsNms"];
								$apellidos_ide = $data_ide["aPrsAps"];
								$nombrecompleto1 = $data_ide["aPrsNm"];
								$nacimiento_ide = $data_ide["aPrsNFc"];
								$direccion_ide = $data_ide["aPrsNLg"];
								$pais_ide = "PARAGUAY";
								$correo_ide =null;
								$celular_ide=null;
								
								//DATOS EXTRAS PARA SIGI
								$sexo_ide = $data_ide["aPrsSx"];
								$nombre1_ide = $data_ide["aPrsNm1"];
								$nombre2_ide = $data_ide["aPrsNm2"];
								$nombre3_ide = $data_ide["aPrsNm3"];
								$apellido1_ide = $data_ide["aPrsAp1"];
								$apellido2_ide = $data_ide["aPrsAp2"];
								$apellido3_ide = $data_ide["aPrsAp3"];
								$estadocivil_ide = $data_ide["aPrsEC"];

								$doctype_ide = 1;

								if($nombres_ide!=null && $apellidos_ide!=null){
								// IMPRIME
									$arr = array ('status'=>'ok','fuente'=>'30','Documento'=>$documento, 'Pais'=>$pais_ide, 'Nombre'=>$nombres_ide,'Apellido'=>$apellidos_ide, 
									'FechaNacimiento'=>$nacimiento_ide,'nombrecompleto'=>$nombrecompleto1,
										'Correo'=>null, 'Celular'=>null, 'Direccion'=>$direccion_ide );
										$json['persona']=$arr;
										echo json_encode($json);

									//GUARDA SIGI
						

								//	$ip_idedos="http://172.17.0.232:8080";
									$ip="http://172.17.0.233:85";

									$url_idedos = $ip.'/sngproductos-m/rest/pdw1029';
									$data_string_idedos = array(
										"cUsrCd" => "80030880-8",
										"cUsrPSW"=> "80030880-8",
											"ModeCd"=>"INS",
											"INdTrnId"=>0,
											"INaPrsCd"=>"$documento",
											"INaPrsTp"=>"PF",
											"INaPrsTdiId"=>1,
											"INaPrsPaiId"=>1,
											"aPrsNm1"=>"$nombre1_ide",
											"aPrsNm2"=>"$nombre2_ide",
											"aPrsNm3"=>"$nombre3_ide",
											"aPrsAp1"=>"$apellido1_ide",
											"aPrsAp2"=>"$apellido2_ide",
											"aPrsAp3"=>"$apellido3_ide",
											"aPrsSx"=>"$sexo_ide",
											"aPrsNFc"=>"$nacimiento_ide",
											"aPrsNLg"=>"",
											"aPrsNPaiId"=>1,
											"aPrsNc"=>"",
											"aPrsECvId"=>1,
											"aPrsEC"=>"$estadocivil_ide",
											"INaPrsId"=>0
									);

									$data_idedos= json_encode($data_string_idedos);
									$ch_idedos = curl_init($url_idedos);
									curl_setopt($ch_idedos, CURLOPT_POST, 1);
									curl_setopt($ch_idedos, CURLOPT_POSTFIELDS, $data_idedos);
									curl_setopt($ch_idedos, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
									curl_setopt($ch_idedos, CURLOPT_RETURNTRANSFER, true);
									$result_idedos = curl_exec($ch_idedos);
									$data_idedos = json_decode($result_idedos, true);
									$idsigi_idedos = $data_idedos["INaPrsId"];
									// GUARDA MI BD

									$nombress   = $nombrecompleto1;


									$queryIDE= "INSERT INTO `filas`.`personas`
										
									(`ci_persona`,`doctype`,`nombre`,`telefono`,`correo`,
									`direccion`,`idsigi`,`pais`)
									VALUES
									(
										'$documento','$doctype_ide','$nombress','$celular_ide',
										'$correo_ide','$direccion_ide',	'$idsigi_idedos','$pais_ide');";
									$resInsert = $mysqli->query($queryIDE);

									echo $queryIDE;

								}

								if($nombress==null && $documento==null){
													$arr = array ('status'=>'error', );
													$json['persona']=$arr;
													echo json_encode($json);
								}

						}else{
                      
                     

						}




















			}





	}else
		printf("Falta algun dato\n");


 mysqli_close($mysqli); 

	
?>