from database.badil_DB import BadilDB

class RulingData:
    def __init__(self):
        self.case_id = None
        self.alternative = None
        self.explanation = None
        self.crime_type = None
        self.crime_category = None
        self.crime_details = None
        self.badilDb = BadilDB().connect()
        self.caseInfo = None
        self.getLastCaseDetails()

    def getLastCaseDetails(self):
        self.caseInfo = self.badilDb.fetch_case_details()
        self.case_id = self.caseInfo[0]
        self.crime_type = self.caseInfo[1]
        self.crime_category = self.caseInfo[2]
        self.crime_details = self.caseInfo[3]

    def setRuling(self): # row is a tuple type
        row = (self.alternative,self.explanation,self.case_id)
        self.badilDb.insert_ruling(row)

    def setData(self,alternative,explanation=None):
        self.alternative =alternative
        self.explanation = explanation

    def getCrimeDetails(self):
        return self.crime_details

    def getCrimeType(self):
        return self.crime_type

    def getCrimeCategory(self):
        return self.crime_category




