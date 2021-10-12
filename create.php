<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jps\models\MJpsVcard */

$this->title = 'Связать Юрлицо и Визитку';

$this->params['breadcrumbs'][] = $this->params['breadcrumbs'][] = app\modules\supplierrequest\Module::getBreadcrumbs();

$this->params['breadcrumbs'][] = ['label' => 'Связь юрлиц и визиток', 'url' => ['/jps/vcard']];

if($model->jp){
    $this->params['breadcrumbs'][] = $model->jp->getBreadcrumbs();
}

if($model->vcard){
    $this->params['breadcrumbs'][] = $model->vcard->getBreadcrumbs();
}

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mjps-vcard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
