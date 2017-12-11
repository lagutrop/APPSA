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
    db1 = Database('localhost', 'appsa_admin', 'appsa_admin', 'appsa')
    
    #Database connection
    database = MySQLdb.connect(host=db1.host, user=db1.user, passwd=db1.pw, db=db1.db, use_unicode=True, charset='utf8')
    return database
    
def getSocio(identifier):
    name_parsed = identifier.replace("%20", " ")
    database = databaseConnect()
    cursor = database.cursor()
    cursor.execute("""SELECT quota FROM socio WHERE numero_socio = concat(%s)""", (name_parsed))
    socio = cursor.fetchall()
    database.close()
    return socio
    
def getAllSocios():
    database = databaseConnect()
    cursor= database.cursor()
    cursor.execute("""SELECT quota FROM socio""")
    socios = cursor.fetchall()
    database.close()
    return socios