<?php

namespace App\Service\Publisher;

use App\Entity\Publisher;
use App\Exception\NotFoundException;
use App\Repository\PublisherRepository;
use App\Request\Publisher\CreateOrUpdatePublisherDto;

class UpdatePublisherService {

  public function __construct(
    private readonly PublisherRepository $publisherRepository
  ) {
  }

    /**
     * @throws NotFoundException
     */
    public function handle(int $id, CreateOrUpdatePublisherDto $createPublisherDto): Publisher {
    /** @var ?Publisher $publisher */
    $publisher = $this->publisherRepository->find($id);
    if (null === $publisher) {
      throw new NotFoundException('Publisher', $id);
    }

    $publisher->setName($createPublisherDto->name);
    $publisher->setAddress($createPublisherDto->address);

    $this->publisherRepository->save($publisher);

    return $publisher;
  }
}