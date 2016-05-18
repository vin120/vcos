<?php
$this->title = 'Agent Ticketing';


use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';
?>
<!-- main content start -->
<div id="dataImport" class="mainContent">
	<div id="topNav">
		<a href="#"><?php echo yii::t('app','Agent Ticketing')?>&nbsp;&gt;&gt;&nbsp;
		<a href="#"><?php echo yii::t('app','Agent Reservation')?>&nbsp;&gt;&gt;&nbsp;
		<a href="#"><?php echo yii::t('app','Agent Input mode')?>&nbsp;&gt;&gt;&nbsp;
		<a href="#"><?php echo yii::t('app','Agent Data Import')?>
	</div>
	<div id="mainContent_content" class="pBox">
		<!-- 请用ajax提交 -->
		<div id="uploadFile">
			<label>
				<span>Filename:</span>
				<span id="uploadBox">
					<label>
						<input type="file"></input>
						<input type="text" disabled="disabled"></input>
						<input type="button" value="Browse" class="btn1"></input>
					</label>
				</span>
			</label>
		</div>
		<div class="btnBox2">
			<input type="button" value="PREVIOUS" class="btn2"></input>
			<input type="button" value="NEXT" class="btn1"></input>
		</div>
	</div>
</div>
<!-- main content end -->