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
<style type="text/css">
	.write label span { width: 160px; }
	.write select.input_select{ width: 165px; height: 26px; }
</style>
<script type="text/javascript">
var ajax_url = "<?php echo Url::toRoute(['country_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['country']);?>">Country</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Country_add</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class=" write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['country_add'],
					'method'=>'post',
					'id'=>'country_val',
					'options' => ['class' => 'country_add'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		
				<div>
					<p>
						<label>
							<span>Country Name:</span>
							<input type="text" id="name" required name="name"></input>
						</label>
						<label>
							<span>area Name:</span>
							<select class="input_select" id="area_code" name="area_code">
							<?php foreach ($area_result as $row){?>
							<option value="<?php echo $row['area_code']?>"><?php echo $row['area_name']?></option>
							<?php }?>
							</select>
						</label>
						<label>
							<span>Status:</span>
							<select name="state" id="state">
								<option value='1'>Usable</option>
								<option value='0'>Disabled</option>
							</select>
						</label>
					</p>
					<p>
						<label>
							<span>Code(2 characters):</span>
							<input type="text"  id='code' required  name='code'></input>
						</label>
						<label>
							<span>Code(3 characters):</span>
							<input type="text" id="code_chara" required name="code_chara"></input>
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

