<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\hotel */

$this->title = 'Crear Hotel';
$this->params['breadcrumbs'][] = ['label' => 'Hotel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
