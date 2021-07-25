<?php
    class Covid{

        // Connection
        private $conn;

        // Table
        private $db_table = "covid19kukarstatus";

        // Columns
        public $id;
        public $name;
        public $positif_penduduk;
        public $positif_bukan_penduduk;
        public $kasus_aktif;
        public $kasus_positif;
        public $kasus_sembuh;
        public $kasus_meninggal;
        public $kontak_erat;
        public $suspect;
        public $isolasi_rs;
        public $isolasi_mandiri;
        public $date;
        

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL PostgreSQL
        public function getCovidPostgreSQL(){
            $sqlQuery = "SELECT id, name, positif_penduduk, positif_bukan_penduduk, kasus_aktif, kasus_positif, kasus_sembuh, kasus_meninggal, kontak_erat, suspect, isolasi_rs, isolasi_mandiri, date FROM " . $this->db_table . "";
			$data = $this->conn->query($sqlQuery);
			return $data;
        }
		

	    // READ single postgeSQL
        public function getSingleCovidPostgreSQL(){
            $sqlQuery = "SELECT id, name, positif_penduduk, positif_bukan_penduduk, kasus_aktif, kasus_positif, kasus_sembuh, kasus_meninggal, kontak_erat, suspect, isolasi_rs, isolasi_mandiri, date FROM ". $this->db_table ." WHERE id =:id LIMIT 1";
			
            $stmt = $this->conn->prepare($sqlQuery);
			$stmt->bindValue (':id', $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $dataRow['id'];
            $this->name = $dataRow['name'];
            $this->positif_penduduk = $dataRow['positif_penduduk'];
            $this->positif_bukan_penduduk = $dataRow['positif_bukan_penduduk'];
            $this->kasus_positif = $dataRow['kasus_positif'];
            $this->kasus_aktif = $dataRow['kasus_aktif'];
            $this->kasus_sembuh = $dataRow['kasus_sembuh'];
            $this->kasus_meninggal = $dataRow['kasus_meninggal'];
            $this->kontak_erat = $dataRow['kontak_erat'];
            $this->suspect = $dataRow['suspect'];
            $this->isolasi_rs = $dataRow['isolasi_rs'];
            $this->isolasi_mandiri = $dataRow['isolasi_mandiri'];
            $this->date = $dataRow['date'];
        } 		

        

    }
?>