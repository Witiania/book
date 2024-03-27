<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ORM\Table(name: 'author')]
#[ORM\HasLifecycleCallbacks]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private int $id;

    #[ORM\Column(length: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $lastName;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: "authors")]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection<Book>
     */
    public function getBooks(): Collection {
        return $this->books;
    }

    public function addBook(Book $book): void {
        $this->books->add($book);
    }
    public function removeBook(Book $book): void {
        $this->books->removeElement($book);
    }

    #[ORM\PreRemove]
    public function preRemove(): void {
        /** @var Book $book */
        foreach ($this->books as $book) {
            $book->removeAuthor($this);
        }
        $this->books->clear();
    }

}
