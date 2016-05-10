<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <h1><?= \Yii::t('app', 'Voyage Management') ?></h1>
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
                    <a><img src="<?=$baseUrl ?>images/routeManage_icon.png"><?= \Yii::t('app', 'Voyage Manage') ?><i></i></a>
                </li>
                <!-- 二级 -->
                <ul>
                	<li class="active"><a href="<?php echo Url::toRoute(['area/area']);?>"><?= \Yii::t('app', 'Area') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['cruise/cruise']);?>"><?= \Yii::t('app', 'Cruise') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['country/country']);?>"><?= \Yii::t('app', 'Country') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['port/port']);?>"><?= \Yii::t('app', 'Port') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['cabintype/cabin_type']);?>"><?= \Yii::t('app', 'Cabin Type') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['cabin/cabin']);?>"><?= \Yii::t('app', 'Cabin') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['activeconfig/active_config']);?>"><?= \Yii::t('app', 'Active Config') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['surcharge/surcharge_config']);?>"><?= \Yii::t('app', 'Surcharge Config') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['shoreexcursion/shore_excursion']);?>"><?= \Yii::t('app', 'Shore Excursion') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['voyageset/index']);?>"><?= \Yii::t('app', 'Voyage Set') ?></a></li>
                    <li><a href="<?php echo Url::toRoute(['cabincategory/cabin_category']);?>"><?= \Yii::t('app', 'Cabin Categorize') ?></a></li>
					<li><a href="<?php echo Url::toRoute(['cabinpricing/cabin_pricing']);?>"><?= \Yii::t('app', 'Cabin Pricing') ?></a></li>
					<li><a href="<?php echo Url::toRoute(['preferentialway/preferential_way']);?>"><?= \Yii::t('app', 'Preferential Way') ?></a></li>
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
