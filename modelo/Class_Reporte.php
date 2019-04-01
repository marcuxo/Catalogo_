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

    public function reporte_Cuentas()
    {
        // Crear nuevo objeto PHPExcel
      $objPHPExcel = new PHPExcel();

      // Propiedades del documento
      $objPHPExcel->getProperties()->setCreator("MarcoUrrutia")
                    ->setLastModifiedBy("MarcoUrrutia");

      // Combino las celdas desde A1 hasta E1
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

      $objPHPExcel->getActiveSheet()->getStyle('A1:F2')->applyFromArray($boldArray);		//DECLARAR RANGO DE CELDAS

        
            
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
      'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
      );
      $objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
      // Cambiar el nombre de hoja de cálculo
      $objPHPExcel->getActiveSheet()->setTitle('Reporte de catalogo');//nombre de hoja de excel


      // Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
      $objPHPExcel->setActiveSheetIndex(0);


      // Redirigir la salida al navegador web de un cliente ( Excel5 )
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="reporte_'.date('d'.'_'.'m'.'_'.'Y').'.xls"');
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