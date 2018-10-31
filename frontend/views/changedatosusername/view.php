<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\changedatosusername */

$this->title = $model->usuario;
$this->params['breadcrumbs'][] = ['label' => 'Changedatosusernames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="changedatosusername-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->usuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'usuario',
            'cargo',
            'nombre',
            'socio',
        ],
    ]) ?>

</div>
