<?php

namespace App\Service\Publisher;

use App\Entity\Publisher;
use App\Exception\NotFoundException;
use App\Repository\PublisherRepository;

class DeletePublisherService {
  public function __construct(
    private readonly PublisherRepository $publisherRepository
  ) {
  }

    /**
     * @throws NotFoundException
     */
    public function handle(int $id): void {
    /** @var ?Publisher $publisher */
    $publisher = $this->publisherRepository->find($id);
    if (null === $publisher) {
      throw new NotFoundException('Publisher', $id);
    }

    $this->publisherRepository->delete($publisher);
  }
}