<?php

namespace App\Entity;

use App\Repository\PublisherRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PublisherRepository::class)]
#[ORM\Table(name: 'publisher')]
class Publisher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: "string")]
    private string $name;

    #[ORM\Column(type: "string")]
    private ?string $address;

    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: "publisher")]
    private Collection $books;

    public function __construct() {
        $this->books = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress(): string {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void {
        $this->address = $address;
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
            $book->setPublisher(null);
        }
        $this->books->clear();
    }
}
