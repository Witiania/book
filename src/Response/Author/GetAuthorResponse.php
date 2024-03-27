<?php

namespace App\Response\Author;

use App\Entity\Author;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetAuthorResponse extends JsonResponse {

  public function __construct(Author $author) {
    parent::__construct(self::getData($author));
  }

  public static function getData(Author $author): array {
    return [
      'id'         => $author->getId(),
      'first_name' => $author->getFirstName(),
      'last_name'  => $author->getLastName(),
    ];
  }
}