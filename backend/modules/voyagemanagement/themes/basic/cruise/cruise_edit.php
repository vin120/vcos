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
<script type="text/javascript">
var cruise_ajax_url = "<?php echo Url::toRoute(['cruise_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav"><?php echo yii::t('app','Voyage Manage')?>&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['cruise']);?>"><?php echo yii::t('app','Cruise')?></a>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Cruise_edit')?></a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['cruise_edit','code'=>$cruise_result['cruise_code']],
					'method'=>'post',
					'id'=>'cruise_val',
					'options' => ['class' => 'cruise_edit','enctype'=>'multipart/form-data'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		<div>
			<input type="hidden" id="id" name="id" value="<?php echo $cruise_result['id']?>" />
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Cruise Code')?>:</span>
					<input type="text" id='code' required name='code' value="<?php echo $cruise_result['cruise_code']?>"></input>
					
				</label>
				
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Cruise Name')?>:</span>
					<input type="text" id="name" required name="name" value="<?php echo $cruise_result['cruise_name']?>"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Deck Number')?>:</span>
					<input type="text" id='number' required  name='number' value="<?php echo $cruise_result['deck_number']?>"></input>
					
				</label>
				
				<span class='tips'></span>
			</p>
			<p style="min-height:130px; ">
				<label>
					<span class='max_l' style="float: left;"><?php echo yii::t('app','Cruise Img')?>:</span>
					<span style="width:120px;height:120px;float:left;margin-left:5px;">
					<img id="ImgPr" width="120" height="120" src="<?php echo $baseUrl.'upload/'.$cruise_result['cruise_img'] ?>"/>
					</span>
					<span id="up_btn" class="btn_img" style="position:relative;left:5px;display:block">
						<span><?php echo yii::t('app','choose image')?></span>
						<input id="photoimg" type="file" name="photoimg">
					</span>
				 </label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Cruise Desc')?>:</span>
					<textarea id='desc' name='desc' required>
					<?php echo $cruise_result['cruise_desc']?>
					</textarea>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'><?php echo yii::t('app','Status')?>:</span>
					<select name="state" id="state">
						<option value='1' <?php echo $cruise_result['status']==1?"selected='selected'":'';?>><?php echo yii::t('app','Avaliable')?></option>
						<option value='0' <?php echo $cruise_result['status']==0?"selected='selected'":'';?>><?php echo yii::t('app','Unavaliable')?></option>
					</select>
				</label>
			</p>
			
		</div>
		<div class="btn">
				<input type="submit" value="<?php echo yii::t('app','SAVE')?>"></input>
				<input class='cancle' type="button" value="<?php echo yii::t('app','CANCLE')?>"></input>
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
