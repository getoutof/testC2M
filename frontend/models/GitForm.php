<?php
namespace frontend\models;

use frontend\services\GitHandlerService;
use frontend\services\GitHubHandlerService;
use frontend\services\GitLabHandlerService;
use Yii;
use yii\base\Model;

class GitForm extends Model
{
    const HOST_GITHUB = 'github.com';
    const HOST_GITLAB = 'gitlab.com';

    public string $path = '';
    public string $from = '';
    public string $to = '';

    public function rules(): array
    {
        return [
            ['path', 'trim'],
            ['path', 'required'],
            ['from', 'trim'],
            ['from', 'required'],
            ['from', 'datetime', 'format' => 'php:Y-m-d'],
            ['to', 'trim'],
            ['to', 'required'],
            ['to', 'datetime', 'format' => 'php:Y-m-d'],
        ];
    }

    public function getCommitData(): array
    {
        $host = parse_url($this->path, PHP_URL_HOST);
        $path = parse_url($this->path, PHP_URL_PATH);
        [, $owner, $repo] = explode('/', $path);

        switch ($host) {
            case self::HOST_GITHUB:
                $git = new GitHub($owner, $repo, $this->from, $this->to);
                break;
            case self::HOST_GITLAB:
                $git = new GitLab($owner, $repo, $this->from, $this->to);
                break;
            default:
                return [];
        }

        $gitHubHandlerService = new GitHubHandlerService();
        $gitLabHandlerService = new GitLabHandlerService();
        $handler = new GitHandlerService($gitHubHandlerService, $gitLabHandlerService);
        return $git->accept($handler);
    }
}