<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\personalh */

$this->title = 'Crear Personal';
$this->params['breadcrumbs'][] = ['label' => 'Personal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalh-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
