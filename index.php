
<html>
<?php
// <link rel="stylesheet" type="text/css" href="mycss.css" >
// <div ><!--style="background:#000; color:#FFF" -->
// <marquee behavior="alternate"  width="98%" scrollamount="3" >
// <font size="2"  face="΢���ź�">
// �ٶȴ�Baidut ���󹤵��������棬��һ�ѣ����޴󹤵�ÿһ�����䣬��֮�󹤣�����֪����ӭ���ԣ�����ԳҪ��ϰ�����ˣ��ݲ����£�ף��ҿ���˳����
// </font>
// </marquee>
// </div>
?>

<title>�ٶȴ�-���󹤵���������</title>

<style >
a:hover{
background:#0099ff;
color:black;
}
body {
    font-family: "Microsoft YaHei UI","Microsoft YaHei",SimSun,"Segoe UI",Tahoma,Helvetica,Sans-Serif,"Microsoft YaHei", Georgia,Helvetica,Arial,sans-serif,����, PMingLiU,serif;
    font-size: 10.5pt;
    line-height: 1.5;
}
</style >
<body>
<img src="title.gif"  height='120'/>
<div>
��վĿ�ģ��ṩ��ḻ���õ�У����Ϣ��������ͬѧ�Ǹ��õع���У԰���
<br/>
Ŀǰ�Ĺ��ܣ�
��У������;
У����Դ����һ��Ϊһ�����ڵ���Ϣ����
<br/>
�������ߣ�
�Զ���½�Ż�����ȡͼ����Ϣ��������������Ϣ��
���񴦶�ȡ�α�������Ϣ��
<br/>
���ڼƻ���
ʵ�����ѣ���Ҳ���õ�������ʵ���ˣ�
�󹤵���ƽ̨��
<br/>
��������Ž�̳����Ա�ڲ⣬���𴫲���
����кõ���Դ��������飬��QQ��ϵ��Ĳ�����^_^
</div>
<hr/ >
<!--Baiduվ��������ʼ-->
<form action="http://www.baidu.com/baidu" target="_blank">
<input type=text name=word>
<input type="submit" value="��У������">
<input name=tn type=hidden value="bds">
<input name=cl type=hidden value="3">
<input name=ct type=hidden value="2097152">
<input name=si type=hidden value="dlut.edu.cn">
</form>
<!--Baiduվ����������-->

<?php
// $showtime=date("Y-m");//date("Y-m-d H:i:s");
$startDate=date("Y-m",strtotime("last month")); // һ���ڵ����� �����ϸ�����ֹͣ ��򵥵ķ�ʽ ����Ĳ�һ���У���Ҫ�Ƚ�
// $start_str_default = '<dl class="artile">';		//�����б�Ŀ�ʼ���
// $end_str_default = $startDate;//'<div id="pager">';	//�����б�Ľ������

// style
function Title_Disp($var){
	echo "<h1>".$var."</h1><hr/>";
}
function echoSources($title,$url,$start,$end) {
require_once 'getLinks.php';
Title_Disp($title);
showUrl($url,$start,$end);
}
echoSources("����Ժ������Ѷ","http://chuangxin.dlut.edu.cn/SecondPage_News.aspx?Type=6","ĩҳ",$startDate);//"http://chuangxin.dlut.edu.cn/SecondPage_News.aspx?Type=1"
echoSources("������Ҫ��Ϣ","http://teach.dlut.edu.cn/o2.asp","Ӣ��",$startDate);
echoSources("��ί�Ҫ��","http://tuanwei.dlut.edu.cn/list.php?classid=1","��������",$startDate);
echoSources("ͼ�����Ϣ","http://www.lib.dlut.edu.cn/","���ݿ���ർ��",$startDate);
echoSources("У����վ����","http://www.dlut.edu.cn/sub/xiaoneisite.shtml","��ҳ",$startDate);
echoSources("��ѧ�����о�Ժ֪ͨ","http://scidep.dlut.edu.cn/list.php?classid=1","������ư칫��",$startDate);
echoSources("�о���Ժ֪ͨ","http://gs.dlut.edu.cn/showmoreinfo.asp","���԰�","��һҳ");
/* bugδ���
// echoSources("������Ϣ","http://tv.dlut.edu.cn/jiangtan/"," ",$startDate);
// echoSources("����˲��","http://news.dlut.edu.cn/photo/star/"," ",$startDate);
Title_Disp("���ص�ί��Ϣ��̬");
showUrl("http://jgdw.dlut.edu.cn/article/ShowClass.asp?ClassID=14"," ","��һҳ");
Title_Disp("���´�֪ͨ����");
showUrl("http://perdep.dlut.edu.cn/NewsList.aspx?ClassID=2"," ","��������ѧ���´�");
*/
?>
û���ˡ������������У�ڷ��������õ���Ϣ���뽫ҳ�����ӷ�����^_^
</body>  
</html>