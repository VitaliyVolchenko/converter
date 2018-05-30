<?php

class Converter
{
    private $number;
    private $dictionaryRom = array('I' => 1, 'V' => 5, 'X' => 10, 'L' => 50,
        'C' => 100, 'D' => 500, 'M' => 1000);

    private $dictionaryArab = array(1000 => "M", 900 => "CM", 500 => "D", 400 => "CD",
        100 => "C", 90 => "XC", 50 => "L", 40 => "XL",
        10 => "X", 9 => "IX", 5 => "V", 4 => "IV", 1 => "I");
    private $result;

    public function __construct(&$buf)
    {
        $this->number = $buf;
    }

    public function roman_to_arabic()
    {
        $length = strlen($this->number);
        $active = 0;
        for ($i = $length - 1; $i >= 0; $i--) {
            $next = $this->dictionaryRom[$this->number[$i]];
            if ($next < $active){
                $this->result -= $next;
            } else {
                $this->result += $next;
                $active = $next;
            }
        }
        echo $this->result;
    }

    public function arabic_to_roman () {
        if ($this->number<0) $this->number=-$this->number;
        if (!$this->number) return "0";

        while($this->number) {
            foreach($this->dictionaryArab as $key => $char){

                if($key <= $this->number){
                    $amount=(int)($this->number/$key);
                    $this->number-=$key*$amount;
                    $this->result.=str_repeat($char,$amount);
                }
            }
            echo $this->result;
        }
    }

    public function valid (){
        if (ctype_digit($this->number)){
            $this->arabic_to_roman();
        } else {
            $this->roman_to_arabic();
        }
    }
}