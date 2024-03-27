<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Table(name: "book")]
#[ORM\HasLifecycleCallbacks]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: "string")]
    private ?string $title = null;

    #[ORM\Column(type: "integer")]
    private int $year;

    #[ORM\ManyToOne(targetEntity: Publisher::class, inversedBy: "books")]
    private ?Publisher $publisher = null;

    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: "books")]
    private Collection $authors;

    public function __construct() {
        $this->authors = new ArrayCollection();
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): self {
        $this->title = $title;
        return $this;
    }

    public function getYear(): int {
        return $this->year;
    }

    public function setYear(int $year): self {
        $this->year = $year;
        return $this;
    }

    /**
     * @return Publisher|null
     */
    public function getPublisher(): ?Publisher {
        return $this->publisher;
    }

    /**
     * @param mixed $publisher
     */
    public function setPublisher(?Publisher $publisher): self {
        $this->publisher = $publisher;
        return $this;
    }

    /**
     * @return Collection<Author>
     */
    public function getAuthors(): Collection {
        return $this->authors;
    }

    public function addAuthor(Author $author): void {
        $this->authors->add($author);
    }

    public function removeAuthor(Author $author): void {
        $this->authors->removeElement($author);
    }

    #[ORM\PreRemove]
    public function preRemove(): void {
        /** @var Author $author */
        foreach ($this->authors as $author) {
            $author->removeBook($this);
        }
        $this->authors->clear();
    }
}
