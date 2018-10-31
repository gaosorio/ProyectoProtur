<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Indicador2;
use frontend\models\Indicador2Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Evento;
use yii\filters\AccessControl;
use \DateTime;

/**
 * Indicador2Controller implements the CRUD actions for indicador2 model.
 */
class Indicador2Controller extends Controller
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
     * Lists all indicador2 models.
     
    public function actionIndex()
    {
        $searchModel = new Indicador2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single indicador2 model.
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
     * Creates a new indicador2 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new indicador2();

        if ($model->load(Yii::$app->request->post())) 
        {
           $datosTipo = Evento::find()->SELECT(['personas_atendidas_evento','mes_evento','ano_evento'])->where(['tipo_evento' => $model->tipo])->andWhere(['id_socio'=>Yii::$app->user->identity->id_socio])->OrderBy('ano_evento, mes_evento ASC')->all();

            $cantidadTipo = array();
            $fechasTipo = array();

            $cantidad = count($datosTipo); 

            if($cantidad > 6)
            {

                 $inicio = $cantidad - 6;


                    for ($i = 0; $i < 6; $i++)
                    {
                        $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i + $inicio]["mes_evento"]); 
                        $mes[$i] = $mesTipo[$i]->format('F');
                        $añoTipo[$i] = $datosTipo[$i + $inicio]["ano_evento"];

                        $cantidadTipo[$i] = (int) $datosTipo[$i + $inicio]["personas_atendidas_evento"];
                        $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
                    }

                    $datosMaximo = Evento::find()->SELECT(['mes_evento','ano_evento','MAX(personas_atendidas_evento) AS cantidadmax'])-> Where(['tipo_evento'=> $model->tipo])->GroupBy('ano_evento, mes_evento')->OrderBy('ano_evento, mes_evento ASC')->asArray()->all();
                    $cantidadMaximo = array();
                    $fechasMaximo = array();

                    for ($i = 0; $i < 6; $i++)
                    {
                     $cantidadMaximo[$i] = (int) $datosMaximo[$i + $inicio]["cantidadmax"];
                    }

                    $datosMinimo = Evento::find()->SELECT(['mes_evento','ano_evento','MIN(personas_atendidas_evento) AS cantidadmin'])-> Where(['tipo_evento'=> $model->tipo])->GroupBy('ano_evento, mes_evento')->OrderBy('ano_evento, mes_evento ASC')->asArray()->all();

                    $cantidadMinimo = array();
                    $fechasMinimo = array();

                    for ($i = 0; $i < 6; $i++)
                    {
                        $cantidadMinimo[$i] = (int) $datosMinimo[$i + $inicio]["cantidadmin"];
                    }

            }else{
            

                     for ($i = 0; $i < sizeof($datosTipo); $i++)
                    {
                        $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i]["mes_evento"]); 
                        $mes[$i] = $mesTipo[$i]->format('F');
                        $añoTipo[$i] = $datosTipo[$i]["ano_evento"];
                      
                        $cantidadTipo[$i] = (int) $datosTipo[$i]["personas_atendidas_evento"];
                        $fechasTipo[$i] =  $mes[$i].'-'.$añoTipo[$i];
                    }

                    $datosMaximo = Evento::find()->SELECT(['mes_evento','ano_evento','MAX(personas_atendidas_evento) AS cantidadmax'])-> Where(['tipo_evento'=> $model->tipo])->GroupBy('ano_evento, mes_evento')->OrderBy('ano_evento, mes_evento ASC')->asArray()->all();
                    $cantidadMaximo = array();
                    $fechasMaximo = array();
                    
                    for ($i = 0; $i < sizeof($datosTipo); $i++)
                    {
                     $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
                    }

                    $datosMinimo = Evento::find()->SELECT(['mes_evento','ano_evento','MIN(personas_atendidas_evento) AS cantidadmin'])-> Where(['tipo_evento'=> $model->tipo])->GroupBy('ano_evento, mes_evento')->OrderBy('ano_evento, mes_evento ASC')->asArray()->all();
                    $cantidadMinimo = array();
                    $fechasMinimo = array();

                    for ($i = 0; $i < sizeof($datosTipo); $i++)
                    {
                        $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
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
     * Updates an existing indicador2 model.
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
     * Deletes an existing indicador2 model.
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
     * Finds the indicador2 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return indicador2 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     
    protected function findModel($id)
    {
        if (($model = indicador2::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
