   <div class="tc-dwbox" id="confirm_tc_page" style="display:none;">
      <div class="tck-box" >
    <div class="tck-tit"><a  onfocus="this.blur()" onclick="close_tc_page()"><img src="/gm/skin/img/c-r-pic50.jpg" width="20" height="20" /></a><span id="tc_title_page">确认框</span></div>
    <div class="tck-con tck-con-borstyle" ><p id="tc_content_page"></p>
    <div class="tck-butbox"><input class="tck-but-style-a" type="button" id="cof_page" value="确定" onfocus="this.blur()"/><input class="tck-but-style-b" type="button" id="cel_page" value="取消" onclick="close_tc_page()" onfocus="this.blur()"/></div>     
    </div>
    
  </div>
</div>



  <div class="tc-dwbox" id="tooltip_page" style="display:none;"> 
  <div class="tck-box">
	<div class="tck-tit"><a  onfocus="this.blur()" onclick="close_tt_page()" ><img src="/gm/skin/img/c-r-pic50.jpg" width="20" height="20" /></a><span>提示框page</span></div> 
    <div class="tck-con tck-con-borstyle">

    <p id="content_tt_page"> </p>
      <div class="tck-butbox"><input  type="hidden" id="refresh_page" value="0"  /><input class="tck-but-style-a" type="button" value="确定"  onfocus="this.blur()" onclick="close_tt_page()" /></div>     
  </div>
    
  </div>
  </div>

<script>
function close_tc_page(){
	$('#confirm_tc_page').hide();
}
function close_tt_page(){
	var refresh_page=$("#refresh_page").val();
	$('#tooltip_page').hide();
	if(refresh_page==1){
		 location.reload();
	}
}
</script>
 <script>

function page_scroll_page()
{
    document.getElementById('confirm_tc_page').style.top = parseInt(g_myBodyInstance.scrollTop) + "px";
	document.getElementById('tooltip_page').style.top = parseInt(g_myBodyInstance.scrollTop) + "px";
}
g_myBodyInstance_page = (document.documentElement ? document.documentElement : window);
g_myBodyInstance_page.onscroll = page_scroll_page;
</script>