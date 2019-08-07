<?php
$cookieName = 'linkcounter';
$count = isset($_COOKIE[$cookieName]) ? (int)$_COOKIE[$cookieName] : 0;
$count++;
setcookie($cookieName, $count,time()+12*3600);

if($count<2){$siteurl="http://adf.ly/3666440/http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
header("Location:".$siteurl."");
die();
}else{$siteurl="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];}
?>
<center>
<iframe src="https://player.twitch.tv/?channel=ingyenfoci" frameborder="0" allowfullscreen="true" scrolling="no" height="378" width="620"></iframe><a href="https://www.twitch.tv/ingyenfoci?tt_content=text_link&tt_medium=live_embed" style="padding:2px 0px 4px; display:block; width:345px; font-weight:normal; font-size:10px; text-decoration:underline;">Nézd meg ingyenfoci élő videóját a www.twitch.tv weboldalon</a>
</center>
