<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    
    <?= Html::a('<img class="logo-mini" src="'. $directoryAsset.'/img/mini-logo.png" height="48" width="48"  /><img class="logo-lg" src="'. Yii::$app->request->baseUrl.'/css/logofondo.jpg" height="50" width="218"  />', Yii::$app->homeUrl, ['class' => 'logo', 'style' => 'background-color:rgb(26,35,38);padding-left: 5px;']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->request->baseUrl?>/css/user_icon2.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"></span>
                        <?php
                            if(!Yii::$app->user->isGuest)
                            { 
                                echo Yii::$app->user->identity->usuario;
                            }
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::$app->request->baseUrl?>/css/user_icon2.png" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?php 

                                if(!Yii::$app->user->isGuest)
                                { 
                                    echo Yii::$app->user->identity->usuario;echo "<BR>";
                                    echo Yii::$app->user->identity->cargo; echo"<BR>";
                                    ?><small><?= Yii::$app->user->identity->socio?></small><?php
                                }
                                ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    '<i class="ace-icon fa fa-power-off"></i> Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-danger']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
