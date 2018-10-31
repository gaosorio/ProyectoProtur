<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Indicador3;
use frontend\models\Indicador3Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Salondeevento;
use yii\filters\AccessControl;
use \DateTime;


/**
 * Indicador3Controller implements the CRUD actions for indicador3 model.
 */
class Indicador3Controller extends Controller
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
     * Lists all indicador3 models.
     
    public function actionIndex()
    {
        $searchModel = new Indicador3Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single indicador3 model.
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
     * Creates a new indicador3 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new indicador3();

        if ($model->load(Yii::$app->request->post())) {

           $datosTipo = Salondeevento::find()->SELECT(['valorreal_salon','mes_salon','ano_salon'])->where(['tipo_salon' => $model->tipo])->andWhere(['id_socio'=>Yii::$app->user->identity->id_socio])->OrderBy('ano_salon, mes_salon ASC')->all();

            $cantidadTipo = array();
            $fechasTipo = array();
            $cantidad = count($datosTipo); 

            if($cantidad>12)
            {
                $inicio = $cantidad - 12;

            for ($i = 0; $i < 12; $i++)
            {
                $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i + $inicio]["mes_salon"]); 
                $mes[$i] = $mesTipo[$i]->format('F');
                $añoTipo[$i] = $datosTipo[$i + $inicio]["ano_salon"];
                
                $cantidadTipo[$i] = (int) $datosTipo[$i]["valorreal_salon"];
                $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
            }

            $datosMaximo = Salondeevento::find()->SELECT(['mes_salon','ano_salon','MAX(valorreal_salon) AS cantidadmax'])-> Where(['tipo_salon'=> $model->tipo])->GroupBy('ano_salon, mes_salon')->OrderBy('ano_salon, mes_salon ASC')->asArray()->all();

            $cantidadMaximo = array();
            $fechasMaximo = array();

            for ($i = 0; $i < 12; $i++)
            {
             $cantidadMaximo[$i] = (int) $datosMaximo[$i + $inicio]["cantidadmax"];
            }

            $datosMinimo = Salondeevento::find()->SELECT(['mes_salon','ano_salon','MIN(valorreal_salon) AS cantidadmin'])-> Where(['tipo_salon'=> $model->tipo])->GroupBy('ano_salon, mes_salon')->OrderBy('ano_salon, mes_salon ASC')->asArray()->all();
            $cantidadMinimo = array();
            $fechasMinimo = array();

            for ($i = 0; $i < 12; $i++)
            {
                $cantidadMinimo[$i] = (int) $datosMinimo[$i + $inicio]["cantidadmin"];
            }

        }else{

            for ($i = 0; $i < sizeof($datosTipo); $i++)
            {
                $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i]["mes_salon"]); 
                $mes[$i] = $mesTipo[$i]->format('F');
                $añoTipo[$i] = $datosTipo[$i]["ano_salon"];
                
                $cantidadTipo[$i] = (int) $datosTipo[$i]["valorreal_salon"];
                $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
            }

            $datosMaximo = Salondeevento::find()->SELECT(['mes_salon','ano_salon','MAX(valorreal_salon) AS cantidadmax'])-> Where(['tipo_salon'=> $model->tipo])->GroupBy('ano_salon, mes_salon')->OrderBy('ano_salon, mes_salon ASC')->asArray()->all();
            $cantidadMaximo = array();
            $fechasMaximo = array();

            for ($i = 0; $i < sizeof($datosTipo); $i++)
            {
             $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
            }

            $datosMinimo = Salondeevento::find()->SELECT(['mes_salon','ano_salon','MIN(valorreal_salon) AS cantidadmin'])-> Where(['tipo_salon'=> $model->tipo])->GroupBy('ano_salon, mes_salon')->OrderBy('ano_salon, mes_salon ASC')->asArray()->all();
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
     * Updates an existing indicador3 model.

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
     * Deletes an existing indicador3 model.
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
     * Finds the indicador3 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return indicador3 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     
    protected function findModel($id)
    {
        if (($model = indicador3::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
