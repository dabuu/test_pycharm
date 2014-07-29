# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'


import os, time, sys;
import hashlib,shutil;

#创建文件夹
def create_dir(parent_dir, new_dir_name):
    new_dir = os.path.join(parent_dir, new_dir_name);
    if not os.path.isdir(new_dir):
        os.makedirs(new_dir);
    return new_dir;


def get_file_md5(file_name):
    if not os.path.isfile(file_name):
        return None;
    with open(file_name,'rb') as f:
        md5obj = hashlib.md5();
        md5obj.update(f.read());
        return md5obj.hexdigest();


def get_bigfile_md5(file_name):
    if not os.path.isfile(file_name):
        return None;
    md5obj = hashlib.md5();
    f = file(file_name, 'rb');
    while True:
        b = f.read(8096)
        if not b:
            break;
        md5obj.update(b);
    f.close();
    return md5obj.hexdigest();


if __name__ == "__main__":
    if(len(sys.argv) != 2):
        print "需要一个路径参数!";
        exit();
    test_dir = sys.argv[1];
    if not os.path.isdir(test_dir):
        print "%s 不是一个有效的文件夹" % test_dir;
        exit();

    cur_dir = os.getcwd();
    log_dir = create_dir(cur_dir,"logs");
    bak_dir = create_dir(cur_dir,"baks");
    log_file = os.path.join(log_dir, time.strftime("%Y%m%d-%H%M%S") + ".txt");

    def write_log(msg):
        with open(log_file,'a+') as wf:
            wf.write(msg + "\r\n");
            wf.flush();

    for each_file in os.listdir(test_dir):
        file_full_name = os.path.join(test_dir,each_file);
        if os.path.isfile(file_full_name):
            temp_md5_value = get_bigfile_md5(file_full_name);
            if each_file != temp_md5_value:
                write_log(("%s\t\t%s" % (each_file, temp_md5_value)));
                shutil.move(file_full_name, os.path.join(bak_dir,each_file));

