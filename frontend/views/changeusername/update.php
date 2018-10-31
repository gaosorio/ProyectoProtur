<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\changeusername */

$this->title = 'Update Changeusername: ' . $model->usuario;
$this->params['breadcrumbs'][] = ['label' => 'Changeusernames', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usuario, 'url' => ['view', 'usuario' => $model->usuario, 'new_username' => $model->new_username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="changeusername-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
