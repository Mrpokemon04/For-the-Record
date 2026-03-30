import mysql.connector # type: ignore
import sys

try:
    conn = mysql.connector.connect(
        user='root',
        database='for the record!'
    )
    if conn.is_connected():
        cursor = conn.cursor()

        username = sys.argv[1]
        password = sys.argv[2]

        cursor.execute('SELECT * FROM `users` WHERE BINARY `username`=%s AND `password`=%s', (username, password))
        result = cursor.fetchone()

        if result:
            print("1")
        else:
            print("2")

        conn.commit()

        cursor.close()
        conn.close()
        
except mysql.connector.Error as error:
    print("Error connecting to MySQL database:", error)