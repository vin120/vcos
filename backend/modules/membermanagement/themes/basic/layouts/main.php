<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use app\modules\membermanagement\themes\basic\myasset\ThemeAsset;
$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <script type="text/javascript" src="<?php echo $baseUrl;?>js/jquery-2.2.2.min.js"></script> 
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<!-- header start -->
<header id="header">
    <div class="l" id="title">
        <img src="<?=$baseUrl ?>images/logo.png">
        <h1><?= \Yii::t('app', 'Membership management') ?></h1>
    </div>
    <div class="r" id="user">
        <div class="l" id="user_img">
            <img src="<?=$baseUrl ?>images/user_img.png">
        </div>
        <div class="r">
            <span>admin</span>
            <a href="#">Exit</a>
        </div>
    </div>
</header>
<!-- header end -->
<!-- main start -->
<main id="main">
    <!-- asideNav start -->
    <aside id="asideNav" class="l">
        <nav id="asideNav_open">
            <!-- 一级 -->
            <ul>
                <li class="open">
                    <a href="#"><img src="<?=$baseUrl ?>images/routeManage_icon.png"><?= \Yii::t('app', 'Membership manage') ?><i></i></a>
                </li>
                <!-- 二级 -->
                <ul>
                    <li class="active"><a href="#"><?= \Yii::t('app', 'Membership') ?></a></li>
                    <li><a href="#"><?= \Yii::t('app', 'Recharge') ?></a></li>
                    <li><a href="#"><?= \Yii::t('app', 'Refund') ?></a></li>
                    <li><a href="#"><?= \Yii::t('app', 'Points') ?><i></i></a></li>
                    <ul>
                        <li><a href="#"><?= \Yii::t('app', 'Point Set') ?></a></li>
                        <li><a href="#"><?= \Yii::t('app', 'Exchange') ?></a></li>
                    </ul>
                    <li><a href="#"><?= \Yii::t('app', 'Message') ?><i></i></a></li>
                    <ul>
                        <li><a href="#"><?= \Yii::t('app', 'SendMessage') ?></a></li>
                        <li><a href="#"><?= \Yii::t('app', 'MessageLog') ?></a></li>
                        <li><a href="#"><?= \Yii::t('app', 'Contacts') ?></a></li>
                        <li><a href="#"><?= \Yii::t('app', 'Phrasebook') ?></a></li>
                    </ul>
                </ul>
            </ul>
            <a href="#" id="closeAsideNav"><img src="<?=$baseUrl ?>images/asideNav_close.png"></a>
        </nav>
        <nav id="asideNav_close">
            <ul>
                <li><img src="<?=$baseUrl ?>images/routeManage_icon.png"></li>
                <a href="#" id="openAsideNav"><img src="<?=$baseUrl ?>images/asideNav_open.png"></a>
            </ul>
        </nav>
    </aside>
    <!-- asideNav end -->
    <!-- content start -->
    <?= $content ?>
    <!-- content end -->
</main>
<!-- main end -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
