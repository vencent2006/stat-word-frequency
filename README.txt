1.利用开源分词库（php实现），
主页：http://www.xunsearch.com/scws/index.php
下载页：http://www.xunsearch.com/scws/download.php

我下载的是PSCWS23(纯 PHP 开发的 SCWS 第二版和第三版，仅支持 GBK 字符集，速度较快，推荐在全 PHP 环境中使用，已含专用 xdb 词典一部。)
说明文档：http://www.xunsearch.com/scws/docs.php#pscws23

PSCWS2 和 PSCWS3 这两个类对应的文件分别为 pscws2.class.php 和 pscws3.class.php ，分别为
第二版及第三版。在 PHP 代码中的调用方法如下：

// 加入头文件, 若用第3版则文件名应为 pscws3.class.php
require '/path/to/pscws2.class.php';

// 建立分词类对像, 参数为词典路径
$pscws = new PSCWS2('/path/to/dict/dict.xdb');

//
// 接下来, 设定一些分词参数或选项
// 包括: set_dict, set_ignore_mark, set_autodis, set_debug ... 等方法
// 

// 调用 segment 方法执行词汇切割, segment 的第二参数为回调函数, 这将使系统自动将切好的词
// 组成的数组作为参数传递给该回调函数去执行，若为空则将词组成的数组返回。

$res = $pscws->segment($string);
print_r($res);

或 （特别地，回调函数视情况会多次调用）

function seg_cb($res) { print_r($res); }
$pscws->segment($string, 'seg_cb');

--- 类方法完全手册 ---
(注: 构造函数可传入词典路径作为参数, 这与另外调用 set_dict 效果是一样的)

class PSCWS2 { | class PSCWS3 {
  
  void set_dict(string dict_fpath);
  说明：设置分词引擎所采用的词典文件。
  参数：dict_fpath 为词典路径，内部会根据词典路径的后缀名采用相应的处理方式。
  返回值：无。
  错误：若有错误会给出 WARNING 级的错误提示。

  void set_ignore_mark(bool set);
  说明：设置分词结果是否忽略标点符号。
  参数：set 必须为布尔型的 true 或 false，分别表示要忽略和不忽略。
  返回值：无。

  void set_autodis(bool set);
  说明：设置分词算法是否启用自动识别人名。
  参数：set 必须为布尔型的 true 或 false，分别表示要识别和不识别。
  返回值：无。

  void set_debug(bool set);
  说明：设置分词过程是否输出分词过程的调试信息。
  参数：set 必须为布尔型的 true 或 false，分别表示要输出和不输出。
  返回值：无。

  void set_statistics(bool set);
  说明：设置分词过程是否记录各词汇出现的次数及位置。
  参数：set 必须为布尔型的 true 或 false，分别表示要记录和不记录。
  返回值：无。
  其它：在 segment() 方法执行结束后调用 get_statistics() 方法获取统计信息。

  Array &get_statistics(void);
  说明：返回上次 segment() 调用的分词结果的各词汇出现的次数及位置信息(引用返回)。
  参数：无。
  返回值：以词汇为键名，其值由次数(times)和(poses)位置列表数组组成。
  其它：该方法应该在 segment() 方法后调用，每次 segment() 调用前统计信息自动清零。

  mixed &segment(string text [, string cb]);
  说明：对字符串 text 执行分词。
  参数：text 为要执行分词的字符串；
        cb 是处理分词结果的回调函数名称，它接受由切好的词语组成的数组这一参数。
  返回值：当 cb 参数没有传入时，返回切好的词语组成的数组成(可以以引用方式返回)，
          若采用回调函数处理分词结果，则直接返回 true。
  其它：cb 函数在一次 segment() 过程中可能是多次调用的。
        若没有传入 cb 参数，segment() 将会在 text 分词结果后再将结果一次返回，
    当 text 很长时速度较慢，建议将 text 按明显的换行标记切分后再依次调用
    segment() 方法进行切词以提高效率！
};


2.我开发的执行程序
stat_word_frequency.php
执行效果如下
[sunmingzhe@cq01-rdqa-dev012.cq01.baidu.com pscws23]$ php stat_word_frequency.php input.data
file(input.data) will be opened
---DISPLAY RESULT---
Array
(
    [我] => 3
    [大家] => 2
    [的] => 1
    [很好] => 1
    [礼物] => 1
    [要] => 1
    [有个] => 1
    [送给] => 1
    [喜欢] => 1
    [小明] => 1
    [我是] => 1
    [希望] => 1
    [都] => 1
    [你好] => 1
    [现在] => 1
)

其中input.data是数据文件，示例如下
[sunmingzhe@cq01-rdqa-dev012.cq01.baidu.com pscws23]$ cat input.data
你好，我是小明，我希望大家都喜欢我，我现在有个很好的礼物要送给大家

3.需要注意的配置
stat_word_frequency.php中，black_words_list为黑名单，黑名单里的词汇将不参与分词
黑名单的开关是，black_switch，true是开启，false是关闭


