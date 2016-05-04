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
	
	.pagination{display:inline-flex;}

</style>

<!-- content start -->
<div class="r content">
<div class="topNav">Voyage Manage&nbsp;&gt;&gt;&nbsp;
    <a href="<?php echo Url::toRoute(['index']);?>">Voyage Set</a>&nbsp;&gt;&gt;&nbsp;
    <a href="#">Voyage_set_edit</a></div>
	<div class="tab">
		<ul class="tab_title">
			<li class="active">Voyage</li>
			<li>Voyage Port</li>
			<li>Active</li>
			<li>Voyage Map</li>
			<li>Cabin</li>
			<li>Return route</li>
		</ul>
		<div class="tab_content">
			<div class="active">
				<!-- voyage start -->
				<div class="write">
				<?php
					$form = ActiveForm::begin([
						'action' => ['voyage_edit'],
						'method'=>'post',
						'id'=>'voyage_edit',
						'options' => ['class' => 'voyage_edit'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
				<input type="hidden" id="voyage_code" name="voyage_code" value="<?php echo $voyage['voyage_code'] ?>"></input>
				<input type="hidden" id="voyage_id" name="voyage_id" value="<?php echo $voyage['id']?>"></input>
					<div>
						<p>
							<label>
								<span>Voyage Name:</span>
								<input type="text" id="voyage_name" name="voyage_name" value="<?php echo $voyage['voyage_name']?>" required></input>
							</label>
							<label>
								<span>Voyage Num:</span>
								<input type="text" id="voyage_num" name="voyage_num" value="<?php echo $voyage['voyage_num']?>" required></input>
							</label>
						</p>
						<p>
							<label class="shortLabel">
								<span>Area:</span>
								<select name="area" id="area">
									<?php foreach ($area as $row ){?>
									<option <?php echo $row['area_code']==$voyage['area_code']?"selected='selected'":'' ?>  value="<?php echo $row['area_code'];?>"><?php echo $row['area_name']?></option>
									<?php } ?>
								</select>
							</label>
							<label>
								<span>Cruise:</span>
								<select id="cruise" name="cruise">
								<?php foreach($cruise as $row) {?>
									<option <?php echo $row['cruise_code']==$voyage['cruise_code']?"selected='selected'":'' ?> value="<?php echo $row['cruise_code']?>"><?php echo $row['cruise_name']?></option>
								<?php } ?>
								</select>
							</label>
						</p>
						<p>
							<label >
								<span>Scheduling :</span>
							</label>
							<label class="uploadFileBox">
								<span class="fileName">Pick Up PDF...</span>
								<a href="#" class="uploadFile">choose<input type="file" name="pdf" id="pdf"></input></a>
							</label>
						</p>
						<p>
							<label>
								<span>Start Time:</span>
								<input type="text" id="s_time" name="s_time" placeholder="please choose" value="<?php echo $voyage['start_time']?>" readonly onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"  ></input>
							</label>
							<label>
								<span>End Time:</span>
								<input type="text" id="e_time" name="e_time" placeholder="please choose" value="<?php echo $voyage['end_time']?>" readonly onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"  ></input>
							</label>
						</p>
						<p>
							<label >
								<span>Desc:</span>
								<textarea id="desc" name="desc"><?php echo $voyage['voyage_desc']?></textarea>
							</label>
						</p>
						
						<div class="price">
							<p>
								<label>
									<span>Start booking time:</span>
									<input type="text" id="s_book_time" name="s_book_time" placeholder="please choose" value="<?php echo $voyage['start_book_time'] ?>" readonly onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate" ></input>
								</label>
								<label>
									<span>Stop booking time:</span>
									<input type="text" id="e_book_time" name="e_book_time" placeholder="please choose" value="<?php echo $voyage['stop_book_time'] ?>" readonly onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss ',lang:'en'})" class="Wdate"  ></input>
								</label>
							</p>
							<p>
								<label>
									<span>Ticket Price:</span>
									<input type="text" id="ticket_price"  onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="ticket_price" value="<?php echo $voyage['ticket_price']?>" required></input>
								</label>
								<label>
									<span>Ticket Taxes:</span>
									<input type="text" id="ticket_taxes"  onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="ticket_taxes" value="<?php echo $voyage['ticket_taxes']?>" min="0" max="100" required></input>
								</label>
							</p>
							<p>
								<label>
									<span>Harbour Taxes:</span>
									<input type="text" id="harbour_taxes" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"  name="harbour_taxes" value="<?php echo $voyage['harbour_taxes']?>"min="0" max="100" required></input>
								</label>
								<label>
									<span>Deposit ratio:</span>
									<input type="text" id="deposit_ratio" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" name="deposit_ratio" value="<?php echo $voyage['deposit_ratio']?>" min="0" max="100" required></input>
								</label>
							</p>
						</div>
					</div>
					<div class="btn">
						<input type="submit" value="SAVE"></input>
						<input class="cancle" type="button" value="CANCLE" ></input>
					</div>
				</div>
				<?php 
					ActiveForm::end(); 
				?>
				<!-- voyage end -->
			</div>
			<div>
				<!-- voyage port start -->
				<?php
					$form = ActiveForm::begin([
						'action' => ['voyage_edit_delete'],
						'method'=>'post',
						'id'=>'voyage_edit_delete',
						'options' => ['class' => 'voyage_edit_delete'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
				<input type="hidden" id="voyage_port_page" value="<?php echo $voyage_port_page;?>" />
				<input type="hidden" id="voyage_id" name="voyage_id" value="<?php echo $voyage['id'] ?>"></input>
				<table id="voyage_port_table">
					<thead>
						<tr>
							<th><input type="checkbox"></input></th>
							<th>No.</th>
							<th>Port Name</th>
							<th>Arrival Time</th>
							<th>Departure Time</th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($voyage_port as $key=>$row):?>
						<tr>
							<td><input type="checkbox" name="ids[]" value="<?php echo $row['id']?>"></input></td>
							<td><?php echo $row['order_no']?></td>
							<td><?php foreach($port as $port_row ){ if($row['port_code'] == $port_row['port_code']){echo $port_row['port_name'] ;}} ?></td>
							<td><?php echo $row['EIA']==''?' - - ':$row['EIA']?></td>
							<td><?php echo $row['ETD']==''?' - - ':$row['ETD']?></td>
							<td>
								<a href="<?php echo Url::toRoute(['voyage_port_edit'])."&voyage_id=".$voyage['id']."&port_id=".$row['id'];?>"><img src="<?=$baseUrl ?>images/write.png"></a>
								<a class="delete" id="<?php echo $row['id'];?>" ><img src="<?=$baseUrl ?>images/delete.png"></a>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<?php 
					ActiveForm::end();
				?>
				<p class="records">Records:<span><?php echo $count ?></span></p>
		        <div class="btn">
		            <a href="<?php echo Url::toRoute(['voyage_port_add']).'&voyage_id='.$voyage['id'];?>"><input type="button" value="Add"></input></a>
		            <input id="del_submit" type="button" value="Del Selected"></input>
		        </div>
		        <!-- 分页 -->
        		<div class="center" id="voyage_port_page_div"> </div>
				<!-- voyage port end -->
			</div>
			<div>
			<?php
					$form = ActiveForm::begin([
						'action' => ['voyage_active'],
						'method'=>'get',
						'id'=>'voyage_active',
						'options' => ['class' => 'voyage_active','enctype'=>'multipart/form-data'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
				<input type="hidden" name="voyage_active_id" value="<?php echo $voyage['id']?>" />
				<!-- active start -->
				<p>
					<label>
						<span>Curr Active:</span>
						<span style="color:red"><?php echo $curr_active_result['name']?></span>
					</label>
				</p>
				<p>
					<label>
						<span>Active Type:</span>
						<select name="voyage_active">
						<?php foreach ($active_result as $k=>$v){?>
							<option value="<?php echo $v['active_id']?>"><?php echo $v['name']?></option>
						<?php }?>
						</select>
					</label>
				</p>
				<div class="btn">
					<input type="submit" value="Save"  ></input>
				</div>
				<?php 
					ActiveForm::end();
				?>
				<!-- active end -->
			</div>
			<div id="map">
			<?php
					$form = ActiveForm::begin([
						'action' => ['voyage_map'],
						'method'=>'post',
						'id'=>'voyage_map',
						'options' => ['class' => 'voyage_map','enctype'=>'multipart/form-data'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
				<!-- voyage map start -->
				<div>
				<input type="hidden" name="voyage_map_id" value="<?php echo $voyage['id']?>" />
				<input type="hidden" name="map_id" value="<?php echo $map_result['map_id'];?>" />
					<img id="ImgPr" src="<?php echo $baseUrl.'upload/'.$map_result['map_img'] ?>">
					<input id="photoimg" name="photoimg" type="file"></input>
					<div class="btn">
						<input type="submit" value="Upload"></input>
					</div>
				</div>
				<?php 
					ActiveForm::end();
				?>
				<!-- voyage map end -->
			</div>
			<div>
				<form id="voyage_cabin_form">
				<!-- cabin start -->
				<div class="search">
				<input type="hidden" name="cabin_voyage_id" value="<?php echo $voyage['id']?>" />
					<label>
						<span>Type:</span>
						<select name="cabin_type_id">
						<?php foreach ($cabin_type_result as $k=>$v){?>
							<option value="<?php echo $v['id']?>"><?php echo $v['type_name']?></option>
						<?php }?>
						</select>
					</label>
					<label>
						<span>Deck:</span>
						<select name="cabin_deck">
						<?php for ($i=1; $i<=$cruise_result['deck_number']; $i++){?>
							<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php }?>
						</select>
					</label>
				</div>
				
				<div class="searchResult selectBox" style="margin-top:20px;">
				
					<div class="l selectList">
						<ul >
							<li><span><input type="checkbox"></span></input><span>未选</span></li>
						</ul>
						<ul  id="cabin_left_ul">
						<?php 
						$really_arr = array();
						foreach ($really_cabin_result as $k=>$v){
							$really_arr[$k] = $v['cabin_lib_id'];
 						}?>
						<?php foreach ($cabin_result as $k=>$v){?>
						<?php if(!in_array($v['id'], $really_arr)){?>
							<li><span><input type="checkbox"  value="<?php echo $v['id'];?>"></span><span class="text"><?php echo $v['cabin_name'];?></span></li>
						<?php }}?>
						</ul>
					</div>
					<div class="btn l">
						<input id="cabin_right_but" type="button" value=" >> "></input>
						<input id="cabin_left_but" type="button" value=" << "></input>
					</div>
					<div class="l selectList">
					
						<ul>
							<li><span><input type="checkbox"></span></input><span>已选</span></li>
						</ul>
						<ul id="cabin_right_ul">
						<?php foreach ($really_cabin_result as $k=>$v){?>
							<li><span><input type="checkbox" name="cabin_right_ids[]" value="<?php echo $v['cabin_lib_id']?>" ></span><span class="text"><?php echo $v['cabin_name']?></span></li>
						<?php }?>
						</ul>
					</div>
				</div>
				<div class="btn">
					<input id="voyage_cabin_save_but" type="button" value="Save" style=" float: left; margin-left: 20%;"></input>
				</div>
			</form>	
				<!-- cabin end -->
			</div>
			<div>
			<?php
					$form = ActiveForm::begin([
						'action' => ['return_voyage'],
						'method'=>'get',
						'id'=>'return_voyage',
						'options' => ['class' => 'return_voyage'],
						'enableClientValidation'=>false,
						'enableClientScript'=>false
					]); 
				?>
				<!-- Return route start -->
				<input type="hidden" name="return_voyage_id" value="<?php echo $voyage['id']?>" />
				<p>
					<label>
						<span>Curr Route:</span>
						<span style="color:red"><?php echo $curr_return_voyage_result['voyage_name']?></span>
					</label>
				</p>
				<p>
					<label>
						<span>Return Route:</span>
						<select name="return_voyage">
						<?php foreach ($voyage_return as $k=>$v){?>
							<option value="<?php echo $v['id']?>"><?php echo $v['voyage_name']?></option>
						<?php }?>
						</select>
					</label>
				</p>
				
				<div class="btn">
					<input type="submit" value="Save" ></input>
				</div>
				<?php 
					ActiveForm::end();
				?>
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
	
	//船舱保存
	$("#voyage_cabin_form #voyage_cabin_save_but").on('click',function(){
			var cabin_type_id = $("#voyage_cabin_form select[name='cabin_type_id']").val();
			var cabin_deck = $("#voyage_cabin_form select[name='cabin_deck']").val();
			var voyage_id = $("#voyage_cabin_form input[name='cabin_voyage_id']").val();
			var cabin_lib_id = '';
			$("#voyage_cabin_form ul#cabin_right_ul").find("input[type='checkbox']").each(function(e){
				var id = $(this).val();
				cabin_lib_id += id+',';
			});

			if(cabin_lib_id==''){alert("No selected items!");return false;}

			$.ajax({
		        url:"<?php echo Url::toRoute(['voyage_cabin_save']);?>",
		        type:'get',
		        async:false,
		        data:'cabin_type_id='+cabin_type_id+'&cabin_deck='+cabin_deck+'&voyage_id='+voyage_id+'&cabin_lib_id='+cabin_lib_id,
		     	dataType:'json',
		    	success:function(data){
		    		if(data!=0){
		    			alert("Save success");
		    		}else{
		    			alert("Save failed");
		    		}
		    	}      
		    });
		
	});


	//航线-》船舱船舱类型改变
	$("#voyage_cabin_form select[name='cabin_type_id'],#voyage_cabin_form select[name='cabin_deck']").on('change',function(){
		var type_id = $("#voyage_cabin_form select[name='cabin_type_id']").val();
		var deck = $("#voyage_cabin_form select[name='cabin_deck']").val();
		//alert(type_id+'----'+deck);
		$.ajax({
	        url:"<?php echo Url::toRoute(['voyage_cabin_change_type_get_cabin_lib']);?>",
	        type:'get',
	        async:false,
	        data:'type_id='+type_id+'&deck='+deck,
	     	dataType:'json',
	    	success:function(data){
	    		if(data!=0){
	    			var cabin_lib_result = data['cabin_lib'];
	    			var really_result = data['really'];
					var str = '';
					var really_arr = new Array();
	    			$.each(really_result,function(k){
	    				str += '<li><span><input value="'+really_result[k]['cabin_lib_id']+'" name="cabin_right_ids[]" type="checkbox"></span><span class="text">'+really_result[k]['cabin_name']+'</span></li>';
	    				really_arr.push(really_result[k]['cabin_lib_id']);
	    			});
	    			$("#cabin_right_ul").html(str);
	    			var l_str = '';
	    			$.each(cabin_lib_result,function(k){
		    			if($.inArray(cabin_lib_result[k]['id'],really_arr)==-1){
	    					l_str += '<li><span><input value="'+cabin_lib_result[k]['id']+'" type="checkbox"></span><span class="text">'+cabin_lib_result[k]['cabin_name']+'</span></li>';
		    			}
	    			});
	    			$("#cabin_left_ul").html(l_str);
	    		}else{
	    			
	    		}
	    	}      
	    });
		
	});

	//delete删除确定but
   $(document).on('click',"#promptBox > .btn .confirm_but",function(){
	   var val = $(this).attr('id');
	   location.href="<?php echo Url::toRoute(['voyage_edit_delete']);?>"+"&id="+val+"&voyage_id="+"<?php echo $voyage['id']?>";
   });

 	//delete删除确定but
   $(document).on('click',"#promptBox > .btn .confirm_but_more",function(){
	   $("form#voyage_edit_delete").submit();
   });


	<?php $voyage_port_total = (int)ceil($count/2);
		if($voyage_port_total >1){
	?>
	$('#voyage_port_page_div').jqPaginator({
	    totalPages: <?php echo $voyage_port_total;?>,
	    visiblePages: 5,
	    currentPage: 1,
	    wrapper:'<ul class="pagination"></ul>',
	    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
	    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
	    onPageChange: function (num, type) {
	    	var this_page = $("input#voyage_port_page").val();
	    	if(this_page==num){$("input#voyage_port_page").val('fail');return false;}
	    	
	    	$.ajax({
                url:"<?php echo Url::toRoute(['get_voyage_port_page']);?>",
                type:'get',
                data:'pag='+num+"&voyage_id="+<?php echo $voyage['id']?>,
             	dataType:'json',
            	success:function(data){
                	var str = '';
            		if(data != 0){
    	                $.each(data,function(key){
                        	str += "<tr>";
                            str += "<td><input name='ids[]' type='checkbox' value='"+data[key]['id']+"'></input></td>";
                            str += "<td>"+data[key]['order_no']+"</td>";
                            str += "<td>"+data[key]['port_name']+"</td>";
                            if(data[key]['EIA']==null){var eia='- -';}else{var eia=data[key]['EIA'];}
                            if(data[key]['ETD']==null){var etd='- -';}else{var etd=data[key]['ETD'];}
                            str += "<td>"+eia+"</td>";
                            str += "<td>"+etd+"</td>";
                            str += "<td  class='op_btn'>";
                            str += "<a href='<?php echo Url::toRoute(['voyage_port_edit']);?>&voyage_id="+<?php echo $voyage['id']?>+"&port_id="+data[key]['id']+"'><img src='<?=$baseUrl ?>images/write.png'></a>";
                            str += "<a class='delete' id='"+data[key]['id']+"'><img src='<?=$baseUrl ?>images/delete.png'></a>";
	                        str += "</td>";
                            str += "</tr>";
                          });
    	                $("table#voyage_port_table > tbody").html(str);
    	            }
            	}      
            });
    	}
	});
<?php }?>

}
</script>