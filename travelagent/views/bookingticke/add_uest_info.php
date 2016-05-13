<?php
$this->title = 'Agent Ticketing';


use travelagent\views\myasset\PublicAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

PublicAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
<!-- main content start -->
<div id="addGuestInfo" class="mainContent">
	<div id="topNav">
		<?php echo yii::t('app','Agent Ticketing')?>
		<span>>></span>
		<a href="#"><?php echo yii::t('app','Reservation')?></a>
		<span>>></span>
		<a href="#"><?php echo yii::t('app','Input mode')?></a>
		<span>>></span>
		<a href="#"><?php echo yii::t('app','Choose Cabin')?> &amp; <?php echo yii::t('app','Reservation Quantity')?></a>
		<span>>></span>
		<a href="#"><?php echo yii::t('app','Add Guest Infomation')?></a>
	</div>
	<div id="mainContent_content" class="pBox">
		<div class="btnBox1">
			<input type="button" value="<?php echo yii::t('app','Add')?>" class="btn1" id="add"></input>
			<input type="button" value="<?php echo yii::t('app','Edit')?>" class="btn1"></input>
			<input type="button" value="<?php echo yii::t('app','Del')?>" class="btn2" id="del"></input>
			<input type="button" value="<?php echo yii::t('app','Deail')?>" class="btn1"></input>
		</div>
		<table>
			<thead>
				<tr>
					<th><input type="checkbox"></input></th>
					<th><?php echo yii::t('app','No.')?></th>
					<th><?php echo yii::t('app','Last Name')?></th>
					<th><?php echo yii::t('app','First Name')?></th>
					<th><?php echo yii::t('app','Sex')?></th>
					<th><?php echo yii::t('app','Date Of Birth')?></th>
					<th><?php echo yii::t('app','Passport Number')?></th>
					<th><?php echo yii::t('app','Date Of Issue')?></th>
					<th><?php echo yii::t('app','Date Of Expiry')?></th>
					<th>....</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox"></input></td>
					<td>1</td>
					<td>ZHAN</td>
					<td>SAN</td>
					<td>Male</td>
					<td>30/01/1990</td>
					<td>G1234567</td>
					<td>21/03/2013</td>
					<td>21/03/2013</td>
					<td>....</td>
				</tr>
			</tbody>
		</table>
		<div class="btnBox2">
			<input type="button" value="PREVIOUS" class="btn2"></input>
			<input type="button" value="NEXT" class="btn1"></input>
		</div>
	</div>
	<!-- popups start -->
	<div class="shadow"></div>
	<div class="popups" id="addPopups">
	<form id="add_uest_info_form">
		<h3>Add<a href="#" class="close r">&#10006;</a></h3>
		<div class="pBox">
			<div>
				<label>
					<span>Last Name:</span>
					<span>
						<input type="text" name="last_name" id="last_name"></input>
					</span>
				</label>
				<label>
					<span>First Name:</span>
					<span>
						<input type="text" name="first_name" id="first_name"></input>
					</span>
				</label>
			</div>
			<div>
				<label>
					<span>Full Name:</span>
					<span>
						<input type="text" name="full_name" id="full_name"></input>
					</span>
				</label>
				<label>
					<span>Birth Place:</span>
					<span>
						<input type="text" name="birth_place" id="birth_place"></input>
					</span>
				</label>
			</div>
			<div>
				<label>
					<span>Gender:</span>
					<span>
						<select name="gender" id="gender">
							<option value="M">M</option>
							<option value="F">F</option>
						</select>
					</span>
				</label>
				<label>
					<span>Nationalify:</span>
					<span>
						<select name="nationalify" id="nationalify">
						<option></option>
						</select>
					</span>
				</label>
			</div>
			
			<div>
				<label>
					<span>Email:</span>
					<span>
						<input type="text"  name="email" id="email"></input>
					</span>
				</label>
				<label>
					<span>Phone:</span>
					<span>
						<input type="text"  name="phone" id="phone"></input>
					</span>
				</label>
			</div>
			<div>
				<label>
					<span>Date Of Birth:</span>
					<span>
						<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'dd/MM/yyyy',lang:'en'})" name="birth" id="birth"></input>
					</span>
				</label>
				<label>
					<span>Passport No.:</span>
					<span>
						<input type="text" name="passport" id="passport"></input>
					</span>
				</label>
			</div>
			<div>
				<label>
					<span>Date Of Issue:</span>
					<span>
						<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'dd/MM/yyyy',lang:'en',maxDate:'#F{$dp.$D(\'expiry\')}'})" name="issue" id="issue"></input>
					</span>
				</label>
				<label>
					<span>Date Of Expiry:</span>
					<span>
						<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'dd/MM/yyyy',lang:'en',minDate:'#F{$dp.$D(\'issue\')}',startDate:'#F{$dp.$D(\'issue\',{d:+1})}'})" name="expiry" id="expiry"></input>
					</span>
				</label>
			</div>
			
			<div class="btnBox2">
				<input type="button" value="SUBMIT" class="btn1"></input>
				<input type="button" value="CANCEL" class="btn2"></input>
			</div>
		</div>
		</form>
	</div>
	<div class="popups prompt">
		<h3>Prompt<a href="#" class="r close">&#10006;</a></h3>
		<div class="pBox">
			<p>xxx</p>
			<p class="btnBox">
				<input type="button" value="YES" class="btn1"></input>
				<input type="button" value="NO" class="btn2"></input>
			</p>
		</div>
	</div>
	<!-- popups end -->
