<?php

$file_name = $argv[1];
if (empty($file_name)){
    echo "file_name is null/n";
    exit;
}

$black_words_list = array('��','�ҵ','��');
$black_switch = false;


//(1)open file
echo "file($file_name) will be opened\n";
$myfile = fopen($file_name, "r") or die("Unable to open file!");
//echo fread($myfile,filesize($file_name));
$result = array();
//(2)split&count
while(!feof($myfile)) {
    $line = fgets($myfile);//read one line
    $line = trim($line);
    if(empty($line)){
        break;
    }
    $words = split_word($line);//split word
}

//(3)count
display($result);

fclose($myfile);




//functions definition
function split_word($line){
    // 实例化分词对像(mydata非空)
    $version = 3;   // 采用版本
    $object = 'PSCWS' . $version;
    require (strtolower($object) . '.class.php');
    $dict = 'dict/dict.xdb';    // 默认采用 xdb (不需其它任何依赖)
    $cws = new $object($dict);
    $ignore  = true;    // 是否忽略标点
    $cws->set_ignore_mark($ignore);
    $autodis = false;   //是否识别人名
    $cws->set_autodis($autodis);
    $debug   = false;	// 是否为除错模式
    $cws->set_debug($debug);
    $stats	 = false;	// 是否查看统计结果
    $cws->set_statistics($stats);
    // 执行切分, 分词结果数组执行 words_cb()
    $cws->segment($line, 'add_word_count');
    
    return;
}


function add_word_count($words){
    global $result;
    global $black_words_list;	
    global $black_switch;
    foreach($words as $word){
	if ($black_switch&&in_array($word, $black_words_list)){
            continue;
	}

        if(empty($result[$word])){
            //该分词不存在
            $result[$word] = 1;
        }else{
           //该分词存在
           $result[$word]++;
        }
    }
    
    return;
}

function display($result){
    echo "---DISPLAY RESULT---\n";
    arsort($result);
    print_r($result);
    /*
     * foreach($result as $word => $num){
        echo "[$word]=$num\n";
     }*/
}
?>
