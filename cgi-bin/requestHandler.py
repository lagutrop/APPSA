'''
Created on 05/10/2017

@author: tiago
'''
import databaseConnector
import json

def tupleParser(tup):
    arraySocios = []
    for key in tup:
        dictSocios = {}
        dictSocios["id"] = str(key[0])
        dictSocios["nome"] = str(key[1])
        dictSocios["local"] = str(key[2])
        dictSocios["data_pagamento"] = str(key[3])
        dictSocios["data_expira"] = str(key[4])
        arraySocios.append(dictSocios)
    return arraySocios

def getSocio(identifier):
    tuples = databaseConnector.getSocio(identifier)
    jsonTuples = tupleParser(tuples)
    return jsonTuples

def getSocios():
    tuples=databaseConnector.getAllSocios()
    jsonTuples = tupleParser(tuples)
    return jsonTuples

if __name__ == '__main__':
    import sys
    if len(sys.argv) > 1:
        print(json.dumps(getSocio(sys.argv[1])))
    else:
        print(json.dumps(getSocios()))