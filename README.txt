1.���ÿ�Դ�ִʿ⣨phpʵ�֣���
��ҳ��http://www.xunsearch.com/scws/index.php
����ҳ��http://www.xunsearch.com/scws/download.php

�����ص���PSCWS23(�� PHP ������ SCWS �ڶ���͵����棬��֧�� GBK �ַ������ٶȽϿ죬�Ƽ���ȫ PHP ������ʹ�ã��Ѻ�ר�� xdb �ʵ�һ����)
˵���ĵ���http://www.xunsearch.com/scws/docs.php#pscws23

PSCWS2 �� PSCWS3 ���������Ӧ���ļ��ֱ�Ϊ pscws2.class.php �� pscws3.class.php ���ֱ�Ϊ
�ڶ��漰�����档�� PHP �����еĵ��÷������£�

// ����ͷ�ļ�, ���õ�3�����ļ���ӦΪ pscws3.class.php
require '/path/to/pscws2.class.php';

// �����ִ������, ����Ϊ�ʵ�·��
$pscws = new PSCWS2('/path/to/dict/dict.xdb');

//
// ������, �趨һЩ�ִʲ�����ѡ��
// ����: set_dict, set_ignore_mark, set_autodis, set_debug ... �ȷ���
// 

// ���� segment ����ִ�дʻ��и�, segment �ĵڶ�����Ϊ�ص�����, �⽫ʹϵͳ�Զ����кõĴ�
// ��ɵ�������Ϊ�������ݸ��ûص�����ȥִ�У���Ϊ���򽫴���ɵ����鷵�ء�

$res = $pscws->segment($string);
print_r($res);

�� ���ر�أ��ص�������������ε��ã�

function seg_cb($res) { print_r($res); }
$pscws->segment($string, 'seg_cb');

--- �෽����ȫ�ֲ� ---
(ע: ���캯���ɴ���ʵ�·����Ϊ����, ����������� set_dict Ч����һ����)

class PSCWS2 { | class PSCWS3 {
  
  void set_dict(string dict_fpath);
  ˵�������÷ִ����������õĴʵ��ļ���
  ������dict_fpath Ϊ�ʵ�·�����ڲ�����ݴʵ�·���ĺ�׺��������Ӧ�Ĵ���ʽ��
  ����ֵ���ޡ�
  �������д������� WARNING ���Ĵ�����ʾ��

  void set_ignore_mark(bool set);
  ˵�������÷ִʽ���Ƿ���Ա����š�
  ������set ����Ϊ�����͵� true �� false���ֱ��ʾҪ���ԺͲ����ԡ�
  ����ֵ���ޡ�

  void set_autodis(bool set);
  ˵�������÷ִ��㷨�Ƿ������Զ�ʶ��������
  ������set ����Ϊ�����͵� true �� false���ֱ��ʾҪʶ��Ͳ�ʶ��
  ����ֵ���ޡ�

  void set_debug(bool set);
  ˵�������÷ִʹ����Ƿ�����ִʹ��̵ĵ�����Ϣ��
  ������set ����Ϊ�����͵� true �� false���ֱ��ʾҪ����Ͳ������
  ����ֵ���ޡ�

  void set_statistics(bool set);
  ˵�������÷ִʹ����Ƿ��¼���ʻ���ֵĴ�����λ�á�
  ������set ����Ϊ�����͵� true �� false���ֱ��ʾҪ��¼�Ͳ���¼��
  ����ֵ���ޡ�
  �������� segment() ����ִ�н�������� get_statistics() ������ȡͳ����Ϣ��

  Array &get_statistics(void);
  ˵���������ϴ� segment() ���õķִʽ���ĸ��ʻ���ֵĴ�����λ����Ϣ(���÷���)��
  �������ޡ�
  ����ֵ���Դʻ�Ϊ��������ֵ�ɴ���(times)��(poses)λ���б�������ɡ�
  �������÷���Ӧ���� segment() ��������ã�ÿ�� segment() ����ǰͳ����Ϣ�Զ����㡣

  mixed &segment(string text [, string cb]);
  ˵�������ַ��� text ִ�зִʡ�
  ������text ΪҪִ�зִʵ��ַ�����
        cb �Ǵ���ִʽ���Ļص��������ƣ����������кõĴ�����ɵ�������һ������
  ����ֵ���� cb ����û�д���ʱ�������кõĴ�����ɵ������(���������÷�ʽ����)��
          �����ûص���������ִʽ������ֱ�ӷ��� true��
  ������cb ������һ�� segment() �����п����Ƕ�ε��õġ�
        ��û�д��� cb ������segment() ������ text �ִʽ�����ٽ����һ�η��أ�
    �� text �ܳ�ʱ�ٶȽ��������齫 text �����ԵĻ��б���зֺ������ε���
    segment() ���������д������Ч�ʣ�
};


2.�ҿ�����ִ�г���
stat_word_frequency.php
ִ��Ч������
[sunmingzhe@cq01-rdqa-dev012.cq01.baidu.com pscws23]$ php stat_word_frequency.php input.data
file(input.data) will be opened
---DISPLAY RESULT---
Array
(
    [��] => 3
    [���] => 2
    [��] => 1
    [�ܺ�] => 1
    [����] => 1
    [Ҫ] => 1
    [�и�] => 1
    [�͸�] => 1
    [ϲ��] => 1
    [С��] => 1
    [����] => 1
    [ϣ��] => 1
    [��] => 1
    [���] => 1
    [����] => 1
)

����input.data�������ļ���ʾ������
[sunmingzhe@cq01-rdqa-dev012.cq01.baidu.com pscws23]$ cat input.data
��ã�����С������ϣ����Ҷ�ϲ���ң��������и��ܺõ�����Ҫ�͸����

3.��Ҫע�������
stat_word_frequency.php�У�black_words_listΪ����������������Ĵʻ㽫������ִ�
�������Ŀ����ǣ�black_switch��true�ǿ�����false�ǹر�


