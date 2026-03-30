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
        albumid = sys.argv[2]
        rating = sys.argv[3]
        review = sys.argv[4].replace("{{{newline}}}", "\n")
        
        cursor.execute('INSERT INTO ratings (username, album_id, rating, review) VALUES (%s, %s, %s, %s) ON DUPLICATE KEY UPDATE rating = %s, review = %s', (username, albumid, rating, review, rating, review))

        conn.commit()

        cursor.close()
        conn.close()

except mysql.connector.Error as err:
    print(f"Error: {err}")
    sys.exit(1)