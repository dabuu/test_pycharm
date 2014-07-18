# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

def himymodule(args):
    print "hello world!\t" + args;



if __name__ == '__main__':
    himymodule(__name__);
else:
    himymodule("module: " + __name__);
