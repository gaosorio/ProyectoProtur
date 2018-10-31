<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\changedatosusernameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Changedatosusernames';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="changedatosusername-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Changedatosusername', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usuario',
            'cargo',
            'nombre',
            'socio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
