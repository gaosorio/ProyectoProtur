<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Graficopersonal;
use frontend\models\GraficopersonalSearch;
use frontend\models\Personalh;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use \DateTime;

/**
 * GraficopersonalController implements the CRUD actions for Graficopersonal model.
 */
class GraficopersonalController extends Controller
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
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Graficopersonal models.

    public function actionIndex()
    {
        $searchModel = new GraficopersonalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Graficopersonal model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
   
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Graficopersonal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
       public function actionCreate()
    {
        $model = new Graficopersonal();
        if ($model->load(Yii::$app->request->post())) {
            if($model->tipo === 'Personal fijo'){

              $datosSocio = Personalh::find()->SELECT(['mes_personal','año_personal','personalfijo'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_personal,año_personal,personalfijo')->OrderBy('año_personal,mes_personal ASC')->asArray()->all();  
              $cantidadSocio = array();
              $fechasSocio = array();
              $cantidad = count($datosSocio);
              if( $cantidad > 12){
              for ($i = 0; $i < 12; $i++)
              {
                $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_personal"]);
                $mes[$i] = $mesSocio[$i]->format('F');
                $añoSocio[$i] = $datosSocio[$i]["año_personal"];
                $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i+$inicio];
                $cantidadSocio[$i] = (int) $datosSocio[$i+$inicio]["personalfijo"];
            }

          $datosMaximo = Personalh::find()->SELECT(['mes_personal','MAX(personalfijo) AS cantidadmax'])->GroupBy('mes_personal,año_personal')->OrderBy('mes_personal,año_personal ASC')->asArray()->all();
          $cantidadMaximo = array();
          $fechasMaximo = array();
          for ($i = 0; $i < 12; $i++)
          {
           $fechasMaximo[$i] = $datosMaximo[$i]["mes_personal"];
           $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
       }

       $datosMinimo = Personalh::find()->SELECT(['mes_personal','MIN(personalfijo) AS cantidadmin'])->GroupBy('mes_personal,año_personal')->OrderBy('mes_personal,año_personal ASC')->asArray()->all();
       $cantidadMinimo = array();
       $fechasMinimo = array();
       for ($i = 0; $i < 12; $i++)
       {
           $fechasMinimo[] = $datosMinimo[$i]["mes_personal"];
           $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
       }

       for ($i = 0; $i < 1; $i++)
       {
        if(!empty($cantidadSocio)) 
        {
          $b[]= array('type'=> 'line','name' => 'Personal Fijo', 'data' => $cantidadSocio);
      }
      if(!empty($fechasMaximo)) 
      {
        $b[] = array('type'=> 'line','name' => 'Maximo', 'data' => $cantidadMaximo);
    }
    if(!empty($fechasMinimo)) 
    {
        $b[] = array('type'=> 'line','name' => 'Minimo', 'data' => $cantidadMinimo);
    }
}
}else{
               for ($i = 0; $i < sizeof($datosSocio); $i++)
              {
                $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_personal"]);
                $mes[$i] = $mesSocio[$i]->format('F');
                $añoSocio[$i] = $datosSocio[$i]["año_personal"];
                $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
                $cantidadSocio[$i] = (int) $datosSocio[$i]["personalfijo"];
            }

          $datosMaximo = Personalh::find()->SELECT(['mes_personal','MAX(personalfijo) AS cantidadmax'])->GroupBy('mes_personal,año_personal')->OrderBy('mes_personal,año_personal ASC')->asArray()->all();
          $cantidadMaximo = array();
          $fechasMaximo = array();
          for ($i = 0; $i < sizeof($datosSocio); $i++)
          {
           $fechasMaximo[$i] = $datosMaximo[$i]["mes_personal"];
           $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
       }

       $datosMinimo = Personalh::find()->SELECT(['mes_personal','MIN(personalfijo) AS cantidadmin'])->GroupBy('mes_personal,año_personal')->OrderBy('mes_personal,año_personal ASC')->asArray()->all();
       $cantidadMinimo = array();
       $fechasMinimo = array();
       for ($i = 0; $i < sizeof($datosSocio); $i++)
       {
           $fechasMinimo[] = $datosMinimo[$i]["mes_personal"];
           $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
       }

       for ($i = 0; $i < 1; $i++)
       {
        if(!empty($cantidadSocio)) 
        {
          $b[]= array('type'=> 'line','name' => 'Personal Fijo', 'data' => $cantidadSocio);
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
}else if($model->tipo === 'Personal part time'){        
            $datosSocio = Personalh::find()->SELECT(['mes_personal','año_personal','personalparttime'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_personal,año_personal,personalparttime')->OrderBy('año_personal,mes_personal ASC')->asArray()->all();
  
  $cantidadSocio = array();
  $fechasSocio = array();
  $cantidad = count($datosSocio);
  if( $cantidad > 12){
    $inicio = $cantidad - 12;
  for ($i = 0; $i < 12; $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i+$inicio]["mes_personal"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i+$inicio]["año_personal"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i +$inicio]["personalparttime"];
  }

  $datosMaximo = Personalh::find()->SELECT(['mes_personal','MAX(personalparttime) AS cantidadmax'])->GroupBy('mes_personal,año_personal')->OrderBy('año_personal,mes_personal ASC')->asArray()->all();
   $cantidadMaximo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
   }

   $datosMinimo = Personalh::find()->SELECT(['mes_personal','MIN(personalparttime) AS cantidadmin'])->GroupBy('mes_personal,año_personal')->OrderBy('año_personal,mes_personal ASC')->asArray()->all();

   $cantidadMinimo = array();
   for ($i = 0; $i < 12; $i++)
   {
     $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
   }
}else{
  for ($i = 0; $i < sizeof($datosSocio); $i++)
  {
    $mesSocio[$i] = DateTime::createFromFormat('!m',$datosSocio[$i]["mes_personal"]);
    $mes[$i] = $mesSocio[$i]->format('F');
    $añoSocio[$i] = $datosSocio[$i]["año_personal"];
    $fechasSocio[] = $mes[$i].'-'.$añoSocio[$i];
    $cantidadSocio[$i] = (int) $datosSocio[$i]["personalparttime"];
  }

  $datosMaximo = Personalh::find()->SELECT(['mes_personal','MAX(personalparttime) AS cantidadmax'])->GroupBy('mes_personal,año_personal')->OrderBy('mes_personal,año_personal ASC')->asArray()->all();

   $cantidadMaximo = array();
   for ($i = 0; $i < sizeof($datosSocio); $i++)
   {
     $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
   }

   $datosMinimo = Personalh::find()->SELECT(['mes_personal','MIN(personalparttime) AS cantidadmin'])->GroupBy('mes_personal,año_personal')->OrderBy('mes_personal,año_personal ASC')->asArray()->all();
   
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
      $b[]= array('type'=> 'line','name' => 'Personal part time', 'data' => $cantidadSocio);
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
}else {
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
     * Updates an existing Graficopersonal model.
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
     * Deletes an existing Graficopersonal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
  
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Graficopersonal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Graficopersonal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     
    protected function findModel($id)
    {
        if (($model = Graficopersonal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
