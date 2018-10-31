<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Graficopais;
use frontend\models\GraficopaisSearch;
use frontend\models\Origen;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \DateTime;

/**
 * GraficopaisController implements the CRUD actions for Graficopais model.
 */
class GraficopaisController extends Controller
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
        ];
    }

    /**
     * Lists all Graficopais models.
     * @return mixed
     *
    public function actionIndex()
    {
        $searchModel = new GraficopaisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Graficopais model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Graficopais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Graficopais();

        if ($model->load(Yii::$app->request->post())) {
            $datosSocio = Origen::find()->SELECT(['mes_origen','año_origen','cantidad'])->Where(['pais'=>$model->pais])->andWhere(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_origen,año_origen,cantidad')->OrderBy('año_origen,mes_origen ASC')->asArray()->all();
  
  $cantidadSocio = array();
  $fechasSocio = array();
  $cantidad = count($datosSocio);
  if( $cantidad > 12){
  $inicio = $cantidad - 12;
  for ($i = 0; $i < 12; $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_origen"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i+$inicio]["año_origen"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i +$inicio]["cantidad"];
  }

  $datosMaximo = Origen::find()->SELECT(['mes_origen','MAX(cantidad) AS cantidadmax'])->Where(['pais'=>$model->pais])->GroupBy('mes_origen,año_origen')->OrderBy('año_origen,mes_origen ASC')->asArray()->all();
   $cantidadMaximo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
   }

   $datosMinimo = Origen::find()->SELECT(['mes_origen','MIN(cantidad) AS cantidadmin'])->Where(['pais'=>$model->pais])->GroupBy('mes_origen,año_origen')->OrderBy('año_origen,mes_origen ASC')->asArray()->all();

   $cantidadMinimo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
   }
   }else{
  for ($i = 0; $i < sizeof($datosSocio); $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_origen"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i]["año_origen"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i]["cantidad"];
  }

  $datosMaximo = Origen::find()->SELECT(['mes_origen','MAX(cantidad) AS cantidadmax'])->Where(['pais'=>$model->pais])->GroupBy('mes_origen,año_origen')->OrderBy('mes_origen,año_origen ASC')->asArray()->all();

   $cantidadMaximo = array();
   for ($i = 0; $i < sizeof($datosSocio); $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
   }

   $datosMinimo = Origen::find()->SELECT(['mes_origen','MIN(cantidad) AS cantidadmin'])->Where(['pais'=>$model->pais])->GroupBy('mes_origen,año_origen')->OrderBy('mes_origen,año_origen ASC')->asArray()->all();
   
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
      $b[]= array('type'=> 'line','name' => 'Tarifa origen', 'data' => $cantidadSocio);
    }
    if(!empty($cantidadMaximo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Maximo', 'data' => $cantidadMaximo);
    }
    if(!empty($cantidadMinimo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Minimo', 'data' => $cantidadMinimo);
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
     * Updates an existing Graficopais model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pais]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Graficopais model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     *
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Graficopais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Graficopais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     *
    protected function findModel($id)
    {
        if (($model = Graficopais::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
