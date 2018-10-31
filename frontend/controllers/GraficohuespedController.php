<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Graficohuesped;
use frontend\models\GraficohuespedSearch;
use frontend\models\Habitacion;
use frontend\models\Huesped;
use miloschuman\highcharts\Highcharts;
use yii\widgets\Pjax;
use frontend\models\Graficotarifa;
use frontend\models\GraficotarifaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \DateTime;

/**
 * GraficohuespedController implements the CRUD actions for Graficohuesped model.
 */
class GraficohuespedController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['estadiapromedio','create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /*
    public function actionIndex()
    {
        $searchModel = new GraficohuespedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Graficohuesped model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Graficohuesped model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
      public function actionCreate()
    {
        $model = new Graficohuesped();
        if ($model->load(Yii::$app->request->post())) {
            if($model->tipo === 'Nacionales'){

              $datosSocio = Huesped::find()->SELECT(['mes_huesped','año_huesped','nacionales'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_huesped,año_huesped,nacionales')->OrderBy('año_huesped,mes_huesped ASC')->asArray()->all();  
              $cantidadSocio = array();
              $fechasSocio = array();
              $cantidad = count($datosSocio);
              if( $cantidad > 12){
              for ($i = 0; $i < 12; $i++)
              {
                $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_huesped"]);
                $mes[$i] = $mesSocio[$i]->format('F');
                $añoSocio[$i] = $datosSocio[$i]["año_huesped"];
                $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i+$inicio];
                $cantidadSocio[$i] = (int) $datosSocio[$i+$inicio]["nacionales"];
            }

          $datosMaximo = Huesped::find()->SELECT(['mes_huesped','MAX(nacionales) AS cantidadmax'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
          $cantidadMaximo = array();
          $fechasMaximo = array();
          for ($i = 0; $i < 12; $i++)
          {
           $fechasMaximo[$i] = $datosMaximo[$i]["mes_huesped"];
           $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
       }

       $datosMinimo = Huesped::find()->SELECT(['mes_huesped','MIN(nacionales) AS cantidadmin'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
       $cantidadMinimo = array();
       $fechasMinimo = array();
       for ($i = 0; $i < 12; $i++)
       {
           $fechasMinimo[] = $datosMinimo[$i]["mes_huesped"];
           $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
       }

       for ($i = 0; $i < 1; $i++)
       {
        if(!empty($cantidadSocio)) 
        {
          $b[]= array('type'=> 'line','name' => 'Huéspedes nacionales', 'data' => $cantidadSocio);
      }
      if(!empty($fechasMaximo)) 
      {
        $b[] = array('type'=> 'line','name' => 'Máximo Mercado', 'data' => $cantidadMaximo);
    }
    if(!empty($fechasMinimo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Mínimo Mercado', 'data' => $cantidadMinimo);
    }
}
}else{
               for ($i = 0; $i < sizeof($datosSocio); $i++)
              {
                $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_huesped"]);
                $mes[$i] = $mesSocio[$i]->format('F');
                $añoSocio[$i] = $datosSocio[$i]["año_huesped"];
                $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
                $cantidadSocio[$i] = (int) $datosSocio[$i]["nacionales"];
            }

          $datosMaximo = Huesped::find()->SELECT(['mes_huesped','MAX(nacionales) AS cantidadmax'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
          $cantidadMaximo = array();
          $fechasMaximo = array();
          for ($i = 0; $i < sizeof($datosSocio); $i++)
          {
           $fechasMaximo[$i] = $datosMaximo[$i]["mes_huesped"];
           $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
       }

       $datosMinimo = Huesped::find()->SELECT(['mes_huesped','MIN(nacionales) AS cantidadmin'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
       $cantidadMinimo = array();
       $fechasMinimo = array();
       for ($i = 0; $i < sizeof($datosSocio); $i++)
       {
           $fechasMinimo[] = $datosMinimo[$i]["mes_huesped"];
           $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
       }

       for ($i = 0; $i < 1; $i++)
       {
        if(!empty($cantidadSocio)) 
        {
          $b[]= array('type'=> 'line','name' => 'Huéspedes nacionales', 'data' => $cantidadSocio);
      }
      if(!empty($fechasMaximo)) 
      {
        $b[] = array('type'=> 'line','name' => 'Máximo Mercado', 'data' => $cantidadMaximo);
    }
    if(!empty($fechasMinimo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Mínimo Mercado', 'data' => $cantidadMinimo);
    }
} 
}                
}else if($model->tipo === 'Extranjeros'){        
            $datosSocio = Huesped::find()->SELECT(['mes_huesped','año_huesped','extranjeros'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_huesped,año_huesped,extranjeros')->OrderBy('año_huesped,mes_huesped ASC')->asArray()->all();
  
  $cantidadSocio = array();
  $fechasSocio = array();
  $cantidad = count($datosSocio);
  if( $cantidad > 12){
    $inicio = $cantidad - 12;
  for ($i = 0; $i < 12; $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_huesped"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i+$inicio]["año_huesped"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i +$inicio]["extranjeros"];
  }

  $datosMaximo = Huesped::find()->SELECT(['mes_huesped','MAX(extranjeros) AS cantidadmax'])->GroupBy('mes_huesped,año_huesped')->OrderBy('año_huesped,mes_huesped ASC')->asArray()->all();
   $cantidadMaximo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
   }

   $datosMinimo = Huesped::find()->SELECT(['mes_huesped','MIN(extranjeros) AS cantidadmin'])->GroupBy('mes_huesped,año_huesped')->OrderBy('año_huesped,mes_huesped ASC')->asArray()->all();

   $cantidadMinimo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
   }
   for ($i = 0; $i < 1; $i++)
  {
    if(!empty($cantidadSocio)) 
    {
      $b[]= array('type'=> 'line','name' => 'Huéspedes extranjeros', 'data' => $cantidadSocio);
    }
    if(!empty($cantidadMaximo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Máximo Mercado', 'data' => $cantidadMaximo);
    }
    if(!empty($cantidadMinimo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Mínimo Mercado', 'data' => $cantidadMinimo);
    }
  }
}else{
  for ($i = 0; $i < sizeof($datosSocio); $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_huesped"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i]["año_huesped"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i]["extranjeros"];
  }

  $datosMaximo = Huesped::find()->SELECT(['mes_huesped','MAX(extranjeros) AS cantidadmax'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();

   $cantidadMaximo = array();
   for ($i = 0; $i < sizeof($datosSocio); $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
   }

   $datosMinimo = Huesped::find()->SELECT(['mes_huesped','MIN(extranjeros) AS cantidadmin'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
   
   $cantidadMinimo = array();
   for ($i = 0; $i < sizeof($datosSocio); $i++)
   {
     $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
   }
}
for ($i = 0; $i < 1; $i++)
  {
    if(!empty($cantidadSocio)) 
    {
      $b[]= array('type'=> 'line','name' => 'Huéspedes extranjeros', 'data' => $cantidadSocio);
    }
    if(!empty($cantidadMaximo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Máximo Mercado', 'data' => $cantidadMaximo);
    }
    if(!empty($cantidadMinimo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Mínimo Mercado', 'data' => $cantidadMinimo);
    }
  }
        
}
if(empty($cantidadSocio)){
return $this->render('create', [
            'model' => $model,
            'fechasSocio' => -1,
            'b' => -1,
          ]);
}else{
  return $this->render('create', [
            'model' => $model,
            'fechasSocio' => $fechasSocio,
            'b' => $b,
          ]);
}
}

return $this->render('create', [
            'model' => $model,
            'fechasSocio' => 0,
            'b' => 0,
        ]);
}


    /**
     * Updates an existing Graficohuesped model.
     * If update is successful, the browser will be redirected to the 'view' page.
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tipo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Graficohuesped model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    public function actionEstadiapromedio()
    {
        $model = new Graficohuesped();
        $datosSocio = Huesped::find()->SELECT(['mes_huesped','año_huesped','estadiapromedio'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_huesped,año_huesped,estadiapromedio')->OrderBy('año_huesped,mes_huesped ASC')->asArray()->all();  
        $cantidadSocio = array();
        $fechasSocio = array();
        $cantidad = count($datosSocio);
        if( $cantidad > 12){
          $inicio = $cantidad -12;
        for ($i = 0; $i < 12; $i++)
        {
            $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_huesped"]);
            $mes[$i] = $mesSocio[$i]->format('F');
            $añoSocio[$i] = $datosSocio[$i]["año_huesped"];
            $fechasSocio[] = $mes[$i+$inicio].'-'.$añoSocio[$i];
            $cantidadSocio[$i] = (int) $datosSocio[$i+$inicio]["estadiapromedio"];
        }
    
      $datosMaximo = Huesped::find()->SELECT(['mes_huesped','MAX(estadiapromedio) AS cantidadmax'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
      $cantidadMaximo = array();

      for ($i = 0; $i < 12; $i++)
      {
       $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
      }

   $datosMinimo = Huesped::find()->SELECT(['mes_huesped','MIN(estadiapromedio) AS cantidadmin'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
   $cantidadMinimo = array();

   for ($i = 0; $i < 12; $i++)
   {
       $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
   }

  }else {
    for ($i = 0; $i < sizeof($datosSocio); $i++)
        {
            $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_huesped"]);
            $mes[$i] = $mesSocio[$i]->format('F');
            $añoSocio[$i] = $datosSocio[$i]["año_huesped"];
            $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
            $cantidadSocio[$i] = (int) $datosSocio[$i]["estadiapromedio"];
        }
    
      $datosMaximo = Huesped::find()->SELECT(['mes_huesped','MAX(estadiapromedio) AS cantidadmax'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
      $cantidadMaximo = array();
      for ($i = 0; $i < sizeof($datosMaximo); $i++)
      {
       $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
      }

   $datosMinimo = Huesped::find()->SELECT(['mes_huesped','año_huesped','MIN(estadiapromedio) AS cantidadmin'])->GroupBy('mes_huesped,año_huesped')->OrderBy('mes_huesped,año_huesped ASC')->asArray()->all();
   
   $cantidadMinimo = array();
   for ($i = 0; $i < sizeof($datosMinimo); $i++)
   {
       $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
   }

   for ($i = 0; $i < 1; $i++)
   {
    if(!empty($cantidadSocio)) 
    {
      $b[]= array('type'=> 'line','name' => 'Estadía promedio huéspedes', 'data' => $cantidadSocio);
  }
  if(!empty($cantidadMaximo)) 
  {
    $b[] = array('type'=> 'line','name' => 'Máximo Mercado', 'data' => $cantidadMaximo);
  }
  if(!empty($cantidadMinimo)) 
  {
      $b[] = array('type'=> 'line','name' => 'Mínimo Mercado', 'data' => $cantidadMinimo);
  }
  } 
  }
if(empty($cantidadSocio)){  
  return $this->render('estadiapromedio',['model' => $model,
     'fechasSocio' => -1,
     'b' => -1,]);
}else{
 return $this->render('estadiapromedio',['model' => $model,
     'fechasSocio' => $fechasSocio,
     'b' => $b,]);
}
  }

    /**
     * Finds the Graficohuesped model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.

    protected function findModel($id)
    {
        if (($model = Graficohuesped::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
