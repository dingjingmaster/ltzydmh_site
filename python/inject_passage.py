#!/bin/env python
#-*- coding=utf-8 -*-
import os
import os.path
import pymysql
import time
import hashlib

def dir_files(dir_path, file_list, uploaded):
    files = os.listdir(dir_path)
    try:
        for f in files:
            fpath = os.path.join(dir_path, f)
            if (True != os.path.isdir(fpath)) and (not(f in uploaded)):
                file_list.append((f, fpath))
    except:
        print ("dir_files 异常")


def load_uploaded_file(file, file_path, loaded):
    loaded[file] = 0
    global fr
    try:
        fr = open(file_path, 'r')
        for i in fr.readlines():
            i = i.strip()
            loaded[i] = 0
    except:
        print ("获取历史上传文件记录失败")
    else:
        fr.close()


def save_uploaded_file(file, loaded):
    file_buf = ""
    for i in loaded.keys():
        file_buf += i + "\n"
    try:
        fr = open(file, 'w')
        fr.write(file_buf.strip())
    except:
        print ("获取历史上传文件记录失败")
    else:
        fr.close()

def parse_file(file_path):
    pas_title = ""
    pas_summary = ""
    pas_status = ""
    pas_category = ""
    pas_content = ""
    pas_keyword = ""
    is_blog_file = False
    try:
        fw = open(file_path, 'r', encoding='UTF-8')
        lines = fw.readlines()
        content_list = []
        for i in range(len(lines)):
            line = lines[i].strip()
            if -1 != line.find('[title]'):
                pas_title = lines[i + 1].strip()
                continue
            elif -1 != line.find('[summary]'):
                pas_summary = lines[i + 1].strip()
                continue
            elif -1 != line.find('[status]'):
                pas_status = lines[i + 1].strip()
                continue
            elif -1 != line.find('[category]'):
                pas_category = lines[i + 1].strip()
                continue
            elif -1 != line.find('[keyword]'):
                pas_keyword = lines[i + 1].strip()
                continue
            elif -1 != line.find('[content]'):
                content_list = lines[i + 1:]
                is_blog_file = True
                break
        if is_blog_file:
            for i in content_list:
                pas_content += i
    except:
        print ("无法打开的文件" + file_path)
    else:
        fw.close()
    return (pas_title, pas_summary, pas_status, pas_category, pas_keyword, pas_content)

def execute_sql(cursor, sql):
    try:
        cursor.execute(sql)
        db.commit()
    except:
        print ("sql:" + sql + "\t 执行错误")
        db.rollback()
    return;


def ltzydmh_summary(cursor):
    sql = "UPDATE ltzydmh_summary SET passage_num=passage_num + 1"
    execute_sql(cursor, sql);


def ltzydmh_passage_info(cursor, title, summary, status, category):
    djid = ""
    create = ""
    update = ""
    md5 = hashlib.md5()
    djid = "" + category + title
    localtime = time.asctime(time.localtime(time.time()))
    create = time.strftime("%Y%m%d%H%M%S", time.localtime())
    update = create
    md5.update(djid.encode('utf8'))
    djid = md5.hexdigest()
    sql = "INSERT INTO ltzydmh_passage_info \
        (djid, name, summary, create_time, update_time, status, category, view) \
        VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d')" % (djid, title, summary, create, update, status, category, 0)
    execute_sql(cursor, sql);


def ltzydmh_passage_content(cursor, title, category, keyword, content):
    djid = "" + category + title
    md5 = hashlib.md5()
    md5.update(djid.encode('utf8'))
    djid = md5.hexdigest()
    sql = "INSERT INTO ltzydmh_passage_content \
        (djid, keyword, content) \
        VALUES('%s', '%s', '%s')" % (djid, keyword, content)
    execute_sql(cursor, sql);


def ltzydmh_passage_category(cursor, category):
    sql = "INSERT INTO ltzydmh_passage_category \
        (category, num) \
        VALUES('%s', '%d')" % (category, 0)
    try:
        execute_sql(cursor, sql);
        db.commit()
    except:
        db.rollback()
        sql = "UPDATE ltzydmh_passage_category SET num=num + 1 WHERE category=" + category
        execute_sql(cursor, sql);


def upload_passage(cursor, title, summary, status, category, keyword, content):
    ltzydmh_summary(cursor)
    ltzydmh_passage_info(cursor, title, summary, status, category)
    ltzydmh_passage_content(cursor, title, category, keyword, content)
    ltzydmh_passage_category(cursor, category)



if __name__ == '__main__':
    db = pymysql.connect(host='127.0.0.1', port=3306, user='root', passwd='root', db='ltzydmh', charset='utf8')
    cur = db.cursor()
    global base_path
    global uploaded_file
    global upload_path
    global uploaded
    global file_list

    base_path = "G:/OneDrive/www/博客文章/"
    uploaded_file = "uploaded.txt"
    upload_path = base_path + uploaded_file
    uploaded = {}
    file_list = []

    load_uploaded_file(uploaded_file, upload_path, uploaded)
    dir_files(base_path, file_list, uploaded)
    for files, file_path in file_list:
        pas_title, pas_summary, pas_status, pas_category, pas_wordkey, pas_content = parse_file(file_path)
        upload_passage(cur, pas_title, pas_summary, pas_status, pas_category, pas_wordkey, pas_content)
        uploaded[files] = 0
    save_uploaded_file(upload_path, uploaded)

    cur.close()
    db.close()
    exit (0)
