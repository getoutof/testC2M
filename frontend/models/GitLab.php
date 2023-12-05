<?php

namespace frontend\models;

class GitLab implements GitInterface
{
    public function __construct(
        private string $owner,
        private string $repo,
        private string $from,
        private string $to
    ) {}

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getRepo(): string
    {
        return $this->repo;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function accept(GitHandlerInterface $gitHandlerInterface): array
    {
        return $gitHandlerInterface->handleGitLab($this);
    }
}