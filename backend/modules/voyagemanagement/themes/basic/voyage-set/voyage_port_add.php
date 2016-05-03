<?php
$this->title = 'Voyage Management';


use app\modules\voyagemanagement\themes\basic\myasset\ThemeAsset;
use app\modules\voyagemanagement\themes\basic\myasset\ThemeAssetDate;
ThemeAsset::register($this);
ThemeAssetDate::register($this);
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>
<style type="text/css">
	.write p { overflow: hidden; }
	.write label { width: 324px; }
	.write label:first-child { float: left; margin-left: 10%; }
	.write label + label { margin-right: -170px; }
	.write label span { width: 140px; }
	.shortLabel { margin-right: 84px; }
</style>

<!-- content start -->
<div class="r content">
<div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="#">Voyage Set</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Voyage_set_add</a></div>
	<div class="write">
	<?php
		$form = ActiveForm::begin([
			'action' => ['voyage_port_add'],
			'method'=>'post',
			'id'=>'voyage_port_add',
			'options' => ['class' => 'voyage_port_add'],
			'enableClientValidation'=>false,
			'enableClientScript'=>false
		]);
	?>
	<input type="hidden" id="voyage_id" name="voyage_id" value="<?php echo $voyage['id'];?>"></input>
		<div>
			<p>
				<label class="shortLabel">
					<span>Num:</span>
					<select id="order_no" name="order_no">
						<?php for($i=1;$i<=100;$i++){ ?>
                       		<option value="<?php echo $i;?>"><?php echo $i?></option>
                        <?php } ?>
					</select>
				</label>
			</p>
			<p>
				<label class="shortLabel">
					<span>Port:</span>
					<select id="port_code" name="port_code">
						<?php foreach($port as $row){?>
						<option id="<?php echo $row['port_code']?>" value="<?php echo $row['port_code'] ?>"><?php echo $row['port_name'] ;?> </option>
						<?php } ?>
					</select>
				</label>
				<label>
					<input type="checkbox" id="terminal" name="terminal" >Terminal</input> 
				</label>
			</p>
			<p>
				<label>
					<span>Arrival Time:</span>
					<input type="text" id="s_time" name="s_time" placeholder="please choose"  readonly></input>
				</label>
			</p>
			<p>
				<label>
					<span>Departure Time:</span>
					<input type="text" id="e_time" name="e_time" placeholder="please choose"  readonly></input>
				</label>
			</p>
		</div>
		<div class="btn">
			<input type="submit" value="SAVE"></input>
			<input type="button" value="CANCLE"></input>
		</div>
		<?php 
			ActiveForm::end(); 
		?>
	</div>
</div>
<!-- content end -->


<script type="text/javascript">
window.onload = function(){
	var start = {
	    dateCell: '#s_time',
	    format: 'YYYY-MM-DD hh:mm:ss',
	    minDate: '0000-00-00 00:00:00', //设定最小日期为当前日期
		festival:false,
		isinitVal:false,
	    maxDate: '2199-99-99 23:59:59', //最大日期
	    isTime: true,
	    choosefun: function(datas){
	         end.minDate = datas; //开始日选好后，重置结束日的最小日期
	    }
	};
	var end = {
	    dateCell: '#e_time',
	    format: 'YYYY-MM-DD hh:mm:ss',
	    minDate: '0000-00-00 00:00:00', //设定最小日期为当前日期
		festival:false,
		isinitVal:false,
	    maxDate: '2199-99-99 23:59:59', //最大日期
	    isTime: true,
	    choosefun: function(datas){
	         start.maxDate = datas; //将结束日的初始值设定为开始日的最大日期
	    }
	};
		jeDate(start);
		jeDate(end);

		var order_no = $("#order_no").val();
		if(order_no == 1){
			$("#terminal").attr("disabled",'disabled');
			$("#s_time").attr("disabled",'disabled');
		}else{
			$("#terminal").removeAttr('disabled');
			$("#s_time").removeAttr('disabled');
		}

		$("#order_no").on('change',function(){
			order_no = $(this).val();
			if(order_no == 1){
				$("#terminal").attr("disabled",'disabled');
				$("#s_time").attr("disabled",'disabled');
			}else{
				$("#terminal").removeAttr('disabled');
				$("#s_time").removeAttr('disabled');
			}
		});

		$("input#terminal").on('click',function(){
		if($(this).is(":checked")){
			$("#e_time").attr("disabled",'disabled');
		}else{
			$("#e_time").removeAttr('disabled');
		}
	});


	var order_no = $("#order_no").val();
	if(order_no == 1){
		$("#terminal").attr("disabled",'disabled');
		$("#s_time").attr("disabled",'disabled');
	}else{
		$("#terminal").removeAttr('disabled');
		$("#s_time").removeAttr('disabled');
	}

	$("#order_no").on('change',function(){
		order_no = $(this).val();
		if(order_no == 1){
			$("#terminal").removeAttr('checked');
			$("#terminal").attr("disabled",'disabled');
			$("#s_time").attr("disabled",'disabled');
			$("#s_time").val('');
			$("#e_time").removeAttr('disabled');
			$("#e_time").val('<?php echo date('Y-m-d H:i:s',time())?>');
		}else{
			$("#terminal").removeAttr('disabled');
			$("#s_time").removeAttr('disabled');
			$("#s_time").val('<?php echo date('Y-m-d H:i:s',time())?>');
		}
	});

	$("input#terminal").on('click',function(){
		if($(this).is(":checked")){
			$("#e_time").attr("disabled",'disabled');
			$("#s_time").removeAttr('disabled');
			$("#e_time").val('');
		}else{
			$("#e_time").removeAttr('disabled');
			$("#e_time").val('<?php echo date('Y-m-d H:i:s',time())?>');
		}
	});
	
	var e_time = $('#e_time').val();
	if(e_time ==''){
		$("#terminal").attr("checked",'checked');
		$("#e_time").attr("disabled",'disabled');
	}

}
</script>