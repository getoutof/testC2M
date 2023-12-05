<?php

namespace frontend\models;

interface GitHandlerInterface
{
    public function handleGitHub(GitHub $gitHub): array;

    public function handleGitLab(GitLab $gitLab): array;
}