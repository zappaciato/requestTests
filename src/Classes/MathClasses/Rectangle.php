<?php

namespace Kris\TestProject\Classes\MathClasses;

use Kris\TestProject\Classes\MathClasses\Shape;
use Kris\TestProject\Classes\MathClasses\NiceDisplay;

//1. Write a PHP class 'Rectangle' that has properties for length and width. Implement methods to calculate the rectangle's area and perimeter.


class Rectangle extends Shape{

    use NiceDisplay;

    private int $length;
    private int $width;

    public function __construct($length, $width)
    {
        $this->length = $length;
        $this->width = $width;
    }

    public function calcArea() : int {
        $area = $this->length * $this->width;

        return $area;
    }

    public function calcPerimeter() : int {
        $perimeter = 2 * $this->length + 2 * $this->width;

        return $perimeter;
    }

}