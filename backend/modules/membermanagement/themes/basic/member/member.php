<style type="text/css">
	
a{
	text-decoration: none;
}

</style>



<?php
$this->title = 'Membership';
use app\modules\membermanagement\themes\basic\myasset\ThemeAsset;
ThemeAsset::register($this);
$baseUrl = $this->assetBundles[ThemeAsset::className()]->baseUrl . '/';
use yii\helpers\Url;

//$assets = '@app/modules/membermanagement/themes/basic/static';
//$baseUrl = Yii::$app->assetManager->publish($assets);

?>


 <script type="text/javascript" src="<?php echo $baseUrl;?>js/jqPaginator.js"></script>
 
 
   




	
<!-- content start -->
<form id="member_list" method="post">
<div id="country"   style="display: none;"  ><?php echo $Searchdata ['country_code']?></div>
<div class="r content" id="issueTicket_info" style="float: left;">
			<div class="topNav">Route Manage&nbsp;&gt;&gt;&nbsp;<a href="#">Scenic Route</a></div>

      <div class="search">
        <label>
          <span>Member Code :</span>
          <input type="text" name="m_code" value="<?php echo $Searchdata ['m_code']?>">
        </label>
        <label>
            <span>Country</span>
              <select name="country_code" id="country_code">
              <option></option>
                <?php  

                            foreach ($country as $row) {

              ?>

              <!-- 国家编号 -->

              <!-- 国家名字 -->
                <option value="<?php echo $row['country_code']; ?>"><?php echo $row['country_name']; ?></option>
              <?php
                   }
                   ?>
              </select>
        </label>
        <label>
          <span>Name :</span>
          <input type="text" name="m_name" value="<?php echo $Searchdata ['m_name']?>">
        </label>
        <span class="btn"><input value="SEARCH" type="submit"></span>
      </div>
   <div class="table-responsive">
    
        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th> <input class="ace" id="checkALL" type="checkbox">
                    </th>
                    <th><?= \Yii::t('app', 'NO') ?></th>
                    <th><?= \Yii::t('app', 'Member Code') ?></th>
                    <th><?= \Yii::t('app', 'Name') ?></th>
                    <th><?= \Yii::t('app', 'Gender') ?></th>
                    <th><?= \Yii::t('app', 'Country Name') ?></th>
                    <th><?= \Yii::t('app', 'Passport Number') ?></th>
                    <th><?= \Yii::t('app', 'point') ?></th>
                    <td><?= \Yii::t('app', 'operation') ?></td>
                    
                </tr>
            </thead>
            <tbody>
            
            
            <?php 
            $i=0;
            foreach ($member as $key => $value) {
            	$i++;
            
            
            
            ?>
		
				<tr>
                    <td> <input class="checkbox_button" name="ids[]" value="<?php echo $value['m_id']?>" type="checkbox"> 
                    </td>
                    <td><?php echo $i?></td>
                    <td><?php echo $value['m_code']?></td>
                    <td><?php echo $value['m_name']?></td>
                    <td><?php echo $value['gender']?></td>
                    <td><?php echo $value['country_name']?></td>
                    <td><?php echo $value['passport_number']?></td>
                    <td><?php echo $value['points']?></td>
                 
                   
                    <td>

                    <div>

                     <a href="<?= Url::to(['member/member_read']);?>&id=<?php echo $value['m_id']?>"title="edit"> <img src="<?php echo  $baseUrl; ?>images/text.png"></a>
                    <a href="<?= Url::to(['member/member_edit']);?>&id=<?php echo $value['m_id']?>"title="edit"> <img src="<?php echo  $baseUrl; ?>images/write.png"></a>
                    
                    <a class="delete" id="<?php echo $value['m_id']?>"   title="delete" style="text-align: center;cursor:pointer;"> <img src="<?php echo  $baseUrl; ?>images/delete.png"></a>
                   
                        
             
                     </div>
                       
                    </td>
                </tr>
                
                <?php 
                
                
				}
				?>

			
				

			</tbody>
        </table>
             <div class="pageNum" style="margin-left:40%">
 	<input type='hidden' name='page' value="<?php echo $page?>">
                 	<input type='hidden' name='isPage' value="1">
                 	<div class="center" id="page_div"></div> 
            	</div>
    
   


     <div style="text-align: center; margin-top: 100px;">


           <input type="button" value="Del Selected"  id="Batch_delete" style="width: 100px;text-align: center;cursor:pointer; background-color: #ffb752;   padding: 10px;
    color: #fff;
    border: none;">
				  <input type="button" value="Add" id="member_add" style="width: 80px;text-align: center;cursor:pointer;background-color: #556fb5;    padding: 10px;
    color: #fff;    border: none;">

              
					
	
    </div>
</div>
	</div>
	</form>
<!-- content end -->


<script type="text/javascript">
jQuery(function($) {
	/* 获取参数 */
	//分页
	var page = <?php echo $page;?>;
	$('#page_div').jqPaginator({
	            totalPages: <?php echo $count;?>,
	            visiblePages: 5,
	            currentPage: page,
	         
	            first:  '<a href="javascript:void(0);">First</a>',
	            prev:   '<a href="javascript:void(0);">«</a>',
	            next:   '<a href="javascript:void(0);">»</a>',
	            last:   '<a href="javascript:void(0);">Last</a>',
	            page:   '<a href="javascript:void(0);">{{page}}</a>',
	            onPageChange: function (num) {
	                var val = $("input[name='page']").val();
	                if(num != val)
	                {
	                    $("input[name='page']").val(num);
	                    $("input[name='isPage']").val(2);
	                    $("form#member_list").submit();
	                }
	            }
	        });	

	});
window.onload=function () {



           $("#country_code option").each(function()
           {

              if ($.trim($(this).val())==$.trim($('#country').text())) {
                 $(this).prop('selected', 'selected');

              }
          });




	$('.delete').click(function(event) {

		var $a = $.trim($(this).attr("id"));
		            
        	       if(confirm("Sure to delete? Record cannot be recovered after deletion"))

        	      {




        	      	var url="<?= Url::to(['member/index']);?>"+'&id='+$a;
        	      	
                   location.href=url;

                 
  
                  return false;



        	      	

         		    
         		  }
         		  else{

      		   
         		  }


	});
	$('#checkALL').click(function(event) {


		if ($(this).prop('checked')==true) 
		{

			$('.checkbox_button').prop('checked', true);
		}
		else {
			$('.checkbox_button').prop('checked', false);
			
		}
		
	});



	//批量删除

	 $( "#Batch_delete" ).on('click', function(e) {
        var ischeckbox=false;
        $(".checkbox_button").each(function(){
          if($(this).prop('checked')==true)
          {
              ischeckbox=true;
          }
        });

        if(ischeckbox==false)
        {
            alert("Please select Delete item");
        	
        }


        if(ischeckbox==true)
        {

        	 if(confirm("Sure to delete? Record cannot be recovered after deletion"))

        	      {

        	      	var url="<?= Url::to(['member/index']);?>";
        	      	$('form').attr('action', url);
        	      	$('form').submit();


         		    
         		  }
         		  else{

      		   
         		  }


        }



    });


   $('#member_add').click(function(event) {


	var url="<?= Url::to(['member/add_member']);?>";	
    location.href=url;
    return false;
   


        
    
   });




	
}
	

</script>





	
		

