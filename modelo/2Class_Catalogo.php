<?php
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

                            	$salida.= "<div id='tipo'><script>btn_trae_tipo()</script></div>";//configuracion tipo

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
    public function traeDatos_1_7($dato)// +++++++++++++++++++++++++++++++++++en uso+++++++++++++++++++++++++++++++++++++++++++
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
            	<div class='input-group input-group-sm col-9 py-2'><select class='form-control form-control-sm' name='material' required><option value='seccionar' >Seleccione el Material</option>";
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
                            	</script>
                            		<input id='acaSaleElTipo' value=".$fila['fk_tipo']." class='invisible'>
                            	</div>
                            	";//configuracion tipo*-**-*-*-*-**-*-*-*-*-*-*-******-****
                            	$salida .= $salida2;
                            	
                            }
                			else if($fila['dato_2'] == "TIPO"){

                            	$salida.= "
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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
                            	<div id='tipo' class='col-9'>
                            	<script>
										btn_trae_tipo();
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

    public function pruebas_copia($dato)
    {
        try {
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ?');
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
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ?');
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

    public function traer_material()//sin uso
    {
    	 try {
            $query = $this->dbh->prepare('SELECT nombre_material FROM material');
            $query->execute();

            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='input-group input-group-sm py-2'><select class='form-control form-control-sm' name='tipo'>
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


    public function buscaTipo($dato) //+++++++++++++++++++++++++++++++++++++++++++++++++++++en uso
    {
    	try {
            $query = $this->dbh->prepare('SELECT nombre_tipo FROM '.$dato.'');

            $query->execute();


            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='input-group input-group-sm'><select class='form-control form-control-sm' name='tipo' id='tipo' required>
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
    	$to = 'pruebas.correo.dev@gmail.com';
		$subject = 'the subject';
		//$message = 'Hola mundo desde el mail';
		$headers[]= 'MiME-Version: 1.0';
		$headers[]= 'Content-type: text/html; charset=iso-8859-1';

		mail($to, $subject, $msg, implode("\r\n", $headers));
		echo "<center><p class='lead'>Correo enviado, revisa la bandeja de entrada o spam del correo ".$to."<p><center>";

    }

    public function Login($user, $pass)
    {
        try {
            $query = $this->dbh->prepare('SELECT usuario, clave FROM login_mantenedor WHERE usuario = ? AND clave = ?');
            $query->bindParam(1, $user);
            $query->bindParam(2, $pass);
            $query->execute();

            $data = $query->fetchAll();
            if(!empty($data)){
               echo "ok";
            }else{
                echo "no_ok";
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
                           <option value='".$fila['img']."' onclick='itemSeleccionado()'>Codigo: ".$fila['codigo']." -Descripcion: ".$fila['descripcion']." -Subfamilia: ".$fila['subfamilia']."</option>";
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
    
		

   
}
