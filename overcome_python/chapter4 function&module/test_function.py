# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

print "=========== basic function";

def listsum(L):
    result = 0;
    for l in L:
        result += l;

    return result;

list = [2,4,6,8];

print listsum(list);


print "=========== with args function";

def Cube(x = 5):
    return  x**3 # 数的 3次方

print Cube(2.1);
print Cube();

def MultiCube(x =1, y=2, z=3):
    return  (x+y-z)**3;

print MultiCube(0);
print MultiCube(2,1);
print MultiCube(3,2,1);
# 指定参数 传值
print MultiCube(z=1,y=2,x=3);
print MultiCube(z=1);


print "=================== not fixed args function"

def ParaArgsMethod(*arg):
    print arg; # 传入arg 是一个 元组

ParaArgsMethod(1, "one");

print "=================== valid scope for functions";

def ValidScopeMethod(x):
    global a;
    return a + x;

a = 1;
print ValidScopeMethod(2);
a = 3;
print ValidScopeMethod(2);

print "=================== lambda expression"; # 所有的lambda 表达式 都会返回一个值 ， 调用这个 lambda 就是 直接调用这个返回值

lambdamethod = lambda x,y: x+y;
print lambdamethod(1,2);

def multitwo(x):
    return x*2;

lambdamethod2 = lambda x: multitwo(x)*100;
print lambdamethod2(2);


