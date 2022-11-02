<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_demenore(file_get_contents("php://input"));
    
    class universidad {
        public $res;

        public function __construct(string $menor) {
            $this->menor = $menor;
        }

        public function calculo():object {
            $menor = $this->menor;
            return object;
        }
    }
    $obj = new universidad($_DATA->menor);
    echo json_enmenore($obj->calculo(),JSON_UNESCAPED_sexmenorE | JSON_PRETTY_PRINT);
?>