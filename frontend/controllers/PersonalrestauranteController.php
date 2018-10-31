<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Personalrestaurante;
use frontend\models\PersonalrestauranteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * PersonalrestauranteController implements the CRUD actions for personalrestaurante model.
 */
class PersonalrestauranteController extends Controller
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
                        'actions' => ['index','view','create','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all personalrestaurante models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            $searchModel = new PersonalrestauranteSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else
        {
           return $this->goHome();
        }
    }

    /**
     * Displays a single personalrestaurante model.
     * @param string $fecha_personal
     * @param integer $id_restaurante
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fecha_personal, $id_restaurante)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fecha_personal);
            if (is_numeric($id_restaurante) && is_numeric($mes) && is_numeric($año)) 
            {
                return $this->render('view', ['model' => $this->findModel($fecha_personal, $id_restaurante),]);
            }
            else
            {
                return $this->goHome();
            }
        }
        else
        {
            return $this->goHome();
        }
    }

    /**
     * Creates a new personalrestaurante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            $model = new personalrestaurante();

            if ($model->load(Yii::$app->request->post())) 
            {
                if($model->validate())
                {
                    list($mes, $año) = explode('-', $model->fecha_personal);
                    $model->mes_personal = intval($mes);
                    $model->año_personal = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'fecha_personal' => $model->fecha_personal, 'id_restaurante' => $model->id_restaurante]);
                    }
                }   
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else
        {
            return $this->goHome();
        }
    }

    /**
     * Updates an existing personalrestaurante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $fecha_personal
     * @param integer $id_restaurante
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fecha_personal, $id_restaurante)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fecha_personal);
            if (is_numeric($id_restaurante) && is_numeric($mes) && is_numeric($año)) 
            {
                $model = $this->findModel($fecha_personal, $id_restaurante);

                if ($model->load(Yii::$app->request->post()) ) {
                    list($mes, $año) = explode('-', $model->fecha_personal);
                    $model->mes_personal = intval($mes);
                    $model->año_personal = intval($año);
                    if ($model->save())
                    {
                        return $this->redirect(['view', 'fecha_personal' => $model->fecha_personal, 'id_restaurante' => $model->id_restaurante]);
                    }
                }

                return $this->render('update', ['model' => $model,]);
            }
            else
            {
                return $this->goHome();
            }
        }
        else
        {
            return $this->goHome();
        }

    }

    /**
     * Deletes an existing personalrestaurante model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $fecha_personal
     * @param integer $id_restaurante
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fecha_personal, $id_restaurante)
    {
        $this->findModel($fecha_personal, $id_restaurante)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the personalrestaurante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $fecha_personal
     * @param integer $id_restaurante
     * @return personalrestaurante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fecha_personal, $id_restaurante)
    {
        if (($model = personalrestaurante::findOne(['fecha_personal' => $fecha_personal, 'id_restaurante' => $id_restaurante])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
