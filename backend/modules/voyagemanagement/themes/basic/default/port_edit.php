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
    <a href="#">Port_edit</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class="pop-ups write max_write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['port_edit','code'=>$port_result['port_code']],
					'method'=>'post',
					'id'=>'port_val',
					'options' => ['class' => 'port_edit'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		<div>
			<input type="hidden" id="id" name="id" value="<?php echo $port_result['id']?>" />
			<p>
				<label>
					<span class='max_l'>Port Code:</span>
					<input type="text" id='code' name='code' value="<?php echo $port_result['port_code']?>"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Port Code(2 character):</span>
					<input type="text" id="code_chara" name="code_chara" value="<?php echo $port_result['port_short_code']?>"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Country Code:</span>
					<select name="country_code" id="country_code">
						<?php foreach ($country_result as $k=>$row){?>
						<option <?php if($port_result['country_code']==$row['country_code']){echo "selected='selected'";}?> value="<?php echo $row['country_code']?>"><?php echo $row['country_code']?></option>
						<?php }?>
					</select>
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Port Name:</span>
					<input type="text" id="name" name="name" value="<?php echo $port_result['port_name']?>"></input>
					
				</label>
				<span class='tips'></span>
			</p>
			<p>
				<label>
					<span class='max_l'>Status:</span>
					<select name="state" id="state">
						<option value='1' <?php echo $port_result['status']==1?"selected='selected'":'';?>>Usable</option>
						<option value='0' <?php echo $port_result['status']==0?"selected='selected'":'';?>>Disabled</option>
					</select>
				</label>
				
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
