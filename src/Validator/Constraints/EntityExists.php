<?php

namespace App\Validator\Constraints;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class EntityExists extends Constraint
{
  public string $message = 'The entity ID "{{ id }}" does not exist.';

  public string $entityClass;

  public function __construct(string $entityClass, mixed $options = null, ?array $groups = null, mixed $payload = null) {
    parent::__construct($options, $groups, $payload);
    $this->entityClass = $entityClass;
  }
}