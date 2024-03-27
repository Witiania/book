<?php

namespace App\Response\Publisher;

use App\Entity\Publisher;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetPublisherResponse extends JsonResponse {
  public function __construct(Publisher $publisher) {
    parent::__construct(self::getData($publisher));
  }

  public static function getData(Publisher $publisher): array {
    return [
      'id'      => $publisher->getId(),
      'name'    => $publisher->getName(),
      'address' => $publisher->getAddress(),
    ];
  }
}