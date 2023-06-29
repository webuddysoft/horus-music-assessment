<?php

namespace App\Repository;

use App\Entity\Circle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Circle>
 *
 * @method Circle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Circle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Circle[]    findAll()
 * @method Circle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CircleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Circle::class);
    }

    public function get(float $radius): Circle
    {
        $entity = $this->findOneBy(['radius' => $radius]);
        if (!$entity) {
            $entity = $this->save($radius, true);
        }

        return $entity;
    }

    public function save(float $radius, bool $flush = false): Circle
    {
        $entity = new Circle();
        $entity->setRadius($radius);
        $entity->setSurface();
        $entity->setCircumference();

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $entity;
    }
}
