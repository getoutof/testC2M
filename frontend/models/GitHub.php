<?php

namespace frontend\models;

class GitHub implements GitInterface
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

    public function getFromWithTime(): string
    {
        return $this->from . 'T00:00:00Z';
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getToWithTime(): string
    {
        return $this->to . 'T00:00:00Z';
    }

    public function accept(GitHandlerInterface $gitHandlerInterface): array
    {
        return $gitHandlerInterface->handleGitHub($this);
    }
}