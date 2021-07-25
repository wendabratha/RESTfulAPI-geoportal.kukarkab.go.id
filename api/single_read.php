<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/covid19.php';

    $database = new database();
    $db = $database->getConnectionPostgreSQL(); // untuk postgresSQL
	// $db = $database->getConnectionMysql(); // untuk mysql

    $item = new Covid($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    
	$item->getSingleCovidPostgreSQL(); // untuk postgresSQL
	// $item->getSingleEmployeeMySql(); // untuk mysql
	

    if($item->name != null){
        
		// create array
        $data = array(
                "id" => $item -> id,
                "name" => $item -> name,
                "positif_penduduk" => $item -> positif_penduduk,
                "positif_bukan_penduduk" => $item -> positif_bukan_penduduk,
                "kasus_aktif" => $item -> kasus_aktif,
                "kasus_positif" => $item -> kasus_positif,
                "kasus_sembuh" => $item -> kasus_sembuh,
                "kasus_meninggal" => $item -> kasus_meninggal,
                "kontak_erat" => $item -> kontak_erat,
                "suspect" => $item -> suspect,
                "isolasi_rs" => $item -> isolasi_rs,
                "isolasi_mandiri" => $item -> isolasi_mandiri,
                "date" => $item -> date,
        );
      
        http_response_code(200);
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Not found.");
    }
?>