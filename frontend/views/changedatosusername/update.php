<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\changedatosusername */

$this->title = 'Update Changedatosusername: ' . $model->usuario;
$this->params['breadcrumbs'][] = ['label' => 'Changedatosusernames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuario, 'url' => ['view', 'id' => $model->usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="changedatosusername-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
