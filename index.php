<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\onecdb\models\MOnecdbUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if(aIfModuleControllerAction("onecdb", "user", "index")){
    $this->title = 'M Onecdb Users';
    $this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="monecdb-user-index">

    <?= aIfModuleControllerAction("onecdb", "user", "index") ?
        aH1(Html::encode($this->title))
    : null  ?>

    <p>
        <?= aIfModuleControllerAction("onecdb", "user", "index") ?
            Html::a('Добавить', ['create'], ['class' => 'btn btn-success'])
        : null  ?>

        <?= aIfModuleControllerAction("onecdb", "db", "view") ?
            Html::a('Добавить', ['/onecdb/user/create', 'id' => aGet('id')], ['class' => 'btn btn-success'])
        : null  ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'markdel_at',
            //'markdel_by',
            'onecdb.name',
            'user.lastNameWithInititals',
            //'onec_link',
            'onec_username',
            //'onec_password',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}', 'buttons' => [
                'view' => function($url, $model, $key){
                    return aGridViewActionColumnViewButton($model);
                }
            ]],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
