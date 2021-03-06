<?php
$this->title = 'Agent Ticketing';


use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
<!-- main content start -->
<div id="inputMode" class="mainContent">
   
    <div id="mainContent_content" class="pBox">
		<div class="pBox" id="entryBox">
			<h2><?php echo yii::t('app','Please Input The Entry Mode')?></h2>
			<div>
				<a href="<?php echo Url::toRoute(['data_import'])?>">
					<img src="<?=$baseUrl ?>images/excel.png">
					<span><?php echo yii::t('app','Excel Import')?></span>
				</a>
				<a href="<?php echo Url::toRoute(['add_uest_info'])?>">
					<img src="<?=$baseUrl ?>images/entry.png">
					<span><?php echo yii::t('app','Manual Entry')?></span>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- main content end -->




