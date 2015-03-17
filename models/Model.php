<?php

namespace sersid\profile\models;

use Yii;

/**
 * This is the model class for profile component.
 *
 * @property integer $id
 * @property integer $user_id
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }
}