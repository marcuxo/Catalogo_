<?php
session_start();
class Catalogo
{
    private static $instancia;
    public $dbh;

    private function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=ap_mantencion', 'root', '');
            $this->dbh->exec("SET CHARACTER SET utf8");
            //echo "conectado";
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function singleton()
    {
			if (!isset(self::$instancia)) {
					$miclase = __CLASS__;
					self::$instancia = new $miclase;
			}
			return self::$instancia;
    }

    public function traeDatos_1_7copia($dato)
    {
        try {
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ?');
            $query->bindParam(1, $dato);
            $query2 = $this->dbh->prepare('SELECT * FROM material');
 

            $query->execute();
            $query2->execute();
            $data2 = $query2->fetchAll();
            $data = $query->fetchAll();
            	$salida2="
            	<div class='input-group input-group-sm col-4 py-2'><select class='form-control form-control-sm' name='material'><option value='seccionar' >Seleccione el Material</option>";
                foreach ($data2 as $filas):
                		$salida2.=  "
                		   <option value='".$filas['nombre_material']."' >".$filas['nombre_material']."</option>";
                endforeach;
                $salida2.= "</select></div>";


            if(!empty($data)){

                $salida="<div class='row'>";
                foreach ($data as $fila):
                	if($fila['dato_3'] == "N/A"){
                			$salida.=  "

                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            	$salida .= $salida2;
                            } else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            }
							
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            } else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                        	}
                            

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL" && $fila['dato_2'] == "TIPO"){

                            	$salida.= "
	                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
		                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";

