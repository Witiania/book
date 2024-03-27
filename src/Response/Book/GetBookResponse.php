<?php

namespace App\Response\Book;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetBookResponse extends JsonResponse {
  public function __construct(Book $book) {
    parent::__construct(self::getData($book));
  }

  public static function getData(Book $book): array {
    $result = [
      'id'             => $book->getId(),
      'title'          => $book->getTitle(),
      'year'           => $book->getYear(),
      'publisher_name' => $book->getPublisher()?->getName(),
      'authors'        => [],
    ];

    /** @var Author $author */
    foreach ($book->getAuthors() as $author) {
      $result['authors'][] = [
        'last_name' => $author->getLastName(),
      ];
    }

    return $result;
  }
}