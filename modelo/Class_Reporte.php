<?php
//require_once dirname('__FILE__') . 'PHPExcel.php';
require_once 'PHPExcel.php';

class Reporte extends PHPExcel
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

    public function retorno()
    {
      echo "Estas en Class Reporte";
    }

    public function reporte_FormalizadoActivo()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE GLOSA ACTIVAS')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'CODIGO')//titulo de celda
                  ->setCellValue('B2', 'GRUPO')//titulo de celda
                  ->setCellValue('C2', 'FAMILIA')//titulo de celda
                  ->setCellValue('D2', 'DATO 1')//titulo de celda
                  ->setCellValue('E2', 'DATO 2')//titulo de celda
                  ->setCellValue('F2', 'DATO 3')//titulo de celda
                  ->setCellValue('G2', 'DATO 4')//titulo de celda
                  ->setCellValue('H2', 'DATO 5')//titulo de celda
                  ->setCellValue('I2', 'DATO 6')//titulo de celda
                  ->setCellValue('J2', 'DATO 7')//titulo de celda
                  ->setCellValue('K2', 'DATO 8')//titulo de celda
                  ->setCellValue('L2', 'FECHA INGRESO')//titulo de celda
                  ->setCellValue('M2', 'FECHA ACTIVACION');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM datos_formalizados WHERE estado_dato_f = 1 ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['codigo_dato_f'];
          $celda_B=$row['grupo_dato_f'];
          $celda_C=$row['familia_dato_f'];
          $celda_d=$row['dato1_dato_f'];
          $celda_e=$row['dato2_dato_f'];
          $celda_f=$row['dato3_dato_f'];
          $celda_g=$row['dato4_dato_f'];
          $celda_h=$row['dato5_dato_f'];
          $celda_i=$row['dato6_dato_f'];
          $celda_j=$row['dato7_dato_f'];
          $celda_k=$row['dato8_dato_f'];
          $celda_l=$row['fecha_ingreso'];
          $celda_m=$row['fecha_aprobacion'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
            $h="H".$cel;
            $i="I".$cel;
            $j="J".$cel;
            $k="K".$cel;
            $l="L".$cel;
            $m="M".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f)
                  ->setCellValue($g, $celda_g)
                  ->setCellValue($h, $celda_h)
                  ->setCellValue($i, $celda_i)
                  ->setCellValue($j, $celda_j)
                  ->setCellValue($k, $celda_k)
                  ->setCellValue($l, $celda_l)
                  ->setCellValue($m, $celda_m);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$m"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ')//titulo de celda
          ->setCellValue('G2', ' ')//titulo de celda
          ->setCellValue('H2', ' ')//titulo de celda
          ->setCellValue('I2', ' ')//titulo de celda
          ->setCellValue('J2', ' ')//titulo de celda
          ->setCellValue('K2', ' ')//titulo de celda
          ->setCellValue('L2', ' ')//titulo de celda
          ->setCellValue('M2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte GLOSA');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_formalizado_activo_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    public function reporte_Cuentas()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE CUENTAS')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'USUARIO')//titulo de celda
                  ->setCellValue('B2', 'NOMBRE')//titulo de celda
                  ->setCellValue('C2', 'INFORMACION')//titulo de celda
                  ->setCellValue('D2', 'TIPO USUARIO')//titulo de celda
                  ->setCellValue('E2', 'FECHA INGRESO')//titulo de celda
                  ->setCellValue('F2', 'ESTADO CUENTA');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM login_mantenedor');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['usuario'];
          $celda_B=$row['nombre_login'];
          $celda_C=$row['info'];
          $celda_d=$row['tipo_user_login'];
          $celda_e=$row['fecha_ingreso'];
          if($row['estado_login'] == "1"){
            $estado  = "Activado";
          } else {
            $estado  = "Inactivo";
          }
          
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $estado);		
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$f"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ')//titulo de celda
          ->setCellValue('G2', ' ')//titulo de celda
          ->setCellValue('H2', ' ')//titulo de celda
          ->setCellValue('I2', ' ')//titulo de celda
          ->setCellValue('J2', ' ')//titulo de celda
          ->setCellValue('K2', ' ')//titulo de celda
          ->setCellValue('L2', ' ')//titulo de celda
          ->setCellValue('M2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte CUENTAS');//nombre de hoja de excel----
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_cuentas_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL---
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    public function reporte_FormalizadoInactivos()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE GLOSA INACTIVAS')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'CODIGO')//titulo de celda
                  ->setCellValue('B2', 'GRUPO')//titulo de celda
                  ->setCellValue('C2', 'FAMILIA')//titulo de celda
                  ->setCellValue('D2', 'DATO 1')//titulo de celda
                  ->setCellValue('E2', 'DATO 2')//titulo de celda
                  ->setCellValue('F2', 'DATO 3')//titulo de celda
                  ->setCellValue('G2', 'DATO 4')//titulo de celda
                  ->setCellValue('H2', 'DATO 5')//titulo de celda
                  ->setCellValue('I2', 'DATO 6')//titulo de celda
                  ->setCellValue('J2', 'DATO 7')//titulo de celda
                  ->setCellValue('K2', 'DATO 8')//titulo de celda
                  ->setCellValue('L2', 'FECHA INGRESO')//titulo de celda
                  ->setCellValue('M2', 'FECHA ACTIVACION');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM datos_formalizados WHERE estado_dato_f = "0" ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['codigo_dato_f'];
          $celda_B=$row['grupo_dato_f'];
          $celda_C=$row['familia_dato_f'];
          $celda_d=$row['dato1_dato_f'];
          $celda_e=$row['dato2_dato_f'];
          $celda_f=$row['dato3_dato_f'];
          $celda_g=$row['dato4_dato_f'];
          $celda_h=$row['dato5_dato_f'];
          $celda_i=$row['dato6_dato_f'];
          $celda_j=$row['dato7_dato_f'];
          $celda_k=$row['dato8_dato_f'];
          $celda_l=$row['fecha_ingreso'];
          $celda_m=$row['fecha_aprobacion'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
            $h="H".$cel;
            $i="I".$cel;
            $j="J".$cel;
            $k="K".$cel;
            $l="L".$cel;
            $m="M".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f)
                  ->setCellValue($g, $celda_g)
                  ->setCellValue($h, $celda_h)
                  ->setCellValue($i, $celda_i)
                  ->setCellValue($j, $celda_j)
                  ->setCellValue($k, $celda_k)
                  ->setCellValue($l, $celda_l)
                  ->setCellValue($m, $celda_m);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$m"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ')//titulo de celda
          ->setCellValue('G2', ' ')//titulo de celda
          ->setCellValue('H2', ' ')//titulo de celda
          ->setCellValue('I2', ' ')//titulo de celda
          ->setCellValue('J2', ' ')//titulo de celda
          ->setCellValue('K2', ' ')//titulo de celda
          ->setCellValue('L2', ' ')//titulo de celda
          ->setCellValue('M2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte GLOSA');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_formalizado_inactivo_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    public function reporte_FormalizadoXAprobar()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE GLOSA POR APROBAR')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'CODIGO')//titulo de celda
                  ->setCellValue('B2', 'GRUPO')//titulo de celda
                  ->setCellValue('C2', 'FAMILIA')//titulo de celda
                  ->setCellValue('D2', 'DATO 1')//titulo de celda
                  ->setCellValue('E2', 'DATO 2')//titulo de celda
                  ->setCellValue('F2', 'DATO 3')//titulo de celda
                  ->setCellValue('G2', 'DATO 4')//titulo de celda
                  ->setCellValue('H2', 'DATO 5')//titulo de celda
                  ->setCellValue('I2', 'DATO 6')//titulo de celda
                  ->setCellValue('J2', 'DATO 7')//titulo de celda
                  ->setCellValue('K2', 'DATO 8')//titulo de celda
                  ->setCellValue('L2', 'FECHA INGRESO')//titulo de celda
                  ->setCellValue('M2', 'FECHA ACTIVACION');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM datos_formalizados WHERE estado_dato_f = "2" ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['codigo_dato_f'];
          $celda_B=$row['grupo_dato_f'];
          $celda_C=$row['familia_dato_f'];
          $celda_d=$row['dato1_dato_f'];
          $celda_e=$row['dato2_dato_f'];
          $celda_f=$row['dato3_dato_f'];
          $celda_g=$row['dato4_dato_f'];
          $celda_h=$row['dato5_dato_f'];
          $celda_i=$row['dato6_dato_f'];
          $celda_j=$row['dato7_dato_f'];
          $celda_k=$row['dato8_dato_f'];
          $celda_l=$row['fecha_ingreso'];
          $celda_m=$row['fecha_aprobacion'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
            $h="H".$cel;
            $i="I".$cel;
            $j="J".$cel;
            $k="K".$cel;
            $l="L".$cel;
            $m="M".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f)
                  ->setCellValue($g, $celda_g)
                  ->setCellValue($h, $celda_h)
                  ->setCellValue($i, $celda_i)
                  ->setCellValue($j, $celda_j)
                  ->setCellValue($k, $celda_k)
                  ->setCellValue($l, $celda_l)
                  ->setCellValue($m, $celda_m);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$m"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ')//titulo de celda
          ->setCellValue('G2', ' ')//titulo de celda
          ->setCellValue('H2', ' ')//titulo de celda
          ->setCellValue('I2', ' ')//titulo de celda
          ->setCellValue('J2', ' ')//titulo de celda
          ->setCellValue('K2', ' ')//titulo de celda
          ->setCellValue('L2', ' ')//titulo de celda
          ->setCellValue('M2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte GLOSA');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_formalizado_poraprobar_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    //reporte de familias(activas, inactivas, x aprobar)
    public function reporte_familiasActivas()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE FAMILIA ACTIVA')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'FAMILIA')//titulo de celda
                  ->setCellValue('B2', 'TIPO')//titulo de celda
                  ->setCellValue('C2', 'DATO')//titulo de celda
                  ->setCellValue('D2', 'DATO')//titulo de celda
                  ->setCellValue('E2', 'DATO')//titulo de celda
                  ->setCellValue('F2', 'DATO')//titulo de celda
                  ->setCellValue('G2', 'DATO');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM items_db_2 WHERE estado_item = "1" ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['dato_1'];
          $celda_B=$row['dato_2'];
          $celda_C=$row['dato_3'];
          $celda_d=$row['dato_4'];
          $celda_e=$row['dato_5'];
          $celda_f=$row['dato_6'];
          $celda_g=$row['dato_7'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f)
                  ->setCellValue($g, $celda_g);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$g"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ')//titulo de celda
          ->setCellValue('G2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_familia_activa_'.date('d'.'_'.'m'.'_'.'Y'.'H'.'i'.'s').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    public function reporte_familiasInctivas()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE FAMILIA INACTIVA')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'FAMILIA')//titulo de celda
                  ->setCellValue('B2', 'TIPO')//titulo de celda
                  ->setCellValue('C2', 'DATO')//titulo de celda
                  ->setCellValue('D2', 'DATO')//titulo de celda
                  ->setCellValue('E2', 'DATO')//titulo de celda
                  ->setCellValue('F2', 'DATO')//titulo de celda
                  ->setCellValue('G2', 'DATO');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM ITEMS_DB_2 WHERE estado_item = "0" ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['dato_1'];
          $celda_B=$row['dato_2'];
          $celda_C=$row['dato_3'];
          $celda_d=$row['dato_4'];
          $celda_e=$row['dato_5'];
          $celda_f=$row['dato_6'];
          $celda_g=$row['dato_7'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f)
                  ->setCellValue($g, $celda_g);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$g"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ')//titulo de celda
          ->setCellValue('G2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_familia_inactiva_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    public function reporte_familiasXaprobar()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE FAMILIA POR APROBAR')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'FAMILIA')//titulo de celda
                  ->setCellValue('B2', 'TIPO')//titulo de celda
                  ->setCellValue('C2', 'DATO')//titulo de celda
                  ->setCellValue('D2', 'DATO')//titulo de celda
                  ->setCellValue('E2', 'DATO')//titulo de celda
                  ->setCellValue('F2', 'DATO')//titulo de celda
                  ->setCellValue('G2', 'DATO');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM ITEMS_DB_2 WHERE estado_item = "2" ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['dato_1'];
          $celda_B=$row['dato_2'];
          $celda_C=$row['dato_3'];
          $celda_d=$row['dato_4'];
          $celda_e=$row['dato_5'];
          $celda_f=$row['dato_6'];
          $celda_g=$row['dato_7'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            $g="G".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f)
                  ->setCellValue($g, $celda_g);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$g"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ')//titulo de celda
          ->setCellValue('G2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_familia_Xaprobar_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    public function reporte_allNoFormActivo()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE ITEMS NO FORMALIZADOS ACTIVOS')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'ID')//titulo de celda
                  ->setCellValue('B2', 'GRUPO')//titulo de celda
                  ->setCellValue('C2', 'FAMILIA')//titulo de celda
                  ->setCellValue('D2', 'TIPO')//titulo de celda
                  ->setCellValue('E2', 'CODIGO')//titulo de celda
                  ->setCellValue('F2', 'DESCRIPCION');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(80);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM all_items WHERE estado_item = "1" ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['id_item'];
          $celda_B=$row['grupo'];
          $celda_C=$row['familia'];
          $celda_d=$row['subfamilia'];
          $celda_e=$row['codigo'];
          $celda_f=$row['descripcion'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$f"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_allItem_noFormalizado_activo_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }

    public function reporte_allNoFormInctivo()
    {
      // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');//DECLARAR RANGO DE CELDAS

      //-----------plantilla EXCEL---------------------------------------------
      $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'REPORTE DE ITEMS NO FORMALIZADOS INACTIVOS')//titulo dentro de la hoja de excel
                  ->setCellValue('A2', 'ID')//titulo de celda
                  ->setCellValue('B2', 'GRUPO')//titulo de celda
                  ->setCellValue('C2', 'FAMILIA')//titulo de celda
                  ->setCellValue('D2', 'TIPO')//titulo de celda
                  ->setCellValue('E2', 'CODIGO')//titulo de celda
                  ->setCellValue('F2', 'DESCRIPCION');//titulo de celda
            
      // Fuente de la primera fila en negrita
      $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
      $titulo_1 = array('font' => array( 'name' => 'Arial','size' => 20));

      $objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($titulo_1);		//DECLARAR RANGO DE CELDAS
      $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
      //Ancho de las columnas
      $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);//rellena las celdas
      $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(80);//rellena las celdas

      /*Extraer datos de MYSQL*/
      # conectare la base de datos
        //esta consulta carga los items de ingreso de datos vacios
        $query = $this->dbh->prepare('SELECT * FROM all_items WHERE estado_item = "0" ');
        $query->execute();
        $data = $query->fetchAll();

      $cel=3;//Numero de fila donde empezara a crear  el reporte
      if(!empty($data)){
        foreach ($data as $row):
          $celda_A=$row['id_item'];
          $celda_B=$row['grupo'];
          $celda_C=$row['familia'];
          $celda_d=$row['subfamilia'];
          $celda_e=$row['codigo'];
          $celda_f=$row['descripcion'];
            
            $a="A".$cel;
            $b="B".$cel;
            $c="C".$cel;
            $d="D".$cel;
            $e="E".$cel;
            $f="F".$cel;
            // Agregar datos
            $objPHPExcel->setActiveSheetIndex(0)
                  ->setCellValue($a, $celda_A)
                  ->setCellValue($b, $celda_B)
                  ->setCellValue($c, $celda_C)
                  ->setCellValue($d, $celda_d)
                  ->setCellValue($e, $celda_e)
                  ->setCellValue($f, $celda_f);
        $cel+=1;
        endforeach;

        /*Fin extracion de datos MYSQL*/
        $rango="A2:$f"; //DECLARAR  RANGO DE CELDAS
        $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
        'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => '000')))
        );
        $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      } else {
          //exit;
          //header('location: ../vista/redireccionar.php?data=no_data');
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1', 'No hay datos Para Mostrar.')//titulo dentro de la hoja de excel
          ->setCellValue('A2', ' ')//titulo de celda
          ->setCellValue('B2', ' ')//titulo de celda
          ->setCellValue('C2', ' ')//titulo de celda
          ->setCellValue('D2', ' ')//titulo de celda
          ->setCellValue('E2', ' ')//titulo de celda
          ->setCellValue('F2', ' ');//titulo de celda
      }

      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte');//nombre de hoja de excel
      //------------------------------------FIN PLANTILLA ------------------------------------------


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_allItem_noFormalizado_inactivo_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');//nombre de ARCHIVO EXCEL
      header('Cache-Control: max-age=0');
      // Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
      header('Cache-Control: max-age=1');

      // Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
      header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
      header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header ('Pragma: public'); // HTTP/1.0

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
    }


}//fin clase