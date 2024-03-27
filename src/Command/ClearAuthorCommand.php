<?php

namespace App\Command;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearAuthorCommand extends Command
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
        parent::__construct('app:clearAuthor');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Author[] $authors */
        $authors = $this->authorRepository->findWithoutBooks();
        foreach ($authors as $author) {
            $this->authorRepository->delete($author);
        }

        return 0;
    }
}