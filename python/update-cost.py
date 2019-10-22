
import pymysql.cursors
import datetime
import json
import os, time
import time
import timestamp


def ulang():
    while True:
        data_today()
        time.sleep(55)


def data_today():
    connect_db()
    times = datetime.datetime.now()  # datetime
    TGL = str(times.date())
    HR = str(times.strftime("%X"))

    print("STARTING TIME :"+HR )
    with connection.cursor() as cursor:
        query = "SELECT * FROM devices"
        cursor.execute(query)
        result = cursor.fetchall()

        for row in result:
            DEV= row['dev']
            call_cost(DEV, TGL)
            cursor.close
    print("ENDED TIME : "+datetime.datetime.now().strftime("%X"))
    print("----------------------------------")

def call_cost(DEV, TGL): 
    with connection.cursor() as cursor2:
        query = "SELECT (((SELECT AVG(kwh1_ar) * AVG(kwh1_vr) FROM histories where dev = '"+DEV+"' and DATE(created_at)='"+TGL+"')*HOUR(TIMEDIFF('00:00:00', TIME(created_at)))/1000)*1450) AS AR1COST,\
                    (((SELECT AVG(kwh1_as) * AVG(kwh1_vs) FROM histories where dev = '"+DEV+"' and DATE(created_at)='"+TGL+"')*HOUR(TIMEDIFF('00:00:00', TIME(created_at)))/1000)*1450) AS AS1COST, \
                    (((SELECT AVG(kwh1_at) * AVG(kwh1_vt) FROM histories where dev = '"+DEV+"' and DATE(created_at)='"+TGL+"')*HOUR(TIMEDIFF('00:00:00', TIME(created_at)))/1000)*1450) AS AT1COST, \
	                (((SELECT AVG(kwh2_ar) * AVG(kwh2_vr) FROM histories where dev = '"+DEV+"' and DATE(created_at)='"+TGL+"')*HOUR(TIMEDIFF('00:00:00', TIME(created_at)))/1000)*1450) AS AR2COST,\
                    (((SELECT AVG(kwh2_as) * AVG(kwh2_vs) FROM histories where dev = '"+DEV+"' and DATE(created_at)='"+TGL+"')*HOUR(TIMEDIFF('00:00:00', TIME(created_at)))/1000)*1450) AS AS2COST, \
                    (((SELECT AVG(kwh2_at) * AVG(kwh2_vt) FROM histories where dev = '"+DEV+"' and DATE(created_at)='"+TGL+"')*HOUR(TIMEDIFF('00:00:00', TIME(created_at)))/1000)*1450) AS AT2COST \
                FROM \
	                histories where dev = '"+DEV+"' and DATE(created_at)='"+TGL+"'  ORDER BY TIME(created_at) DESC LIMIT 1;"
        cursor2.execute(query)
        result = cursor2.fetchall()

        for row in result:
            AR1COST = row['AR1COST']
            AS1COST = row['AS1COST']
            AT1COST = row['AT1COST']
            AR2COST = row['AR2COST']
            AS2COST = row['AS2COST']
            AT2COST = row['AT2COST']
            with connection.cursor() as cursor3:
                query = "UPDATE sensors set kwh1_cost_r=%s, kwh1_cost_s=%s, kwh1_cost_t=%s, kwh2_cost_r=%s, kwh2_cost_s=%s, kwh2_cost_t=%s WHERE dev = %s AND DATE(created_at)=%s"
                cursor3.execute(query, (AR1COST, AS1COST, AT1COST, AR2COST, AS2COST, AT2COST, DEV, TGL))
                connection.commit()
                print('\tBiaya device '+DEV+' Berhasil diperbaharui')
                #print(DEV,"\t\tR1\tS1\tT1\tR2\tS2\tT2\nBIAYA   : \t"+str(AR1COST)+"\t"+str(AS1COST)+"\t"+str(AT1COST)+"\t"+str(AS2COST)+"\t"+str(AS2COST)+"\t"+str(AT2COST)+"\nTANGGAL\t"+ " : "+TGL)
                cursor3.close
        
        cursor2.close

def connect_db():
    global connection
    try:
        connection = pymysql.connect(host='localhost',
                                     user='root',
                                     password='root',
                                     db='dbs_powermeter',
                                     charset='utf8',
                                     cursorclass=pymysql.cursors.DictCursor)
    except :
        print ("Koneksi Database Gagal")


connect_db()
#data_today()
ulang()