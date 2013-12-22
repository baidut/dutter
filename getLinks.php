<?php
function showUrl($sourceURL,$start_str='<dl class="artile">',$end_str='<div id="pager">' ){//Ҫ�ɼ������б����ַ $start_str=$start_str_default��ʾ���� unexpected '$start_str_default' �����ñ�������Ĭ��ֵ

	// �����޸���http://www.baidu3k.com/archives/588
	// ------------����snoopyץȡ��ҳ����------------------
	require_once 'Snoopy.php';
	$snoopy = new Snoopy();
	$snoopy->fetch($sourceURL);
	$fileContent = $snoopy->results;
	// ------------��ȡ��������----------------------------
	$start_num = stripos($fileContent, $start_str)+strlen($start_str); //stripos() ���������ַ�������һ���ַ����е�һ�γ��ֵ�λ�á�δ�ҵ��򷵻� false���﷨stripos(string,find[,start])
	$end_num = stripos($fileContent, $end_str)-$start_num;
	// ------------ͨ��������ʽ��ȡ�����ڵ�����----------
	$fileContent = substr($fileContent, $start_num, $end_num);
	$fileContent = strip_tags($fileContent, '<a>');
	$a = "/<a.*?href=[\"\'](.*?)[\"\'][^>]*>(.*?)<\/a>/i";
	preg_match_all($a, $fileContent, $content); //preg_match_all �� ִ��һ��ȫ��������ʽƥ��(PHP 4, PHP 5) ������������ʽ��Դ���ݣ�Ŀ������

	foreach ($content[1] as $k=>$v){ //=>�������Ա���ʷ���
		$content[1][$k] = FillUrl($sourceURL, $v); //���������ݽ���fillurl����ȫ��ַ
	}
	// ------------��ӡ���--------------------------------
	//print_r($content);

	foreach ($content[2] as $key=>$value) {
		echo " <a link href=\"".$content[1][$key]."\">".$content[2][$key]." ".$content[1][$key]." </a><br/>\n";
		//echo " <a link href=\"".$content[1][$key]."\">".$content[2][$key]."</a><br/>\n";
	}
}
/**
 *  ��ȫ��ַ
 *
 * @access    public
 * @param     string  $refurl  ��Դ��ַ
 * @param     string  $surl  վ���ַ
 * @return    string
 */
function FillUrl($refurl,$surl)
{
	$i = $pathStep = 0;// ��ʼ��ѭ������ i��·������
	$dstr = $pstr = $okurl = ''; // ��ʼ��
	
	$refurl = trim($refurl); //trim() �������ַ���������ɾ���հ��ַ�������Ԥ�����ַ���
	$surl = trim($surl);
	
	$urls = @parse_url($refurl); // PHP�е�at(@)���������δ�����Ϣ�����Ʊ����(���ڷ�������ʱ),��ʱ����ϣ���Լ���������󣬶�������ϵͳ�Զ�����parse_url���� URL����������ɲ���
	$basehost = ( (!isset($urls['port']) || $urls['port']=='80') ? $urls['host'] : $urls['host'].':'.$urls['port']);// isset�������Ƿ����ã�����#ifdef ����˿�û�����û�����Ĭ��ֵ80������Ӷ˿ںţ��������
	
	//$basepath = $basehost.(!isset($urls['path']) ? '' : '/'.$urls['path']);
	//����ֱ�ӻ�õ�path�ڴ��� http://xxxx/nnn/aaa?fdsafd �������ʱ���д��������������ʽ����
	$basepath = $basehost;
	$paths = explode('/',preg_replace("/^http:\/\//i", "", $refurl)); // explode() �������ַ����������ַ��ָ�Ϊ���顣������ʽ�滻����Դ��ַ�е�http://ͷ��ȥ��
	$n = count($paths); // count() �������������еĵ�Ԫ��Ŀ������е����Ը�����
	for($i=1;$i < ($n-1);$i++) {
		if(!preg_match("/[\?]/", $paths[$i]))
			$basepath .= '/'.$paths[$i];
	}
	if(!preg_match("/[\?\.]/", $paths[$n-1])) {
		$basepath .= '/'.$paths[$n-1]; // ����ַ�����
	}
	if($surl=='') {
		return $basepath;
	}
	$pos = strpos($surl, "#"); // strpos() ���������ַ�������һ���ַ����е�һ�γ��ֵ�λ�á�
	if($pos>0) {
		$surl = substr($surl, 0, $pos); // ȡ��û��#ҳ�������ӵĵ�ַ
	}
	//�� '/' ��ʾ��վ������ַ
	if($surl[0]=='/') {
		$okurl = $basehost.$surl; // ok url��ȫ�˵ĵ�ַ
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