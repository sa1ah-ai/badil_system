# -*- coding: utf-8 -*-
import os,sys
path = os.path.dirname(os.path.dirname(__file__))
sys.path.append(path)
from ai.ai_work import *
from database.ruling_Data import RulingData
import re
# sys.path.append('C:/xampp/htdocs/badil_system_v6/')

def main():
    db = RulingData()
    crime =''
    if db.crime_category == 'أخرى':
        crime =db.crime_details
    else:
        crime = db.crime_category + " " + db.crime_type + " " + db.crime_details
    category = classify(crime)
    alternative = getAlternative(category)
    print("الجريمة : ", category)
    print("البديل : ", alternative)
    db.setData(alternative,category)
    db.setRuling()

if __name__ == '__main__':
    main()


