<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

use travelagent\views\myasset\PublicAsset;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';

$controller = Yii::$app->controller->id;

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
<header id="mainHeader" class="clearfix">
    <!-- logo start -->
    <h1 id="logo" class="l">
        <img src="<?=$baseUrl ?>images/logo.png">
        <?= \Yii::t('app', 'Agent Ticketing System') ?>
    </h1>
    <!-- logo end -->
    <!-- user start -->
    <div id="user" class="r clearfix">
        <div class="l" id="userImg">
            <img src="<?=$baseUrl ?>images/user.png">
        </div>
        <div class="l">
            <span id="userName">admin</span>
            <span id="exit"><a href="javascript:window.opener=null;window.open('','_self');window.close();"><?= \Yii::t('app', 'Exit') ?></a></span>
        </div>
    </div>
    <!-- user end -->
</header>
<!-- header end -->
<!-- main start -->
<main id="main" class="pBox">
    <!-- asideNav start -->
    <aside id="asideNav">
        <nav id="openNav">
            <!-- 一级 -->
            <ul>
                <li class="open">
                    <a href="<?php echo Url::toRoute(['default/index']);?>"><img src="<?=$baseUrl ?>images/icon.png"><?= \Yii::t('app', 'Agent Ticketing') ?></a>
                </li>
                <!-- 二级 -->
                <ul>
                    <li<?= $controller=='travelagent'? ' class="active"':'' ?>><a href="<?php echo Url::toRoute(['travelagent/agentinfo']);?>"><?= \Yii::t('app', 'Travel Agent') ?></a></li>
                    <li<?= $controller=='bookingticket'? ' class="active"':'' ?>><a href="<?php echo Url::toRoute(['bookingticke/booking_ticke']);?>"><?= \Yii::t('app', 'Booking Ticke') ?></a></li>
                    <li<?= $controller=='ticketcenter'? ' class="active"':'' ?>><a href="<?php echo Url::toRoute(['ticketcenter/ticket_center']);?>"><?= \Yii::t('app', 'Ticket Center') ?></a></li>
                    <li<?= $controller=='returningticket'? ' class="active"':'' ?>><a href="<?php echo Url::toRoute(['returningticket/returning_ticket']);?>"><?= \Yii::t('app', 'Returning Ticke') ?></a></li>
                    <li<?= $controller=='remainingcabin'? ' class="active"':'' ?>><a href="<?php echo Url::toRoute(['port/port']);?>"><?= \Yii::t('app', 'Remaining Cabin') ?></a></li>
                  </ul>
            </ul>
            <div class="extendBtn">
                <a href="#"><span><<</span></a>
            </div>
        </nav>
        <nav id="closeNav">
            <ul>
                <li><img src="<?=$baseUrl ?>images/icon.png"></li>
            </ul>
            <div class="extendBtn">
                <a href="#"><span><<</span></a>
            </div>
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
