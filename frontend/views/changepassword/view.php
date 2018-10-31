<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\changepassword */

$this->title = $model->usuario;
$this->params['breadcrumbs'][] = ['label' => 'Changepasswords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="changepassword-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'usuario' => $model->usuario, 'pass_actual' => $model->pass_actual, 'pass_nuevo' => $model->pass_nuevo, 'confir_pass_nuevo' => $model->confir_pass_nuevo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'usuario' => $model->usuario, 'pass_actual' => $model->pass_actual, 'pass_nuevo' => $model->pass_nuevo, 'confir_pass_nuevo' => $model->confir_pass_nuevo], [
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
            'pass_actual',
            'pass_nuevo',
            'confir_pass_nuevo',
        ],
    ]) ?>

</div>
