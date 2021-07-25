<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/covid19.php';

    $database = new Database();
    
	$db = $database->getConnectionPostgreSQL(); // koneksi untuk postgres
	// $db = $database->getConnectionMysql(); // koneksi untuk mysql

    $items = new Covid($db);

    $stmt = $items->getCovidPostgreSQL(); // ambil data untuk postgres
	// $stmt = $items->getEmployeesMysql(); // ambil data untuk mysql
    $itemCount = $stmt->rowCount();


    if($itemCount > 0){
        
        // $covidArr = array();
        // $covidArr["attributes"] = array();
        // $covidArr["itemCount"] = $itemCount;

        $covidArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $data = array(
                "id" => $id,
                "name" => $name,
                "positif_penduduk" => $positif_penduduk,
                "positif_bukan_penduduk" => $positif_bukan_penduduk,
                "kasus_aktif" => $kasus_aktif,
                "kasus_positif" => $kasus_positif,
                "kasus_sembuh" => $kasus_sembuh,
                "kasus_meninggal" => $kasus_meninggal,
                "kontak_erat" => $kontak_erat,
                "suspect" => $suspect,
                "isolasi_rs" => $isolasi_rs,
                "isolasi_mandiri" => $isolasi_mandiri,
                "date" => $date,
            );

            // array_push($covidArr["body"], $data);
            array_push($covidArr, ($data));
        }
        echo json_encode($covidArr, JSON_PRETTY_PRINT);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>