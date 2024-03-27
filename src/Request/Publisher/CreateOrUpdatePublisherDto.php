<?php

namespace App\Request\Publisher;

use Symfony\Component\Validator\Constraints as Assert;

class CreateOrUpdatePublisherDto
{
  #[Assert\NotBlank]
  #[Assert\Type(type: 'string')]
  public string $name;

  #[Assert\NotBlank]
  #[Assert\Type(type: 'string')]
  public string $address;
}