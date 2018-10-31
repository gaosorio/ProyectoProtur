<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Graficos;
use frontend\models\GraficosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Servicio;
use frontend\models\Consumo;
use frontend\models\Personalrestaurante;
use yii\filters\AccessControl;
use \DateTime;
/**
 * GraficosController implements the CRUD actions for graficos model.
 */
class GraficosController extends Controller
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
                        'actions' => ['personasatendidas','personalcontratado','consumopromedio'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionConsumopromedio()
    {
      $datosSocio = Consumo::find()->SELECT(['mes_consumo','año_consumo','consumo_promedio'])->Where(['not', ['consumo_promedio' => null]])->andWhere(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_consumo,año_consumo,consumo_promedio')->OrderBy('año_consumo,mes_consumo ASC')->asArray()->all();
      $cantidad = count($datosSocio);
      $cantidadSocio = array();
      $fechasSocio = array();
      $cantidadMaximo = array();
      $cantidadMinimo = array();
      $mesSocio = array();$mes = array();
      $añoSocio = array();
      if($cantidad>12)
      {
        $inicio = $cantidad-12;
        for ($i = 0; $i < 12; $i++)
        {
          $mesSocio[$i] = DateTime::createFromFormat('!m', $datosSocio[$i+$inicio]["mes_consumo"]); 
          $mes[$i] = $mesSocio[$i]->format('F');
          $añoSocio[$i] = $datosSocio[$i+$inicio]["año_consumo"];
          $cantidadSocio[$i] = (int) $datosSocio[$i+$inicio]["consumo_promedio"];
          $fechasSocio[$i] = $mes[$i].'-'.$añoSocio[$i];
        }
        $datosMaximo = Consumo::find()->SELECT(['mes_consumo','MAX(consumo_promedio) AS cantidadmax'])->Where(['not', ['consumo_promedio' => null]])->GroupBy('mes_consumo,año_consumo')->OrderBy('año_consumo,mes_consumo ASC')->asArray()->all();   
        for ($i = 0; $i < 12; $i++)
        {
          $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
        }
        $datosMinimo = Consumo::find()->SELECT(['mes_consumo','MIN(consumo_promedio) AS cantidadmin'])->Where(['not', ['consumo_promedio' => null]])->GroupBy('mes_consumo,año_consumo')->OrderBy('año_consumo,mes_coASC')->asArray()->all();
        for ($i = 0; $i < 12; $i++)
        {
          $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
        }
      }
      else
      {
        for ($i = 0; $i < sizeof($datosSocio); $i++)
        {
          $mesSocio[$i] = DateTime::createFromFormat('!m', $datosSocio[$i]["mes_consumo"]); 
          $mes[$i] = $mesSocio[$i]->format('F');
          $añoSocio[$i] = $datosSocio[$i]["año_consumo"];
          $cantidadSocio[$i] = (int) $datosSocio[$i]["consumo_promedio"];
          $fechasSocio[$i] = $mes[$i].'-'.$añoSocio[$i];
        }
        $datosMaximo = Consumo::find()->SELECT(['mes_consumo','MAX(consumo_promedio) AS cantidadmax'])->Where(['not', ['consumo_promedio' => null]])->GroupBy('mes_consumo,año_consumo')->OrderBy('año_consumo,mes_consumo ASC')->asArray()->all();
           
        for ($i = 0; $i < sizeof($datosSocio); $i++)
        {
          $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
        }
        $datosMinimo = Consumo::find()->SELECT(['mes_consumo','MIN(consumo_promedio) AS cantidadmin'])->Where(['not', ['consumo_promedio' => null]])->GroupBy('mes_consumo,año_consumo')->OrderBy('año_consumo,mes_consumo ASC')->asArray()->all();
        for ($i = 0; $i < sizeof($datosSocio); $i++)
        {
          $cantidadMinimo[$i] = (int) $datosMinimo[$i]["cantidadmin"];
        }
      }

      for ($i = 0; $i < 1; $i++)
      {
        if(!empty($cantidadSocio)) 
        {
          $b[]= array('type'=> 'line','name' => 'Consumo promedio', 'data' => $cantidadSocio);
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
      if(empty($cantidadSocio))
      {
        return $this->render('consumopromedio', ['cantidades' => -1,'fechas' => -1]);
      }
      else
      {
        return $this->render('consumopromedio', ['cantidades' => $b,'fechas' => $fechasSocio]);
      }
    }

    public function actionPersonasatendidas()
    {
      $model = new Graficos();
      if ($model->load(Yii::$app->request->post()) ) 
      {   
        $datosTipo = Servicio::find()->SELECT(['mes_servicio','año_servicio','cantidad'])->where(['tipo_servicio' => $model->tipo])->andWhere(['not', ['cantidad' => null]])->andWhere(['id_socio'=>Yii::$app->user->identity->id_socio])->GroupBy('mes_servicio,año_servicio,cantidad')->OrderBy('año_servicio,mes_servicio ASC')->all();
        $cantidadTipo = array();
        $fechasTipo = array();
        $cantidad = count($datosTipo);
        if ($cantidad>12)
        {
          $inicio = $cantidad-12;
          for ($i = 0; $i < 12; $i++)
          {
            $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i+$inicio]["mes_servicio"]); 
            $mes[$i] = $mesTipo[$i]->format('F');
            $añoTipo[$i] = $datosTipo[$i+$inicio]["año_servicio"];
            $cantidadTipo[$i] = (int) $datosTipo[$i+$inicio]["cantidad"];
            $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
          }
          $datosMaximo = Servicio::find()->SELECT(['mes_servicio','año_servicio','MAX(cantidad) AS cantidadmax'])->Where(['not', ['cantidad' => null]])->andWhere(['tipo_servicio'=> $model->tipo])->GroupBy('mes_servicio,año_servicio')->OrderBy('año_servicio,mes_servicio ASC')->asArray()->all();
          $cantidadMaximo = array();
          for ($i = 0; $i < 12; $i++)
          {
            $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["cantidadmax"];
          }
          $datosMinimo = Servicio::find()->SELECT(['mes_servicio','año_servicio','MIN(cantidad) AS cantidadmin'])->Where(['not', ['cantidad' => null]])->andWhere(['tipo_servicio'=> $model->tipo])->GroupBy('mes_servicio,año_servicio')->OrderBy('año_servicio,mes_servicio ASC')->asArray()->all();
          $cantidadMinimo = array();
          for ($i = 0; $i < 12; $i++)
          {
            $cantidadMinimo[$i] = (int) $datosMinimo[$i+$inicio]["cantidadmin"];
          }
          
        }
        else
        {
          for ($i = 0; $i < sizeof($datosTipo); $i++)
          {
            $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i]["mes_servicio"]); 
            $mes[$i] = $mesTipo[$i]->format('F');
            $añoTipo[$i] = $datosTipo[$i]["año_servicio"];
            $cantidadTipo[$i] = (int) $datosTipo[$i]["cantidad"];
            $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
          }
          $datosMaximo = Servicio::find()->SELECT(['mes_servicio','año_servicio','MAX(cantidad) AS cantidadmax'])->Where(['not', ['cantidad' => null]])->andWhere(['tipo_servicio'=> $model->tipo])->GroupBy('mes_servicio,año_servicio')->OrderBy('año_servicio,mes_servicio ASC')->asArray()->all();
          $cantidadMaximo = array();
          for ($i = 0; $i < sizeof($datosTipo); $i++)
          {
            $cantidadMaximo[$i] = (int) $datosMaximo[$i]["cantidadmax"];
          }
          $datosMinimo = Servicio::find()->SELECT(['mes_servicio','año_servicio','MIN(cantidad) AS cantidadmin'])->Where(['not', ['cantidad' => null]])->andWhere(['tipo_servicio'=> $model->tipo])->GroupBy('mes_servicio,año_servicio')->OrderBy('año_servicio,mes_servicio ASC')->asArray()->all();
          $cantidadMinimo = array();
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
          return $this->render('personasatendidas', ['model' => $model,'cantidades' => -1,'meses' => -1]);
        }
        else
        {
          return $this->render('personasatendidas', ['model' => $model,'cantidades' => $b,'meses' => $fechasTipo]);
        }      
      }
      else
      {
        return $this->render('personasatendidas', ['model' => $model,'cantidades' => 0,'meses' => 0]);
      }
    }

    public function actionPersonalcontratado()
    {
        $model = new Graficos();

        if ($model->load(Yii::$app->request->post()) ) 
        {   
            $datosTipo = Personalrestaurante::find()->SELECT(["mes_personal","año_personal",$model->tipo])->andWhere(['id_socio'=>Yii::$app->user->identity->id_socio])->andWhere(['not', [$model->tipo => null]])->GroupBy("mes_personal,año_personal,$model->tipo")->OrderBy('año_personal,mes_personal ASC')->asArray()->all();
            $cantidad = count($datosTipo);
            $cantidadTipo = array();
            $fechasTipo = array();
            $cantidadMinima = array();
            $cantidadMaximo = array();
            $mesTipo = array(); $mes = array();
            $añoTipo = array();
            $tipo = array();
            if ($model->tipo == 'personal_fijo')
            {
                $tipo = 'Personal Fijo';
            }
            elseif ($model->tipo == 'personal_partime') {
                $tipo = 'Personal Part-Time';
            }
            if ($cantidad>12) 
            {
                $inicio = $cantidad-12;
                for ($i = 0; $i < 12; $i++)
                    {
                        $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i+$inicio]["mes_personal"]); 
                        $mes[$i] = $mesTipo[$i]->format('F');
                        $añoTipo[$i] = $datosTipo[$i+$inicio]["año_personal"];
                        $cantidadTipo[$i] = (int) $datosTipo[$i+$inicio][$model->tipo];
                        $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
                    }
                $sqlMinimo = "SELECT mes_personal,año_personal, MIN($model->tipo) as mini 
                       FROM Personalrestaurante 
                       WHERE '$model->tipo' is not null
                       GROUP BY año_personal,mes_personal
                       ORDER BY año_personal,mes_personal ASC";

                $datosMinimo = Personalrestaurante::findBySql($sqlMinimo)->asArray()->all();
                
                for ($i = 0; $i < 12; $i++)
                    {
                        $cantidadMinima[$i] = (int) $datosMinimo[$i+$inicio]["mini"];
                    }
                $sqlMaximo = "SELECT mes_personal,año_personal, MAX($model->tipo) as maxi
                       FROM Personalrestaurante 
                       WHERE '$model->tipo' is not null
                       GROUP BY año_personal,mes_personal
                       ORDER BY año_personal,mes_personal ASC";

                $datosMaximo = Personalrestaurante::findBySql($sqlMaximo)->asArray()->all();
                
                for ($i = 0; $i < 12; $i++)
                    {
                        $cantidadMaximo[$i] = (int) $datosMaximo[$i+$inicio]["maxi"];
                    }
            }
            else
            {
                for ($i = 0; $i < sizeof($datosTipo); $i++)
                    {
                        $mesTipo[$i] = DateTime::createFromFormat('!m', $datosTipo[$i]["mes_personal"]); 
                        $mes[$i] = $mesTipo[$i]->format('F');
                        $añoTipo[$i] = $datosTipo[$i]["año_personal"];
                        $cantidadTipo[$i] = (int) $datosTipo[$i][$model->tipo];
                        $fechasTipo[$i] = $mes[$i].'-'.$añoTipo[$i];
                    }
                $sqlMinimo = "SELECT mes_personal,año_personal, MIN($model->tipo) as mini 
                       FROM Personalrestaurante 
                       WHERE '$model->tipo' is not null
                       GROUP BY año_personal,mes_personal
                       ORDER BY año_personal,mes_personal ASC";

                $datosMinimo = Personalrestaurante::findBySql($sqlMinimo)->asArray()->all();
                
                for ($i = 0; $i < sizeof($datosTipo); $i++)
                    {
                        $cantidadMinima[$i] = (int) $datosMinimo[$i]["mini"];
                    }
                $sqlMaximo = "SELECT mes_personal,año_personal, MAX($model->tipo) as maxi
                       FROM Personalrestaurante 
                       WHERE '$model->tipo' is not null
                       GROUP BY año_personal,mes_personal
                       ORDER BY año_personal,mes_personal ASC";

                $datosMaximo = Personalrestaurante::findBySql($sqlMaximo)->asArray()->all();
                
                for ($i = 0; $i < sizeof($datosTipo); $i++)
                    {
                        $cantidadMaximo[$i] = (int) $datosMaximo[$i]["maxi"];
                    }
            }
            for ($i = 0; $i < 1; $i++)
            {
                if(!empty($cantidadTipo)) 
                {
                    $b[] = array('type'=> 'line','name' => $tipo, 'data' => $cantidadTipo);
                }
                if(!empty($cantidadMinima)) 
                {
                    $b[] = array('type'=> 'line','name' => 'Mínimo Mercado', 'data' => $cantidadMinima);
                }
                if(!empty($cantidadMaximo)) 
                {
                    $b[] = array('type'=> 'line','name' => 'Máximo Mercado', 'data' => $cantidadMaximo);
                }
            }
            if(empty($cantidadTipo))
            {
                return $this->render('personalcontratado', ['model' => $model,'cantidades' => -1,'meses' => -1]);
            }
            else
            {
                return $this->render('personalcontratado', ['model' => $model,'cantidades' => $b,'meses' => $fechasTipo]);
            }
        }
        else
        {
            return $this->render('personalcontratado', ['model' => $model,'cantidades' => 0,'meses' => 0]);
        }
    }
}
