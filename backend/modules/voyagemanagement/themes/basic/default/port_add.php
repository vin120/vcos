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
var port_ajax_url = "<?php echo Url::toRoute(['port_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['port']);?>">Port</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Port_add</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['port_add'],
					'method'=>'post',
					'id'=>'port_val',
					'options' => ['class' => 'port_add'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		<div>
			<p>
				<label>
					<span class='max_l'>Port Code:</span>
					<input type="text" id='code' name='code'></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Port Code(2 character):</span>
					<input type="text" id="code_chara" name="code_chara"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Country Code:</span>
					
					<select name="country_code" id="country_code">
						<?php foreach ($country_result as $k=>$val){?>
						<option value="<?php echo $val['country_code']?>"><?php echo $val['country_code']?></option>
						<?php }?>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Port Name:</span>
					<input type="text" id="name" name="name"></input>
					
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
			<div class="btn">
				<input type="submit" value="SAVE"></input>
				<input class="cancle" type="button" value="CANCLE"></input>
			</div>
		</div>
		<?php 
		ActiveForm::end(); 
		?>

	</div>
        
    </div>
</div>
<!-- content end -->

