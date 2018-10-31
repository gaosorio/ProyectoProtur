<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Indicador4;
use frontend\models\Indicador4Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Personalce;
use yii\filters\AccessControl;
use \DateTime;

/**
 * Indicador4Controller implements the CRUD actions for indicador4 model.
 */
class Indicador4Controller extends Controller
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
     * Lists all indicador4 models.
  
    public function actionIndex()
    {
        $searchModel = new Indicador4Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single indicador4 model.
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
     * Creates a new indicador4 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $model = new indicador4();

        if ($model->load(Yii::$app->request->post())) {

           $datosTipo = Personalce::find()->SELECT([$model->tipo,'mes_personal_ce','ano_personal_ce'])->Where(['id_socio'=>Yii::$app->user->identity->id_socio])->OrderBy('ano_personal_ce, mes_personal_ce ASC')->all();
            $cantidadTipo = array();
            $fechasTipo = array();

            $cantidad = count($datosTipo); 

            if($cantidad>12)
            {
                $inicio = $cantidad - 12;


            for ($i = 0; $i < 12; $i++)
            {
              $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i + $inicio]["mes_personal_ce"]); 
              $mes[$i] = $mesTipo[$i]->format('F');
              $añoTipo[$i] = $datosTipo[$i + $inicio]["ano_personal_ce"];

              $cantidadTipo[$i] = (int) $datosTipo[$i + $inicio][$model->tipo];
              $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
            }

            $sqlMaximo = "SELECT mes_personal_ce,ano_personal_ce, MAX($model->tipo) as max 
                       FROM Personalce 
                       WHERE '$model->tipo' is not null
                       GROUP BY mes_personal_ce,ano_personal_ce
                       ORDER BY mes_personal_ce,ano_personal_ce";

            $datosMaximo = Personalce::findBySql($sqlMaximo)->asArray()->all();
            $cantidadMaximo = array();
 
            for ($i = 0; $i < 12; $i++)
            {
             $cantidadMaximo[$i] = (int) $datosMaximo[$i + $inicio]["max"];
            }


            $sqlMinimo = "SELECT mes_personal_ce,ano_personal_ce, MIN($model->tipo) as min 
                       FROM Personalce 
                       WHERE '$model->tipo' is not null
                       GROUP BY mes_personal_ce,ano_personal_ce
                       ORDER BY mes_personal_ce,ano_personal_ce";

            $datosMinimo = Personalce::findBySql($sqlMinimo)->asArray()->all();
            $cantidadMinimo = array();
     
            for ($i = 0; $i < 12; $i++)
            {
                $cantidadMinimo[$i] = (int) $datosMinimo[$i + $inicio]["min"];
            }

    }else{

            for ($i = 0; $i < sizeof($datosTipo); $i++)
            {
              $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i]["mes_personal_ce"]); 
              $mes[$i] = $mesTipo[$i]->format('F');
              $añoTipo[$i] = $datosTipo[$i]["ano_personal_ce"];

              $cantidadTipo[$i] = (int) $datosTipo[$i][$model->tipo];
              $fechasTipo[$i] =  $mes[$i].'-'.$añoTipo[$i];;
            }

            $sqlMaximo = "SELECT mes_personal_ce,ano_personal_ce, MAX($model->tipo) as max 
                       FROM Personalce 
                       WHERE '$model->tipo' is not null
                       GROUP BY mes_personal_ce,ano_personal_ce
                       ORDER BY mes_personal_ce,ano_personal_ce";

            $datosMaximo = Personalce::findBySql($sqlMaximo)->asArray()->all();
            $cantidadMaximo = array();
 
            for ($i = 0; $i < sizeof($datosTipo); $i++)
            {
             $cantidadMaximo[$i] = (int) $datosMaximo[$i]["max"];
            }

            $sqlMinimo = "SELECT mes_personal_ce,ano_personal_ce, MIN($model->tipo) as min 
                       FROM Personalce 
                       WHERE '$model->tipo' is not null
                       GROUP BY mes_personal_ce,ano_personal_ce
                       ORDER BY mes_personal_ce,ano_personal_ce";

            $datosMinimo = Personalce::findBySql($sqlMinimo)->asArray()->all();
            $cantidadMinimo = array();
     
            for ($i = 0; $i < sizeof($datosTipo); $i++)
            {
                $cantidadMinimo[$i] = (int) $datosMinimo[$i]["min"];
            }


    }





            for ($i = 0; $i < 1; $i++)
            {
                if(!empty($cantidadMaximo)) 
                {
                    $b[] = array('type'=> 'line','name' => 'Máximo Mercado', 'data' => $cantidadMaximo);
                }
                if(!empty($cantidadMinimo)) 
                {
                    $b[] = array('type'=> 'line','name' => 'Mínimo Mercado', 'data' => $cantidadMinimo);
                }
                if(!empty($cantidadTipo)) 
                {
                    $b[] = array('type'=> 'line','name' => $model->tipo, 'data' => $cantidadTipo);
                }
            }

            if(empty($cantidadTipo))
            {
                return $this->render('create', ['model' => $model,'cantidades' => -1,'meses' => -1]);
            }
            else
            {
                return $this->render('create', ['model' => $model,'cantidades' => $b,'meses' => $fechasTipo]);
            }
        }

         return $this->render('create', ['model' => $model,'cantidades' => 0,'meses' => 0]);
    }

    /**
     * Updates an existing indicador4 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id

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
     * Deletes an existing indicador4 model.
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
     * Finds the indicador4 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return indicador4 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
    
    protected function findModel($id)
    {
        if (($model = indicador4::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    } */
}
