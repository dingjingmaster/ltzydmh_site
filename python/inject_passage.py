#!/bin/env python
#-*- coding=utf-8 -*-
import os
import sys
import time
import pymysql
import hashlib

# 将时间戳转为时间字符串
def time_to_str(timeStamp):
    return time.strftime("%Y%m%d%H%M%S", time.localtime(timeStamp))

# 获取文件的创建时间和最后更新时间
def file_create_update(fileName):
    fileInfo = os.stat(fileName)
    createTime = time_to_str(fileInfo.st_ctime)
    updateTime = time_to_str(fileInfo.st_mtime)
    return (str(createTime), str(updateTime))

# 获取指定文件夹下的文件名及文件路径
def dir_files(dirPath, fileList, loaded):
    files = os.listdir(dirPath)
    flag = ""
    try:
        for f in files:
            fpath = os.path.join(dirPath, f)
            if os.path.isfile(fpath):
                realCreateTime = ""
                realUpdateTime = ""
                historyCreateTime = ""
                historyUpdateTime = ""
                realCreateTime, realUpdateTime = file_create_update(fpath)
                if f in loaded:
                    historyCreateTime, historyUpdateTime = loaded[f]        # 历史更新时间和历史创建时间
                    flag = "update"
                else:
                    flag = "insert"
                    historyCreateTime, historyUpdateTime = (0, 0)
                if (int(realUpdateTime) > int(historyUpdateTime))\
                        and (f.endswith(".md")):
                    fileList.append((f, fpath, realCreateTime, realUpdateTime, flag))
    except:
        print ("dirFiles 异常")
    return

# 获取历史文件上传记录
def load_uploaded_file(file, filePath, loaded):
    fr = None
    try:
        fr = open(filePath, 'rb')
        for i in fr.readlines():
            i = i.decode("utf8")
            i = i.strip()
            arr = i.split("\t")
            loaded[arr[0]] = (arr[1], arr[2])
    except:
        print ("获取历史上传文件记录失败")
    else:
        fr.close()

# 保存历史文件上传记录
def save_uploaded_file(file, loaded):
    fileBuf = ""
    for i in loaded.keys():
        createTime, updateTime = loaded[i]
        fileBuf += str(i) + "\t" + str(createTime) + "\t" + str(updateTime) + "\n"
    try:
        fr = open(file, 'wb')
        fileBuf = fileBuf.strip().encode("utf-8")
        fr.write(fileBuf)
    except:
        print ("获取历史上传文件记录失败")
    else:
        fr.close()

def parse_file(filePath):
    pasTitle = ""
    pasSummary = ""
    pasStatus = ""
    pasCategory = ""
    pasContent = ""
    pasKeyword = ""
    isBlogFile = False
    try:
        fw = open(filePath, 'r', encoding='UTF-8')
        lines = fw.readlines()
        contentList = []
        for i in range(len(lines)):
            line = lines[i].strip()
            if -1 != line.find('[title]'):
                pasTitle = lines[i + 1].strip()
                continue
            elif -1 != line.find('[summary]'):
                pasSummary = lines[i + 1].strip()
                continue
            elif -1 != line.find('[status]'):
                pasStatus = lines[i + 1].strip()
                continue
            elif -1 != line.find('[category]'):
                pasCategory = lines[i + 1].strip()
                continue
            elif -1 != line.find('[keyword]'):
                pasKeyword = lines[i + 1].strip()
                continue
            elif -1 != line.find('[content]'):
                contentList = lines[i + 1:]
                isBlogFile = True
                break
        if isBlogFile:
            for i in contentList:
                pasContent += i
    except:
        print ("无法打开的文件" + file_path)
    else:
        fw.close()
    return (pasTitle, pasSummary, pasStatus, pasCategory, pasKeyword, pasContent)

def execute_sql(cursor, sql):
    try:
        cursor.execute(sql)
        db.commit()
    except:
        print ("sql:" + sql + "\t 执行错误")
        db.rollback()
    return;


def ltzydmh_update_category(cursor):
    sql = "UPDATE ltzydmh_summary SET category_num=category_num + 1"
    execute_sql(cursor, sql);


def ltzydmh_update_passage(cursor):
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
        (djid, name, summary, create_time, update_time, status, category, viewcount) \
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
        VALUES('%s', '%d')" % (category, 1)
    try:
        execute_sql(cursor, sql);
        ltzydmh_update_category(cursor)
    except:
        sql = "UPDATE ltzydmh_passage_category SET num=num+1 WHERE category=" + category
        execute_sql(cursor, sql);



def upload_passage(cursor, title, summary, status, category, keyword, content):
    ltzydmh_passage_info(cursor, title, summary, status, category)
    ltzydmh_passage_content(cursor, title, category, keyword, content)
    ltzydmh_update_passage(cursor)
    ltzydmh_passage_category(cursor, category)



if __name__ == '__main__':
    basePath = "G:/OneDrive/www/博客文章/"
    if len(sys.argv) == 2:
        basePath = sys.argv[1]
    uploadedFile = "uploaded.txt"
    uploadPath = basePath + uploadedFile                        # 暂存历史上传文件路径
    uploaded = {}                                               # 已经上传的
    fileList = []                                               # 将要上传或者更新的

    db = pymysql.connect(host='127.0.0.1', port=3306\
            , user='root', passwd='root', db='ltzydmh'\
            , charset='utf8')
    cur = db.cursor()
    load_uploaded_file(uploadedFile, uploadPath, uploaded)
    dir_files(basePath, fileList, uploaded)
    for files, filePath, createTime, updateTime, flag in fileList:
        pasTitle, pasSummary, pasStatus, pasCategory, pasWordkey, pasContent = parse_file(filePath)
        '''
        upload_passage(cur, pasTitle, pasSummary, pasStatus, pasCategory, pasWordkey, pasContent)
        '''
        uploaded[files] = (createTime, updateTime)
    save_uploaded_file(uploadPath, uploaded)

    cur.close()
    db.close()

    exit (0)
