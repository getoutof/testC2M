<?php

namespace frontend\controllers;

use frontend\models\GitForm;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $gitForm = new GitForm();
        $gitCommitTable = [];

        if ($gitForm->load(Yii::$app->request->post())) {
            $gitCommitTable = $gitForm->getCommitData();
        }

        return $this->render('index', [
            'gitForm' => $gitForm,
            'gitCommitTable' => $gitCommitTable
        ]);
    }
}
