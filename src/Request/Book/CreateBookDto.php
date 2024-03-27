<?php

namespace App\Request\Book;

use App\Entity\Author;
use App\Entity\Publisher;
use App\Validator\Constraints\EntityExists;
use Symfony\Component\Validator\Constraints as Assert;

class CreateBookDto {
  #[Assert\NotBlank]
  #[Assert\Type(type: 'string')]
  public string $title;

  #[Assert\NotBlank]
  #[Assert\Type(type: 'int')]
  public int $year;

  #[Assert\NotBlank]
  #[Assert\Type(type: 'int')]
  #[EntityExists(entityClass: Publisher::class)]
  public int $publisherId;

  #[Assert\NotBlank]
  #[Assert\All(constraints: [
    new Assert\Type("int"),
    new EntityExists(entityClass: Author::class)
  ])]
  #[Assert\Valid]
  public array $authorIds;
}