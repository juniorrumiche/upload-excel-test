<?php
    require "config/db.php";

    $result = ORM::for_table('test')->findArray();

    $list = json_encode($result);
    // print_r($list);

    echo $list;
?>