<?php

namespace App\Controller;

use App\Repository\CircleRepository;
use App\Repository\TriangleRepository;
use App\Entity\Triangle;
use App\Entity\Circle;
use App\Service\GeometryCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GeometryController extends AbstractController
{
    public function __construct(
        private CircleRepository $circleRepository,
        private TriangleRepository $triangleRepository,
        private GeometryCalculator $geometryCalculator,
        private CacheInterface $cache
    ) {
        
    }

    #[Route('/triangle/{a}/{b}/{c}', name: 'triangle')]
    public function triangleAction(float $a, float $b, float $c): JsonResponse
    {
        $triangle = $this->cache->get('triangle_' . $a . '_' . $b . '_' . $c, function(ItemInterface $item) use ($a, $b, $c): Triangle {
            return $triangle = $this->triangleRepository->get($a, $b, $c);
        });

        return $this->json($triangle);
    }

    #[Route('/circle/{radius}', name: 'radius')]
    public function radiusAction(float $radius): JsonResponse
    {
        $circle = $this->cache->get('circle_' . $radius, function(ItemInterface $item) use ($radius): Circle {
            return $this->circleRepository->get($radius);
        });

        return $this->json($circle);
    }
}
