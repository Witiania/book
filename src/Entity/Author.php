<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use App\Entity\BookAuthor;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ORM\Table(name: 'author')]
class Author
{
    #[ORM\OneToMany(targetEntity: BookAuthor::class, mappedBy: 'author')]
    private Collection $bookAuthors;

    public function __construct()
    {
        $this->bookAuthors = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getBookAuthors(): Collection
    {
        return $this->bookAuthors;
    }

    public function addBookAuthor(BookAuthor $bookAuthor): self
    {
        if (!$this->bookAuthors->contains($bookAuthor)) {
            $this->bookAuthors[] = $bookAuthor;
            $bookAuthor->setAuthor($this);
        }

        return $this;
    }

    public function removeBookAuthor(BookAuthor $bookAuthor): self
    {
        if ($this->bookAuthors->removeElement($bookAuthor)) {
            // set the owning side to null (unless already changed)
            if ($bookAuthor->getAuthor() === $this) {
                $bookAuthor->setAuthor(null);
            }
        }

        return $this;
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $books = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBooks(): ?string
    {
        return $this->books;
    }

    public function setBooks(string $books): static
    {
        $this->books = $books;

        return $this;
    }
}
