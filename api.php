<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    $_DATA = json_decode(file_get_contents("php://input"));
    
    class signo_zod {
        public $dia;
        public $mes;
        public $signos;

        public function __construct(int $dia, int $mes) {
            $this->dia = $dia;
            $this->mes = $mes;
            $this->signos = (object) [
                "Aries" => [
                    "0" => [21, 3],
                    "1" => [19, 4]
                ],
                "Tauro" => [
                    "0" => [20, 4],
                    "1" => [20, 5]
                ],
                "Géminis" => [
                    "0" => [21, 5],
                    "1" => [20, 6]
                ],
                "Cáncer" => [
                    "0" => [21, 6],
                    "1" => [22, 7]
                ],
                "Leo" => [
                    "0" => [23, 7],
                    "1" => [22, 8]
                ],
                "Virgo" => [
                    "0" => [23, 8],
                    "1" => [22, 9]
                ],
                "Libra" => [
                    "0" => [23, 9],
                    "1" => [22, 10]
                ],
                "Escorpio" => [
                    "0" => [23, 10],
                    "1" => [21, 11]
                ],
                "Sagitario" => [
                    "0" => [22, 11],
                    "1" => [21, 12]
                ],
                "Capricornio" => [
                    "0" => [22, 12],
                    "1" => [19, 1]
                ],
                "Acuario" => [
                    "0" => [20, 1],
                    "1" => [18, 2]
                ],
                "Piscis" => [
                    "0" => [19, 2],
                    "1" => [20, 3]
                ]
            ];
        }

        public function buscar():string {
            $res = "";
            foreach ($this->signos as $key => $value) {
                if(($this->dia >= $value[0][0] && $value[0][1] == $this->mes) || ($this->dia <= $value[1][0] && $value[1][1] == $this->mes)){
                    $res = $key;
                }
            }
            return $res;
        }
    }
    $obj = new signo_zod($_DATA->dia, $_DATA->mes);
    echo json_encode(["signo_user" => $obj->buscar()],JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>