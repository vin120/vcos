<?php
$this->title = 'Voyage Management';


use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetUpload;

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
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['cruise']);?>">Cruise</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Cruise_add</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['cruise_add'],
					'method'=>'post',
					'id'=>'cruise_val',
					'options' => ['class' => 'cruise_add','enctype'=>'multipart/form-data'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		<div>
			<p>
				<label>
					<span class='max_l'>Cruise Code:</span>
					<input type="text" required id='code' name='code'></input>
					
				</label>
				
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Cruise Name:</span>
					<input type="text" required id="name" name="name"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Deck Number:</span>
					<input type="text" required id='number' name='number'  required ></input>
					
				</label>
				
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l' style="float: left;">Cruise Img:</span>
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
			<p style="clear: both">
				<label>
					<span class='max_l'>Cruise Desc:</span>
					<textarea id='desc' name='desc'>
					</textarea>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Status:</span>
					<select name="state" id="state">
						<option value='1'>Usable</option>
						<option value='0'>Disabled</option>
					</select>
				</label>
			</p>
			
		</div>
		<div class="btn">
				<input type="submit" value="SAVE"></input>
				<input class="cancle" type="button" value="CANCLE"></input>
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