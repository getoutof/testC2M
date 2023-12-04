<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

class GitForm extends Model
{
    public $path;
    public $from;
    public $to;

    public function rules()
    {
        return [
            ['path', 'trim'],
            ['path', 'required'],
            ['from', 'required'],
            ['from', 'datetime'],
            ['to', 'required'],
            ['to', 'datetime'],
        ];
    }

    public function getCommitData()
    {
        return [];
    }
}