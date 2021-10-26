<?php
//GUARDA NUEVA PERSONA EN BD LOCAL Y EN SIGI


    if(isset($_GET["documento"])  && isset($_GET["nombreuno"]) && isset($_GET["nombredos"])   
        && isset($_GET["nombretres"])  && isset($_GET["apellidouno"])  && isset($_GET["apellidodos"]) 
         && isset($_GET["sexo"]) && isset($_GET["estadocivil"]) && isset($_GET["nacimiento"])){
        
        $documento             =   $_GET['documento'];
        $tipodocumento         =   1;
        $nombreuno             =   $_GET['nombreuno'];
        $nombredos             =   $_GET['nombredos'];
        $nombretres            =   $_GET['nombretres'];
        $apellidouno           =   $_GET['apellidouno'];
        $apellidodos           =   $_GET['apellidodos'];
        $sexo                  =   $_GET['sexo'];
        $estadocivil           =   $_GET['estadocivil'];
        $nacimiento            =   $_GET['nacimiento'];


  //  $ip="http://172.17.0.232:8080";
    $ip="http://172.17.0.233:85";
    $usuario="80030880-8";
    $pass="80030880-8";


        
        $nombres   = $nombreuno." ".$nombredos." ".$nombretres;
        $apellidos = $apellidouno." ".$apellidodos;

        $mysqli = new mysqli('172.17.0.78', 'wordpressuser', '#S3rv2019$', 'filas');
        $mysqli->set_charset("utf8");
        if (!$mysqli) {
            die('No se pudo conectar: ' . mysql_error());
        }
        
        
            //INSERTA DATOS EN LA BASE DE DATOS LOCAL
            $resInsert = $mysqli->query("INSERT INTO `filas`.`personas`										
                                        (`ci_persona`,`doctype`,`nombre`,`telefono`,`correo`,
                                        `direccion`,`idsigi`,`pais`)
                                        VALUES
                                        (
                                        '$documento','Paraguay','$nombres','$apellidos',
                                        ' ',' ','Paraguay',
                                        1,'$nacimiento');
                                        ");
                                   
            if ($resInsert === TRUE) {


                                    //GUARDA SIGI

                                    //$ip_idedos="http://172.17.0.232:8080";
                                     $ip="http://172.17.0.233:85";

                                    $url_idedos = $ip.'/sngproductos-m/rest/pdw1029';
                                    $data_string_idedos = array(
                                        "cUsrCd" => "$usuario",
                                        "cUsrPSW"=> "$pass",
                                            "ModeCd"=>"INS",
                                            "INdTrnId"=>0,
                                            "INaPrsCd"=>"$documento",
                                            "INaPrsTp"=>"PF",
                                            "INaPrsTdiId"=>1,
                                            "INaPrsPaiId"=>1,
                                            "aPrsNm1"=>"$nombreuno",
                                            "aPrsNm2"=>"$nombredos",
                                            "aPrsNm3"=>"$nombretres",
                                            "aPrsAp1"=>"$apellidouno",
                                            "aPrsAp2"=>"$apellidodos",
                                            "aPrsAp3"=>"",
                                            "aPrsSx"=>"$sexo",
                                            "aPrsNFc"=>"$nacimiento",
                                            "aPrsNLg"=>"",
                                            "aPrsNPaiId"=>1,
                                            "aPrsNc"=>"",
                                            "aPrsECvId"=>1,
                                            "aPrsEC"=>"$estadocivil",
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
                                    
                                    // GUARDA MI BD ID SIGI
                                    $queryIDE= "UPDATE `filas`.`personas`
                                                SET `idsigi` = $idsigi_idedos
                                                WHERE `ci_persona` ='$documento';";
                                    $resInsert = $mysqli->query($queryIDE);


                $res2 = $mysqli->query("SELECT MAX(id) as `id`  from `filas`.`personas`;");
                        $res2Array = $res2->fetch_object();
                        $idUser = $res2Array->id;   
                        
                $arr = array ('status'=>'ok','id'=>$idUser, );
                $json['persona']=$arr;
                echo json_encode($json);

            } else {
                $arr = array ('status'=>'ok', );
                $json['persona']=$arr;
                echo json_encode($json);
            }

        
        
    }else
        printf("Falta algun dato\n");
    
    
    mysqli_close($mysqli); 
    
?>