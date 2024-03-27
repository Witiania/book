<?php

namespace App\Repository;

use App\Entity\Publisher;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class PublisherRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Publisher::class);
    }

    public function save(Publisher $publisher): void
    {
        $this->getEntityManager()->persist($publisher);
        $this->getEntityManager()->flush();
    }

    public function delete(Publisher $publisher): void
    {
        $this->getEntityManager()->remove($publisher);
        $this->getEntityManager()->flush();
    }
}