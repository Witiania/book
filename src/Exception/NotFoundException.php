<?php

namespace App\Exception;

use Exception;
use Throwable;

class NotFoundException extends Exception {
  public function __construct(string $entityName, int $entityId, ?Throwable $previous = null) {
    parent::__construct("{$entityName} with id {$entityId} not found", 404, $previous);
  }
}