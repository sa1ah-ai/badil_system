import mysql.connector

class BadilDB:
    def __init__(self):
        self.host = "localhost"
        self.username = "root"
        self.password = ""
        self.database = "badil_mansa"
        self.conn = None

    def __enter__(self):
        self.connect()
        return self

    def __exit__(self, exc_type, exc_val, exc_tb):
        self.close()

    def connect(self):
        self.conn = mysql.connector.connect(
            host=self.host,
            user=self.username,
            password=self.password,
            database=self.database
        )
        return self

    def close(self):
        if self.conn:
            self.conn.close()

    def execute_insert(self, query, params):
        cursor = self.conn.cursor()
        cursor.execute(query, params)
        cursor.close()

    def execute_query(self, query):
        cursor = self.conn.cursor()
        cursor.execute(query)
        res = cursor.fetchone()
        cursor.close()
        return res[0], res[1], res[2], res[3]

    def fetch_case_details(self):
        query = f"SELECT case_id , crime_type ,crime_category,crime_details FROM case_details ORDER BY case_details_id DESC LIMIT 1"
        return self.execute_query(query)

    def insert_ruling(self, data):
        query = f"INSERT INTO ruling_report (alternative_judgment,explanation,case_id) VALUES (%s, %s, %s)"
        self.execute_insert(query, data)
        self.conn.commit()

