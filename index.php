<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\onecdb\models\MOnecdbUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$module = "vacancy";
$controller = "default";
$action = "index";

if(aIfModuleControllerAction($module, $controller, $action)){
    $this->title = app\modules\supplierrequest\Module::moduleTitle;
    $this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="monecdb-user-index">

    <?= aHtmlHeader($this->title, $module, $controller, $action) ?>

    <p>
        <?= aIfModuleControllerAction($module, $controller, $action) ?
            Html::a('Добавить', ["/{$module}/{$controller}/create"], ['class' => 'btn btn-success'])
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

            ['attribute' => 'id', 'format' => 'raw', 'value' => function($model) { return aGridVIewColumnId($model); }],
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

            [
                'attribute' => 'doneSearch',
                'format' => 'raw',
                'header' => "<img src='/mmodules/delviery/icon_done.png' height='25' title='Статус выполнено\НЕ выполнено'>",
                'headerOptions' => ['style' => 'width:50px;'],
                'value' => function(\app\modules\deliveries\models\Delivery $model){

                    $ret = [];

                    if($model->doneBy){
                        $ret [] = Html::a(
                            "<i class='fas fa-check-double' title='Правка выполнена, статус установил {$model->doneBy->lastnameWithInitials} {$model->done_at}'></i>",
                            ['/deliveries/delivery/set-done', 'id' => $model->id, 'returnto' => $_SERVER['REQUEST_URI']],
                            ['class' => 'btn btn-success',
                                'data' => [
                                    'confirm' => 'Установить статус НЕ выполнено?',
                                    'method' => 'post',
                                ]
                            ]);
                    } else {
                        $ret [] = Html::a(
                            "<i class='fas fa-times' title='Правка не выполнена'></i>",
                            ['/deliveries/delivery/set-done', 'id' => $model->id, 'returnto' => $_SERVER['REQUEST_URI']],
                            ['class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Установить статус ВЫПОЛНЕНО?',
                                    'method' => 'post',
                                ]
                            ]);
                    }

                    return implode($ret);
                },
            ],
            
            [
                'attribute' => 'jpNameSearch',
                'format' => 'raw',
                'value' => function(\app\modules\jps\models\MJpsVcard $model){
                    return $model->jp->getUrlTo();
                }
            ],
            
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {files}', 'buttons' => [
                'view' => function($url, $model, $key){
                    return aGridViewActionColumnViewButton($model, $model->getUrlView());
                },
                
                'files' => function($url, \app\modules\route\models\MRoute $model, $key){

                    $count = count($model->uploads);

                    if($count > 0){
                        return Html::a("<i class='fas fa-paperclip'>{$count}</i>",
                            ['/route/route/view', 'id' => $model->id, 'tab' => 'files'],
                            ['data-pjax' => 0]);
                    }

                }
            ]],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
