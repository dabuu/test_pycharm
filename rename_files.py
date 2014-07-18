# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

import os;
import re;

def RenameFiles(path):
    for f in os.listdir(path):
        print os.path.splitext(f);

        # if os.path.isfile(os.path.join(path,f)):
        #     m = re.match("(\\d+)(\\.jpg)",f);
        #
        #     if m != None and len(m.groups()) == 2:
        #         # print m.groups()[0];
        #         # print m.groups()[1];
        #         if len(m.groups()[0]) == 1:
        #             # print os.path.join(path,"00" + m.groups()[0] + m.groups()[1]);
        #             os.rename(os.path.join(path,f), os.path.join(path,"00" + m.groups()[0] + m.groups()[1]));
        #         elif len(m.groups()[0]) == 2:
        #             # print os.path.join(path,"0" + m.groups()[0] + m.groups()[1]);
        #             os.rename(os.path.join(path,f), os.path.join(path,"0" + m.groups()[0] + m.groups()[1]));

RenameFiles(r"D:\temp\21");



