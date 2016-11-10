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
class CreateForm extends Model
{
    
    public $name;
    public $author;
    public $songs;
    public $image;
		

    public function rules()
    {
        return [
            [['name','author', 'songs',], 'filter', 'filter'=> trim],
						[['image'], 'file', 'extensions'=>'png, jpg']
        ];
    }
		
		public function attributeLabels(){
			return [
				'name'=> 'Название альбома',
				'author'=> 'Исполнитель',
				'songs'=> 'Композиции',
				'image'=> 'Картинка альбома',
			];
			
		}
		
		/*Функция для записи данных в таблицу БД*/
		public function create(){
			
			$sounds = new Sounds();
			
			$sounds->name = $this->name;
			$sounds->author = $this->author;
			$sounds->songs = $this->songs;
			$sounds->image = $this->image;
			
			return $sounds-> save();
		}
		

} 
