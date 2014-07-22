# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

import types;

list = [1,2,3,4,10];
print len(list);
print list[4];


list.append("aaa");
print list;

list.insert(4,'new one');
print list;

a = 'new one';
list.remove(a); # remove 一个 value
print list;


list.pop(len(list)-1); #pop 一个 index
print list;

print list[1:-3];
print list[1:];

list.insert(2, "one");

print "=============== while int value only "
i = len(list);

while(i > 0):
    i -=1;
    if type(list[i]) is not types.IntType:
        continue;

    print list[i];


# ========== tuples
print '========== tuples';
t = (9,8,7);
print t;

print len(t);
print t[1:];
print t[1:-1];

print "============= t[1:]";
for x in t[1:]:
    print x;

print "============= t[1:-1]";
for x in t[1:-1]:
    print x;


print "==================== test kwargs ====================";

def printkwargs(**kwargs):
    i = 1;
    for key, value in kwargs.iteritems():
        print "%d: %s == %s" % (i, key, value);
        i += 1;


printkwargs(firstname="wang", lastname="yue");