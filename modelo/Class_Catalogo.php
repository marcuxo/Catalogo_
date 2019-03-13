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
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ?');
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
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ?');
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


    public function traeDatos_1_7_foto($dato)// ++++++++++++++++++++++++++++++++++uso en modal+++++++++++++++++++++++++++++++++++++++++++
    {
        try {
        	//esta consulta carga los items de ingreso de datos vacios
            $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE dato_1 = ?');
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
					<input type='file' name='fotoTipoImg' id='fotoTipoImg' class='form-control form-control-sm' accept='image/x-png,image/jpeg'>
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
	
	public function traer_familia2($dato)
    {
        try {
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ?');
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
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ?');
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
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ?');
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
                $salida="<div class='form-group'><select class='form-control form-control-sm' name='familia' id='familiaNew' onclick='selFamilia3()'><option value='1' onclick='selFamilia3()'>Selecciona Familia</option>";
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
            $query = $this->dbh->prepare('SELECT nombre FROM familia_2 WHERE fk_grupo = ?');
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
   
	public function buscaParaEditar($data_1,$data_2,$data_3)
    {
    	try {
			//$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE '.$data_1.' AND familia LIKE '.$data_2.' OR subfamilia LIKE '.$data_3.'');
			//$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE ? AND familia LIKE ? OR subfamilia LIKE ?');
			$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE ? AND familia LIKE ?');
			$query->bindParam(1, $data_1);
            $query->bindParam(2, $data_2);
            //$query->bindParam(3, $data_3);
            $query->execute();


            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='input-group input-group-sm col-14'><select multiple class='form-control form-control-sm table-hover' name='editorB' id='editorB' style='height:320px'>";
                foreach ($data as $fila):
                		$salida.=  "
                		   <option value='' onclick='modalShow();muestra();'>".$fila['grupo']."*".$fila['familia']."*".$fila['subfamilia']."*".$fila['descripcion']."</option>";
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
			$query = $this->dbh->prepare('SELECT * FROM all_items WHERE grupo LIKE ? AND familia LIKE ?');
			$query->bindParam(1, $data_1);
            $query->bindParam(2, $data_2);
            //$query->bindParam(3, $data_3);
            $query->execute();


            $data = $query->fetchAll();
            if(!empty($data)){
                $salida="<div class='input-group input-group-sm col-14'><select multiple class='form-control form-control-sm table-hover' name='buscaUserImg' id='buscaUserImg' style='height:320px'>";
                foreach ($data as $fila):
                		$salida.=  "
                		   <option value='' onclick='showwwwImagen();'>".$fila['grupo']."*".$fila['familia']."*".$fila['subfamilia']."*".$fila['descripcion']."</option>";
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
					$this->dbh = null;
			} catch (PDOException $e){
					$e->getMessage();
			}
	}

	public function cargaImagen()//carga las imagenes de la tabla de imagenes por tipo
	{
		$data1 = "RODAMIENTO";
		$data2 = "MATERIALES Y ARTICULOS ELECTRICOS";
		try {
            $query = $this->dbh->prepare('SELECT * FROM foto_tipo WHERE nombre_famili_foto = ?');
            $query->bindParam(1, $data1);
			
            $query->execute();

            $data = $query->fetchAll();
            $cont = count($data);
            $salida;
            if(!empty($data)){
				$salida ="<div class='col-3 text-right'>
				<h1 class='text-white lead'>".$data1."</h1>";
                foreach ($data as $fila):
						$salida.= "
						<div class='col'>
							<label class='fondo text-white'>".$fila['nombre_tipo_foto']." <img src='".$fila['imagen_tipo_foto']."' class='w-25 rounded' id='img' onclick='showImg(this)'></label>
                        </div>";
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

	public function cargaInactivos()
	{
		try {
            $query = $this->dbh->prepare('SELECT * FROM datos_formalizados WHERE estado_dato_f = 0');
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
							<option value='".$fila['id_dato_f']."' onclick='selInactivo()'>".$fila['grupo_dato_f']." ".$fila['familia_dato_f']." ".$fila['dato1_dato_f']." ".$fila['dato2_dato_f']." ".$fila['dato3_dato_f']." ".$fila['dato4_dato_f']." ".$fila['dato5_dato_f']." ".$fila['dato6_dato_f']."</option>
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

	public function addDato_DM($grupo, $familia, $tipo, $material, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8)
	{
		echo "Desde class=".$grupo.$familia.$tipo.$material.$dato3.$dato4.$dato5.$dato6.$dato7.$dato8;

		try{
			$query = $this->dbh->prepare('INSERT INTO datos_formalizados VALUES(null,"0","N/A","N/A","N/A",?,?,?,?,?,?,?,?,?,?)');
			$query->bindParam(1, $grupo);
			$query->bindParam(2, $familia);
			$query->bindParam(3, $tipo);
			$query->bindParam(4, $material);
			$query->bindParam(5, $dato3);
			$query->bindParam(6, $dato4);
			$query->bindParam(7, $dato5);
			$query->bindParam(8, $dato6);
			$query->bindParam(9, $dato7);
			$query->bindParam(10, $dato8);

			$query->execute();
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
}
