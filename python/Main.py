import paho.mqtt.client as mqtt
import pymysql.cursors
import datetime
import json
import os
import timestamp
import requests


def on_connect(client, userdata, flags, rc):
    # Connect to the database
    global param
    client.subscribe("DEVICE_ADD")
    client.subscribe("DEVICE_UNSUB")
    print("Connect to Broker & subscribe devices:")
    
    url = 'http://localhost:8000/api/historyapi'
    r = requests.get(url = url) 
    data = r.json()
    for item in data: 
        print("%s" % (item['dev']) + "_PM")
        client.subscribe(("%s" % (item['dev']) + "_PM"))


def on_message(client, userdata, msg):
    # print("topics", msg.payload)
    strMsg = str(msg.payload).split("~")
    strTpk = str(msg.topic).split("_")

    times = datetime.datetime.now()  # datetime
    TGL = str(times.date())
    HR = str(times.strftime("%X"))
    waktusplit = HR.split(":")
    jamdoang = waktusplit[0]
    DT = TGL + " " + HR
    DTA = TGL.replace("-", "")
    TMS = HR.replace(":", "")
    IDS = DTA+TMS
    bs = TGL.split("-")
    BLN = str(bs[0]) + "-" + str(bs[1])

    if strTpk[1] == "PM":
        DEV = strMsg[0]
        AR1 = strMsg[1]
        AS1 = strMsg[2]
        AT1 = strMsg[3]
        AR2 = strMsg[4]
        AS2 = strMsg[5]
        AT2 = strMsg[6]
        VR1 = strMsg[7]
        VS1 = strMsg[8]
        VT1 = strMsg[9]
        VR2 = strMsg[10]
        VS2 = strMsg[11]
        VT2 = strMsg[12]

        dts = datetime.datetime.now()
        print("------------------------------------")
        insert_data_PM(IDS, DEV, float(AR1), float(AS1), float(AT1), float(AR2), float(AS2), float(AT2), float(VR1), float(VS1), float(VT1), float(VR2), float(VS2), float(VT2), dts)
        on_connect()

    if strTpk[1] == "ADD":
        client.subscribe(str(msg.payload)+'_PM')
        # print(str(msg.payload))
        DEV = str(msg.payload)
        update_device(DEV)

    if strTpk[1] == "UNSUB":
        client.unsubscribe(str(msg.payload)+'_PM')
        # print(str(msg.payload))
        DEV = str(msg.payload)
        update_device_un(DEV)

def update_device(DEV):
    url = 'http://localhost:8000/api/deviceapi'

    data = {
        'dev':DEV,
        'status':'subscribe'
        } 

    r = requests.post(url = url, data = data) 
    
    pastebin_url = r.text 
    print(pastebin_url) 

def update_device_un(DEV):
    url = 'http://localhost:8000/api/deviceapi'

    data = {
        'dev':DEV,
        'status':'not subscribe'
        } 

    r = requests.post(url = url, data = data) 
    
    pastebin_url = r.text 
    print(pastebin_url) 

def insert_data_PM(IDS, DEV, AR1, AS1, AT1, AR2, AS2, AT2, VR1, VS1, VT1, VR2, VS2, VT2, DT):
    url = 'http://localhost:8000/api/historyapi'

    data = {
        'dev':DEV,
        'kwh1_ar':AR1, 'kwh1_as':AS1, 'kwh1_at':AT1, 'kwh1_vr':VR1,'kwh1_vs':VS1, 'kwh1_vt':VT1,
        'kwh2_ar':AR2, 'kwh2_as':AS2, 'kwh2_at':AT2, 'kwh2_vr':VR2,'kwh2_vs':VS2, 'kwh2_vt':VT2,
        } 

    r = requests.post(url = url, data = data) 

    pastebin_url = r.text 
    print("The pastebin URL is:%s"%pastebin_url) 

client = mqtt.Client()
client.on_connect = on_connect
client._on_message = on_message
client.connect("mqtt.grahamitrateguh.com", 1883, 60)

client.loop_forever()
