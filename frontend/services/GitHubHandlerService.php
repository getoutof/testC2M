<?php

namespace frontend\services;

class GitHubHandlerService
{
    const API_HOST = 'https://api.github.com';

    public function getDefaultBranchName(string $owner, string $repo): string
    {
        $response = $this->getRepository($owner, $repo);

        return $response['default_branch'];
    }

    public function getRepository(string $owner, string $repo): array
    {
        $curlService = new CurlService(sprintf("%s/repos/%s/%s", self::API_HOST, $owner, $repo));
        return $curlService->execute();
    }

    public function getBranchSHA(string $owner, string $repo, string $branch): string
    {
        $branch = $this->getBranch($owner, $repo, $branch);

        return $branch['commit']['sha'];
    }

    public function getBranch(string $owner, string $repo, string $branch): array
    {
        $curlService = new CurlService(sprintf("%s/repos/%s/%s/branches/%s", self::API_HOST, $owner, $repo, $branch));
        return $curlService->execute();
    }

    public function getTree(string $owner, string $repo, string $sha, bool $recursive): array
    {
        $url = sprintf("%s/repos/%s/%s/git/trees/%s", self::API_HOST, $owner, $repo, $sha);
        if ($recursive) {
            $url = sprintf("%s/repos/%s/%s/git/trees/%s?recursive=1", self::API_HOST, $owner, $repo, $sha);
        }
        $curlService = new CurlService($url);
        return $curlService->execute();
    }

    public function getCommits(string $owner, string $repo, string $from, string $to, int $perPage, int $page): array
    {
        $query = '';
        if (!empty($from)) {
            $query .= sprintf('since=%s', $from);
        }
        if (!empty($to)) {
            if (!empty($query)) {
                $query .= '&';
            }
            $query .= sprintf('until=%s', $to);
        }
        if (!empty($perPage)) {
            if (!empty($query)) {
                $query .= '&';
            }
            $query .= sprintf('per_page=%d', $perPage);
        }
        if (!empty($page)) {
            if (!empty($query)) {
                $query .= '&';
            }
            $query .= sprintf('page=%d', $page);
        }
        if (!empty($query)) {
            $query = '?' . $query;
        }

        $curlService = new CurlService(sprintf("%s/repos/%s/%s/commits" . $query, self::API_HOST, $owner, $repo));
        return $curlService->execute();
    }

    public function getCommit(string $owner, string $repo, string $ref): array
    {
        $curlService = new CurlService(sprintf("%s/repos/%s/%s/commits/%s", self::API_HOST, $owner, $repo, $ref));
        return $curlService->execute();
    }
}