<?php

namespace app\modules\user\models;

use yii\base\Model;

class RegisterForm extends Model
{
    private $email;
    private $name;
    private $password;
    
    public function __construct(string $email, string $name, string $password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function rules()
    {
        return [
            [['email', 'name', 'password',], 'required'],
            [['password'], 'string', 'min' => 8, 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => User::class, 'message' => 'Пользователь с таким Email уже существует']
        ];
    }
}