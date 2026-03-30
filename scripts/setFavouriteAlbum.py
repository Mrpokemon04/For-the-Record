import mysql.connector # type: ignore
import sys

print(sys.argv[1] + " " + sys.argv[2])

try:
    conn = mysql.connector.connect(
        user='root',
        database='for the record!'
    )
    if conn.is_connected():
        cursor = conn.cursor()

        username = sys.argv[1]
        album_id = sys.argv[2]

        cursor.execute('DELETE FROM `favourite_album` WHERE `username` = %s', (username,))

        cursor.execute('INSERT INTO `favourite_album`(`username`, `album_id`) VALUES (%s, %s)', (username, album_id))

        conn.commit()

        cursor.close()
        conn.close()
        
except mysql.connector.Error as error:
    print("Error connecting to MySQL database:", error)