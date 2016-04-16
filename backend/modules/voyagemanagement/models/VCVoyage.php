<?php

namespace app\modules\voyagemanagement\models;

use Yii;

/**
 * This is the model class for table "v_c_voyage".
 *
 * @property string $id
 * @property integer $cruise_id
 * @property string $voyage_code
 * @property string $start_time
 * @property string $end_time
 * @property integer $status
 */
class VCVoyage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_c_voyage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cruise_id', 'status'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['voyage_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cruise_id' => 'Cruise ID',
            'voyage_code' => 'Voyage Code',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
        ];
    }
}
