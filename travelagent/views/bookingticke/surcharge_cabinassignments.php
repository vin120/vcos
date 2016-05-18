<?php
$this->title = 'Agent Ticketing';


use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';
?>

<!-- main content start -->
<div id="surchargeAndCabinAssignments" class="mainContent">
	<div id="topNav">
    <?php echo yii::t('app','Agent Ticketing')?>&nbsp;&gt;&gt;&nbsp;
	<a href="#"><?php echo yii::t('app','Reservation')?></a>&nbsp;&gt;&gt;&nbsp;
	<a href="#"><?php echo yii::t('app','Input mode')?></a>&nbsp;&gt;&gt;&nbsp;
	<a href="#"><?php echo yii::t('app','Choose Cabin &amp; Reservation Quantity')?></a>&nbsp;&gt;&gt;&nbsp;
	<a href="#"><?php echo yii::t('app','Add Guest Infomation')?></a>&nbsp;&gt;&gt;&nbsp;
	<a href="#"><?php echo yii::t('app','Surcharge &amp; Cabin Assignments')?></a>
	</div>
	<div id="mainContent_content" class="pBox">
		<h2><?php echo yii::t('app','Shore Excursions')?></h2>
		
		<?php foreach ($shore as $row):?>
		<!-- foreach  -->
		<div class="accordion">
			<div class="head clearfix pBox">
				<div class="l">
					<label>
						<input type="checkbox"  id="<?php echo $row['se_code']?>"></input>
						<span><?php echo $row['se_name']?></span>
					</label>
				</div>
				<div class="r accordionBtn">
					<a href="#"><?php echo yii::t('app','Detail')?><i>></i></a>
					<a href="#"><?php echo yii::t('app','Select Guests')?><i>></i></a>
				</div>
			</div>
			<div class="body">
				<div class="pBox">
				<?php echo $row['se_info'];?>
				<!--  
					<h3>01/28 Without Meals</h3>
					<p>Travel time:1 hours;tour time:4 hours</p>
					<p><em>[Jeju,jeju Folk Museum of natural history]</em> info in 1984 Jeju Folk Museum of natural history displays originally scattered in Jeju's traditional folk relics, natural historical sites and other precious items and information. The museum is divided info the natural history of the exhibition hall and second first folk exhibition hall and outdoor exhibition hall.</p>
					<p><em>[Jeju,jeju Folk Museum of natural history]</em> info in 1984 Jeju Folk Museum of natural history displays originally scattered in Jeju's traditional folk relics, natural historical sites and other precious items and information. The museum is divided info the natural history of the exhibition hall and second first folk exhibition hall and outdoor exhibition hall.</p>
					<p><em>[Jeju,jeju Folk Museum of natural history]</em> info in 1984 Jeju Folk Museum of natural history displays originally scattered in Jeju's traditional folk relics, natural historical sites and other precious items and information. The museum is divided info the natural history of the exhibition hall and second first folk exhibition hall and outdoor exhibition hall.</p>
				-->
				</div>
				<div class="pBox shore_div">
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
				</div>
			</div>
		</div>
		<!-- endforeach -->
		<?php endforeach;?>
		
		<h2 class="mgt"><?php echo yii::t('app','Insurance')?></h2>
		
		
		<?php foreach($surcharge as $row):?>
		<!-- foreach start -->
		<div class="accordion">
			<div class="head clearfix pBox">
				<div class="l">
					<label>
						<input type="checkbox" id="<?php echo $row['cost_id']?>"></input>
						<span><?php echo $row['cost_name']?></span>
					</label>
				</div>
				<div class="r accordionBtn">
					<a href="#">Detail<i>></i></a>
					<a href="#">Select Guests<i>></i></a>
				</div>
			</div>
			<div class="body">
				<div class="pBox">
				<?php echo $row['cost_desc']?>
				<!-- 
					<h3>01/28 Without Meals</h3>
					<p>Travel time:1 hours;tour time:4 hours</p>
					<p><em>[Jeju,jeju Folk Museum of natural history]</em> info in 1984 Jeju Folk Museum of natural history displays originally scattered in Jeju's traditional folk relics, natural historical sites and other precious items and information. The museum is divided info the natural history of the exhibition hall and second first folk exhibition hall and outdoor exhibition hall.</p>
					<p><em>[Jeju,jeju Folk Museum of natural history]</em> info in 1984 Jeju Folk Museum of natural history displays originally scattered in Jeju's traditional folk relics, natural historical sites and other precious items and information. The museum is divided info the natural history of the exhibition hall and second first folk exhibition hall and outdoor exhibition hall.</p>
					<p><em>[Jeju,jeju Folk Museum of natural history]</em> info in 1984 Jeju Folk Museum of natural history displays originally scattered in Jeju's traditional folk relics, natural historical sites and other precious items and information. The museum is divided info the natural history of the exhibition hall and second first folk exhibition hall and outdoor exhibition hall.</p>
			 	-->
				</div>
				<div class="pBox insurance_div">
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
					<label>
						<input type="checkbox"></input>
						<span>ZHANG SAN</span>
					</label>
				</div>
			</div>
		</div>
		<!-- endforeach -->
		<?php endforeach;?>
		
		
		
		<h2 class="mgt"><?php echo yii::t('app','Cabin Assignments')?></h2>
		<table id="room_div">
			<thead>
				<tr>
					<th><?php echo yii::t('app','Room')?></th>
					<th><?php echo yii::t('app','Cabin Type')?></th>
					<th><?php echo yii::t('app','Deck')?></th>
					<th><?php echo yii::t('app','Guest1')?></th>
					<th><?php echo yii::t('app','Guest2')?></th>
					<th><?php echo yii::t('app','Guest3')?></th>
					<th><?php echo yii::t('app','Guest4')?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="readOnly">1</td>
					<td class="readOnly">Owner Suite</td>
					<td class="readOnly">10</td>
					<td>
						<select>
							<option>Please Select</option>
						</select>
					</td>
					<td>
						<select>
							<option>Please Select</option>
						</select>
					</td>
					<td class="readOnly point">Null</td>
					<td class="readOnly point">Null</td>
				</tr>
			</tbody>
		</table>
		<div class="btnBox2">
			<input type="button" value="PREVIOUS" class="btn2"></input>
			<input type="button" value="NEXT" class="btn1"></input>
		</div>
	</div>
</div>
<!-- main content end -->
<script type="text/javascript">
window.onload = function(){
	var user_arr = new Array();
	var data = $.session.get('membership');
	//alert(data);
	var str = '';	//	存放其他
	var curr_str = ''; //存放当前
	data_ex = data.split('-');
	$.each(data_ex,function(e){
		if(data_ex[e]!=''){
			var val = data_ex[e].split('&');
			var u_passport = '';
			var u_full_name = ''
			val.forEach(function(param){
			  param = param.split('=');
			  var name = param[0],
			      val = param[1];
				if(name == 'passport'){u_passport=val;}
				if(name == 'full_name'){u_full_name=val;}
		      	 
			});
			
			user_arr.push(u_passport+'-'+u_full_name);
		}
		
	});

	var data_str = '';
	$.each(user_arr,function(k){
		var d_val = user_arr[k].split("-");
		data_str += "<label>";
		data_str += '<input type="checkbox" value="'+d_val[0]+'"></input>';
		data_str += '<span>'+d_val[1]+'</span>';
		data_str += '</label>';

	});

	$(".shore_div").html(data_str);
	$(".insurance_div").html(data_str);


	var room_data = $.session.get("room_<?php echo $code;?>");

	//alert(room_data);

	
}
</script>