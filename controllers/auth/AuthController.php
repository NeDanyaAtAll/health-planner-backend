<?php

namespace app\controllers\auth;

use yii\web\Controller;
use Yii;
use app\modules\user\models\User;
use app\modules\user\models\RegisterForm;
use yii\filters\AccessControl;

use app\modules\user\repos\UserRepo;
use app\modules\user\models\LoginForm;
use app\modules\user\services\AuthService;
use yii\filters\Cors;

class AuthController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'verbs' => ['POST', 'OPTIONS'],
                    'actions' => [
                        'sign-up',
                        'sign-in',
                        'logout'
                    ],
                ],
                [
                    'allow' => true,
                    'verbs' => ['GET', 'OPTIONS'],
                    'actions' => [
                        'current-user',
                    ],
                ],
            ],
        ];

        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => Yii::$app->params['cors']
        ];

        return $behaviors;
    }

    public function actionCurrentUser()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $currentUser = Yii::$app->user->identity;
        if(!$currentUser) {
            Yii::$app->response->statusCode = 404;
            return [
                'errorMessage' => 'Пользователь не найден'
            ];
        }
        Yii::$app->response->statusCode = 200;
        return $currentUser;
    }

    public function actionSignIn()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request->post();
        $loginForm = new LoginForm($request['login'], $request['password']);

        if($loginForm->validate()) {
            $userRepo = new UserRepo();
            $user = $userRepo->getByEmail($loginForm->login);

            if(!$user) {
                Yii::$app->response->statusCode = 404;
                return [
                    'errorMessage' => 'Пользователь не найден'
                ];
            }

            if(!$user->validatePassword($loginForm->password)) {
                Yii::$app->response->statusCode = 422;
                return $user->errors;
            }

            Yii::$app->user->login($user, 0);
            return Yii::$app->response->statusCode = 200;
        }

        Yii::$app->response->statusCode = 422;
        return $loginForm->errors;
    }

    public function actionSignUp()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $request = Yii::$app->request->post();

        $registerForm = new RegisterForm(
            $request['email'], 
            $request['name'], 
            $request['password'], 
            $request['date_of_birth'], 
            $request['preferences']
        );

        $authService = new AuthService();
        $userRepo = new UserRepo();

        if($registerForm->validate())
        {
            $isEmailExists = $authService->checkUniqueEmail($userRepo, $registerForm->email);

            if($isEmailExists) {
                Yii::$app->response->statusCode = 422;
                return [
                    'error' => 'Пользователь с таким email уже существует'
                ];
            }

            $user = new User();
            $user->email = $registerForm->email;
            $user->name = $registerForm->name;
            $user->date_of_birth = date('Y-m-d', strtotime($registerForm->date_of_birth));
            $user->hashed_password = Yii::$app->getSecurity()->generatePasswordHash($registerForm->password);
            $user->preferences = $registerForm->preferences;
            $user->save();
            return $user->toArray();
        }

        Yii::$app->response->statusCode = 422;
        return $registerForm->errors;
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return Yii::$app->response->statusCode = 200;
    }
}