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
        listname = sys.argv[2]
        description = sys.argv[3]
        albums_json = sys.argv[4]

        albums = json.loads(albums_json)

        cursor.execute("INSERT INTO lists (username, listname, description, album_id1, album_id2, album_id3, album_id4, album_id5) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)", (username, listname, description, albums[0], albums[1], albums[2], albums[3], albums[4]))

        conn.commit()

        cursor.close()
        conn.close()

except mysql.connector.Error as err:
    print(f"Error: {err}")
    sys.exit(1)