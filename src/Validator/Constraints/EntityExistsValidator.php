<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;

class EntityExistsValidator extends ConstraintValidator
{
  private EntityManagerInterface $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function validate($value, Constraint $constraint): void
  {
    if (!$constraint instanceof EntityExists) {
      throw new \InvalidArgumentException('Invalid constraint provided.');
    }

    $entityRepository = $this->entityManager->getRepository($constraint->entityClass);
    $entity = $entityRepository->find($value);

    if (!$entity) {
      $this->context->buildViolation($constraint->message)
        ->setParameter('{{ id }}', $value)
        ->addViolation();
    }
  }
}