<?php

namespace frontend\services;

use frontend\models\GitHandlerInterface;
use frontend\models\GitHub;
use frontend\models\GitLab;

class GitHandlerService implements GitHandlerInterface
{
    public function __construct(
        private GitHubHandlerService $gitHubHandlerService,
        private GitLabHandlerService $gitLabHandlerService
    ) {}

    public function handleGitHub(GitHub $gitHub): array
    {
        $perPage = 30;
        $page = 1;
        $commits = [];
        while ($commitsBatch = $this->gitHubHandlerService->getCommits(
            $gitHub->getOwner(),
            $gitHub->getRepo(),
            $gitHub->getFromWithTime(),
            $gitHub->getToWithTime(),
            $perPage,
            $page
        )) {
            $commits = array_merge($commits, $commitsBatch);
            $page++;
        }

        return $this->getCommitsFiles($commits, $gitHub);
    }

    private function getCommitsFiles(array $commits, GitHub $gitHub): array
    {
        $result = [];
        foreach ($commits as $commit) {
            $commitData = $this->gitHubHandlerService->getCommit(
                $gitHub->getOwner(),
                $gitHub->getRepo(),
                $commit['sha']
            );
            if (!empty($commitData['files'])) {
                foreach ($commitData['files'] as $file) {
                    $result[$file['filename']]['commits'][$commit['sha']] = $commit['sha'];
                    $result[$file['filename']]['authors'][$commit['author']['login']] = $commit['author']['login'];
                }
            }
        }

        return $result;
    }

    public function handleGitLab(GitLab $gitLab): array
    {
        return [];
    }
}