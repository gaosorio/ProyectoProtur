<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\GraficopaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grafico Pais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grafico-pais-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Grafico Pais', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pais',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
