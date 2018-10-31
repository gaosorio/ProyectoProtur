<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GraficotarifaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Graficotarifas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="graficotarifa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Graficotarifa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
