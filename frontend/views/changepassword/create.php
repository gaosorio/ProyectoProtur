<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\changepassword */

$this->title = 'Create Changepassword';
$this->params['breadcrumbs'][] = ['label' => 'Changepasswords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="changepassword-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
