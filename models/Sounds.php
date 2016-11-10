<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Sounds extends ActiveRecord
{
    public $image;
		
		public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
		
		/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sounds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author', 'songs'], 'required'],
            [['name', 'author', 'image'], 'string', 'max' => 255],
						[['songs'], 'string'],
						[['image'], 'file', 'extensions'=>'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'name' => 'Имя альбома',
            'author' => 'Автор',
            'songs' => 'Синглы',
            //'image' => 'Изображение',
						'img'=>'Изображение'
        ];
    }
		
		public function upload(){
			if ($this->validate()){
				$path = 'upload/store/'. $this->image->baseName . '.'. $this->image->extension;
				$this-> image-> saveAs($path);
				return true;
			}else{
				return false;
			}
		}
		
}










