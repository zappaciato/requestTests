<?php

namespace Kris\TestProject\Classes\MathClasses;


trait NiceDisplay {
    
    private string $item;
    private string $calculationType;
    private int $result; 

    public function displayResult($item, $calculationType, $result) {
        $this->item = $item;
        $this->calculationType = $calculationType;
        $this->result = $result;
        print_r("THIS IS NICE DISPLAY DATA: " . $this->item . $this->calculationType . $this->result);
    }
}