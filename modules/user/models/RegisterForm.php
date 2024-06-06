<?php

namespace app\modules\user\models;

use yii\base\Model;

class RegisterForm extends Model
{
    //TODO Сделать приватными и сделать аксессоры
    public $email;
    public $name;
    public $password;
    public $date_of_birth;
    public $preferences; 
    
    public function __construct(string $email, string $name, string $password, ?string $date_of_birth, ?string $preferences)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->date_of_birth = $date_of_birth;
        $this->preferences = $preferences;
    } 
    //TODO Сделать нормальные валидации
    public function rules()
    {
        return [
            [['email', 'name', 'password'], 'required'],
            [['password'], 'string', 'min' => 8, 'max' => 255],
        ];
    }
}