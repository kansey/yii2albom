<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\Images;
use yii\base\NotSupportedException;


/**
 * User model
 *
 * @property integer $id_user
 * @property string  $login
 * @property string  $password
 * @property string  $email
 * @property integer $tocken
*/
class User extends ActiveRecord implements IdentityInterface
{

    private $_passwordObject;
    
    
/**
 * @inheritdoc
*/
    public static function tableName()
    {
        return '{{%user}}';
    } //end tableName()


/**
 * @inheritdoc
*/
    public static function findIdentity($id)
    {
       return static::findOne(['id_user' => $id]);
    } //end findIdentity()


/**
 * @inheritdoc
*/
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    } //end findIdentityByAccessToken()

/**
 * Finds user by username
 *
 * @param string $username
 * @return static|null
*/
    public static function findByUsername($username)
    {
       return static::findOne([
            'login' => $username, 
            /*'status' => self::STATUS_ACTIVE*/
        ]);
    } //end findByUsername

/**
 * @inheritdoc
*/
    public function getId()
    {
        return $this->getPrimaryKey();
    } //end getId()

/**
 * @inheritdoc
*/
    public function getAuthKey()
    {
        
    } //end getAuthKey()

/**
 * @inheritdoc
*/
    public function validateAuthKey($authKey)
    {
        
    } //end validateAuthKey()

/**
 * Validates password
 *
 * @param  string  $password password to validate
 * @return boolean if password provided is valid for current user
*/
    public function validatePassword($password)
    {
       return Yii::$app->security->validatePassword($password, $this->password);
    } //end validatePassword()

    
/**
 * @inheritdoc
*/
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    } //end setPassword(()

    
/**
 * @inheritdoc
*/
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['tocken' => 'tocken']);
    } //end getImages()

    
/**
 * @inheritdoc
*/
    public function getTocken($login)
    {
        $user = static::findOne([
            'login' => $login, 
            /*'status' => self::STATUS_ACTIVE*/
        ]);

        return $user['tocken'];
    } //end getTocken()

    
/**
 * @inheritdoc
*/
    public function scenarios()
    {
        $scenarios['save'] = ['login','password','email'];
        return $scenarios;
    } //end scenarios()


/**
 * @inheritdoc
*/  
    public function generateTocken()
    {
        $this->tocken = Yii::$app->security->generateRandomString();        
    } //end generateTocken()

} //end class
