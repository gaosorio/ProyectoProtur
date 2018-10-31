<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\changeusername */

$this->title = $model->usuario;
$this->params['breadcrumbs'][] = ['label' => 'Changeusernames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="changeusername-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'usuario' => $model->usuario, 'new_username' => $model->new_username], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'usuario' => $model->usuario, 'new_username' => $model->new_username], [
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
            'new_username',
        ],
    ]) ?>

</div>
