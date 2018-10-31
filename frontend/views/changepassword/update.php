<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\changepassword */

$this->title = 'Update Changepassword: ' . $model->usuario;
$this->params['breadcrumbs'][] = ['label' => 'Changepasswords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuario, 'url' => ['view', 'usuario' => $model->usuario, 'pass_actual' => $model->pass_actual, 'pass_nuevo' => $model->pass_nuevo, 'confir_pass_nuevo' => $model->confir_pass_nuevo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="changepassword-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
