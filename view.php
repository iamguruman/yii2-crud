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
        <?= Html::a('Удалить?', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                    'created_by',
                    'updated_at',
                    'updated_by',
                    'markdel_at',
                    'markdel_by',
                ],
            ])
        ],
    ]]) ?>

</div>
