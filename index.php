
<html>
<?php
// <link rel="stylesheet" type="text/css" href="mycss.css" >
// <div ><!--style="background:#000; color:#FFF" -->
// <marquee behavior="alternate"  width="98%" scrollamount="3" >
// <font size="2"  face="微软雅黑">
// 百度大工Baidut 做大工的搜索引擎，大工一搜，搜罗大工的每一个角落，我之大工，大工我知。欢迎测试，程序猿要复习考试了，暂不更新，祝大家考试顺利！
// </font>
// </marquee>
// </div>
?>

<title>百度大工-做大工的搜索引擎</title>

<style >
a:hover{
background:#0099ff;
color:black;
}
body {
    font-family: "Microsoft YaHei UI","Microsoft YaHei",SimSun,"Segoe UI",Tahoma,Helvetica,Sans-Serif,"Microsoft YaHei", Georgia,Helvetica,Arial,sans-serif,宋体, PMingLiU,serif;
    font-size: 10.5pt;
    line-height: 1.5;
}
</style >
<body>
<img src="title.gif"  height='120'/>
<div>
本站目的：提供最丰富有用的校内信息，并帮助同学们更好地管理校园生活。
<br/>
目前的功能：
大工校内搜索;
校内资源捕获（一般为一个月内的信息）；
<br/>
即将上线：
自动登陆门户，提取图书信息，玉兰卡消费信息；
教务处读取课表，考试信息。
<br/>
后期计划：
实验提醒，再也不用担心忘记实验了！
大工点评平台。
<br/>
现面向电信讲坛部成员内测，请勿传播。
如果有好的资源、需求或建议，请QQ联系你的部长。^_^
</div>
<hr/ >
<!--Baidu站内搜索开始-->
<form action="http://www.baidu.com/baidu" target="_blank">
<input type=text name=word>
<input type="submit" value="大工校内搜索">
<input name=tn type=hidden value="bds">
<input name=cl type=hidden value="3">
<input name=ct type=hidden value="2097152">
<input name=si type=hidden value="dlut.edu.cn">
</form>
<!--Baidu站内搜索结束-->

<?php
// $showtime=date("Y-m");//date("Y-m-d H:i:s");
$startDate=date("Y-m",strtotime("last month")); // 一周内的新闻 发现上个月则停止 最简单的方式 昨天的不一定有，需要比较
// $start_str_default = '<dl class="artile">';		//文章列表的开始标记
// $end_str_default = $startDate;//'<div id="pager">';	//文章列表的结束标记

// style
function Title_Disp($var){
	echo "<h1>".$var."</h1><hr/>";
}
function echoSources($title,$url,$start,$end) {
require_once 'getLinks.php';
Title_Disp($title);
showUrl($url,$start,$end);
}
echoSources("创新院比赛资讯","http://chuangxin.dlut.edu.cn/SecondPage_News.aspx?Type=6","末页",$startDate);//"http://chuangxin.dlut.edu.cn/SecondPage_News.aspx?Type=1"
echoSources("教务处重要信息","http://teach.dlut.edu.cn/o2.asp","英文",$startDate);
echoSources("团委活动要闻","http://tuanwei.dlut.edu.cn/list.php?classid=1","热门新闻",$startDate);
echoSources("图书馆消息","http://www.lib.dlut.edu.cn/","数据库分类导航",$startDate);
echoSources("校内网站集总","http://www.dlut.edu.cn/sub/xiaoneisite.shtml","首页",$startDate);
echoSources("科学技术研究院通知","http://scidep.dlut.edu.cn/list.php?classid=1","人文社科办公室",$startDate);
echoSources("研究生院通知","http://gs.dlut.edu.cn/showmoreinfo.asp","留言板","下一页");
/* bug未解决
// echoSources("讲座信息","http://tv.dlut.edu.cn/jiangtan/"," ",$startDate);
// echoSources("精彩瞬间","http://news.dlut.edu.cn/photo/star/"," ",$startDate);
Title_Disp("机关党委信息动态");
showUrl("http://jgdw.dlut.edu.cn/article/ShowClass.asp?ClassID=14"," ","下一页");
Title_Disp("人事处通知公告");
showUrl("http://perdep.dlut.edu.cn/NewsList.aspx?ClassID=2"," ","大连理工大学人事处");
*/
?>
没有了。。。如果你在校内发现了有用的信息，请将页面链接发给我^_^
</body>  
</html>