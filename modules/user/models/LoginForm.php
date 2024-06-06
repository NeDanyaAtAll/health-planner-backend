<?php

namespace app\modules\user\models;

use yii\base\Model;

class LoginForm extends Model
{
    //TODO Сделать приватными и сделать аксессоры
    public $login;
    public $password;
    
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    } 
    //TODO Сделать нормальные валидации
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['password', 'login'], 'string', 'min' => 2, 'max' => 255],
        ];
    }
}