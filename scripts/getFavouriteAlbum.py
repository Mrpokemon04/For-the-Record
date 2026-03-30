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

        username = sys.argv[1]

        query = '''
                SELECT a.name AS album_name, a.artist, a.cover 
                FROM favourite_album AS fa 
                JOIN albums AS a ON fa.album_id = a.id 
                WHERE fa.username = %s;
        '''

        cursor.execute(query,(username,))

        result = cursor.fetchone()

        album = {
            "name": result[0],
            "artist": result[1],
            "cover": result[2]
        }

        album = json.dumps(album)

        print(album)

        cursor.close()
        conn.close()
        
except mysql.connector.Error as error:
    print("Error connecting to MySQL database:", error)