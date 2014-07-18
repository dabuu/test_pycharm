# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

import re;

sss = "Life can be good";

print "====================== 1. 匹配&搜索： re.search 从整个string中查询，re.match 从 第一个字母开始查询================";

print re.search("can", sss); # matchobject
print re.search("can", sss).group(); #can

print re.match("can", sss); # None

print re.match("l*",sss,re.IGNORECASE) #matchobject
print re.match("l.*?\\s",sss,re.IGNORECASE).group(); #Life

print re.findall("\\w{3}\\s", sss, re.IGNORECASE); # list

print "====================== 2. 替换： re:sub() re.subn() 功能一样， 只是 subn() 返回一个元组 ================== ";

print re.sub("good","bad", sss);        #Life can be bad
print re.sub("good|be","bad", sss, 1);  #Life can bad good
print re.sub("good|be","bad", sss);     #Life can bad bad

print re.subn("good|be", "bad", sss);   #('Life can bad bad', 2)
print re.subn("good|be", "bad", sss)[1];#2

print "====================== 3. 分割字符串： re:split ================== ";

print re.split(" ", sss);   #['Life', 'can', 'be', 'good']
print re.split(" ", sss,1); #['Life', 'can be good']

print "====================== 4. 正则表达式 对象 ================== ";

r = re.compile("\\b\\w+\\b",re.I); #查找单词
print r.findall(sss);

double = re.compile("(?P<first>\\w)(?P=first)"); # 查找重复字母
print double.findall(sss);

d = double.search(sss);
print d.groupdict();
print d.start(0);
print d.end(0);