
<?php 

use yii\helpers\Html;
use yii\helpers\Url;

use travelagent\views\myasset\PublicAsset;
use travelagent\views\myasset\AgentinfoAsset;

PublicAsset::register($this);
AgentinfoAsset::register($this);
$baseUrl = $this->assetBundles[PublicAsset::className()]->baseUrl . '/';
?>

<!-- main content start -->
<div id="orderCenter" class="mainContent">
			<div id="topNav">
				Agent Ticketing
				<span>>></span>
				<a href="#">Order Center</a>
			</div>
			<div id="mainContent_content">
				<!-- 请用ajax提交 -->
				<div class="pBox search">
					<p>
						<label>
							<span>Name:</span>
							<span>
							<input type="text" name="full_name">
							</span>
						</label>
						<label>
							<span>PassportNum:</span>
							<input name="passport_num" type="text"></input>
						</label>
						<input type="button" value="SEARCH" class="btn1"></input>
					</p>
					
				</div>
				<div class="pBox">
					<table id="member_page_table">
						<thead>
							<tr>
								<th>No.</th>
								<th>Name</th>
								<th>Gender</th>
								<th>Birthday</th>
								<th>PassportNum</th>
								<th>DateExpire</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Operation</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($data as $k=>$v):?>
							<tr>
								<td><?php echo $k+1?></td>
								<td><?php echo $v['full_name']?></td>
								<td><?php echo $v['gender']?></td>
								<td><?php echo $v['birthday']?></td>
								<td><?php echo $v['passport_num']?></td>
								<td><?php echo $v['date_expire']?></td>
								<td><?php echo $v['email']?></td>
								<td><?php echo $v['phone']?></td>
								<td>
								<button class="btn1"><img src="<?=$baseUrl ?>images/write.png"></button>
								<button class="btn2"><img src="<?=$baseUrl ?>images/delete.png"></button>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					<div id="member_page_div"></div>
				</div>
			</div>
		</div>
<!-- main content end -->
<script type="text/javascript">
window.onload = function(){ 
<?php $total = (int)ceil($count/2);
	if($total >1){
?>
	$('#member_page_div').jqPaginator({
	    totalPages: <?php echo $total;?>,
	    visiblePages: 5,
	    currentPage: 1,
	    wrapper:'<ul class="pagination"></ul>',
	    first: '<li class="first"><a href="javascript:void(0);">First</a></li>',
	    prev: '<li class="prev"><a href="javascript:void(0);">«</a></li>',
	    next: '<li class="next"><a href="javascript:void(0);">»</a></li>',
	    last: '<li class="last"><a href="javascript:void(0);">Last</a></li>',
	    page: '<li class="page"><a href="javascript:void(0);">{{page}}</a></li>',
	    onPageChange: function (num, type) {
	    	var this_page = $("input#pag").val();
	    	if(this_page==num){$("input#pag").val('fail');return false;}

	    	
	    	$.ajax({
                url:"<?php echo Url::toRoute(['get_booking_ticke_page']);?>",
                type:'get',
                data:'pag='+num,
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
                            str += "<td><button code='"+data[key]['voyage_code']+"' class='btn1'><img src='<?=$baseUrl ?>images/right.png'></button></td>";
                            str += "</tr>";
                          });
    	                $("table#member_page_table > tbody").html(str);
    	            }
            	}      
            });
    	
       	// $('#text').html('当前第' + num + '页');
    	}
	});
	<?php }?>




	
}
</script>
		