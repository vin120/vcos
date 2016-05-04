<?php

namespace app\modules\voyagemanagement\models;

use Yii;

/**
 * This is the model class for table "v_c_voyage_port".
 *
 * @property integer $id
 * @property integer $voyage_id
 * @property string $port_code
 * @property integer $order_no
 * @property string $EIA
 * @property string $ETD
 */
class VCVoyagePort extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'v_c_voyage_port';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voyage_id', 'order_no'], 'integer'],
            [['EIA', 'ETD'], 'safe'],
            [['port_code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'voyage_id' => Yii::t('app', 'Voyage ID'),
            'port_code' => Yii::t('app', 'Port Code'),
            'order_no' => Yii::t('app', 'Order No'),
            'EIA' => Yii::t('app', 'Eia'),
            'ETD' => Yii::t('app', 'Etd'),
        ];
    }
}
