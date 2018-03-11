#!/bin/env python
#-*- coding=utf-8 -*-

import pymysql





if __name__ == '__main__':
    conn = pymysql.connect(host='127.0.0.1', port=3306, user='root', passwd='root', db='mysql', charset='utf8')
    cur = conn.cursor()
    #global 

    '''
    cur.execute('select version()')
    for i in cur:
        print(i)
    '''


    cur.close()
    conn.close()
    exit (0)