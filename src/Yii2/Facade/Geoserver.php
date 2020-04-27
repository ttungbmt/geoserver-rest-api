<?php
namespace ttungbmt\REST\Geoserver\Yii2\Facade;

class Geoserver extends \sergeymakinen\facades\Facade
{
    /**
     * @inheritdoc
     */
    public static function getFacadeComponentId()
    {
        return 'geoserver'; // Yii::$app->yourFacadeComponentName
    }
}
