<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
$this->title = 'Список пластинок';
?>
<div class="container">
				
		<?php if( Yii::$app->session->hasFlash('success') ): ?>
				<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?php echo Yii::$app->session->getFlash('success'); ?>
				</div>
		<?php endif;?>
		
		<?php if( Yii::$app->session->hasFlash('error') ): ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<?php echo Yii::$app->session->getFlash('error'); ?>
			</div>
		<?php endif;?>
		
		<?php foreach ($sounds as $sound):?>
			<div class="block-sound">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 pull-left">
					<img src="/web/images/195681-lI.jpg" class="pricing" alt="" />
				</div>
				<h2><?=$sound->name?></h2>
				<br>
				<?=$sound->author?>
				<br>
				<?=$sound->songs?>
			</div>
			<p>
				<?= Html::a('Изменить', ['update' , 'idsound' => $sound->id ], ['class' => 'btn btn-primary']) ?>
				<?= Html::a('Удалить', ['delete', 'idsound' => $sound->id], ['class' => 'btn btn-primary']) ?>
			</p>
			<?php echo "<hr>";?>
		<?php endforeach;?>
		<div class="clearfix"></div>
		<?php
			echo LinkPager::widget([
				'pagination'=> $pages,
			]);
		?>
		
		<?php if (!Yii::$app-> user-> isGuest):?>
			<?= Html::a('Добавить альбом', ['create'], ['class' => 'btn btn-primary pull-right']) ?>
		<?php else:?>
			<div class="alert alert-danger alert-dismissible" role="alert">
					<h3>Гости не могут создавать новые записи</h3>
			</div>
		<?php endif?> 
		<?//var_dump($sounds);?>
</div>
