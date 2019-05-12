import mysql.connector
from mysql.connector import Error

def muchAnumOfBins(N,binData):

    step=0.0000001
    bins= []
    bins.append(binData[0][0])
    lastOne = binData[0][1:3]
    del binData[0]
    for _ in range(1,N):
        newRoot=None
        rang=step
        while newRoot==None:
            for i, bin in enumerate(binData):
                if lastOne[0]-rang<= bin[1] <= lastOne[0]+rang and lastOne[1]-rang <= bin[2] <= lastOne[1]+rang:
                    newRoot= bin[0]
                    lastOne= bin[1:3]
                    del binData[i]
                    break
                else:
                    rang+= step
        bins.append(newRoot)
    return binData, bins



def main():
    connection=None
    cursor=None
    try:
        connection = mysql.connector.connect(host='172.16.220.200',
                                 database='smartbin',
                                 user='vavamis',
                                password="")
        if connection.is_connected():
            cursor = connection.cursor()
            cursor.execute("SELECT id,latitude,longitude,volume FROM bins WHERE volume>=45.0;")
            binData= sorted(cursor.fetchall(),key=lambda x :x[3],reverse=True)
            routes=[]
            appentedBins=[]
            cursor.execute("SELECT user_id FROM routes ;")
            existingRoutes = cursor.fetchall()
            cursor.execute("SELECT id FROM users;")
            users = cursor.fetchall()
            availableCars=[]
            for usr in users:
                if usr not in existingRoutes:
                    availableCars.append(usr[0])
            availableCarsNum= len(availableCars)
            if availableCarsNum <= len(binData)//10:
                numOfRoutes= availableCarsNum
            else :
                numOfRoutes= len(binData)//10
            for _ in range(numOfRoutes):
                binData, bins = muchAnumOfBins(10, binData)
                cursor.execute(
                    "INSERT INTO routes (user_id, bin1, bin2, bin3, bin4, bin5, bin6, bin7, bin8, bin9, bin10) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
                    (availableCars[-1], bins[0], bins[1], bins[2], bins[3], bins[4], bins[5], bins[6], bins[7], bins[8], bins[9],))
                del availableCars[-1]
                connection.commit()
                routes.append(bins)
                for r in routes[-1]:
                    appentedBins.append(r)
    except Error as e :
        print ("Error while connecting to MySQL", e)

    finally:
        #closing database connection.
        if connection and (connection.is_connected()):
            cursor.close()
            connection.close()
        print("MySQL connection is closed")

#
if __name__ == '__main__':
    main()