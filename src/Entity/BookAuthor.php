<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'book_authors')]

class BookAuthor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?string $id = null;

    #[ORM\ManyToOne(targetEntity: Book::class, inversedBy: 'bookAuthors')]
    private ?Book $book = null;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'bookAuthors')]
    private ?Author $author = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }
}