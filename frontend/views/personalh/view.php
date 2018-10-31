<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalh */

$this->title = $model->fechap;
$this->params['breadcrumbs'][] = ['label' => 'Personalhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalh-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'fechap' => $model->fechap, 'idhotel' => $model->idhotel], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fechap',
            'idhotel',
            'personalfijo',
            'personalparttime',
            //'id_socio',
            //'mes_personal',
            //'año_personal',
        ],
    ]) ?>

</div>
