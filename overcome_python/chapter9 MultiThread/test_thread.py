# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

import threading;

print "==================== 直接在线程中  运行函数 ====================";

def run_thread(n):
    # for i in range(n):
    for i in n:
        print i;

t = (9,8,7);

t1 = threading.Thread(target=run_thread, args=(t,));
t1.start();

print "==================== 创建thread的新类，通过 start 创建线程，之后执行 run 的方法 ====================";


class MyThread(threading.Thread):
    def __init__(self, num):
        threading.Thread.__init__(self);
        self.num = num;

    def run(self):
        print "i am", self.num;

mt1 = MyThread(1);
mt2 = MyThread(2);

mt1.start();
mt2.start();

print "==================== thread类 相关的方法 ====================";

test_thread = MyThread(2);

test_thread.start();
print test_thread.isAlive();    # thread is alive
print test_thread.getName();    # thread name
test_thread.join();             # join
for i in range(1,5,1):
    print i;
