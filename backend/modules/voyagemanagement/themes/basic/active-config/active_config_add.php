<?php
$this->title = 'Voyage Management';

use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

?>

<!-- content start -->
<div class="r content">
	<div class="topNav">Route Manage&nbsp;&gt;&gt;&nbsp;
	<a href="<?php echo Url::toRoute(['active_config']);?>">Active Config</a>&nbsp;&gt;&gt;&nbsp;
	<a href="#">Active Config Add</a></div>
	<div class="tab">
		<ul class="tab_title">
			<li class="active">Active</li>
			<li>Detail</li>
		</ul>
		<div class="tab_content">
			<div class="active">
				<div class="write">
				<?php
					$form = ActiveForm::begin([
						'action' => ['active_config_add'],
						'method'=>'post',
						'id'=>'active_config_add',
						'options' => ['class' => 'active_config_add','enctype'=>'multipart/form-data'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
					<div>
						<p>
							<label>
								<span>Name:</span>
								<input type="text" id="name"  name="name" required ></input>
							</label>
							<span class='tips'></span>
						</p>
						<p>
							<label>
								<span>Status:</span>
								<select id="active_select" name="active_select">
									<option value="1">Usable</option>
									<option value="0">Disabled</option>
								</select>
							</label>
							<span class='tips'></span>
						</p>
					</div>
					<div class="btn">
						<input type="submit" value="SAVE" ></input>
						<input type="button" class="cancle" value="CLEAN" ></input>
					</div>
				<?php 
					ActiveForm::end(); 
				?>
				</div>
			</div>
			<div>
				<div>
					<table>
						<thead>
							<tr>
								<th><input type="checkbox"></input></th>
								<th>Day</th>
								<th>Title</th>
								<th>Desc</th>
								<th>Operate</th>
							</tr>
						</thead>
					</table>
					<p class="records">Records:<span>0</span></p>
					<div class="btn">
						<input type="button" value="Add" style="background: #ccc;cursor:not-allowed" ></input>
						<input type="button" value="Del Selected" style="background: #ccc;cursor:not-allowed" ></input>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- content end -->