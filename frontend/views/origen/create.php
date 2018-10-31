<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Origen */

$this->title = 'Crear Origen';
$this->params['breadcrumbs'][] = ['label' => 'Países de origen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origen-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
