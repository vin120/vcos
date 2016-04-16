<?php

namespace app\modules\voyagemanagement\models;

use Yii;

/**
 * This is the model class for table "v_c_cabin_type".
 *
 * @property string $id
 * @property string $type_code
 * @property integer $type_status
 * @property string $cruise_code
 */
class VCCabinType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_c_cabin_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_status'], 'integer'],
            [['type_code', 'cruise_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_code' => 'Type Code',
            'type_status' => 'Type Status',
            'cruise_code' => 'Cruise Code',
        ];
    }
}
