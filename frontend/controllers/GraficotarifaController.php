<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Habitacion;
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
 * GraficotarifaController implements the CRUD actions for Graficotarifa model.
 */
class GraficotarifaController extends Controller
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
                        'actions' => ['cantidadhabitaciones','ocupacion','create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     *
    public function actionIndex()
    {
        $searchModel = new GraficotarifaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Graficotarifa model.
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
     * Creates a new Graficotarifa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Graficotarifa();
        
            $datosSocio = Habitacion::find()->SELECT(['mes_habitacion','año_habitacion','tarifahabitacion'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_habitacion,año_habitacion,tarifahabitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();
  
  $cantidadSocio = array();
  $fechasSocio = array();
  $cantidad = count($datosSocio);
  if( $cantidad > 12){
  $inicio = $cantidad - 12;
  for ($i = 0; $i < 12; $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_habitacion"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i+$inicio]["año_habitacion"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i +$inicio]["tarifahabitacion"];
  }

  $datosMaximo = Habitacion::find()->SELECT(['mes_habitacion','MAX(tarifahabitacion) AS cantidadmax'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();
   $cantidadMaximo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
   }

   $datosMinimo = Habitacion::find()->SELECT(['mes_habitacion','MIN(tarifahabitacion) AS cantidadmin'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();

   $cantidadMinimo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
   }
}else{
  for ($i = 0; $i < sizeof($datosSocio); $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_habitacion"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i]["año_habitacion"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i]["tarifahabitacion"];
  }

  $datosMaximo = Habitacion::find()->SELECT(['mes_habitacion','MAX(tarifahabitacion) AS cantidadmax'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('mes_habitacion,año_habitacion ASC')->asArray()->all();

   $cantidadMaximo = array();
   for ($i = 0; $i < sizeof($datosSocio); $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
   }

   $datosMinimo = Habitacion::find()->SELECT(['mes_habitacion','MIN(tarifahabitacion) AS cantidadmin'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('mes_habitacion,año_habitacion ASC')->asArray()->all();
   
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
      $b[]= array('type'=> 'line','name' => 'Tarifa habitacion', 'data' => $cantidadSocio);
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
            if(empty($cantidadSocio)){
            return $this->render('create', [
            'model' => $model,
            'fechasSocio' => -1,
            'b' => -1,
          ]);
          }else {
            return $this->render('create', [
            'model' => $model,
            'fechasSocio' => $fechasSocio,
            'b' => $b,
          ]);
          }
        

        return $this->render('create', [
            'model' => $model,
            'fechasSocio' => 0,
            'b' => 0,
        ]);
    }
    /**
     * Updates an existing Graficotarifa model.
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
     * Deletes an existing Graficotarifa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
  
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    public function actionCantidadhabitaciones()
    {
        $model = new Graficotarifa();
        
            $datosSocio = Habitacion::find()->SELECT(['mes_habitacion','año_habitacion','cantidadhabitacion'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_habitacion,año_habitacion,cantidadhabitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();
  
  $cantidadSocio = array();
  $fechasSocio = array();
  $cantidad = count($datosSocio);
  if( $cantidad > 12){
    $inicio = $cantidad - 12;
  for ($i = 0; $i < 12; $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_habitacion"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i+$inicio]["año_habitacion"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i +$inicio]["cantidadhabitacion"];
  }

  $datosMaximo = Habitacion::find()->SELECT(['mes_habitacion','MAX(cantidadhabitacion) AS cantidadmax'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();
   $cantidadMaximo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
   }

   $datosMinimo = Habitacion::find()->SELECT(['mes_habitacion','MIN(cantidadhabitacion) AS cantidadmin'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();

   $cantidadMinimo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
   }
}else{
  for ($i = 0; $i < sizeof($datosSocio); $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_habitacion"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i]["año_habitacion"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i]["cantidadhabitacion"];
  }

  $datosMaximo = Habitacion::find()->SELECT(['mes_habitacion','MAX(cantidadhabitacion) AS cantidadmax'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('mes_habitacion,año_habitacion ASC')->asArray()->all();

   $cantidadMaximo = array();
   for ($i = 0; $i < sizeof($datosSocio); $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
   }

   $datosMinimo = Habitacion::find()->SELECT(['mes_habitacion','MIN(cantidadhabitacion) AS cantidadmin'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('mes_habitacion,año_habitacion ASC')->asArray()->all();
   
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
      $b[]= array('type'=> 'line','name' => 'Habitaciones disponibles', 'data' => $cantidadSocio);
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
            if(empty($cantidadSocio)){
            return $this->render('cantidadhabitaciones', [
            'model' => $model,
            'fechasSocio' => -1,
            'b' => -1,
          ]);
          }else{
          return $this->render('cantidadhabitaciones', [
            'model' => $model,
            'fechasSocio' => $fechasSocio,
            'b' => $b,
        ]);
          }
        

        return $this->render('cantidadhabitaciones', [
            'model' => $model,
            'fechasSocio' => 0,
            'b' => 0,
        ]);
    }

            

   public function actionOcupacion(){
              $model = new Graficotarifa();
      
            $datosSocio = Habitacion::find()->SELECT(['mes_habitacion','año_habitacion','ocupacion'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_habitacion,año_habitacion,ocupacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();
  
  $cantidadSocio = array();
  $fechasSocio = array();
  $cantidad = count($datosSocio);
  if( $cantidad > 12){
    $inicio = $cantidad - 12;
  for ($i = 0; $i < 12; $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_habitacion"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i+$inicio]["año_habitacion"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i +$inicio]["ocupacion"];
  }

  $datosMaximo = Habitacion::find()->SELECT(['mes_habitacion','MAX(ocupacion) AS cantidadmax'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();
   $cantidadMaximo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
   }

   $datosMinimo = Habitacion::find()->SELECT(['mes_habitacion','MIN(ocupacion) AS cantidadmin'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('año_habitacion,mes_habitacion ASC')->asArray()->all();

   $cantidadMinimo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
   }
}else{
  for ($i = 0; $i < sizeof($datosSocio); $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_habitacion"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i]["año_habitacion"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i]["ocupacion"];
  }

  $datosMaximo = Habitacion::find()->SELECT(['mes_habitacion','MAX(ocupacion) AS cantidadmax'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('mes_habitacion,año_habitacion ASC')->asArray()->all();

   $cantidadMaximo = array();
   for ($i = 0; $i < sizeof($datosSocio); $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
   }

   $datosMinimo = Habitacion::find()->SELECT(['mes_habitacion','MIN(ocupacion) AS cantidadmin'])->GroupBy('mes_habitacion,año_habitacion')->OrderBy('mes_habitacion,año_habitacion ASC')->asArray()->all();
   
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
      $b[]= array('type'=> 'line','name' => 'Porcentaje ocupación', 'data' => $cantidadSocio);
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
            if(empty($cantidadSocio)){
            return $this->render('ocupacion', [
            'model' => $model,
            'fechasSocio' => -1,
            'b' => -1,
          ]);
          }else{
            return $this->render('ocupacion', [
            'model' => $model,
            'fechasSocio' => $fechasSocio,
            'b' => $b,
          ]);
          }
        

        return $this->render('ocupacion', [
            'model' => $model,
            'fechasSocio' => 0,
            'b' => 0,
        ]);

    }
    /**
     * Finds the Graficotarifa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.

    protected function findModel($id)
    {
        if (($model = Graficotarifa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
