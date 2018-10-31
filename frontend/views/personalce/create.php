<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\personalce */

$this->title = 'Crear Personal';
$this->params['breadcrumbs'][] = ['label' => 'Personalces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalce-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
