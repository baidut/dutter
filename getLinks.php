<?php
function showUrl($sourceURL,$start_str='<dl class="artile">',$end_str='<div id="pager">' ){//要采集文章列表的网址 $start_str=$start_str_default提示错误 unexpected '$start_str_default' 不能用变量定义默认值

	// 代码修改自http://www.baidu3k.com/archives/588
	// ------------利用snoopy抓取网页内容------------------
	require_once 'Snoopy.php';
	$snoopy = new Snoopy();
	$snoopy->fetch($sourceURL);
	$fileContent = $snoopy->results;
	// ------------提取正文内容----------------------------
	$start_num = stripos($fileContent, $start_str)+strlen($start_str); //stripos() 函数返回字符串在另一个字符串中第一次出现的位置。未找到则返回 false。语法stripos(string,find[,start])
	$end_num = stripos($fileContent, $end_str)-$start_num;
	// ------------通过正则表达式提取正文内的链接----------
	$fileContent = substr($fileContent, $start_num, $end_num);
	$fileContent = strip_tags($fileContent, '<a>');
	$a = "/<a.*?href=[\"\'](.*?)[\"\'][^>]*>(.*?)<\/a>/i";
	preg_match_all($a, $fileContent, $content); //preg_match_all — 执行一个全局正则表达式匹配(PHP 4, PHP 5) 参数：正则表达式，源内容，目的数组

	foreach ($content[1] as $k=>$v){ //=>是数组成员访问符号
		$content[1][$k] = FillUrl($sourceURL, $v); //将数组内容交给fillurl处理补全网址
	}
	// ------------打印输出--------------------------------
	//print_r($content);

	foreach ($content[2] as $key=>$value) {
		echo " <a link href=\"".$content[1][$key]."\">".$content[2][$key]." ".$content[1][$key]." </a><br/>\n";
		//echo " <a link href=\"".$content[1][$key]."\">".$content[2][$key]."</a><br/>\n";
	}
}
/**
 *  补全网址
 *
 * @access    public
 * @param     string  $refurl  来源地址
 * @param     string  $surl  站点地址
 * @return    string
 */
function FillUrl($refurl,$surl)
{
	$i = $pathStep = 0;// 初始化循环变量 i和路径索引
	$dstr = $pstr = $okurl = ''; // 初始化
	
	$refurl = trim($refurl); //trim() 函数从字符串的两端删除空白字符和其他预定义字符。
	$surl = trim($surl);
	
	$urls = @parse_url($refurl); // PHP中的at(@)是用于屏蔽错误信息、抑制报错的(如在方法调用时),有时候你希望自己来处理错误，而不是由系统自动处理。parse_url解析 URL，返回其组成部分
	$basehost = ( (!isset($urls['port']) || $urls['port']=='80') ? $urls['host'] : $urls['host'].':'.$urls['port']);// isset检测变量是否设置，类似#ifdef 如果端口没有设置或者是默认值80，则不添加端口号，否则添加
	
	//$basepath = $basehost.(!isset($urls['path']) ? '' : '/'.$urls['path']);
	//由于直接获得的path在处理 http://xxxx/nnn/aaa?fdsafd 这种情况时会有错误，因此用其它方式处理
	$basepath = $basehost;
	$paths = explode('/',preg_replace("/^http:\/\//i", "", $refurl)); // explode() 函数把字符串按所给字符分割为数组。正则表达式替换把来源地址中的http://头部去掉
	$n = count($paths); // count() 函数计算数组中的单元数目或对象中的属性个数。
	for($i=1;$i < ($n-1);$i++) {
		if(!preg_match("/[\?]/", $paths[$i]))
			$basepath .= '/'.$paths[$i];
	}
	if(!preg_match("/[\?\.]/", $paths[$n-1])) {
		$basepath .= '/'.$paths[$n-1]; // 基地址添加上
	}
	if($surl=='') {
		return $basepath;
	}
	$pos = strpos($surl, "#"); // strpos() 函数返回字符串在另一个字符串中第一次出现的位置。
	if($pos>0) {
		$surl = substr($surl, 0, $pos); // 取出没有#页面内链接的地址
	}
	//用 '/' 表示网站根的网址
	if($surl[0]=='/') {
		$okurl = $basehost.$surl; // ok url补全了的地址
	}
	else if($surl[0]=='.')
	{
		if(strlen($surl)<=2)
		{
			return '';
		}
		else if($surl[1]=='/')
		{
			$okurl = $basepath.preg_replace('/^./', '', $surl);
		}
		else
		{
			$okurl = $basepath.'/'.$surl;
		}
	}
	else
	{
		if( strlen($surl) < 7 )
		{
			$okurl = $basepath.'/'.$surl;
		}
		else if( preg_match("/^http:\/\//i",$surl) )
		{
			$okurl = $surl;
		}
		else
		{
			$okurl = $basepath.'/'.$surl;
		}
	}
	$okurl = preg_replace("/^http:\/\//i", '', $okurl);
	$okurl = 'http://'.preg_replace("/\/{1,}/", '/', $okurl);
	return $okurl;
}
?>