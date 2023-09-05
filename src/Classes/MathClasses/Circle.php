<?php

namespace Kris\TestProject\Classes\MathClasses;
// Write a PHP class called 'Circle' that has a radius property. Implement methods to calculate the circle's area and circumference.
use Kris\TestProject\Classes\MathClasses\Shape;

class Circle extends Shape
{

    private int $radius;
    public $pi = 3.14;

    public function __construct($radius)
    {
        $this->radius = $radius;
        
    }

    public function calcArea (): int
    {
        $area = pow($this->radius, 2) * $this->pi;

        return $area;
    }

    public function calcPerimeter(): int
    {
        $perimeter = 2 * ($this->radius  * $this->pi);

        return $perimeter;
    }
}
