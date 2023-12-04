<?php

/** @var yii\web\View $this */

use frontend\models\GitForm;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="input-group mb-3">
        <?php $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'options' => [
                'class' => "width100"
            ],
            'fieldConfig' => [
                'template' => "<span class='input-group-text'>{label}</span>{input}",
                'options' => ['tag' => false]
            ]
        ]); ?>

        <div class="input-group mb-3">
            <?= $form->field($gitForm, 'path', [
                'options' => [
                    'class' => 'form-control'
                ],
                'inputOptions' => [
                    'placeholder' => 'Введите адрес репозитория',
                ],
            ])->textInput(['autofocus' => true])
                ->label('Ссылка на репозиторий')
            ?>
            <?= $form->field($gitForm, 'from')
                ->widget(DatePicker::classname(), [
                    'options' => [
                        'class' => 'form-control'
                    ]
                ])->label('С')
            ?>
            <?= $form->field($gitForm, 'to')
                ->widget(DatePicker::classname(), [
                    'options' => [
                        'class' => 'form-control'
                    ],
                ])->label('По')
            ?>

            <?= Html::submitButton('Go!', ['class' => 'btn btn-outline-secondary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <?php if (!empty($gitCommitTable)) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>Название файла</th>
                    <th>Общее количество коммитов, в которых изменялся файл</th>
                    <th>Cписок авторов, которые вносили изменения в файл</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($gitCommitTable as $gitCommit) { ?>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
