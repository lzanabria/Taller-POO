<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"));
    
    class productos {
        public $cod;
        public $uni;
        public $productos;

        public function __construct(int $cod, int $uni) {
            $this->cod = $cod;
            $this->uni = $uni;
            $this->productos = (object) [
                "23548" => [
                    "nombre" => "Durazno",
                    "precio" => 3200
                ],
                "87845" => [
                    "nombre" => "Manzana",
                    "precio" => 2500
                ],
                "54878" => [
                    "nombre" => "Pera",
                    "precio" => 1700
                ]
            ];
        }

        public function calculo():object {
            $res = (array) $this->productos;
            $res = $res[$this->cod];
            return (object) [
                "Producto" => $res["nombre"],
                "total" => $this->uni * $res["precio"],
            ];
        }
    }
    $obj = new productos($_DATA->cod, $_DATA->uni);
    echo json_encode($obj->calculo(),JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>