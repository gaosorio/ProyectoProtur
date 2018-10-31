<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Evento */

$this->title = 'Crear Evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
