# -*- coding: utf-8 -*-
__author__ = 'dabuwang'

import os,shutil;

cur_dir = os.getcwd();
dl_dir = cur_dir + "\\DL";


def get_all_files(source_dir, suffix):
    if not os.path.isdir(source_dir):
        return None;
    txt_files = [];
    for temp_dir_f in os.listdir(source_dir):
        if os.path.isfile(temp_dir_f):
            temp_file_tuple = os.path.splitext(temp_dir_f);
            if temp_file_tuple[1] == suffix:
                txt_files.append(os.path.join(source_dir,temp_dir_f));
    return txt_files;


def get_md5value_list_from_file(file_full_name):
    if not os.path.isfile(file_full_name):
        return None;
    md5_list =[];
    with open(file_full_name, "r") as f_read:
        for line in f_read:
            split_temp = str.split(line, "\t", 1);
            if len(split_temp) == 2:
                md5_list.append(split_temp[0]);
            # print line.decode("gbk"); #python 2.x 读入内存的字节码格式是 ansi

    return md5_list;


def get_all_dl_files_name():
    if not os.path.isdir(dl_dir):
        return None;
    dl_files = [];
    for temp_md5_f in os.listdir(dl_dir):
        dl_files.append(temp_md5_f);
    return dl_files;

# print get_all_files(cur_dir, ".py");
# get_md5value_list_from_file(r"C:\Users\dabuwang.TENCENT\Desktop\test.txt");

if __name__ == "__main__":

    all_dl_files = get_all_dl_files_name();

    for txt_file in get_all_files(cur_dir, ".txt"):
        md5_value_list = get_md5value_list_from_file(txt_file);
        temp_dir = os.path.splitext(txt_file)[0];

        if not os.path.isdir(temp_dir):
            os.mkdir(temp_dir);

        for md5value in md5_value_list:
            if md5value in all_dl_files:
                shutil.move(os.path.join(dl_dir,md5value), os.path.join(temp_dir, md5value));
                # print "move %s to %s" % (os.path.join(dl_dir,md5value), os.path.join(temp_dir, md5value));
            else:
                print "can't find the md5 file: %s " % (os.path.join(dl_dir,md5value));