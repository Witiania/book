<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $author1 = new Author();
        $author1->setFirstName('Test1');
        $author1->setLastName('Test1');
        $manager->persist($author1);

        $author2 = new Author();
        $author2->setFirstName('Test2');
        $author2->setLastName('Test2');
        $manager->persist($author2);

        $publisher1 = new Publisher();
        $publisher1->setName('Test1');
        $publisher1->setAddress('Test1');
        $manager->persist($publisher1);

        $publisher2 = new Publisher();
        $publisher2->setName('Test2');
        $publisher2->setAddress('Test2');
        $manager->persist($publisher2);

        $book1 = new Book();
        $book1->setTitle('Test1');
        $book1->setYear(1990);
        $book1->setPublisher($publisher1);
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle('Test2');
        $book2->setYear(1991);
        $book2->setPublisher($publisher2);
        $manager->persist($book2);

        $manager->flush();

        $book1->addAuthor($author1);
        $book1->addAuthor($author2);
        $manager->persist($book1);

        $book2->addAuthor($author1);
        $book2->addAuthor($author2);
        $manager->persist($book2);

        $manager->flush();
    }
}