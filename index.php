

<?php
require 'vendor/autoload.php';
require 'config/db.php';
require 'utils.php';
use PhpOffice\PhpSpreadsheet\IOFactory;


?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>

  <script>
    setTimeout(() => {
      let element = document.querySelector(".info-message");
      if (element) {
        console.log(element);
        element.remove();
      }

      let errors = document.querySelector(".form-error");
      if (errors) {
        errors.remove();
      }
    }, 5000);
  </script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      width: 100%;
      height: 100vh;
      background-color: #e2e8f0;
      display: flex;
      gap: 1rem;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 1rem;
      box-sizing: border-box;
    }
    .form {
      background-color: #f5f7fa;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      padding: 1rem;
      width: 28%;
      height: 20vh;
      border-radius: 1rem;
      box-sizing: border-box;
      box-shadow: 3px 3px 15px #dbe1e7;
    }
    .form-file {
      color: #4a5568;
    }
    .btn {
      width: 50%;
      height: 40px;
      margin-top: 10px;
      align-self: center;
      border: none;
      background-color: #edf2f7;
      border-radius: 10px;
    }
    .info-message {
      position: absolute;
      transition: 0.1s all ease-in;
      top: 10px;
      right: 10px;
      width: 15%;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 1rem;
      border-radius: 0.3rem;
      color: #edf2f7;
      background: #48bb78;
      box-shadow: 3px 3px 10px #dbe1e7;
    }
    .form-error {
      width: 28%;
      text-align: center;
      background-color: #fc8181;
      color: #edf2f7;
      padding: 1rem;
      border-radius: 1rem;

      box-shadow: 3px 3px 15px #dbe1e7;
    }
    .btn:hover {
      background-color: #e2e8f0;
    }
  </style>
  <body>
<?php


if (isset($_FILES['file'])) {
    $filename = $_FILES['file']['tmp_name'];
    echo $filename;
    $document = IOFactory::load($filename)->getSheet(0);
    $totalRows = $document->getHighestRow('A');
    
    $util = new SheetCellArray($document);
    for($i = 2; $i<= $totalRows; $i++){
        $query = ORM::forTable('test')->create();
        $data = $util->getCellToArray($i);
        try {
        
            $query->set($data);
            $query->save();
        } catch (Exception $e) {
            echo "<div class='form-error'>".$e->getMessage()."</div>";
        }
    
        try{
            if(($i % 400) == 0) {
                echo '<div class="info-message">'.$i.'Registros insertados</div>';
            
            }


        }catch(Exception $e){
        
        }
    
    }
}
//

?>
    <form method="post" class="form" enctype="multipart/form-data">
      <input accept=".xlsx" type="file" class="form-file" name="file" step="" />
      <button class="btn" type="submit">Enviar</button>
    </form>
  </body>
</html>
