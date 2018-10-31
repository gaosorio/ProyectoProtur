<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Personalce;
use frontend\models\PersonalceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PersonalceController implements the CRUD actions for personalce model.
 */
class PersonalceController extends Controller
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
     * Lists all personalce models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $searchModel = new PersonalceSearch();
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
     * Displays a single personalce model.
     * @param string $fecha_personal_ce
     * @param integer $id_centro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fecha_personal_ce, $id_centro)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($año,$mes) = explode('-', $fecha_personal_ce);
            if (is_numeric($id_centro) && is_numeric($mes) && is_numeric($año)) 
            {
            return $this->render('view', [
            'model' => $this->findModel($fecha_personal_ce, $id_centro),]);
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
     * Creates a new personalce model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $model = new personalce();

        if ($model->load(Yii::$app->request->post()) ) {
            list($mes, $año) = explode('-', $model->fecha_personal_ce);
            $model->mes_personal_ce = intval($mes);
            $model->ano_personal_ce = intval($año);

            if ($model->save()){

            return $this->redirect(['view', 'fecha_personal_ce' => $model->fecha_personal_ce, 'id_centro' => $model->id_centro]);
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
     * Updates an existing personalce model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $fecha_personal_ce
     * @param integer $id_centro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fecha_personal_ce, $id_centro)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($año,$mes) = explode('-', $fecha_personal_ce);
            if (is_numeric($id_centro) && is_numeric($mes) && is_numeric($año)) 
            {
            $model = $this->findModel($fecha_personal_ce, $id_centro);

            if ($model->load(Yii::$app->request->post()) ) {
                list($mes, $año) = explode('-', $model->fecha_personal_ce);
                $model->mes_personal_ce = intval($mes);
                $model->ano_personal_ce = intval($año);

            if ($model->save()) {
                return $this->redirect(['view', 'fecha_personal_ce' => $model->fecha_personal_ce, 'id_centro' => $model->id_centro]);
            }
            
            }

            return $this->render('update', [
                'model' => $model,
            ]);
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
     * Deletes an existing personalce model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $fecha_personal_ce
     * @param integer $id_centro
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fecha_personal_ce, $id_centro)
    {
        $this->findModel($fecha_personal_ce, $id_centro)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the personalce model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $fecha_personal_ce
     * @param integer $id_centro
     * @return personalce the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fecha_personal_ce, $id_centro)
    {
        if (($model = personalce::findOne(['fecha_personal_ce' => $fecha_personal_ce, 'id_centro' => $id_centro])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
