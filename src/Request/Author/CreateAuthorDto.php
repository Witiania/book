<?php


namespace App\Request\Author;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAuthorDto
{
    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    public string $firstName;

    #[Assert\NotBlank]
    #[Assert\Type(type: 'string')]
    public string $lastName;
}