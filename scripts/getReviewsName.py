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
            SELECT a.cover, r.rating
            FROM ratings r
            JOIN albums a ON r.album_id = a.id
            WHERE r.username = %s
            LIMIT 3;
        '''

        cursor.execute(query, (username,))
        rows = cursor.fetchall()

        ratings = []
        for row in rows:
            ratings.append({
                "album_cover": row[0],
                "rating": row[1]
            })

        ratings = json.dumps(ratings)

        print(ratings)

        conn.commit()

        cursor.close()
        conn.close()

except mysql.connector.Error as err:
    print(f"Error: {err}")
    sys.exit(1)
