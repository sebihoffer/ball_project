<?php

namespace sebi\ball;


class basketball extends ball implements ballinterface
{

        function __construct(String $name, int $durchmessser, String $material){
            parent:: __construct($name, $durchmessser, $material);

    }

    public function volumen(): float
    {
        // TODO: Implement volumen() method.
        return 3/4*pi()*($this->durchmesser/2)^3;
    }
}