<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class AuthorRepository extends EntityRepository {
    public function __construct(ManagerRegistry $em) {
        parent::__construct($em, new ClassMetadata(Author::class));
    }

    public function save(Author $author): void
    {
        $this->getEntityManager()->persist($author);
        $this->getEntityManager()->flush();
    }

    public function delete(Author $author): void
    {
        $this->getEntityManager()->remove($author);
        $this->getEntityManager()->flush();
    }

    public function findWithoutBooks() {

        $qb = $this->createQueryBuilder('a');

        $qb->leftJoin('a.books', 'b')
            ->where($qb->expr()->isNull('b'));

        return $qb->getQuery()->getResult();
    }
}