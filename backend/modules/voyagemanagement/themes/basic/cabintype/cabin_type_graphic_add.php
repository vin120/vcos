<?php
$this->title = 'Voyage Management';


use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetUpload;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);
ThemeAssetUpload::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';
$baseUrl_upload = $this->assetBundles[ThemeAssetUpload::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['cabin_type']);?>">Cabin Type</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Graphic_add</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class=" write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['cabin_type_graphic_add'],
					'method'=>'post',
					'id'=>'cabin_type_graphic_val',
					'options' => ['class' => 'cabin_type_graphic_add','enctype'=>'multipart/form-data'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		
				<div>
				<input type="hidden" name="type_id" id='type_id' value="<?php echo $id;?>" />
					<p>
						<label>
							<span class='max_l'>Describe:</span>
							<textarea id="desc" name="desc" required></textarea>
						</label>
					</p>
					<p>
						<label>
							<span class='max_l' style="float: left;">Images:</span>
							<span id="img_back" style="width:120px;height:120px;float:left;margin-left:5px;margin-bottom:30px;display:none">
							<img id="ImgPr" width="120" height="120" src=""/>
							</span>
							<span id="up_btn" class="btn_img" style="display:inline-block;margin-left:5px;">
								<span>选择图片</span>
								<input id="photoimg" type="file" name="photoimg" style="width:60px;">
							</span>
							
						 </label>
						<span class='tips'></span>
					</p>
					<span style="clear: both;display:block;"></span>
				</div>
				<div class="btn">
					<input type="submit" value="SAVE"></input>
				</div>
		<?php 
		ActiveForm::end(); 
		?>

	</div>
        
    </div>
</div>
<!-- content end -->
<script>
window.onload = function(){
$("#photoimg").uploadPreview({ Img: "ImgPr", Width: 120, Height: 120 });
}
</script>
