<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class RegForm extends Model
{
    public $login;
    public $email;
    public $password;
    public $password_repeat;
    public $user_role;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login', 'email', 'password', 'password_repeat'], 'required', 'message' => 'Заполните поле'],
            ['email', 'email', 'message' => 'Значение "Почта" не является правильным email адресом'],
            [['login', 'email'], 'trim'],
            ['login', 'unique', 'targetClass' => User::class, 'message' => 'Такой логин уже зарегистрирован'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Такая почта уже зарегистрирована'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            ['password', 'string', 'min' => 8, 'max' => 24, 'tooShort' => 'Пароль должен иметь минимум 8 символов', 'tooLong' => 'Пароль не должен превышать 24-ёх символов']
        ];
    }


    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->login);
        }

        return $this->_user;
    }

//    ункция сохранения данных в базу данных
    public function registration() {
        $model = new User();
        $model->createAuthKey();
        $model->login = $this->login;
        $model->email = $this->email;
        $model->setPasswordHash($this->password);
        $model->user_role = 2;
        $model->save();
    }
}