                            	$salida.= "<div id='tipo'><script>traeMaterial()</script></div>";//configuracion tipo

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
		                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            ".$salida2."
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_'4 type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            }else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
	                        }

                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            } else {
                				$salida.=  "
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                        	}
                	} else {
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
                            	";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>";
                            } else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>
	                            <div class='input-group input-group-sm col-4 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2'><br></div>"
	                            ;
                        }
                	}
                    
                endforeach;
                $salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

    //carga todos los items correspondientes al item de familia seleccionado
    public function traeDatos_1_7_2($dato)// ++++++++++++++++++++++++++++++++++uso en modal+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            //esta consulta carga los datos del item material para luego ser cargados en un select
            $query2 = $this->dbh->prepare('SELECT * FROM material');
 

            $query->execute();
            $query2->execute();
            $data2 = $query2->fetchAll();
            $data = $query->fetchAll();
            	//recorrido para el select material
            	$salida2="
            	<div class='input-group input-group-sm col-12'><select class='form-control form-control-sm' name='material'id='materialMod' required><option value='seccionar' >Seleccione el Material</option>";
                foreach ($data2 as $filas):
                		$salida2.=  "
                		   <option value='".$filas['nombre_material']."' >".$filas['nombre_material']."</option>";
                endforeach;
                $salida2.= "</select></div>";


            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='row'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            } else {
                			$salida.=  "
                				
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	$salida .= $salida2;
                            	
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;

                            } else if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;

                            } else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
							
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                           } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                            }  else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                            

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
		                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            ".$salida2."
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div";
                            }else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
	                        }

                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "material"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	
                            	$salida.=  "
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;
                            	$salida .=  "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";

                            } else {
                				$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                           		<input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                           		<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialMOD();
                            	</script>
                            		<input id='acaSaleElTipoMod' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
		                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
                            	";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control'name=''  placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>"
	                            ;
                        }
                	}
                    
                endforeach;
				$salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            $salida .= "
            <div class='input-group input-group-sm col-14 py-2'><span class='input-group-addon' id='sizing-addon2'>Opcional</span>
            <input name='dato_8' type='text' class='form-control' placeholder='Ingrese Dato opcional' aria-describedby='sizing-addon2'><br></div>
            ";
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}


    //carga todos los items correspondientes al item de familia seleccionado
    public function traeDatos_1_7_4($dato)// ++++++++++++++++++++++++++++++++++uso en modal+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            //esta consulta carga los datos del item material para luego ser cargados en un select
            $query2 = $this->dbh->prepare('SELECT * FROM material');
 

            $query->execute();
            $query2->execute();
            $data2 = $query2->fetchAll();
            $data = $query->fetchAll();
            	//recorrido para el select material
            	$salida2="
            	<div class='input-group input-group-sm col-12'><select class='form-control form-control-sm' name='material'id='materialMod' required><option value='seccionar' >Seleccione el Material</option>";
                foreach ($data2 as $filas):
                		$salida2.=  "
                		   <option value='".$filas['nombre_material']."' >".$filas['nombre_material']."</option>";
                endforeach;
                $salida2.= "</select></div>";


            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='row'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            } else {
                			$salida.=  "
                				
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	$salida .= $salida2;
                            	
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;

                            } else if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;

                            } else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
							
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                           } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                            }  else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                            

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
		                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm  col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            ".$salida2."
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div";
                            }else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
	                        }

                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "material"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	
                            	$salida.=  "
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;
                            	$salida .=  "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";

                            } else {
                				$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                           		<input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                           		<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterialNew();
                            	</script>
                            		<input id='acaSaleElTipoNew' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
		                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
                            	";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control'name=''  placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-12 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>"
	                            ;
                        }
                	}
                    
                endforeach;
				$salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            $salida .= "
            <div class='input-group input-group-sm col-14 py-2'><span class='input-group-addon' id='sizing-addon2'>Opcional</span>
            <input name='dato_8' type='text' class='form-control' placeholder='Ingrese Dato opcional' aria-describedby='sizing-addon2'><br></div>
            ";
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}
    
    public function traeDatos_1_7_3respaldo($dato)// ++++++++++++++++++++++++++++++++++uso en modal+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            //esta consulta carga los datos del item material para luego ser cargados en un select
            $query2 = $this->dbh->prepare('SELECT * FROM material');
 

            $query->execute();
            $query2->execute();
            $data2 = $query2->fetchAll();
            $data = $query->fetchAll();
            	//recorrido para el select material
            	$salida2="
            	<div class='input-group input-group-sm col-12'><select class='form-control form-control-sm' name='material' required><option value='seccionar' >Seleccione el Material</option>";
                foreach ($data2 as $filas):
                		$salida2.=  "
                		   <option value='".$filas['nombre_material']."' >".$filas['nombre_material']."</option>";
                endforeach;
                $salida2.= "</select></div>";


            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='row'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	$salida .= $salida2;
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= $salida2;

                            } else if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;

                            }
							
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	}
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	
                           } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= $salida2;
                            }

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	}
                            else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	} else if($fila['dato_3'] == "MATERIAL"){
                            	
                                $salida.= $salida2;
                            }
                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "material"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	}
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                             } else if($fila['dato_3'] == "MATERIAL"){
                                $salida .= $salida2;
                            	 }
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	 }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                            else if($fila['dato_3'] == "MATERIAL"){
                            	
                            	$salida .= $salida2;
                            	} 
                	}
                    
                endforeach;
				$salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}


    public function traeDatos_1_7_3($dato)// ++++++++++++++++++++++++++++++++++uso en modal+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            $query->execute();
            $data = $query->fetchAll();



            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='row'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";
                            }
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	
                           }

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                             }
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	}
                    
                endforeach;
				$salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}


    public function traeDatos_1_7_Xtipo($dato)// ++++++++++++++++++++++++++++++++++uso en mantenedor+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            $query->execute();
            $data = $query->fetchAll();



            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='row'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traetipoXtipo();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traetipoXtipo();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";
                            }
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traetipoXtipo();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	
                           }

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traetipoXtipo();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traetipoXtipo();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                             }
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								traetipoXtipo();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	}
                    
                endforeach;
				$salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}


    public function traeDatos_1_7_Xtipo2($dato)// ++++++++++++++++++++++++++++++++++uso en mantenedor+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            $query->execute();
            $data = $query->fetchAll();



            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='col'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            		<input id='acaSaleElTipo' name='elTipo' value=".$fila['fk_tipo']." class='invisible'>
															
															<input id='acaSaleElTipo' name='sacaTipo' placeholder='Ingrese el nuevo Tipo' class='col-14 form-control form-control-sm'></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            		<input id='acaSaleElTipo' name='elTipo' value=".$fila['fk_tipo']." class='invisible'>
                            
															<input id='acaSaleElTipo' name='sacaTipo' placeholder='Ingrese el nuevo Tipo' class='col-14 form-control form-control-sm'>	</div>";
                            }
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            		<input id='acaSaleElTipo' name='elTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	
															<input id='acaSaleElTipo' name='sacaTipo' placeholder='Ingrese el nuevo Tipo' class='col-14 form-control form-control-sm'></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	
                           }

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            		<input id='acaSaleElTipo' name='elTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	
															<input id='acaSaleElTipo' name='sacaTipo' placeholder='Ingrese el nuevo Tipo' class='col-14 form-control form-control-sm'></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            		<input id='acaSaleElTipo' name='elTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	
															<input id='acaSaleElTipo' name='sacaTipo' placeholder='Ingrese el nuevo Tipo' class='col-14 form-control form-control-sm'></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                             }
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            		<input id='acaSaleElTipo' name='elTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	
															<input id='acaSaleElTipo' name='sacaTipo' placeholder='Ingrese el nuevo Tipo' class='col-14 form-control form-control-sm'></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	}
                    
                endforeach;
				$salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}

    public function traeDatos_1_7_foto($dato)// ++++++++++++++++++++++++++++++++++uso en modal+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            $query->execute();
            $data = $query->fetchAll();



            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='row'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								fotoTipo();
                            	</script>
                            		<input id='fotoTipoD' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								fotoTipo();
                            	</script>
                            		<input id='fotoTipoD' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";
                            }
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								fotoTipo();
                            	</script>
                            		<input id='fotoTipoD' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	
                           }

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								fotoTipo();
                            	</script>
                            		<input id='fotoTipoD' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								fotoTipo();
                            	</script>
                            		<input id='fotoTipoD' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                             }
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='p-0 m-0 b-0'>
                            	<script>
								fotoTipo();
                            	</script>
                            		<input id='fotoTipoD' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	}
                	}
                    
				endforeach;
				
				$salida.= "</div>";
				$salida.= "<div class='input-group input-group-sm col-14 pt-2'>
					<input type='file' name='fotoTipoImg' id='fotoTipoImg' class='form-control form-control-sm ' accept='image/x-png,image/jpeg'>
					</div>";
				
            }else{
                $salida = "No se encontro lo que buscas";
            }
            
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}

	public function traeDatos_1_7($dato)// muestra los inputs en el mantenedor de datos central+
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            //esta consulta carga los datos del item material para luego ser cargados en un select
            $query2 = $this->dbh->prepare('SELECT * FROM material');
 

            $query->execute();
            $query2->execute();
            $data2 = $query2->fetchAll();
            $data = $query->fetchAll();
            	//recorrido para el select material
            	$salida2="
            	<div class='input-group input-group-sm col-9'><select class='form-control form-control-sm' name='material' required><option value='seccionar' >Seleccione el Material</option>";
                foreach ($data2 as $filas):
                		$salida2.=  "
                		   <option value='".$filas['nombre_material']."' >".$filas['nombre_material']."</option>";
                endforeach;
                $salida2.= "</select></div>";


            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="<div class='row'>";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            } else {
                			$salida.=  "
                				
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	$salida .= $salida2;
                            	
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;

                            } else if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeMaterial();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;

                            } else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
							
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                           } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                            }  else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                            

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	
                            	$salida.=  "
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            ".$salida2."
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div";
                            }else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
	                        }

                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "material"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	
                            	$salida.=  "
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;
                            	$salida .=  "
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";

                            } else {
                				$salida.=  "
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                           		<input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                           		<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeMaterial()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
		                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
                            	";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' type='text' class='form-control'name=''  placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>"
	                            ;
                        }
                	}
                    
				endforeach;
				$salida .= "
				<div class='input-group input-group-sm col-9 py-2'><span class='input-group-addon' id='sizing-addon2'>Opcional</span>
				<input name='dato_8' type='text' class='form-control' placeholder='Ingrese Dato opcional' aria-describedby='sizing-addon2'><br></div>
				";
                $salida.= "</div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
			
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}
	
	
	public function traeDatos_1_7_ngls($dato)// muestra los inputs en el mantenedor de datos central+
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ?');
            $query->bindParam(1, $dato);
            //esta consulta carga los datos del item material para luego ser cargados en un select
            $query2 = $this->dbh->prepare('SELECT * FROM material');
 

            $query->execute();
            $query2->execute();
            $data2 = $query2->fetchAll();
            $data = $query->fetchAll();
            	//recorrido para el select material
            	$salida2="
            	<div class='input-group input-group-sm mb-2'><select class='form-control form-control-sm' name='material' id='material' required><option value='seccionar' >Seleccione el Material</option>";
                foreach ($data2 as $filas):
                		$salida2.=  "
                		   <option value='".$filas['nombre_material']."' >".$filas['nombre_material']."</option>";
                endforeach;
                $salida2.= "</select></div>";


            if(!empty($data)){
            	//recorrido para la carga de los items de llenado de datos vacios
                $salida="";
                foreach ($data as $fila):

                	if($fila['dato_3'] == "N/A"){
                			if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeTipoNGLS();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            } else {
                			$salida.=  "
                				
                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeTipoNGLS();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	$salida .= $salida2;
                            	
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeTipoNGLS();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;

                            } else if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
									traeTipoNGLS();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;

                            } else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
							
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	//$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                           } else if($fila['dato_3'] == "MATERIAL"){
														 $salida .= $salida2;
                            	$salida.= "
                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida.=  "
                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            
                            }  else {
                            	$salida.=  "
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                            

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible '>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	
                            	$salida.=  "
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            ".$salida2."
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div";
                            }else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
	                        }

                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "material"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' id='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	
                            	$salida.=  "
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            	<input name='dato_6' id='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	$salida .= "
                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            	$salida .= $salida2;
                            	$salida .=  "
                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' id='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";

                            } else {
                				$salida.=  "
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' id='dato_3' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' id='dato_5' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' id='dato_6' type='text' class='form-control' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                        	}
                	} else {
                			$salida.=  "";
                			if($fila['dato_2'] == "TIPO" && $fila['dato_3'] == "MATERIAL"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida .= $salida2;
                            	$salida.=  "
	                            	<div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' id='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                           		<input name='dato_6' id='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                           		<div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' id='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo'>
                            	<script>
								traeTipoNGLS()
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****

                            	$salida.=  "
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
		                            <input name='dato_3' id='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            	<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
		                            <input name='dato_4' id='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
		                            <input name='dato_5' id='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
		                            <input name='dato_6' id='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
		                            <div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            	<input name='dato_7' id='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            }
                            else if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "
                            	<div class='input-group input-group-sm mb-2 '><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
                            	";
                            	$salida .= $salida2;
                            	$salida.=  "
                            	<div class='input-group input-group-sm mb-2 '><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2 '><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' id='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2 '><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' id='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2 '><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' id='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>";
                            } else {
	                			$salida.=  "
	                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_2']."</span>
	                            <input name='dato_2' id='dato_2' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_3']."</span>
	                            <input name='dato_3' id='dato_3' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_4']."</span>
	                            <input name='dato_4' id='dato_4' type='text' class='form-control'name=''  placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_5']."</span>
	                            <input name='dato_5' id='dato_5' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_6']."</span>
	                            <input name='dato_6' id='dato_6' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>
	                            <div class='input-group input-group-sm mb-2' ><span class='input-group-addon' id='sizing-addon2'>".$fila['dato_7']."</span>
	                            <input name='dato_7' id='dato_7' type='text' class='form-control' name='' placeholder='Ingrese Dato.' aria-describedby='sizing-addon2' required><br></div>"
	                            ;
                        }
                	}
                    
				endforeach;
				$salida .= "
				<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>Opcional</span>
				<input name='dato_8' id='dato_8' type='text' class='form-control form-control-sm' placeholder='Ingrese Dato opcional' aria-describedby='sizing-addon2'><br></div>
				";
                $salida.= "";
            }else{
                $salida = "No se encontro lo que buscas";
            }
			
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
  }

  public function pruebas_copia($dato)
    {
        try {
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
            $query->bindParam(1, $dato);
            $query2 = $this->dbh->prepare('SELECT * FROM material');
 

            $query->execute();
            $query2->execute();
            $data2 = $query2->fetchAll();
            $data = $query->fetchAll();
            	$salida2="<select multiple class='form-control col-3' name='selector'>";
                foreach ($data2 as $filas):
                		$salida2.=  "
                		   <option value='".$filas['nombre_material']."' onclick='sel_material()'>".$filas['nombre_material']."</option>";
                endforeach;
                $salida2.= "</select>";


            if(!empty($data)){

                $salida="";
                foreach ($data as $fila):
                	if($fila['dato_3'] == "N/A"){
                			$salida.=  "
                            <label>".$fila['dato_2']."</label><br><input value='Ingrese Info.'><br>";
                            
                	} else if($fila['dato_4'] == "N/A"){
                			$salida.=  "";
                			if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "<label class='col-form-label-sm'>".$fila['dato_2']."</label><br><input class='form-control form-control-sm col-2' value='Ingrese Info.'><br>";
                            	$salida .= "<label class='col-form-label-sm'>".$fila['dato_3']."</label><br>".$salida2;
                            } else {
                            	$salida.=  "
                            <label class='col-form-label-sm'>".$fila['dato_2']."</label><br><input class='form-control form-control-sm' value='Ingrese Info.'><br>
                            <label class='col-form-label-sm'>".$fila['dato_3']."</label><br><input class='form-control form-control-sm' value='Ingrese Info.'><br>";
                            }
							
                	} else if($fila['dato_5'] == "N/A"){
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "<label class='lead'>".$fila['dato_2']."</label><br><input value='Ingrese Info.'><br>";
                            	$salida .= "<label class='lead'>".$fila['dato_3']."</label><br>".$salida2."<br>";
                            	$salida.=  "<label class='lead'>".$fila['dato_4']."</label><br><input value='Ingrese Info.'><br>";
                            } else {
                            	$salida.=  "
	                            <label>".$fila['dato_2']."</label><br><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_3']."</label><br><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_4']."</label><br><input value='Ingrese Info.'><br>";
                        	}
                            

                	} else if($fila['dato_6'] == "N/A"){
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL" && $fila['dato_2'] == "TIPO"){

                            	$salida.= "<label>".$fila['dato_2']."</label><br><input value='".$fila['fk_tipo']."'><br>";
                            	$salida.= "<select id='id_tipo' onclick='trae_tipo()'> <option >".$fila['fk_tipo']."</option> </select><br>";

                            	$salida .= "<label>".$fila['dato_3']."</label><br>".$salida2."<br>";
                            	$salida.=  "<label>".$fila['dato_4']."</label><br><input value='Ingrese Info.'><br>
                            				<label>".$fila['dato_5']."</label><br><input value='Ingrese Info.'><br>";
                            } else if($fila['dato_3'] == "MATERIAL"){
                            	
                            	$salida.= "<label>".$fila['dato_2']."</label><br><input value='".$fila['fk_tipo']."'><br>";

                            	$salida .= "<label>".$fila['dato_3']."</label><br>".$salida2."<br>";
                            	$salida.=  "<label>".$fila['dato_4']."</label><br><input value='Ingrese Info.'><br>
                            				<label>".$fila['dato_5']."</label><br><input value='Ingrese Info.'><br>";
                            }else {
	                			$salida.=  "
	                            <label>".$fila['dato_2']."</label><br><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_3']."</label><br><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_4']."</label><br><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_5']."</label><br><input value='Ingrese Info.'><br>";
	                        }

                	} else if($fila['dato_7'] == "N/A"){
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "<label>".$fila['dato_2']."</label><br><input value='Ingrese Info.'>";
                            	$salida .= "<label>".$fila['dato_3']."</label><br>".$salida2."<br>";
                            	$salida.=  "<label>".$fila['dato_4']."</label><br><input value='Ingrese Info.'>
                            				<label>".$fila['dato_5']."</label><br><input value='Ingrese Info.'>
                            				<label>".$fila['dato_6']."</label><br><input value='Ingrese Info.'>";
                            } else {
                			$salida.=  "
                            <label>".$fila['dato_2']."</label><br><input value='Ingrese Info.'>
                            <label>".$fila['dato_3']."</label><br><input value='Ingrese Info.'>
                            <label>".$fila['dato_4']."</label><br><input value='Ingrese Info.'>
                            <label>".$fila['dato_5']."</label><br><input value='Ingrese Info.'>
                            <label>".$fila['dato_6']."</label><br><input value='Ingrese Info.'>";
                        	}
                	} else {
                			$salida.=  "";
                            if($fila['dato_3'] == "MATERIAL"){
                            	$salida.= "<label>".$fila['dato_2']."</label><br><input value='Ingrese Info.'><br>";
                            	$salida .= "<label>".$fila['dato_3']."</label><br>".$salida2."<br>";
                            	$salida.=  "<label>".$fila['dato_4']."</label><br><input value='Ingrese Info.'><br>
                            				<label>".$fila['dato_5']."</label><br><input value='Ingrese Info.'><br>
                            				<label>".$fila['dato_6']."</label><br><input value='Ingrese Info.'><br>
                            				<label>".$fila['dato_7']."</label><br><input value='Ingrese Info.'><br>";
                            } else {
	                			$salida.=  "
	                            <label>".$fila['dato_2']."</label><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_3']."</label><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_4']."</label><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_5']."</label><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_6']."</label><input value='Ingrese Info.'><br>
	                            <label>".$fila['dato_7']."</label><input value='Ingrese Info.'>";
                        }
                	}
                    
                endforeach;
                $salida.= "";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
  }

        //carga el primer select multiple donde se cargan los datos de los grupos de repuestos
	public function TraeGrupo()
	{
        try {
            $query = $this->dbh->prepare('SELECT * FROM grupo');

            $query->execute();

            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='form-group'><select multiple class='form-control form-control-sm' name='grupo' id='grupo' style='height:110px'>";
                foreach ($data as $fila):
                        $salida.=  "
                           <option value='".$fila['nombre_grupo']."' onclick='carga_familia()'>".$fila['nombre_grupo']."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}

	
	
	    //carga el primer select multiple donde se cargan los datos de la familia de repuestos
	public function traer_familia($dato)
	{
        try {
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ? AND estado_familia = "1"');
			$query->bindParam(1, $dato);
            $query->execute();

            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='form-group'><select multiple class='form-control form-control-sm' name='familia' id='selector' style='height:110px'>";
                foreach ($data as $fila):
                		$salida.=  "
                		   <option value='".$fila['nombre']."' onclick='traeDatos()'>".$fila['nombre']."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}
	
	public function traer_familia_ngls($dato)
	{
        try {
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ? ');
			$query->bindParam(1, $dato);
            $query->execute();

            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='form-group'><select class='form-control form-control-sm' name='familiaNGLS_sel' id='familiaNGLS_sel' onclick='selFamiliaNGLS()'><option value='1' onclick='selFamiliaNGLS()'>Seleccione Familia ...</option>";
                foreach ($data as $fila):
                		$salida.=  "
                		   <option value='".$fila['nombre']."' onclick='selFamiliaNGLS()'>".$fila['nombre']."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}

	public function traer_familia2($dato)
    {
        try {
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ? AND estado_familia = "1"');
			$query->bindParam(1, $dato);
            $query->execute();

            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='form-group'><select class='form-control form-control-sm' name='familia' id='familia' onclick='selFamilia()'><option value='1' onclick='selFamilia()'>Selecciona Familia</option>";
                foreach ($data as $fila):
                		$salida.=  "
                		   <option value='".$fila['nombre']."' onclick='selFamilia()'>".$fila['nombre']."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}
	
	public function traer_familia_foto($dato)
	{
			try {
					$query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ? AND estado_familia = "1"');
		$query->bindParam(1, $dato);
					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='form-group'><select class='form-control form-control-sm' name='familia' id='familiaFoto' onclick='selFamiliaFoto()'><option value='1' onclick='selFamiliaFoto()'>Selecciona Familia</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre']."' onclick='selFamiliaFoto()'>".$fila['nombre']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}

  public function traer_familia3($dato)
    {
        try {
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ? AND estado_familia = "1"');
			$query->bindParam(1, $dato);
            $query->execute();

            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='form-group'><select class='form-control form-control-sm' name='familia' id='familiaSelPag' onclick='selFamilia2()'><option value='1' onclick='selFamilia2()'>Selecciona Familia</option>";
                foreach ($data as $fila):
                		$salida.=  "
                		   <option value='".$fila['nombre']."' onclick='selFamilia2()'>".$fila['nombre']."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
  }

	public function traer_familia4($dato)
	{
			try {
					$query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ?');
		$query->bindParam(1, $dato);
					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='form-group'><select class='form-control form-control-sm' name='familiaNew' id='familiaNew' onclick='selFamilia3()'><option value='1' onclick='selFamilia3()'>Selecciona Familia</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre']."' onclick='selFamilia3()'>".$fila['nombre']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}


	public function traer_familiaXtipo($dato)
	{
			try {
					$query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ? AND estado_familia = "1"');
		$query->bindParam(1, $dato);
					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='form-group'><select class='form-control form-control-sm' name='familia' id='familiaXfoto' onclick='selFamiliaXfoto();loadImagenXtipo()'><option value='1' onclick='selFamiliaXfoto();loadImagenXtipo()'>Selecciona Familia</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre']."' onclick='selFamiliaXfoto();loadImagenXtipo()'>".$fila['nombre']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}

	public function traer_familiaAGFT($dato)
	{
			try {
					$query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ? AND estado_familia = "1"');
		$query->bindParam(1, $dato);
					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='form-group'><select class='form-control form-control-sm' name='familiaAGFT' id='familiaAGFT' onclick='familiAGFT_sel()'><option value='1' onclick='familiAGFT_sel()'>Selecciona Familia</option>";
							foreach ($data as $fila):
									$salida.=  "
										 <option value='".$fila['nombre']."' onclick='familiAGFT_sel()'>".$fila['nombre']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
}

	public function traer_material()//sin uso
	{
			try {
					$query = $this->dbh->prepare('SELECT nombre_material FROM material');
					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='input-group input-group-sm'><select class='form-control form-control-sm' name='tipo'>
								<option value='seccionar' onclick='sel_material()'>ComboBox Provisorio!!</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre_material']."'>".$fila['nombre_material']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida .= "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}

	public function buscaTipo($dato) //+++++++++++++++++++++++++++++++++++++++++++++++++++++en uso++++++++++++++++++++++++++++++++++++
	{
		try {
					$query = $this->dbh->prepare('SELECT nombre_tipo FROM '.$dato.'');

					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='input-group input-group-sm col-14'><select class='form-control form-control-sm' name='tipo' id='tipoSelMod' required>
							<option value='seleccionar'>Seleccione el Tipo</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre_tipo']."'>".$fila['nombre_tipo']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}

	public function buscaTipoXtipo($dato) //+++++++++++++++++++++++++++++++++++++++++++++++++++++en uso++++++++++++++++++++++++++++++++++++
	{
		try {
					$query = $this->dbh->prepare('SELECT nombre_tipo FROM '.$dato.'');

					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='input-group input-group-sm col-14'><select onclick='loadImagenXtipo()' class='form-control form-control-sm' name='tipo' id='tipoXtipo' required>
							<option onclick='loadImagenXtipo()' value='seleccionar'>Seleccione el Tipo</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre_tipo']."' onclick='loadImagenXtipo()'>".$fila['nombre_tipo']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}


	public function buscaTipoFoto($dato) //+++++++++++++++++++++++++++++++++++++++++++++++++++++en uso++++++++++++++++++++++++++++++++++++
	{
		try {
					$query = $this->dbh->prepare('SELECT nombre_tipo FROM '.$dato.'');

					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='input-group input-group-sm col-14'><select class='form-control form-control-sm' name='tipo' id='tipoSelMod' required>
							<option value='seleccionar'>Seleccione el Tipo</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre_tipo']."'>".$fila['nombre_tipo']."</option>";
							endforeach;
			$salida.= "</select></div>";
			
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}


	public function buscaTipo2($dato) //+++++++++++++++++++++++++++++++++++++++++++++++++++++en uso++++++++++++++++++++++++++++++++++++
	{
		try {
					$query = $this->dbh->prepare('SELECT nombre_tipo FROM '.$dato.'');

					$query->execute();


					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<div class='input-group input-group-sm col-14'><select class='form-control form-control-sm' name='tipo' id='tiposel' required>
							<option value='seleccionar'>Seleccione el Tipo</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre_tipo']."'>".$fila['nombre_tipo']."</option>";
							endforeach;
							$salida.= "</select></div>";
					}else{
							$salida = "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
}
	
	public function Correo($msg)
	{
		$to = 'crusok@live.cl';
			$subject = 'Verificacion de Datos';
			//$message = 'Hola mundo desde el mail';
			$headers[]= 'MiME-Version: 1.0';
			$headers[]= 'Content-type: text/html; charset=iso-8859-1';

			mail($to, $subject, $msg, implode("\r\n", $headers));
			echo "Correo enviado, revisa la bandeja de entrada o spam del correo ".$to;

	}

	public function Login($user, $pass)
	{
			try {
					$query = $this->dbh->prepare('SELECT * FROM login_mantenedor WHERE usuario = binary ? AND clave = ?');
					$query->bindParam(1, $user);
					$query->bindParam(2, $pass);
					$query->execute();

					$data = $query->fetchAll();

					$_SESSION["usuario"] = $data[0]["nombre_login"];
					if($data[0]["estado_login"] == "1"){
						if(!empty($data)){
							echo $data[0]["tipo_user_login"];
						}else{
								echo "no_ok";
						}
					} else {
						echo "bloqueo";
					}
	
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}

	// metodo que recibe un parametro para buscar las coincidencias en la base de datos
	public function BuscarB($dato)
	{
        try {
            $query = $this->dbh->prepare('SELECT * FROM all_items WHERE descripcion LIKE ? OR serie LIKE ? OR material LIKE ? OR medida LIKE ? OR subfamilia LIKE ? OR familia LIKE ?');
            //$query = $this->dbh->prepare('SELECT * FROM all_items WHERE descripcion LIKE ?');
            $query->bindParam(1, $dato);
            $query->bindParam(2, $dato);
            $query->bindParam(3, $dato);
            $query->bindParam(4, $dato);
			$query->bindParam(5, $dato);
			$query->bindParam(6, $dato);
			
            $query->execute();

            $data = $query->fetchAll();
            $cont = count($data);
            $salida;
            if(!empty($data)){
                $salida ="<label class=''>Los resultados de la busqueda son ".$cont."</label>
                <div class='input-group input-group-sm py-2'>
                <select multiple class='form-control form-control-sm' id='selectBuscado' name='tipo' required style='height:320px'>
                ";
                foreach ($data as $fila):
                        $salida.=  "
                           <option value='".$fila['img']."' onclick='itemSeleccionado()'>".$fila['codigo']."*".$fila['descripcion']."*".$fila['familia']."*".$fila['subfamilia']."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}
	
  public function ingresoDatos($img,$grupo,$familia,$tipo,$material,$dato_2,$dato_3,$dato_4,$dato_5,$dato_6,$dato_7)
	{
		try{
			$query = $this->dbh->prepare('INSERT INTO datos_formalizados VALUES(null,"0",?,"N/A","N/A",?,?,?,?,?,?,?,?,?,?)');
			$query->bindParam(1, $img);
			$query->bindParam(2, $grupo);
			$query->bindParam(3, $familia);
			$query->bindParam(4, $tipo);
			$query->bindParam(5, $material);
			$query->bindParam(6, $dato_2);
			$query->bindParam(7, $dato_3);
			$query->bindParam(8, $dato_4);
			$query->bindParam(9, $dato_5);
			$query->bindParam(10, $dato_6);
			$query->bindParam(11, $dato_7);

			$query->execute();
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}
   
	public function buscaParaEditar($data_1,$data_2,$data_3)
    {
    	try {
			//$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE '.$data_1.' AND familia LIKE '.$data_2.' OR subfamilia LIKE '.$data_3.'');
			//$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE ? AND familia LIKE ? OR subfamilia LIKE ?');
			$query = $this->dbh->prepare('SELECT * FROM all_items WHERE estado_item = 1 AND (grupo LIKE ? or familia LIKE ?)');
			$query->bindParam(1, $data_1);
            $query->bindParam(2, $data_2);
            //$query->bindParam(3, $data_3);
            $query->execute();


            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='input-group input-group-sm col-14'><select multiple class='form-control form-control-sm table-hover' name='editorB' id='editorB' style='height:320px'>";
                foreach ($data as $fila):
                		$salida.=  "
                		   <option value='' onclick='modalShow();muestra();'>".$fila['codigo']."*".$fila['grupo']."*".$fila['familia']."*".$fila['subfamilia']."*".$fila['descripcion']."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}
	
	public function buscaParaEditarUser($data_1,$data_2,$data_3)
    {
    	try {
			//$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE '.$data_1.' AND familia LIKE '.$data_2.' OR subfamilia LIKE '.$data_3.'');
			//$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE ? AND familia LIKE ? OR subfamilia LIKE ?');
			$query = $this->dbh->prepare('SELECT * FROM datos_formalizados WHERE grupo_dato_f LIKE ? AND familia_dato_f LIKE ? AND dato1_dato_f LIKE ? AND estado_dato_f = 1');
			$query->bindParam(1, $data_1);
            $query->bindParam(2, $data_2);
            $query->bindParam(3, $data_3);
            $query->execute();


			$data = $query->fetchAll();
			$textConcat = "";
            if(!empty($data)){
                $salida="<div class='input-group input-group-sm col-14'><select multiple class='form-control form-control-sm table-hover' name='buscaUserImg' id='buscaUserImg' style='height:320px'>";
				foreach ($data as $fila):
					if($fila['dato1_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato1_dato_f'];
					}if($fila['dato2_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato2_dato_f'];
					}if($fila['dato3_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato3_dato_f'];
					}if($fila['dato4_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato4_dato_f'];
					}if($fila['dato5_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato5_dato_f'];
					}if($fila['dato6_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato6_dato_f'];
					}if($fila['dato7_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato7_dato_f'];
					}if($fila['dato8_dato_f'] != "N/A"){
						$textConcat .= "*".$fila['dato8_dato_f'];
					}
						$salida.=  "
                		   <option value='' onclick='showwwwImagen();'>".$fila['codigo_dato_f']."*".$fila['grupo_dato_f']."*".$fila['familia_dato_f']."".$textConcat."</option>";
                endforeach;
                $salida.= "</select></div>";
            }else{
                $salida = "No se encontro lo que buscas";
            }

            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
    }

	public function agregaFotoTipo($fami, $tipo, $img)
	{
		echo("se agrega la foto al tipo".$fami." ".$tipo." ".$img);
		try{
			$query = $this->dbh->prepare('INSERT INTO foto_tipo VALUES(null,?,?,?)');
			$query->bindParam(1, $fami);
			$query->bindParam(2, $tipo);
			$query->bindParam(3, $img);
			$query->execute();
			header('Location: ../vista/Mantenedor_Datos_.php');
			$this->dbh = null;
		} catch (PDOException $e){
				$e->getMessage();
		}
	}

	public function cargaImagenRES($fam, $tipo)//carga las imagenes de la tabla de imagenes por tipo
	{
		if($tipo != "N/A"){
			try {
				$query = $this->dbh->prepare('SELECT * FROM foto_tipo WHERE nombre_famili_foto = ? AND nombre_tipo_foto = ?');
				$query->bindParam(1, $fam);
				$query->bindParam(2, $tipo);
				
				$query->execute();
	
				$data = $query->fetchAll();
				$cont = count($data);
				$salida;
				if(!empty($data)){
					$salida ="<div class='col-12 fondo'></div>";
									foreach ($data as $fila):
										if($fila['nombre_tipo_foto'] != "N/A"){
											$salida.= "
											<div class='card m-2 fondo' style='width: 15rem;'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image'>
												<div class='card-block'>
													<p class='card-text'>".$fila['nombre_famili_foto']." ".$fila['nombre_tipo_foto']."</p>
												</div>
											</div>
											";
										} else {
											$salida.= "
											<div class='card m-2 fondo' style='width: 15rem;'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image'>
												<div class='card-block'>
													<p class='card-text'>".$fila['nombre_famili_foto']."</p>
												</div>
											</div>
											";
										}
	
					endforeach;
					$salida.= "";
				}else{
					$salida = "No se encontro lo que buscas";
				}
				echo $salida;
				$this->dbh = null;
			}catch (PDOException $e) {
				$e->getMessage();
			}
		} else {
			try {
				$query = $this->dbh->prepare('SELECT * FROM foto_tipo WHERE nombre_famili_foto = ?');
				$query->bindParam(1, $fam);
				
				$query->execute();
	
				$data = $query->fetchAll();
				$cont = count($data);
				$salida;
				if(!empty($data)){
					$salida ="<div class='col-12 fondo'></div>";
									foreach ($data as $fila):
										if($fila['nombre_tipo_foto'] != "N/A"){
											$salida.= "
											<div class='card m-2 fondo' style='width: 15rem;'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image'>
												<div class='card-block'>
													<p class='card-text'>".$fila['nombre_famili_foto']." ".$fila['nombre_tipo_foto']."</p>
												</div>
											</div>
											";
										} else {
											$salida.= "
											<div class='card m-2 fondo' style='width: 15rem;'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image'>
												<div class='card-block'>
													<p class='card-text'>".$fila['nombre_famili_foto']."</p>
												</div>
											</div>
											";
										}
	
					endforeach;
					$salida.= "";
				}else{
					$salida = "No se encontro lo que buscas";
				}
				echo $salida;
				$this->dbh = null;
			}catch (PDOException $e) {
				$e->getMessage();
			}
		}
	}

	public function cargaImagen($fam, $tipo)//carga las imagenes de la tabla de imagenes por tipo
	{
		if($tipo != "N/A"){
			try {
				$query = $this->dbh->prepare('SELECT * FROM foto_tipo WHERE nombre_famili_foto = ? AND nombre_tipo_foto = ?');
				$query->bindParam(1, $fam);
				$query->bindParam(2, $tipo);
				
				$query->execute();
	
				$data = $query->fetchAll();
				$cont = count($data);
				$salida;
				if(!empty($data)){
					$salida ="<div class='col-12 fondo'></div>";
									foreach ($data as $fila):
										if($fila['nombre_tipo_foto'] != "N/A"){
											$salida.= "
											<div class='col-2 m-2 fondo'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image' width='150px'>
												<div class='col'>
													<p class='lead'>".$fila['nombre_famili_foto']." ".$fila['nombre_tipo_foto']."</p>
												</div>
											</div>
											";
										} else {
											$salida.= "
											<div class='col-2 m-2 fondo'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image' width='150px'>
												<div class='col'>
													<p class='card-text'>".$fila['nombre_famili_foto']."</p>
												</div>
											</div>
											";
										}
	
					endforeach;
					$salida.= "";
				}else{
					$salida = "No se encontro lo que buscas";
				}
				echo $salida;
				$this->dbh = null;
			}catch (PDOException $e) {
				$e->getMessage();
			}
		} else {
			try {
				$query = $this->dbh->prepare('SELECT * FROM foto_tipo WHERE nombre_famili_foto = ?');
				$query->bindParam(1, $fam);
				
				$query->execute();
	
				$data = $query->fetchAll();
				$cont = count($data);
				$salida;
				if(!empty($data)){
					$salida ="<div class='col-12 fondo'></div>";
									foreach ($data as $fila):
										if($fila['nombre_tipo_foto'] != "N/A"){
											$salida.= "
											<div class='col-2 m-2 fondo' style='width: 15rem;'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image' width='150px'>
												<div class='col'>
													<p class='card-text'>".$fila['nombre_famili_foto']." ".$fila['nombre_tipo_foto']."</p>
												</div>
											</div>
											";
										} else {
											$salida.= "
											<div class='col-2 m-2 fondo' style='width: 15rem;'>
												<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image' width='150px'>
												<div class='col'>
													<p class='card-text'>".$fila['nombre_famili_foto']."</p>
												</div>
											</div>
											";
										}
	
					endforeach;
					$salida.= "";
				}else{
					$salida = "No se encontro lo que buscas";
				}
				echo $salida;
				$this->dbh = null;
			}catch (PDOException $e) {
				$e->getMessage();
			}
		}
	}

		
	public function cargaImagen2($fam, $tipo)//carga las imagenes de la tabla de imagenes por tipo
	{
		try {
            $query = $this->dbh->prepare('SELECT * FROM foto_tipo WHERE nombre_famili_foto = ? AND nombre_tipo_foto = ?');
            $query->bindParam(1, $fam);
            $query->bindParam(2, $tipo);
			
            $query->execute();

            $data = $query->fetchAll();
            $cont = count($data);
            $salida;
            if(!empty($data)){
				$salida ="<div class='col-12 fondo'></div>";
								foreach ($data as $fila):
									if($fila['nombre_tipo_foto'] != "N/A"){
										$salida.= "
										<div class='card m-2 fondo' style='width: 15rem;'>
											<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image' height='200px'>

										</div>
										";
									} else {
										$salida.= "
										<div class='card m-2 fondo' style='width: 15rem;'>
											<img class='w-100' src='".$fila['imagen_tipo_foto']."' alt='Card image' height='200px'>

										</div>
										";
									}

                endforeach;
                $salida.= "";
            }else{
                $salida = "No se encontro lo que buscas";
            }
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}

	public function cargaInactivos()
	{
		try {
			$query = $this->dbh->prepare('SELECT * FROM datos_formalizados WHERE estado_dato_f = 2');
			//$query = $this->dbh->prepare('SELECT * FROM all_items WHERE descripcion LIKE ?');
			//$query->bindParam(1, $dato);

			$query->execute();

			$data = $query->fetchAll();
			$cont = count($data);
			$salida;
			if(!empty($data)){
					$salida ="<select multiple name='itemInactivo' id='itemInactivo' class='col-12 form-control' style='height:220px'>";
					foreach ($data as $fila):
			$salida.= "
				<option value='".$fila['id_dato_f']."' onclick='selInactivo()'>".$fila['codigo_dato_f']." ".$fila['grupo_dato_f']." ".$fila['familia_dato_f']." ".$fila['dato1_dato_f']." ".$fila['dato2_dato_f']." ".$fila['dato3_dato_f']." ".$fila['dato4_dato_f']." ".$fila['dato5_dato_f']." ".$fila['dato6_dato_f']."</option>
										";
					endforeach;
					$salida.= "</select>";
			}else{
					$salida = "<p class='lead text-white'>No hay datos INACTIVOS en estos momemntos.</p>";
			}
			echo $salida;
			$this->dbh = null;
		}catch (PDOException $e) {
			$e->getMessage();
		}
	}

	public function cargaActivos()
	{
		try {
            $query = $this->dbh->prepare('SELECT * FROM datos_formalizados WHERE estado_dato_f = "1"');
            //$query = $this->dbh->prepare('SELECT * FROM all_items WHERE descripcion LIKE ?');
            //$query->bindParam(1, $dato);
			
            $query->execute();

            $data = $query->fetchAll();
            $cont = count($data);
            $salida;
            if(!empty($data)){
                $salida ="<select multiple name='itemActivo' id='itemActivo' class='col-12 form-control' style='height:220px'>";
                foreach ($data as $fila):
						$salida.= "
							<option value='".$fila['id_dato_f']."' onclick='selActivo()'>".$fila['grupo_dato_f']." ".$fila['familia_dato_f']." ".$fila['dato1_dato_f']." ".$fila['dato2_dato_f']." ".$fila['dato3_dato_f']." ".$fila['dato4_dato_f']." ".$fila['dato5_dato_f']." ".$fila['dato6_dato_f']."</option>
                        	";
                endforeach;
                $salida.= "</select>";
            }else{
                $salida = "<p class='lead text-success'>No hay datos ACTIVOS en estos momemntos.</p>";
            }
            echo $salida;
            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}

	public function downItem($id)
	{
		try{
			$query = $this->dbh->prepare('UPDATE datos_formalizados SET estado_dato_f = 0 WHERE ID_DATO_F = ?');
			$query->bindParam(1, $id);

			$query->execute();
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function upItem($id)
	{
		try{
			$query = $this->dbh->prepare('UPDATE datos_formalizados SET estado_dato_f = 1 WHERE ID_DATO_F = ?');
			$query->bindParam(1, $id);

			$query->execute();
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function addDato_DM($code, $grupo, $familia, $tipo, $material, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $fechora)
	{
		echo "Datos Ingresados Correctamente : ".$code.$grupo.$familia.$tipo.$material.$dato3.$dato4.$dato5.$dato6.$dato7.$dato8;

		try{
			$query = $this->dbh->prepare('INSERT INTO datos_formalizados VALUES(null,"1","N/A",?,"N/A",?,?,?,?,?,?,?,?,?,?,?,"--/--/--/ --:--:--")');
			$query->bindParam(1, $code);
			$query->bindParam(2, $grupo);
			$query->bindParam(3, $familia);
			$query->bindParam(4, $tipo);
			$query->bindParam(5, $material);
			$query->bindParam(6, $dato3);
			$query->bindParam(7, $dato4);
			$query->bindParam(8, $dato5);
			$query->bindParam(9, $dato6);
			$query->bindParam(10, $dato7);
			$query->bindParam(11, $dato8);
			$query->bindParam(12, $fechora);

			$query->execute();

			$query2 = $this->dbh->prepare('UPDATE all_items SET estado_item = 0 WHERE CODIGO = ?');
			$query2->bindParam(1, $code);
			$query2->execute();
			echo "Datos ingresados correctamente<br>";
			echo "Sera redireccionado en 3 segundos<br>";
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=../vista/Mantenedor_Datos_.php'>";
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function addDato_DC($dato_1, $dato_2, $dato_3, $dato_4)
	{
		echo "Desde class=".$dato_1.$dato_2.$dato_3.$dato_4;

		try{
			$query = $this->dbh->prepare('INSERT INTO datos_formalizados VALUES(null,"0","N/A","N/A",?,?,?,?,"N/A","N/A","N/A","N/A","N/A","N/A","N/A")');

			$query->bindParam(1, $dato_4);
			$query->bindParam(2, $dato_1);
			$query->bindParam(3, $dato_2);
			$query->bindParam(4, $dato_3);

			$query->execute();
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function addNewTipo($tabla, $newTipo)
	{
		try{
				$query = $this->dbh->prepare('SELECT * FROM '.$tabla.' WHERE nombre_tipo = '.$newTipo.'');
				$query->execute();

				$data = $query->fetchAll();
				if(empty($data)){
					$query = $this->dbh->prepare('INSERT INTO '.$tabla.' VALUES ("'.$newTipo.'")');
					$query->execute();
					echo "Datos ingresados correctamente<br>";
					echo "Sera redireccionado en 3 segundos<br>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=../vista/Mantenedor_Datos_.php'>";
				}else{
						echo "El dato que se intenta ingresar YA EXISTE.";
						echo "Sera redireccionado en 3 segundos<br>";
						echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=../vista/Mantenedor_Datos_.php'>";
				}
				$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function crearTabla(){
		try{
			$query = $this->dbh->prepare('CREATE TABLE marco_urrutia(id varchar(50),nombre varchar(INSERT ))');
			$query->execute();
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function addUserDB($user, $pass, $nombre, $info, $tipo,$fecha){
		try {
            $query = $this->dbh->prepare('INSERT INTO login_mantenedor VALUES(null, ?, ?, ?, "1", ?, ?, ?)');
            $query->bindParam(1, $user);
            $query->bindParam(2, $pass);
            $query->bindParam(3, $nombre);
            $query->bindParam(4, $info);
            $query->bindParam(5, $tipo);
            $query->bindParam(6, $fecha);
            $query->execute();

            $this->dbh = null;
        }catch (PDOException $e) {
            $e->getMessage();
        }
	}

	public function loadUsers(){
		try {
			$query = $this->dbh->prepare('SELECT * FROM login_mantenedor ORDER BY nombre_login ASC');

			$query->execute();

			$data = $query->fetchAll();
			$salida;
			if(!empty($data)){
				$salida ="<select multiple name='selUserDB' id='selUserDB' class='col-12 form-control form-control-sm'>";
				foreach ($data as $fila):
				$salida.= "
				<option value='".$fila['id']."' onclick='seleccionaUser()'>".$fila['nombre_login']."</option>
										";
				endforeach;
				$salida.= "</select>";
			}else{
				$salida = "<p class='lead text-success'>Upss! no se cargaron los datos</p>";
			}
			echo $salida;
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}

	public function traemeElUser($id)
	{
		try {
			$query = $this->dbh->prepare('SELECT * FROM login_mantenedor WHERE id = '.$id.'');

			$query->execute();
			$data = $query->fetchAll();
			$salida ="";
			if(!empty($data)){
					foreach ($data as $fila):
						$salida.= "
						
						<label><small>Nombre:</small></label><label class='invisible' id='crudUserId' value='".$fila['id']."'></label>
							<input type='text' class='form-control form-control-sm mb-2' value='".$fila['nombre_login']."' name='crudNombre' id='crudNombre' readonly>
						<label><small>Nombre de Usuario:</small></label>
							<input type='text' class='form-control form-control-sm mb-2' value='".$fila['usuario']."' name='crudUser' id='crudUser'>
						<label><small>Contraseña actual:</small></label><a onmousedown='verClaveOld()' onmouseup='ocultaClaveOld()' class=''><i class='pl-5 fas fa-eye'></i></a>	<label><small>Ver clave</small></label>
							<input type='password' class='form-control form-control-sm mb-2' value='".$fila['clave']."' name='' id='crudClaveO' readonly>
						<label><small>Nueva Contraseña:</small></label><a onmousedown='verClave()' onmouseup='ocultaClave()' class=''><i class='pl-5 fas fa-eye'></i></a>	<label><small>Ver clave</small></label>
							<input type='password' class='form-control form-control-sm mb-2' placeholder='Ingrese La nueva Clave' name='crudClaveN' id='crudClaveN'>
						<label><small>Tipo de Cuenta:</small></label>
							<input type='text' class='form-control form-control-sm mb-2' value='".$fila['tipo_user_login']."' name='crudTypoCuentaOld' id='crudTypoCuentaOld' readonly>
						<select name='crudTypoCuentaNew' id='crudTypoCuentaNew' class='form-control form-control-sm'>
							<option value='0'>Selecciona nuevo tipo de cuenta</option>
							<option value='Administrador'>Administrador</option>
							<option value='Privilegiado'>Privilegiado</option>
						</select>
						<label><small>Comentario:</small></label>
							<input type='text' class='form-control form-control-sm mb-2' value='".$fila['info']."' name='crudInfo' id='crudInfo' required>";
							if($fila['estado_login'] == "0"){
								$salida.= "
								<input type='text' class='form-control form-control-sm mb-2' value='Estado de la cuenta DESACTIVADO' name='crudTypoCuentaOld' id='crudTypoCuentaOld' readonly>
								<select name='crudActivaDesactivaCta' id='crudActivaDesactivaCta' class='form-control form-control-sm'>
									<option value='3'>Active o desactive la Cuenta</option>
									<option value='1'>Activar</option>
									<option value='0'>Desactivar</option>
								</select>
												";
							} else {
								$salida.= "
								<input type='text' class='form-control form-control-sm mb-2' value='Estado de la cuenta ACTIVADO' readonly>
								<select name='crudActivaDesactivaCta' id='crudActivaDesactivaCta' class='form-control form-control-sm'>
									<option value='3'>Active o desactive la Cuenta</option>
									<option value='1'>Activar</option>
									<option value='0'>Desactivar</option>
								</select>
												";
							}
							
					endforeach;
					$salida.= "";
			}else{
					$salida = "<p class='lead text-success'>Upss! no se cargaron los datos</p>";
			}
			echo $salida;
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}

	public function updateUserCrud($id,$nombre,$usuario,$nClave,$tCuenta,$info,$stado)
	{
		// echo "class: ".$id.$nombre.$usuario.$nClave.$tCuenta.$info;
		try{
			$query = $this->dbh->prepare('UPDATE login_mantenedor SET usuario = ?, clave = ?, estado_login = ?, info = ?, tipo_user_login = ? WHERE id = ?');
			$query->bindParam(1, $usuario);
			$query->bindParam(2, $nClave);
			$query->bindParam(3, $stado);
			$query->bindParam(4, $info);
			$query->bindParam(5, $tCuenta);
			$query->bindParam(6, $id);

			$query->execute();
			echo "ok";
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function addNewFamili($grupo,$familia)
	{
		try{
			$query = $this->dbh->prepare('INSERT INTO familia_2 VALUES(?, null, ?,"2")');
			$query->bindParam(1, $familia);
			$query->bindParam(2, $grupo);
			$query->execute();

			$query2 = $this->dbh->prepare('INSERT INTO items_db_2 VALUES(?,null,null,null,null,null,null,null,"2",null,null)');
			$query2->bindParam(1, $familia);
			$query2->execute();

			if($query->execute()){
				echo "ok";
			} else {
				echo "no_ok";
			}
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function traeLosMateriales()
	{
			try {
					$query = $this->dbh->prepare('SELECT nombre_material FROM material');
					$query->execute();

					$data = $query->fetchAll();
					if(!empty($data)){
							$salida="<select class='form-control form-control-sm' name='materialAddNewTipo' id='materialAddNewTipo'>
								<option value='1'>Seleccione el material</option>";
							foreach ($data as $fila):
									$salida.=  "
											<option value='".$fila['nombre_material']."'>".$fila['nombre_material']."</option>";
							endforeach;
							$salida.= "</select>";
					}else{
							$salida .= "No se encontro lo que buscas";
					}

					echo $salida;
					$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}

	public function addNewItem($fam,$fk,$txtTipo,$tipo,$material,$dT1,$dT2,$dT3,$dT4,$fecha)
	{
		echo "datos desde class: ".$fam."-".$txtTipo."-".$fk."-".$tipo."-".$material."-".$dT1."-".$dT2."-".$dT3."-".$dT4."-".$fecha;
		try{
			//$query2 = $this->dbh->prepare('UPDATE items_db_2 SET dato_2 = '.$txtTipo.', fk_tipo = '.$fk.', dato_3 = '.$material.', dato_4 = '.$dT1.', dato_5 = '.$dT2.', dato_6 = '.$dT3.', dato_7 = '.$dT4.' WHERE dato_1 = '.$fam.'');
			$query2 = $this->dbh->prepare('UPDATE items_db_2 SET dato_2 = ?, fk_tipo = ?, dato_3 = ?, dato_4 = ?, dato_5 = ?, dato_6 = ?, dato_7 = ?, estado_item = "2", fecha_ingreso = ? WHERE dato_1 = ?');
			$query2->bindParam(1, $txtTipo);
			$query2->bindParam(2, $fk);
			$query2->bindParam(3, $material);
			$query2->bindParam(4, $dT1);
			$query2->bindParam(5, $dT2);
			$query2->bindParam(6, $dT3);
			$query2->bindParam(7, $dT4);
			$query2->bindParam(8, $fecha);
			$query2->bindParam(9, $fam);
			$query2->execute();

			$query3 = $this->dbh->prepare('CREATE TABLE '.$fk.'(nombre_tipo varchar(50), estado_tipo varchar(4))');
			$query3->execute();
			sleep(2);
			$tabla = strtolower($fk);
			$query4 = $this->dbh->prepare('INSERT INTO '.$tabla.'(nombre_tipo) VALUES(?,"2")');
			$query4->bindParam(1, $tipo);
			$query4->execute();

			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function pruebaDeTiposEnTabla()
	{
		$tipo = "tipó_sensor";
		try{
			$query2 = $this->dbh->prepare('SELECT * FROM all_tipos WHERE nombre_tipo = ?');
			$query2->bindParam(1, $tipo);
			$query2->execute();

			$data = $query2->fetchAll();
					if(!empty($data)){
							$salida="<select class='form-control form-control-sm' name='' id=''>
								<option value='1'>Seleccione el material</option>";
							foreach ($data as $fila):
								if($fila['tipo_1'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_1']."'>".$fila['tipo_1']."</option>";
								}
								if($fila['tipo_2'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_2']."'>".$fila['tipo_2']."</option>";
								}
								if($fila['tipo_3'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_3']."'>".$fila['tipo_3']."</option>";
								}
								if($fila['tipo_4'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_4']."'>".$fila['tipo_4']."</option>";
								}
								if($fila['tipo_5'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_5']."'>".$fila['tipo_5']."</option>";
								}
								if($fila['tipo_6'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_6']."'>".$fila['tipo_6']."</option>";
								}
								if($fila['tipo_7'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_7']."'>".$fila['tipo_7']."</option>";
								}
								if($fila['tipo_8'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_8']."'>".$fila['tipo_8']."</option>";
								}
								if($fila['tipo_9'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_9']."'>".$fila['tipo_9']."</option>";
								}
								if($fila['tipo_10'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_10']."'>".$fila['tipo_10']."</option>";
								}
								if($fila['tipo_11'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_11']."'>".$fila['tipo_11']."</option>";
								}
								if($fila['tipo_12'] != "N/A"){
									$salida.=  "<option value='".$fila['tipo_12']."'>".$fila['tipo_12']."</option>";
								}
							endforeach;
							$salida.= "</select>";
					}else{
							$salida .= "No se encontro lo que buscas";
					}
					echo $salida;
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function AddNewGlosaNGLS($codigo,$grupo,$familia,$fecha,$datoOptn,$dato2,$dato3,$dato4,$dato5,$dato6,$dato7)
	{
		echo "Class Glosa: ".$codigo."--".$grupo."--".$familia."--".$fecha."--".$datoOptn."--".$dato2."--".$dato3."--".$dato4."--".$dato5."--".$dato6."--".$dato7;
		$nn = "N/A";
		try{
			$query2 = $this->dbh->prepare('INSERT INTO datos_formalizados VALUES(null,"2","N/A",?,"N/A",?,?,?,?,?,?,?,?,?,?,?,"--/--/-- --:--:--")');
			$query2->bindParam(1, $codigo);
			$query2->bindParam(2, $grupo);
			$query2->bindParam(3, $familia);
			$query2->bindParam(4, $dato2);
			$query2->bindParam(5, $dato3);
			$query2->bindParam(6, $dato4);
			$query2->bindParam(7, $dato5);
			$query2->bindParam(8, $dato6);
			$query2->bindParam(9, $dato7);
			$query2->bindParam(10, $nn);
			$query2->bindParam(11, $datoOptn);
			$query2->bindParam(12, $fecha);
			$query2->execute();

			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function addCodigoNGLS($codigo, $id)
	{
		//echo $codigo."/class/".$id;
		try{
			$query = $this->dbh->prepare('UPDATE datos_formalizados SET codigo_dato_f = '.$codigo.' WHERE ID_DATO_F = ?');
			$query->bindParam(1, $id);

			$query->execute();
			$this->dbh = null;
		} catch (PDOException $e){
			$e->getMessage();
		}
	}

	public function loadItemsEnEsperaDeActivacion()
	{
		try {
			$query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE estado_item = "2"');

			$query->execute();
			$data = $query->fetchAll();
			$cont = count($data);
			$salida;
			if(!empty($data)){
					$salida ="<select multiple name='itemActivo' id='itemActivo' class='col-12 form-control form-control-sm' style='height:220px'>";
					foreach ($data as $fila):
			$salida.= "
				<option value='".$fila['dato_1']."' onclick='sel_ItemEspera()'>".$fila['dato_1']." ".$fila['dato_3']." ".$fila['dato_4']." ".$fila['dato_5']." ".$fila['dato_6']." ".$fila['dato_7']." ".$fila['fecha_ingreso']."</option>
										";
					endforeach;
					$salida.= "</select>";
			}else{
					$salida = "<p class='lead text-success'>No hay datos ACTIVOS en estos momemntos.</p>";
			}
			echo $salida;
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}
	//metodo que carga items inactivos al modal 1
	public function cargaItemsInactivosGFT()
	{
		try {
			$query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE estado_item = "0" ORDER BY dato_1 ');
			//$query = $this->dbh->prepare('SELECT i.dato_1, d.tipo_d, d.fk_tipo_d FROM items_db_2 AS i INNER JOIN items_desactivados AS d ON i.estado_item = "0" AND d.estado_tipo_d = "0" ');

			$query->execute();
			$data = $query->fetchAll();
			$salida ="";
			$ARtipo = array();
			if(!empty($data)){
					foreach ($data as $fila):
					array_push($ARtipo, $fila['dato_1']);
					endforeach;
			}

			$query = $this->dbh->prepare('SELECT * FROM items_desactivados WHERE estado_tipo_d = "0" ');
			$query->execute();
			$data2 = $query->fetchAll();
			$salida;
			if(!empty($data2)){
					foreach ($data2 as $fila):
						array_push($ARtipo, $fila['familia_tipo_d']);
					endforeach;
			}
				//print_r($ARtipo);
				if(!empty($ARtipo)){
					$salida ="<select name='_item_AGFT' id='_item_AGFT' class='col-12 form-control form-control-sm' onclick='sel_itemIGFT()'><option value='1' onclick='sel_itemIGFT()'>Seleccione Item</option>";
					foreach($ARtipo as $XY):
						$salida .= "<option value='".$XY."' onclick='sel_itemIGFT()'>".$XY."</option>";
					endforeach;
					$salida.= "</select>";
				}else{
					echo "<p class='lead text-success'>No hay datos INACTIVOS en estos momemntos.</p>";
			}
				echo $salida;
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}

	public function cargaItemsActivosGFT()
	{
		try {
			$query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE estado_item = "1" ORDER BY dato_1 ');

			$query->execute();
			$data = $query->fetchAll();
			$cont = count($data);
			$salida;
			if(!empty($data)){
					$salida ="<select name='_item_AGFT' id='_item_AGFT' class='col-12 form-control form-control-sm' onclick='sel_itemAGFT()'><option value='1' onclick='sel_itemAGFT()'>Seleccione Item</option>";
					foreach ($data as $fila):
			$salida.= "
				<option value='".$fila['dato_1']."' onclick='sel_itemAGFT()'>".$fila['dato_1']."</option>
										";
					endforeach;
					$salida.= "</select>";
			}else{
					$salida = "<p class='lead text-success'>No hay datos ACTIVOS en estos momemntos.</p>";
			}
			echo $salida;
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}

	public function loadTipoAGFT($data)
	{
		//echo($data ." from Class");
		try {
			$query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ? AND estado_item = "1"');
			$query->bindParam(1, $data);
			$query->execute();
			$data = $query->fetchAll();
			$cont = count($data);
			$salida = " ";
			if(!empty($data)){
				if($data[0]["dato_2"] === "TIPO"){
					$tipo = strtolower($data[0]["fk_tipo"]);
					//$salida.= $tipo;
					//$this->consultaTipo_Tablas($tipo);

					$query2 = $this->dbh->prepare('SELECT * FROM '.$tipo.' WHERE estado_tipo = "1" ');
					//$query2->bindParam(1, $tipo);
					$query2->execute();
					$data2 = $query2->fetchAll();
					//print_r($data2);
					if(!empty($data2)){
							$salida ="<select multiple name='datoItemGFT_' id='datoItemGFT_' class='col-12 form-control form-control-sm'>";
							foreach ($data2 as $fila2):
								$salida.= "<option value='".$tipo."' onclick='desctivarTipoGFT()'>".$fila2['nombre_tipo']."</option>";
							endforeach;
							$salida.= "</select>";
					} else {
						$salida .= "<p class=''>El item No contine tipo. Desea DESACTIVAR la familia de este Item.</p>
						<button onclick='desactivarFamiliaGFT_()' class='btn btn-sm btn-danger'>Desactivar Familia</button>";
					}

				}else{
					$salida .= "<p class=''>El item No contine tipo. Desea DESACTIVAR la familia de este Item.</p>
					<button onclick='desactivarFamiliaGFT_()' class='btn btn-sm btn-danger'>Desactivar Familia</button>";
				}
			}
			echo $salida;
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}
	//muestra datos desactivos para activar 2
	public function loadTipoDGFT($data)
	{
		//echo $data;
		try {
				$query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ?');
				$query->bindParam(1, $data);
				$query->execute();
				$data = $query->fetchAll();
				//print_r($data[0]["fk_tipo"]."//".$data[0]["nombre_tipo"]);
				if($data[0]["dato_2"] == "TIPO"){
					$F_k = strtolower($data[0]["fk_tipo"]);
					$query2 = $this->dbh->prepare('SELECT * FROM '.$F_k.' WHERE estado_tipo = "0" ');
					// $query2->bindParam(1, $F_k);
					$query2->execute();
					$data2 = $query2->fetchAll();
					$salida ="<select multiple name='tipo_dessactivado_GFT' id='tipo_dessactivado_GFT' class='col-12 form-control form-control-sm''>";
					foreach($data2 as $col):
						$salida.= "	<option value='".$F_k."' onclick='activarItemGFT()'>".$col['nombre_tipo']."</option>";
					endforeach;
					$salida.= "</select>";
					echo $salida;
				} else {
					echo "<button class='btn btn-sm btn-danger' onclick='activarItemGFT_btn()'>Activar Item</button>";//GENERAR BOTON PARA ACTIVAR FAMILIA DE ITEM_DB_2
				}
				$this->dbh = null;
			}catch (PDOException $e) {
					$e->getMessage();
			}
	}
	//desactiva los items en ttabla tipo_ y en tabla de rompimiento items_desactivados
	public function desactivar_item_gft($dataFK, $data, $grupo)
	{
		//echo $data." from class ".$dataFK;
		try {
			$query = $this->dbh->prepare('INSERT INTO items_desactivados VALUES(null, ?, ?, ?,"0")');
			$query->bindParam(1, $grupo);
			$query->bindParam(2, $data);
			$query->bindParam(3, $dataFK);
			
			$query2 = $this->dbh->prepare('UPDATE '.$dataFK.' SET estado_tipo = "0" WHERE nombre_tipo = ?');
			$query2->bindParam(1, $data);

			$query->execute();
			$query2->execute();

			echo "ok";
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}
	
	public function desactivar_item_gft_familia($fam_lia)
	{
		//echo $fam_lia . " from class";
		try {			
			$query2 = $this->dbh->prepare('UPDATE items_db_2 SET estado_item = "0" WHERE dato_1 = ?');
			$query2->bindParam(1, $fam_lia);

			$query2->execute();

			echo "ok";
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}

	public function funcActivarItemGFT_btn($data)
	{
		//echo($data ."from controlador btn class");
		try {			
			$query2 = $this->dbh->prepare('UPDATE items_db_2 SET estado_item = "1" WHERE dato_1 = ?');
			$query2->bindParam(1, $data);

			$query2->execute();
			if($query2->execute()){
				echo "ok";
			} else {
				echo "no_ok";
			}
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}

	public function funActivarItemGFT($data, $data2)
	{
		echo($data."//".$data2 ." from controlador class");
		//echo $data." from class ".$dataFK;
		try {			
			$query2 = $this->dbh->prepare('UPDATE '.$data2.' SET estado_tipo = "1" WHERE nombre_tipo = ?');
			$query2->bindParam(1, $data);
				$query3 = $this->dbh->prepare('DELETE FROM items_desactivados WHERE tipo_d = ?');
				$query3->bindParam(1, $data);
				
				$query3->execute();
			$query2->execute();
			if($query2->execute()){
				echo "ok";
			} else {
				echo "no_ok";
			}
			$this->dbh = null;
		}catch (PDOException $e) {
				$e->getMessage();
		}
	}



}//fin class
