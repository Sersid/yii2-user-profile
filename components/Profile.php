<?php
namespace sersid\profile\components;

use Yii;
use yii\base\Component;
use yii\base\ErrorException;

class Profile extends Component
{
    /**
     * @var \sersid\profile\models\Model
     */
    private $_model;

    /**
     * @var string
     */
    public $model = 'sersid\profile\models\Model';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if(Yii::$app->user->isGuest) {
            throw new ErrorException('is guest');
        }
    }

    /**
     * @return \sersid\profile\models\Model
     * @throws ErrorException
     */
    public function model()
    {
        /* @var $model \sersid\profile\models\Model */
        $model = $this->model;

        if($this->_model === null) {
            $this->_model = $model::findOne(['user_id' => Yii::$app->user->id]);
        }

        if($this->_model === null) {
            $model = new $model;
            $model->user_id = Yii::$app->user->id;
            if(!$model->save()) {
                throw new ErrorException("Profile is not created. \n".implode("\n", $model->getFirstErrors()));
            }
            $this->_model = $model;
        }

        return $this->_model;
    }

    /**
     * Get field data
     * @param $field string
     * @return mixed
     */
    public function get($field)
    {
        return $this->model()->$field;
    }

    /**
     * Set field data
     * @param $field
     * @param null $value
     * @throws ErrorException
     */
    public function set($field, $value = null)
    {
        $model = $this->model();
        if(is_array($field)) {
            $model->attributes = $field;
        } else {
            $model->$field = $value;
        }
        if(!$model->save()) {
            throw new ErrorException("Profile is not created. \n\n".implode("\n", $model->getFirstErrors()));
        }
    }
}