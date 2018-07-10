#!/usr/bin/python
# -*- coding: utf-8 -*-

def tsplit(string, delimiters):
    """Behaves str.split but supports multiple delimiters."""

    delimiters = tuple(delimiters)
    stack = [""] # stack to return

    for i in xrange(len(string)):
        if string[i] in delimiters:
            stack.append("")
        else:
            stack[-1] += string[i]

    return stack


from difflib import SequenceMatcher

#renvoie le pourcentage de similarité entre deux chaines
def similar(a, b):
    return SequenceMatcher(None, a, b).ratio()

# renvoie vrai si les 2 chaines sont similaires a plus de 80%
def highsimilar(a,b):
    if similar(a,b)>=0.8:
        return True

def veryHighSimilar(a,b):
    if similar(a,b)>=0.95:
        return True

#convertit un temps au format date vers le format décimal
def timeToDecimal(time):
    if ':' in time:
        (h, m, s) = time.split(':')
        result = (int(h) * 3600 + int(m) * 60 + int(s)) / 3600
        return str(result)
    elif time==' ' or time==0 or time=='' or time=='0':
        return 'NULL'
    else:
        return str(time)

def secondsToDecimal(seconds):
    seconds = int(seconds)
    if seconds < 60:
        return str(seconds)
    elif seconds < 3600:
        minutes = seconds // 60
        seconds = seconds - 60*minutes
        return str(minutes)+':'+str(seconds)
    else:
        hours = seconds // 3600
        minutes = (seconds - 3600*hours) // 60
        seconds = seconds - 3600*hours - 60*minutes
        return str(hours)+':'+str(minutes)+':'+str(seconds)

#convertit aaaa-mm-jj hh:mm:ss vers hh:mm:ss
def dateTimeToTime(date):
    return "'"+str(date.split(' ')[-1].strip("'"))+"'"

def datetimeToDuree(datetime):
    if "'" in datetime:
        datetime = datetime.replace("'","")
    duree=datetime.split(" ")[-1]
    # print(duree)
    if ':' in duree:
        (h,m,s) = duree.split(':')
        return str(int(h)*3600 + int(m)*60 + int(s))
    else: return 'NULL'
