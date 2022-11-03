<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    
    class pago {
        public $mens=0;
        public $total=0;
        public function calculo():array {
            $men = [];
            for($i=1; $i<=20; $i++) {
                if($i==1) {
                    $this->mens = 10;
                }
                else {
                    $this->mens *=2;
                }
                $this->total += $this->mens;
                array_push($men, ["mensaje" => "El pago del mes $i es de $: $this->mens"]);
            }
            array_push($men, ["total" => "El pago total es de: $: $this->total"]);
            return $men;
        }  
    }
    $obj = new pago();
    echo json_encode($obj->calculo(), JSON_PRETTY_PRINT);
?>