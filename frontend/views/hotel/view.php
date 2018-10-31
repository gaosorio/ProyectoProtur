<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\hotel */

$this->title = $model->idhotel;
$this->params['breadcrumbs'][] = ['label' => 'Hotel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'id' => $model->idhotel], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idhotel',
            'nombrehotel',
            //'id_socio',
        ],
    ]) ?>

</div>
