<?php
namespace travelagent\views\myasset;

use yii\web\AssetBundle;
/**
 * Created by PhpStorm.
 * User: leijiao
 * Date: 16/3/11
 * Time: 上午11:34
 */
class TicketCenterInfoAsset extends AssetBundle
{

    public $sourcePath = '@app/views/static';
    public $css = [
        
    ];

    public $js = [
       'js/TicketCenterInfo.js',
    ];

    //依赖关系
    public $depends = [
    ];

}