</div>
<!-- main content end -->

<script type="text/javascript">
window.onload = function(){

	$(document).on('click','#addPopups .btnBox2 input.btn1',function(){
		var last_name = $("#addPopups input[name='last_name']").val();
		var first_name = $("#addPopups input[name='first_name']").val();
		var gender = $("#addPopups select[name='gender']").val();
		var nationalify = $("#addPopups input[name='nationalify']").val();
		var birth = $("#addPopups input[name='birth']").val();
		var passport = $("#addPopups input[name='passport']").val();
		var issue = $("#addPopups input[name='issue']").val();
		var expiry = $("#addPopups input[name='expiry']").val();

		var where_data = "last_name="+last_name+"&first_name="+first_name+"&gender="+gender+"&nationalify="+nationalify; 
		where_data += '&birth='+birth+'&passport='+passport+'&issue='+issue+'&expiry='+expiry;
    	$.ajax({
            url:"<?php echo Url::toRoute(['add_uest_info_save']);?>",
            type:'post',
            data:where_data,
         	dataType:'json',
        	success:function(data){
            	var str = '';
        		if(data != 0){
	                $.each(data,function(key){
						
                    	str += "<tr>";
                        str += "<td>"+data[key]['voyage_code']+"</td>";
                        str += "<td>"+data[key]['ticket_price']+"</td>";
                        str += "<td>"+data[key]['start_time']+"</td>";
                        str += "<td>"+data[key]['end_time']+"</td>";
                        str += "<td>"+data[key]['voyage_name']+"</td>";
                        str += "<td><a href='<?php echo Url::toRoute(['input_mode'])?>&code="+data[key]['voyage_code']+"'><button  class='btn1'><img src='<?=$baseUrl ?>images/right.png'></button></td>";
                        str += "</tr>";
                      });
	                $("table#booking_ticke_table > tbody").html(str);
	            }
        	}      
        });
		
	});



	$("#mainContent_content .btnBox1 input#add").click(function(){
		$.ajax({
            url:"<?php echo Url::toRoute(['get_country_data']);?>",
            type:'post',
         	dataType:'json',
        	success:function(data){
            	var str = '';
        		if(data != 0){
	                $.each(data,function(key){
						
                        str += "<td>"+data[key]['voyage_code']+"</td>";
                        str += "<td>"+data[key]['ticket_price']+"</td>";
                        str += "<td>"+data[key]['start_time']+"</td>";
                        str += "<td>"+data[key]['end_time']+"</td>";
                        str += "<td>"+data[key]['voyage_name']+"</td>";
                        str += "<td><a href='<?php echo Url::toRoute(['input_mode'])?>&code="+data[key]['voyage_code']+"'><button  class='btn1'><img src='<?=$baseUrl ?>images/right.png'></button></td>";
                        str += "</tr>";
                      });
	                $("table#booking_ticke_table > tbody").html(str);
	            }
        	}      
        });
	});
	
}
</script>


