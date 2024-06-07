<?php

namespace app\modules\user\models;

use yii\base\Model;

class LoginForm extends Model
{
    private $login;
    private $password;
    
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = (string)$password;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['password', 'login'], 'string', 'min' => 2, 'max' => 255],
            [['login'], 'email']
        ];
    }
}