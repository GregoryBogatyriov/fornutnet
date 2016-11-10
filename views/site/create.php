<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\User;
use yii\captcha\Captcha;
use yii\captcha\CaptchaAction;


$this->title = ' Редактирование';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
		<?php if( Yii::$app->session->hasFlash('error') ): ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
						<?php echo Yii::$app->session->getFlash('error'); ?>
				</div>
		<?php endif;?>
		
    <?php $form = ActiveForm::begin([
        'id' => 'create-form',
        'options' => ['enctype'=>'multipart/form-data','class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

		
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
				
        <?= $form->field($model, 'author')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'songs')->textarea(['autofocus' => true, ]) ?>
				
        <?= $form->field($model, 'image')->fileInput()  ?>
				
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
		
		

</div>
