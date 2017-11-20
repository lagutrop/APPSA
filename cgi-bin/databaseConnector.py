#!/usr/bin/env python
# -*- coding: utf-8 -*- 
'''
Created on 05/10/2017

@author: tiago
'''

import MySQLdb
import _mysql_exceptions

class Database:
    def __init__(self, host, user, pw, db):
        self.host = host
        self.user = user
        self.pw = pw
        self.db = db
        
def databaseConnect():
    #Setup initial variables
    db1 = Database('localhost', 'ceo_appsa', 'ceo_appsa', 'appsa')
    
    #Database connection
    database = MySQLdb.connect(host=db1.host, user=db1.user, passwd=db1.pw, db=db1.db, use_unicode=True, charset='utf8')
    return database
    
def getSocio(identifier):
    name_parsed = identifier.replace("%20", " ")
    database = databaseConnect()
    cursor = database.cursor()
    cursor.execute("""SELECT * FROM socio WHERE id = concat(%s) or nome = %s""", (name_parsed, name_parsed))
    socio = cursor.fetchall()
    database.close()
    return socio
    
def addSocio(identifier, name, region, payment_date, expire_date):
    database = databaseConnect()
    cursor = database.cursor()
    try:
        cursor.execute("""INSERT INTO socio (id, nome, regiao, data_pagamento, data_expira) VALUES(%s, %s, %s, %s, %s)""", (identifier, name, region, payment_date, expire_date))
        cursor.execute("COMMIT")
    except (_mysql_exceptions.OperationalError, _mysql_exceptions.IntegrityError) as error:
        database.close()
        switch = {
            _mysql_exceptions.OperationalError: "Por favor insira um número" , 
            _mysql_exceptions.IntegrityError: "Número de sócio repetido"
            }
        print(switch[type(error)])
        return False
    database.close()
    return True
    
def removeSocio(identifier):
    database = databaseConnect()
    cursor = database.cursor()
    cursor.execute("""DELETE FROM socio where id = %s""", (identifier,))
    cursor.execute("COMMIT")
    database.close()
    
def updateSocio(identifier, name, region, payment_date, expire_date):
    database = databaseConnect()
    cursor = database.cursor()
    cursor.execute("""UPDATE socio set nome=%s, regiao=%s, data_pagamento=%s, data_expira=%s where id = %s""", (name, region, payment_date, expire_date, identifier))
    cursor.execute("COMMIT")        
    database.close()
    
def getAllSocios():
    database = databaseConnect()
    cursor= database.cursor()
    cursor.execute("""SELECT * FROM socio""")
    socios = cursor.fetchall()
    database.close()
    return socios