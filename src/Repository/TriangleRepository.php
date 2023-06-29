<?php

namespace App\Repository;

use App\Entity\Triangle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Triangle>
 *
 * @method Triangle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Triangle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Triangle[]    findAll()
 * @method Triangle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TriangleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Triangle::class);
    }

    public function get(float $a, float $b, float $c): Triangle
    {
        $entity = $this->findOneBy(['a' => $a, 'b' => $b, 'c' => $c]);
        if (!$entity) {
            $entity = $this->save($a, $b, $c, true);
        }

        return $entity;
    }

    public function save(float $a, float $b, float $c, bool $flush = false): Triangle
    {
        $entity = new Triangle;
        $entity->setA($a);
        $entity->setB($b);
        $entity->setC($c);
        $entity->setSurface();
        $entity->setCircumference();

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $entity;
    }
}
