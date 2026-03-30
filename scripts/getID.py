import mysql.connector # type: ignore
import sys

try:
    conn = mysql.connector.connect(
        user='root',
        database='for the record!'
    )
    if conn.is_connected():
        cursor = conn.cursor()

        name = sys.argv[1]

        cursor.execute('SELECT `id` FROM `albums` WHERE `name`=%s', (name,))
        result = cursor.fetchone()

        print(result[0])

        cursor.close()
        conn.close()
        
except mysql.connector.Error as error:
    print("Error connecting to MySQL database:", error)