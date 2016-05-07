<?php
$this->title = 'Voyage Management';

use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetDate;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetUpload;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

ThemeAsset::register($this);
ThemeAssetDate::register($this);
ThemeAssetUpload::register($this);


$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';
$baseUrl_upload = $this->assetBundles[ThemeAssetUpload::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
<style type="text/css">

	.write p { overflow: hidden; }
	.write label { width: 324px; }
	.write label:first-child { float: left; margin-left: 5%; }
	.write label + label { float: right; margin-right: 15%; }
	.write label span { width: 140px; }
	.shortLabel { margin-right: 84px; }
	.write label textarea { float: left; margin-left: 45%; width: 550px; height: 80px; vertical-align: top; }
	
	/*upload*/
	.uploadFileBox { display: inline-block; width: 280px; line-height: 20px; border: 1px solid #dcdcdc; border-radius: 4px; box-sizing: border-box; overflow: hidden; }
	.fileName { display: inline-block; width: 190px; line-height: 30px; margin-left: 10px; vertical-align: middle; overflow: hidden; }
	.uploadFile { float: right; position: relative; display: inline-block; background-color: #3f7fcf; padding: 6px 12px; overflow: hidden; color: #fff; text-decoration: none; text-indent: 0; line-height: 20px; }
	.uploadFile input { position: absolute; font-size: 100px; right: 0; top: 0; opacity: 0; }
	.price {border-radius: 4px; box-sizing: border-box; background-color:"#fff"}
	#map img {display: block; width: 40%; min-height: 400px; margin-bottom: 20px; border: 1px solid #dcdcdc; }
	
	
	/* cabin */
	.selectBox { float: left; width: 100%; overflow: hidden; box-sizing: border-box; }
	.selectList { border: 1px solid #e0e9f4; }
	.selectList ul { width: 200px; margin: 0; padding: 0; list-style: none; }
	.selectList ul:first-child { background-color: #99bfee; }
	.selectList ul:last-child { max-height: 500px; overflow-y: scroll; }
	.selectList li { display: table-row; }
	.selectList li > span { display: table-cell; padding: 10px; }
	.selectBox .btn input { display: block; margin: 20px; }
	
</style>

<!-- content start -->
<div class="r content">
<div class="topNav"><?php echo yii::t('app','Voyage Manage')?>&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['index']);?>"><?php echo yii::t('app','Voyage Set')?></a>&nbsp;&gt;&gt;&nbsp;
    <a href="#"><?php echo yii::t('app','Voyage_set_add')?></a></div>
	<div class="tab">
		<ul class="tab_title">
			<li class="active"><?php echo yii::t('app','Voyage')?></li>
			<li><?php echo yii::t('app','Voyage Port')?></li>
			<li><?php echo yii::t('app','Active')?></li>
			<li><?php echo yii::t('app','Voyage Map')?></li>
			<li><?php echo yii::t('app','Cabin')?></li>
			<li><?php echo yii::t('app','Return route')?></li>
		</ul>
		<div class="tab_content">
			<div class="active">
				<!-- voyage start -->
				<div class="write">
				<?php
					$form = ActiveForm::begin([
						'action' => ['voyage_add'],
						'method'=>'post',
						'id'=>'voyage_add',
						'options' => ['class' => 'voyage_add'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
					<div>
						<p>
							<label>
								<span><?php echo yii::t('app','Voyage Name')?>:</span>
								<input type="text" id="voyage_name" name="voyage_name" required ></input>
							</label>
							<label>
								<span><?php echo yii::t('app','Voyage Num')?>:</span>
								<input type="text" id="voyage_num" name="voyage_num" required ></input>
							</label>
						</p>
						<p>
							<label >
								<span><?php echo yii::t('app','Area')?>:</span>
								<select name="area" id="area">
									<?php foreach ($area as $row ){?>
									<option value="<?php echo $row['area_code'];?>"><?php echo $row['area_name']?></option>
									<?php } ?>
								</select>
							</label>
							<label>
								<span><?php echo yii::t('app','Cruise')?>:</span>
								<select id="cruise" name="cruise">
								<?php foreach($cruise as $row) {?>
									<option value="<?php echo $row['cruise_code']?>"><?php echo $row['cruise_name']?></option>
								<?php } ?>
								</select>
							</label>
						</p>
						<p>
							<label >
								<span><?php echo yii::t('app','Scheduling')?>:</span>
							</label>
							<label class="uploadFileBox">
								<span class="fileName"><?php echo yii::t('app','Pick Up PDF')?>...</span>
								<a href="#" class="uploadFile">choose<input type="file" name="pdf" id="pdf"></input></a>
							</label>
						</p>
						<p>
							<label>
								<span><?php echo yii::t('app','Start Time')?>:</span>
								<input type="text" id="s_time" name="s_time" placeholder="<?php echo yii::t('app','please choose')?>"  readonly value="<?php echo date("Y-m-d H:i:s",time());?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"  ></input>
							</label>
							<label>
								<span><?php echo yii::t('app','End Time')?>:</span>
								<input type="text" id="e_time" name="e_time" placeholder="<?php echo yii::t('app','please choose')?>"  readonly value="<?php echo date("Y-m-d H:i:s",time());?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"  ></input>
							</label>
						</p>
						<p>
							<label >
								<span><?php echo yii::t('app','Desc')?>:</span>
								<textarea id="desc" name="desc"></textarea>
							</label>
						</p>
						
						<div class="price">
							<p>
								<label>
									<span><?php echo yii::t('app','Start booking time')?>:</span>
									<input type="text" id="s_book_time" name="s_book_time" placeholder="<?php echo yii::t('app','please choose')?>"  readonly value="<?php echo date("Y-m-d H:i:s",time());?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"  ></input>
								</label>
								<label>
									<span><?php echo yii::t('app','Stop booking time')?>:</span>
									<input type="text" id="e_book_time" name="e_book_time" placeholder="<?php echo yii::t('app','please choose')?>"  readonly value="<?php echo date("Y-m-d H:i:s",time());?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"  ></input>
								</label>
							</p>
							<p>
								<label>
									<span><?php echo yii::t('app','Ticket Price')?>:</span>
									<input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="ticket_price" name="ticket_price" required></input>
								</label>
								<label>
									<span><?php echo yii::t('app','Ticket Taxes')?>:</span>
									<input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="ticket_taxes" name="ticket_taxes" min="0" max="100" required></input>
								</label>
							</p>
							<p>
								<label>
									<span><?php echo yii::t('app','Harbour Taxes')?>:</span>
									<input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="harbour_taxes" name="harbour_taxes" min="0" max="100" required></input>
								</label>
								<label>
									<span><?php echo yii::t('app','Deposit ratio')?>:</span>
									<input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" id="deposit_ratio" name="deposit_ratio" min="0" max="100" required></input>
								</label>
							</p>
						</div>
					</div>
					<div class="btn">
						<input type="submit" value="<?php echo yii::t('app','SAVE')?>"></input>
						<input class="cancel" type="button" value="<?php echo yii::t('app','CANCEL')?>" ></input>
					</div>
				</div>
				<?php 
					ActiveForm::end(); 
				?>
				<!-- voyage end -->
			</div>
			<div>
				<!-- voyage port start -->
				<table>
					<thead>
						<tr>
							<th><input type="checkbox"></input></th>
							<th><?php echo yii::t('app','No.')?></th>
							<th><?php echo yii::t('app','Port Name')?></th>
							<th><?php echo yii::t('app','Arrival Time')?></th>
							<th><?php echo yii::t('app','Departure Time')?></th>
							<th><?php echo yii::t('app','Operation')?></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<p class="records"><?php echo yii::t('app','Records')?>:<span>0</span></p>
		        <div class="btn">
		            <a href="#"><input type="button" value="<?php echo yii::t('app','Add')?>"  style="background: #ccc;cursor:not-allowed"></input></a>
		            <input type="button" value="<?php echo yii::t('app','Del Selected')?>"  style="background: #ccc;cursor:not-allowed"></input>
		        </div>
				<!-- voyage port end -->
			</div>
			<div>
				<!-- active start -->
				<p>
					<label>
						<span><?php echo yii::t('app','Curr Active')?>:</span>
						<span style="color:red">null</span>
					</label>
				</p>
				<p>
					<label>
						<span><?php echo yii::t('app','Active Type')?>:</span>
						<select disabled="disabled"></select>
					</label>
				</p>
				<div class="btn">
					<input type="button" value="<?php echo yii::t('app','Save')?>"   style="background: #ccc;cursor:not-allowed" ></input>
				</div>
				<!-- active end -->
			</div>
			<div id="map">
				<!-- voyage map start -->
				<div>
					<img id="ImgPr" src="">
					<input id="photoimg" type="file" disabled="disabled"></input>
					<div class="btn">
						<input type="button" value="Upload" style="background: #ccc;cursor:not-allowed" ></input>
					</div>
				</div>
				<!-- voyage map end -->
			</div>
			<div>
				<!-- cabin start -->
				<div class="search">
					<label>
						<span><?php echo yii::t('app','Type')?>:</span>
						<select disabled="disabled">
							<option><?php echo yii::t('app','All')?></option>
						</select>
					</label>
					<label>
						<span><?php echo yii::t('app','Desk')?>:</span>
						<select disabled="disabled">
							<option>1</option>
							<option>2</option>
						</select>
					</label>
				</div>
				<div class="searchResult selectBox">
					<div class="l selectList">
						<ul>
							<li><span><input type="checkbox" disabled="disabled"></span></input><span><?php echo yii::t('app','No Selected')?></span></li>
						</ul>
						<ul>
							<li><span><input type="checkbox" disabled="disabled"></span><span></span></li>
							<li><span><input type="checkbox" disabled="disabled"></span><span></span></li>
							<li><span><input type="checkbox" disabled="disabled"></span><span></span></li>
						</ul>
					</div>
					<div class="btn l">
						<input type="button" value=" >> "></input>
						<input type="button" value=" << "></input>
					</div>
					<div class="l selectList">
						<ul>
							<li><span><input type="checkbox" disabled="disabled"></span></input><span><?php echo yii::t('app','Selected')?></span></li>
						</ul>
						<ul>
							<li><span><input type="checkbox" disabled="disabled"></span><span></span></li>
							<li><span><input type="checkbox" disabled="disabled"></span><span></span></li>
							<li><span><input type="checkbox" disabled="disabled"></span><span></span></li>
						</ul>
					</div>
				</div>
				<div class="btn">
					<input type="button" value="<?php echo yii::t('app','Save')?>"  style="background: #ccc;cursor:not-allowed"></input>
				</div>
				<!-- cabin end -->
			</div>
			<div>
				<!-- Return route start -->
				<p>
					<label>
						<span><?php echo yii::t('app','Return Route')?>:</span>
						<select disabled="disabled">
							<option><?php echo yii::t('app','All')?></option>
						</select>
					</label>
				</p>
				<p>
					<label>
						<span><?php echo yii::t('app','Route Name')?>:</span>
						<input type="text" disabled="disabled"></input>
					</label>
				</p>
				<div class="btn">
					<input type="button" value="<?php echo yii::t('app','Save')?>" style="background: #ccc;cursor:not-allowed"></input>
				</div>
				<!-- Return route end -->
			</div>
		</div>
	</div>
</div>
<!-- content end -->
<script type="text/javascript">
window.onload = function(){

	$("#photoimg").uploadPreview({ Img: "ImgPr", Width: 120, Height: 120 });
	
// 上传文件功能
	$(".uploadFile").on("change","input[type='file']",function(){
		var filePath = $(this).val();
		var arr=filePath.split('\\');
		var fileName=arr[arr.length-1];
		$(".fileName").html(fileName);
		$(".fileName").attr("title",fileName);
	});
}
</script>