<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Request;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\UpdateForm;
use app\models\CreateForm;
use app\models\User;
use app\models\Sounds;
use app\controllers\BehaviorController;

class SiteController extends BehaviorController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
								'backColor'=>111222,
								'foreColor'=>99,
								'offset'=>2,
            ],
        ];
    }

    public function actionIndex()
    {
				return $this->render('index');
    }
		
		function actionLogin()
    {
				if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app-> session->setFlash('success', "<h4>Вы зашли в свой профиль</h4>");
						return $this->goBack();
        }elseif($model->load(Yii::$app->request->post()) && !$model->login()){
						Yii::$app-> session->setFlash('error', "<h4>Произошла неизвестная ошибка. Возможно вы не до конца прошли процедуру регистрации</h4>");
				}
				
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
		
		/*Экшен для регистрации*/
		public function actionReg(){
			$model = new RegForm();
			
			if ($model-> load(Yii::$app->request -> post()) && $model-> validate()){
				if ($user = $model->reg()){
					Yii::$app->session-> setFlash('success', "<h4>{$model->username}, Вы успешно зарегистрированы! Зайдите под своим именем</h4>");
					return $this-> redirect('/site/login');
				}else {
					Yii::$app-> session-> setFlash('error','Возникла ошибка при регистрации');
					return $this-> refresh();
				}
			}
			
			return $this-> render('reg', [
				'model'=> $model,
			]);
				
		}
		
		public function actionSounds(){
			$sounds = Sounds::find()->all();
			
			return $this-> render('sounds', [
				'sounds'=>$sounds,
			]);
		}
		
		public function actionCreate(){
			$model = new CreateForm();
			if (!Yii::$app-> user-> isGuest){
				if ($model-> load(Yii::$app->request -> post()) && $model-> validate()){
					if ($sounds = $model->create()){
						Yii::$app->session-> setFlash('success', "<h4>Вы добавили запись!</h4>");
						return $this-> redirect('/site/sounds');
					}else {
						Yii::$app-> session-> setFlash('error','Не удалось добавить запись');
						return $this-> refresh();
					}
				}
			}else 
				return false;
			
			return $this-> render('create', [
				'model'=> $model,
			]);
		}
		
		public function actionUpdate(){
			$model = new UpdateForm();
			$idsound = Yii::$app-> request-> get('idsound');
			$sound = Sounds::findOne(['id'=>$idsound]);
			
			if (!Yii::$app-> user-> isGuest){
				if ($model-> load(Yii::$app->request -> post()) && $model-> validate()){
					if ($sounds = $model->update()){
						Yii::$app->session-> setFlash('success', "<h4>Вы изменили запись!</h4>");
						return $this-> redirect('/site/sounds');
					}else {
						Yii::$app-> session-> setFlash('error','Не удалось изменить запись запись');
						return $this-> refresh();
					}
				}
			}else {
				Yii::$app->session-> setFlash('error', "<h4>Гости не могут удалять или редактировать записи!</h4>");
				return $this-> redirect('/site/sounds');
			}
			
			return $this-> render('update', [
				'model'=> $model,
				'sound'=> $sound,
			]);
		}
		
		public function actionDelete(){
			if (!Yii::$app-> user-> isGuest):
				$idsound = Yii::$app-> request-> get('idsound');
				if (isset($idsound)):
					$sound = Sounds::findOne(['id'=>$idsound]);
					$sound -> delete();
					Yii::$app->session-> setFlash('success', "<h4>Пластинка удалена!</h4>");
					return $this-> redirect('/site/sounds');
				endif;
			else:
				Yii::$app->session-> setFlash('error', "<h4>Гости не могут удалять или редактировать записи!</h4>");
				return $this-> redirect('/site/sounds');
			endif;
			
			return $this->render('delete', compact( 'sound'));
		}
		
		
		
		
}
