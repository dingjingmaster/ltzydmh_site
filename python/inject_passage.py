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
    except Exception as ex:
        print ("获取历史上传文件记录错误: ", end = "")
        print (ex)
        print ("\n")
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
    except Exception as ex:
        print ("保存历史上传文件错误: ", end = "")
        print (ex)
        print ("\n")
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
        fw = open(filePath, 'r', encoding="utf8")
        lines = fw.readlines()
        contentList = []
        for i in range(len(lines)):
            line = lines[i]
            line = line.strip()
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
    except Exception as ex:
        print ("打开文件" + filePath + " 错误:", end=""),
        print (ex)
        print ("\n")
    else:
        fw.close()
    return (pasTitle, pasSummary\
            , pasStatus, pasCategory\
            , pasKeyword, pasContent)

def execute_sql(cursor, sql):
    res = None
    try:
        cursor.execute(sql)
        db.commit()
        res = cursor.fetchall()
    except Exception as ex:
        print (ex)
        #print ("sql:" + sql + "\t 执行错误")
        db.rollback()
    return res


def insert_category(cursor, category):
    sql = "INSERT INTO ltzydmh_passage_category \
        (category, num) \
        VALUES('%s', '%d')" % (pymysql.escape_string(category), 0)
    try:
        execute_sql(cursor, sql);
        ltzydmh_update_category(cursor)
    except:
        execute_sql(cursor, sql);
    return


def update_summary(cursor):
    res1 = None
    res2 = None
    categoryNum = 0
    passageNum = 0
    sql1 = "SELECT COUNT(*) FROM ltzydmh_passage_category"
    sql2 = "SELECT COUNT(*) FROM ltzydmh_passage_content"
    try:
        res1 = execute_sql(cursor, sql1);
        res2 = execute_sql(cursor, sql2);
    except:
        pass
    categoryNum = res1[0][0]
    passageNum = res2[0][0]
    sql = "UPDATE ltzydmh_summary SET passage_num='%d', category_num='%d' WHERE id=id"\
            % (passageNum, categoryNum)
    execute_sql(cursor, sql);
    return


def insert_content(cursor, title, category, keyword, content):
    djid = "" + category + title
    md5 = hashlib.md5()
    md5.update(djid.encode('utf8'))
    djid = md5.hexdigest()
    sql = "INSERT INTO ltzydmh_passage_content \
        (djid, keyword, content) \
        VALUES('%s', '%s', '%s')" % (pymysql.escape_string(djid)\
        , pymysql.escape_string(keyword)\
        , pymysql.escape_string(content))
    execute_sql(cursor, sql);
    return


def update_content(cursor, title, category, keyword, content):
    djid = category + title
    md5 = hashlib.md5()
    md5.update(djid.encode('utf8'))
    djid = md5.hexdigest()
    sql = "UPDATE ltzydmh_passage_content SET keyword='%s', content='%s' WHERE djid='%s'" \
            % (pymysql.escape_string(keyword)\
            , pymysql.escape_string(content)\
            , pymysql.escape_string(djid))
    execute_sql(cursor, sql);
    return


def insert_info(cursor, title, summary, status, category, createTime, updateTime):
    djid = ""
    create = ""
    update = ""
    md5 = hashlib.md5()
    djid = "" + category + title
    md5.update(djid.encode('utf8'))
    djid = md5.hexdigest()
    sql = "INSERT INTO ltzydmh_passage_info \
        (djid, name, summary, create_time, update_time, status, category, viewcount) \
        VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d')" \
         % (pymysql.escape_string(djid), pymysql.escape_string(title)\
         , pymysql.escape_string(summary), pymysql.escape_string(createTime)\
         , pymysql.escape_string(updateTime), pymysql.escape_string(status)\
         , pymysql.escape_string(category), 0)
    execute_sql(cursor, sql);
    return


def update_info(cursor, title, summary, status, category, createTime, updateTime):
    djid = ""
    create = ""
    update = ""
    md5 = hashlib.md5()
    djid = "" + category + title
    md5.update(djid.encode('utf8'))
    djid = md5.hexdigest()
    sql = "UPDATE ltzydmh_passage_info SET name='%s', summary='%s', create_time='%s',\
            update_time='%s', status='%s', category='%s' WHERE djid='%s'"\
            % (pymysql.escape_string(title), pymysql.escape_string(summary)\
            , pymysql.escape_string(createTime), pymysql.escape_string(updateTime)\
            , pymysql.escape_string(status), pymysql.escape_string(category)\
            , pymysql.escape_string(djid))
    execute_sql(cursor, sql);
    return


def insert_passage(cursor, title, summary, status, category, keyword, content, createTime, updateTime):
    insert_content(cursor, title, category, keyword, content)
    insert_info(cursor, title, summary, status, category, createTime, updateTime)
    insert_category(cursor, category)


def update_passage(cursor, title, summary, status, category, keyword, content, createTime, updateTime):
    update_content(cursor, title, category, keyword, content)
    update_info(cursor, title, summary, status, category, createTime, updateTime)
    insert_category(cursor, category)



if __name__ == '__main__':
    basePath = "G:/OneDrive/www/博客文章/"
    ip = ''
    passwd = ''
    if len(sys.argv) == 3:
        ip = sys.argv[1]
        passwd = sys.argv[2]
    uploadedFile = "uploaded.txt"
    uploadPath = basePath + uploadedFile                        # 暂存历史上传文件路径
    uploaded = {}                                               # 已经上传的
    fileList = []                                               # 将要上传或者更新的
    db = pymysql.connect(host=ip, port=3306\
            , user='root', passwd=passwd, db='ltzydmh'\
            , charset='utf8')
    cur = db.cursor()
    load_uploaded_file(uploadedFile, uploadPath, uploaded)
    dir_files(basePath, fileList, uploaded)
    for files, filePath, createTime, updateTime, flag in fileList:
        pasTitle, pasSummary, pasStatus, pasCategory, pasWordkey, pasContent = parse_file(filePath)
        if flag == "insert":
            insert_passage(cur, pasTitle, pasSummary, pasStatus, pasCategory, pasWordkey, pasContent, createTime, updateTime)
        elif flag == "update":
            update_passage(cur, pasTitle, pasSummary, pasStatus, pasCategory, pasWordkey, pasContent, createTime, updateTime)
        else:
            continue
        uploaded[files] = (createTime, updateTime)
    update_summary(cur)
    save_uploaded_file(uploadPath, uploaded)
    cur.close()
    db.close()
    exit (0)
