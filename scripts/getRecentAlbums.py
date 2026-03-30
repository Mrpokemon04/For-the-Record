import mysql.connector # type: ignore
import json

try:
    conn = mysql.connector.connect(
        user='root',
        database='for the record!'
    )
    if conn.is_connected():
        cursor = conn.cursor()

        cursor.execute('SELECT `cover`, `name`, `artist` FROM `albums` ORDER BY `id` DESC LIMIT 6')
        results = cursor.fetchall()

        albums = []
        for cover, name, artist in results:
            albums.append({'cover': cover, 'name': name, 'artist': artist})

        print(json.dumps(albums))

        cursor.close()
        conn.close()
        
except mysql.connector.Error as error:
    print("Error connecting to MySQL database:", error)