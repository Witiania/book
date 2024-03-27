<?php

namespace App\Response\Book;

use App\Entity\Book;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetBooksResponse extends JsonResponse {
  public function __construct(array $books) {
    parent::__construct(self::getData($books));
  }

  /**
   * @param Book[] $books
   * @return array
   */
  public static function getData(array $books): array {
    $result = [];

    foreach ($books as $book) {
      $result[] = GetBookResponse::getData($book);
    }

    return $result;
  }
}