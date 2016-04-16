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
var shore_excursion_ajax_url = "<?php echo Url::toRoute(['shore_excursion_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['shore_excursion']);?>">Port</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Shore_excursion_edit</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['shore_excursion_edit','code'=>$shore_excursion_result['se_code']],
					'method'=>'post',
					'id'=>'shore_excursion_val',
					'options' => ['class' => 'shore_excursion_edit'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		<div>
			<input type="hidden" id="id" name="id" value="<?php echo $shore_excursion_result['id']?>" />
			<p>
				<label>
					<span class='max_l'>Shore Excursion Code:</span>
					<input type="text" id='code' name='code' value="<?php echo $shore_excursion_result['se_code']?>"></input>
					
				</label>
				<label>
					<span>Status:</span>
					<select name="state" id="state">
						<option value='1' <?php echo $shore_excursion_result['status']==1?"selected='selected'":'';?>>Usable</option>
						<option value='0' <?php echo $shore_excursion_result['status']==0?"selected='selected'":'';?>>Disabled</option>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Shore Excursion Name:</span>
					<input type="text" id="name" name="name" value="<?php echo $shore_excursion_result['se_name']?>"></input>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Shore Excursion Info:</span>
					<textarea id="desc" name="desc">
					<?php echo $shore_excursion_result['se_info']?>
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
