<?php
$this->title = 'Voyage Management';


use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

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
    <a href="#">Cruise_edit</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['cruise_edit','code'=>$cruise_result['cruise_code']],
					'method'=>'post',
					'id'=>'cruise_val',
					'options' => ['class' => 'cruise_edit'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		<div>
			<input type="hidden" id="id" name="id" value="<?php echo $cruise_result['id']?>" />
			<p>
				<label>
					<span class='max_l'>Cruise Code:</span>
					<input type="text" id='code' name='code' value="<?php echo $cruise_result['cruise_code']?>"></input>
					
				</label>
				<label>
					<span>Status:</span>
					<select name="state" id="state">
						<option value='1' <?php echo $cruise_result['status']==1?"selected='selected'":'';?>>Usable</option>
						<option value='0' <?php echo $cruise_result['status']==0?"selected='selected'":'';?>>Disabled</option>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Cruise Name:</span>
					<input type="text" id="name" name="name" value="<?php echo $cruise_result['cruise_name']?>"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Cruise Desc:</span>
					<textarea id='desc' name='desc'>
					<?php echo $cruise_result['cruise_desc']?>
					</textarea>
				</label>
				<span class='tips'></span>
			</p>
			<div class="btn">
				<input type="submit" value="SAVE"></input>
				<input class='cancle' type="button" value="CANCLE"></input>
			</div>
		</div>
		<?php 
		ActiveForm::end(); 
		?>

	</div>
        
    </div>
</div>
<!-- content end -->

}
