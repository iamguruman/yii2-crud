<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\customer_review\models\MReview */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы Покупателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mreview-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= aHtmlButtonUpdate($model) ?>
        
        <?= $model->doneBy ?
            Html::a(
                "<i class='fas fa-check-double' title='Выполнено, статус установил {$model->doneBy->lastnameWithInitials} {$model->done_at}'></i>",
                ['/tasks/correction/set-done', 'id' => $model->id, 'returnto' => $_SERVER['REQUEST_URI']],
                ['class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'Установить статус НЕ выполнено?',
                        'method' => 'post',
                    ]
                ])
            :
            Html::a(
                "<i class='fas fa-times' title='Не выполнен'></i>",
                ['/tasks/correction/set-done', 'id' => $model->id, 'returnto' => $_SERVER['REQUEST_URI']],
                ['class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Установить статус ВЫПОЛНЕНО?',
                        'method' => 'post',
                    ]
                ])
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'saleorder_id',
            'ordered_goods',
            'person_name',
            'person_photo',
            'textreview:ntext',
            'stars',
        ],
    ]) ?>
    
    <?= \yii\bootstrap\Tabs::widget(['items' => [
        [
            'label' => 'ID',
            'active' => false,
            'content' => DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'created_at',
                    'createdBy.lastNameWithInitials',
                    'updated_at',
                    'updatedBy.lastNameWithInitials',
                    'markdel_at',
                    'markdelBy.lastNameWithInitials',
                ],
            ])
        ],
    ]]) ?>

</div>
