
<?php
require 'vendor/autoload.php';
require 'config/db.php';
require 'utils.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$filename = "ex.xlsx";
$document = IOFactory::load($filename)->getSheet(0);
$totalRows = $document->getHighestRow('A');



$util = new SheetCellArray($document);

echo "\r registando $totalRows registros ";

for($i = 2; $i<= $totalRows; $i++){
    $query = ORM::forTable('test')->create();
    $data = $util->getCellToArray($i);
    try {
        
        $query->set($data);
        $query->save();
    } catch (Exception $e) {
        echo "error en celda".$i.$e->getMessage();
        echo "<br>";
        //throw $th;
    }
    
}
