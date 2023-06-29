<?php

namespace App\Service;

use App\Entity\Circle;
use App\Entity\Triangle;

class GeometryCalculator
{
    public function calculateSumOfAreas(Circle $circle, Triangle $triangle): float
    {
        return $circle->calculateSurface() + $triangle->calculateSurface();
    }

    public function calculateSumOfDiameters(Circle $circle, Triangle $triangle): float
    {
        return $circle->calculateCircumference() + $triangle->calculateCircumference();
    }
}
