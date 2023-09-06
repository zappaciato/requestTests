<?php

namespace Kris\TestProject\Classes\MathClasses;

use NiceDisplay;

//1. Write a PHP class 'Rectangle' that has properties for length and width. Implement methods to calculate the rectangle's area and perimeter.


abstract class Shape
{
    // use NiceDisplay;

    abstract protected function calcArea() : float;
    abstract protected function calcPerimeter() : float;

}
