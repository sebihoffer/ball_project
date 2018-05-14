<?php

namespace sebi\ball;


  abstract class ball {
        protected $name;
        protected $durchmesser;
        protected $material;

        public function __construct(String $name, int $durchmessser, String $material){
            $this->name = $name;
            $this->durchmesser = $durchmessser;
            $this->material = $material;

        }

        /**
         * @return mixed
         */
        public function getName() : string
        {
            return $this->name;
        }

        /**
         * @return mixed
         */
        public function getDurchmesser() : float
        {
            return $this->durchmesser;
        }

        /**
         * @return mixed
         */
        public function getMaterial() : string
        {
            return $this->material;
        }


        public function volumen() : float {
            return 3/4*pi()*($this->durchmesser/2)^3;
        }


        function __toString() : string
        {
            $stringResult = "Name: " . $this->getName() . "<br> Durchmesser: " . $this->getDurchmesser() . "<br> Material: " . $this->getMaterial() . "<br> Volumen: ". $this->volumen() ."<br> <br>";

            if($_GET['jsonHtml'] == "html") {
                if(isset($_GET['material']) && $this->material == $_GET['material']) {
                    return $stringResult;
                }elseif(isset($_GET['material']) == false){
                    return $stringResult;
                }
            }elseif ($_GET['jsonHtml'] == "json"){
                if(isset($_GET['material']) && $this->material == $_GET['material']) {
                    echo json_encode($stringResult);
                    return "";
                }elseif(isset($_GET['material']) == false){
                    echo json_encode($stringResult);
                    return "";
                }
            }
            return "";

        }


    }


$ball1 = new basketball("Basketball", 30, "Leder");
$ball2 = new volleyball("Volleyball", 30, "Plastik");
$ball3 = new flummi("Flummi", 30, "Gummi");
$ball4 = new basketball("Basketball", 30, "Leder");
$ball5 = new volleyball("Volleyball", 30, "Leder");
$ball6 = new flummi("Flummi", 30, "Gummi");

if(isset($_GET['jsonHtml'])) {
    echo $ball1;
    echo $ball2;
    echo $ball3;
    echo $ball4;
    echo $ball5;
    echo $ball6;
}



