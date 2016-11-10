<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Sounds;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class UpdateForm extends Model
{
    public $id;
    public $name;
    public $author;
    public $songs;
    public $image;
		

    public function rules()
    {
        return [
            [['name','author', 'songs', 'image'], 'filter', 'filter'=> trim],
        ];
    }
		
		public function attributeLabels(){
			return [
				'id'=> 'Номер',
				'name'=> 'Название альбома',
				'author'=> 'Исполнитель',
				'songs'=> 'Композиции',
				'image'=> 'Картинка альбома',
			];
			
		}
		
		/*Функция для записи данных в таблицу БД*/
		public function update(){
			//$sound = new Sounds();
			$sound = Sounds::findOne(['id'=>Yii::$app-> request-> get('idsound')]);
			
			//$sound->id = $this->id;
			$sound->name = $this->name;
			$sound->author = $this->author;
			$sound->songs = $this->songs;
			$sound->image = $this->image;
			
			return $sound-> save() ? $sound : null;
		}
		

} 
