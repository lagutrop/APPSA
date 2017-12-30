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
        dictSocios["numero_socio"] = str(key[0])
        dictSocios["quota"] = str(key[1])
        dictSocios["data_pagamento"] = str(key[2])
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