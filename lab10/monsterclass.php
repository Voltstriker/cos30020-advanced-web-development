<?php
class Monster
{
    public $num_of_eyes;
    public $colour;

    function __construct($num, $col)
    {
        $this->num_of_eyes = $num;
        $this->colour = $col;
    }

    function describe()
    {
        $ans = "The " . $this->colour .  " monster has " . $this->num_of_eyes . " eye";
        // Ensure the number of eyes is pluralised correctly
        if ($this->num_of_eyes != 1) {
            $ans = $ans . "s";
        } else {
            $ans = $ans . ".";
        }

        return $ans;
    }
}
