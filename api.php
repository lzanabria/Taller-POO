<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"));

    class ventas { 
        public $venta;
        public $global=0;
        public $listaA;
        
        public function __construct(int $venta) {
            if($venta){
                $this->venta = $venta;
                $data = json_decode(file_get_contents("Ventas.json"), true);
                array_push($data,(object) [
                "Ventas" => [
                    "Monto" => $this->venta,
                    ]
                ]);
                $file = fopen("Ventas.json", "w+");
                fwrite($file, json_encode($data, JSON_PRETTY_PRINT));
                fclose($file);
            }
        }

        public function calculo() {
            $data = json_decode(file_get_contents("Ventas.json"), true);
            $this->global = 0;
            foreach ($data as $key => $value) {
                $this->global += $value["Ventas"]["Monto"];
            }
            $lista = array_column(array_column($data, 'Ventas'), "Monto");
            $categoriaA = array_filter($lista, function($item) {
                return $item > 1000;
            });

            $sumaA = array_sum($categoriaA);

            $totalA = count($categoriaA);
            $this->listaA = (object) [
                "CategoriaA" => [
                    "n_items" => $totalA,
                    "Monto" => $sumaA,
                    "Ventas"=> $categoriaA
                ],
            ];

            $categoriaB = array_filter($lista, function($item) {
                return $item >500 && $item <= 1000;
            });
            $sumaB = array_sum($categoriaB);
            $totalB = count($categoriaB);
            $this->listaA->CategoriaB = [
                "n_items" => $totalB,
                "Monto" => $sumaB,
                "Ventas"=> $categoriaB
            ];

            $categoriaC = array_filter($lista, function($item) {
                return $item <=500;
            });
            $sumaC = array_sum($categoriaC);
            $totalC = count($categoriaC);
            $this->listaA->CategoriaC = [
                "n_items" => $totalC,
                "Monto" => $sumaC,
                "Ventas"=> $categoriaC
            ];
            $this->listaA->global = $this->global;
            return $this->listaA;
        }
    }
    $obj = new ventas($_DATA->venta);
    echo json_encode($obj->calculo(),JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>