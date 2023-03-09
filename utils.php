<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class SheetCellArray
{
    protected $sheet;
    protected $keys = array(
        'region','nombre_centro', 'centro', 'almacen', 'nombre_almacen',
        'material', 'texto_material', 'libre_utilizacion','bloqueado','stock'
    );
    
    protected $sheetCells = array('A', 'B', 'C', 'D', 'E','F', 'G', 'H', 'I', 'J');
    function __construct(Worksheet $sheet)
    {
            $this->sheet = $sheet;
        
    }

    /**
     *
     *
     * */
    protected function transformToArrayMap(Array $arr): array
    {


        $keyData = array();
        for($i = 0; $i< count($this->keys); $i++) {
            $keyData[$this->keys[$i]] = utf8_decode($arr[$i]);
        }

        return $keyData;
        
    }
      /**
       *
       *
       * */
    function getCellToArray( int $index): array
    {
        $data = array();
        foreach($this->sheetCells as $c){
            array_push($data, utf8_decode($this->sheet->getCell($c.$index)));
        }
        return $this->transformToArrayMap($data);

        
    }

    
}


// $result = $document->getSheet(0);
// echo $result->getCell('A2');

// for($i = 0; $i< 10; $i++){
//     
// }
