<?php

namespace App\Service\Publisher;

use App\Entity\Publisher;
use App\Repository\PublisherRepository;
use App\Request\Publisher\CreateOrUpdatePublisherDto;

class CreatePublisherService {

  public function __construct(
    private readonly PublisherRepository $publisherRepository
  ) {
  }

  public function handle(CreateOrUpdatePublisherDto $createPublisherDto): Publisher {
    $publisher = new Publisher();
    $publisher->setName($createPublisherDto->name);
    $publisher->setAddress($createPublisherDto->address);

    $this->publisherRepository->save($publisher);

    return $publisher;
  }
}