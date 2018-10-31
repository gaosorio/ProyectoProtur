<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\personalce */

$this->title = $model->fecha_personal_ce;
$this->params['breadcrumbs'][] = ['label' => 'Personalces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personalce-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> Actualizar', ['update', 'fecha_personal_ce' => $model->fecha_personal_ce, 'id_centro' => $model->id_centro], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fecha_personal_ce',
            //'mes_personal_ce',
            //'ano_personal_ce',
            'id_centro',
            //'id_socio',
            'personalfijo_personal_ce',
            'personalparttime_personal_ce',
        ],
    ]) ?>

</div>
