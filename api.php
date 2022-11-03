<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"));

    class taller { 
        public $presion;
        public $volumen;
        public $masa;
        
        public function __construct(int $presion, int $volumen) {
            $this->presion = $presion;
            $this->volumen = $volumen;
        }

        public function calculo() {
            $this->masa = $this->presion * $this->volumen;
            return $this->masa;
        }
    }
    $obj = new taller ($_DATA->presion, $_DATA->volumen);
    echo json_encode($obj->calculo(),JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>