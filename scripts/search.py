import mysql.connector # type: ignore
import sys
import json

try:
    conn = mysql.connector.connect(
        user='root',
        database='for the record!'
    )
    if conn.is_connected():
        cursor = conn.cursor()

        query = sys.argv[1]

        cursor.execute('SELECT `name`, `artist`, `cover` FROM `albums` WHERE name LIKE %s OR artist LIKE %s', ('%' + query + '%', '%' + query + '%'))
        rows = cursor.fetchall()

        results = []
        for row in rows:
            results.append({
                "name": row[0],
                "artist": row[1],
                "cover": row[2]
            })

        print(json.dumps(results))

        cursor.close()
        conn.close()
        
except mysql.connector.Error as error:
    print("Error connecting to MySQL database:", error)