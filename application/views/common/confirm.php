  
    <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/confirm.css">
   <div class="tc-dwbox" id="confirm_tc" style="display:none;">
      <div class="tck-box" >
    <div class="tck-tit"><a  onfocus="this.blur()" onclick="close_tc()"><img src="<?=$cdn?>/style/dist/img/c-r-pic50.jpg" width="20" height="20" /></a><span id="tc_title">确认框</span></div>
    <div class="tck-con tck-con-borstyle" ><p id="tc_content"></p>
    <div class="tck-butbox"><input class="tck-but-style-a" type="button" id="cof" value="确定" onfocus="this.blur()"/><input class="tck-but-style-b" type="button" id="cel" value="取消" onclick="close_tc()" onfocus="this.blur()"/></div>     
    </div>
    
  </div>
</div>



  <div class="tc-dwbox" id="tooltip" style="display:none;"> 
  <div class="tck-box">
	<div class="tck-tit"><a  onfocus="this.blur()" onclick="close_tt()" ><img src="<?=$cdn?>/style/dist/img/c-r-pic50.jpg" width="20" height="20" /></a><span>提示框</span></div> 
    <div class="tck-con tck-con-borstyle">

    <p id="content_tt"> </p>
      <div class="tck-butbox"><input  type="hidden" id="refresh" value="0"  /><input class="tck-but-style-a" type="button" value="确定"  onfocus="this.blur()" onclick="close_tt()" /></div>     
  </div>
    
  </div>
  </div>

<script>
function close_tc(){
	$('#confirm_tc').hide();
}
function close_tt(){
	var refresh=$("#refresh").val();
	$('#tooltip').hide();
	if(refresh==1){
		 location.reload();
	}
}
</script>
 <script>

function page_scroll()
{
    document.getElementById('confirm_tc').style.top = parseInt(g_myBodyInstance.scrollTop) + "px";
	document.getElementById('tooltip').style.top = parseInt(g_myBodyInstance.scrollTop) + "px";
}
g_myBodyInstance = (document.documentElement ? document.documentElement : window);
g_myBodyInstance.onscroll = page_scroll;
</script>