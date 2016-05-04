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


<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['cabin']);?>">Cabin</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Cabin_add</a></div>
    
    <div class="searchResult">
        
        <div id="service_write" class=" write">

		<?php
			$form = ActiveForm::begin([
					'action' => ['cabin_add'],
					'method'=>'post',
					'id'=>'cabin_val',
					'options' => ['class' => 'cbain_add'],
					'enableClientValidation'=>false,
					'enableClientScript'=>false
			]); 
		?>
		
		
				<div>
					<p>
						<label>
							<span class='max_l'>Cabin Type:</span>
							<select class="input_select" name="cabin_type_id" id="cabin_type_id">
							<?php foreach ($type_result as $k=>$val){?>
							<option value="<?php echo $val['id']?>"><?php echo $val['type_name']?></option>
							<?php }?>
							</select>
							
						</label>
						<span class='tips'></span>
					</p>
					<p>
						<label>
							<span class='max_l'>Deck Num:</span>
							<input type="text" required id="deck" name="deck"></input>
							
						</label>
						<span class='tips'></span>
					</p>
					
					<p>
						<label>
							<span class='max_l'>Max Check In:</span>
							<input type="text" required id="max" name="max"></input>
							
						</label>
						<span class='tips'></span>
					</p>
					<p>
						<label>
							<span class='max_l'>Ieast Aduits Num:</span>
							<input type="text" required id="min" name="min"></input>
							
						</label>
						<span class='tips'></span>
					</p>
					<p>
						<label>
							<span class='max_l'>Cabin Name:</span>
							
							<textarea type="text" id="name" name="name" required>
							</textarea>
							<span style="color:red;">例：2001,,2002,2003,</span>
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

