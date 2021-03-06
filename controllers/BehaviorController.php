<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class BehaviorController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'contact', 'about', 'reviews', 'sounds', 'delete', 'update', 'view', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
										[
                        'actions' => ['login', 'reg', 'index', 'contact', 'about', 'reviews', 'sounds', 'delete', 'update', 'view', 'create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'login' => ['post', 'get'],
                    'reviews' => ['post', 'get'],
                ],
            ],
        ];
    }

    
}