# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

myList = [1,2,3];

print "=============== section 1: handle errors ===============";
try:
    print myList[3];
except IOError, value:
    print "myList IOError: " + value.message;
except (IndexError, ZeroDivisionError), value:
    print "myList Error: " + value.message;
# else:
#     print "No Error!";


print "=============== section 1: handle several errors ===============";
try:
    try:
        print myList[3];
    except:
        print "inside Error!";
except:
    print "Outside Error!";


print "=============== section 2: raise errors ===============";

def fun(n):
    if n == 0:
        # raise ValueError("Zero");
        raise Exception("Zero", "Here is Zero"); #用 Exception 抛出的异常 ，要用 Exception 来 catch
    print n;

try:
    fun(0);
# except ValueError, value:
except Exception, value:
    print value;

print "=============== section 2: assert =============== " \
      "只有当 __debug__ 为True的时候， assert 才生效， 当python -O编译的时候， assert语句会被移除";

ml = [];
try:
    assert len(ml), "assert one empty list";
except AssertionError,value:
    print value.message;


print "=============== section 2: custom Exception=============== " ;
class MyError(Exception):
    def __init__(self, data):
        self.data = data;
    def __str__(self):
        return self.data;

try:
    if len(ml) == 0:
        raise MyError("My Error Catch!");
except MyError,value:
    print value;
except value:
    print value.message;
else:
    print "no errors";