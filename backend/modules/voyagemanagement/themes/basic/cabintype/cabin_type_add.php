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
var cabin_type_ajax_url = "<?php echo Url::toRoute(['cabin_type_code_check']);?>";
</script>

<!-- content start -->
<div class="r content" id="user_content">
    <div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['cabin_type']);?>">Cabin Type</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Cabin_type_add</a></div>
    
    <div class="tab">
		<ul class="tab_title">
			<li class="active">Basic</li>
			<li>Graphic</li>
		</ul>
		<div class="tab_content">
			<div class="active">
				<div class="searchResult">
					<div id="service_write" class="write">

					<?php
						$form = ActiveForm::begin([
								'action' => ['cabin_type_add'],
								'method'=>'post',
								'id'=>'cabin_type_val',
								'options' => ['class' => 'cabin_type_add'],
								'enableClientValidation'=>false,
								'enableClientScript'=>false
						]); 
					?>
					<div>
						<p>
							<label>
								<span class='max_l'>Cabin Type Code:</span>
								<input required type="text" id='code' name='code'></input>
								
							</label>
							
							<span class='tips'></span>
						</p>
						<p>
							<label>
								<span class='max_l'>Cabin Type Name:</span>
								<input required type="text" id="name" name="name"></input>
								
							</label>
							<span class='tips'></span>
						</p>
						<p>
							<label>
								<span class='max_l'>Live Number:</span>
								<select name='live_number' id="live_number">
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
									<option value='4'>4</option>
								</select>
							</label>
							
							<span class='tips'></span>
						</p>
						<p>
							<label>
								<span class='max_l'>Beds:</span>
								<select name='beds' id="beds">
									<option value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
									<option value='4'>4</option>
								</select>
							</label>
							
							<span class='tips'></span>
						</p>
						
						<p>
							<label>
								<span class='max_l'>Room Area:</span>
								<input required type="text" id="room_min" name="room_min" style="width:35px" /> -
								<input required type="text" id="room_max" name="room_max" style="width:35px" />平方米
							</label>
							<span class='tips'></span>
						</p>
						<p>
							<label>
								<span class='max_l'>Floor:</span>
								<input required type="text" id='floor' name='floor'></input>
								
							</label>
							
							<span class='tips'></span>
						</p>
						<p>
							<label>
								<span class='max_l'>location:</span>
								<select name="location" id="location">
									<option value="0">左弦</option>
									<option value="1">右弦</option>
								</select>
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
						<?php foreach($type_attr as $k=>$val){?>
						<p>
							<label>
								<span class='max_l'><?php echo $val['att_name']?>:</span>
								<input type="radio" name="att[<?php echo $k;?>]" id="att[<?php echo $k;?>]" value="<?php echo $val['id']?>" /> 有
								<input checked="checked" type="radio" name="att[<?php echo $k;?>]" id="att[<?php echo $k;?>]" value="0" /> 无
							</label>
						</p>
						<?php }?>
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
			<div>
				<div>
					<table>
						<thead>
							<tr>
								<th>No.</th>
								<th>Cabin Type Desc</th>
								<th>Cabin Type Img</th>
								<th>Operate</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<p class="records">Records:<span>0</span></p>
					<div class="btn">
						<input type="button" value="Add" style="background:#ccc;"></input>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<!-- content end -->


