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

        query = '''
            SELECT 
                albums.name AS album_name,
                albums.artist AS artist_name,
                albums.cover AS album_cover,
                ratings.username,
                ratings.rating,
                ratings.review
            FROM 
                ratings
            LEFT JOIN albums ON ratings.album_id = albums.id
            ORDER BY
                ratings.id DESC
            LIMIT 3;
        '''

        cursor.execute(query)
        rows = cursor.fetchall()

        reviews = []
        for row in rows:
            reviews.append({
                'album_name': row[0],
                'artist_name': row[1],
                'album_cover': row[2],
                'username': row[3],
                'rating': row[4],
                'review': row[5]
            })

        reviews = json.dumps(reviews)

        print(reviews)

        conn.commit()

        cursor.close()
        conn.close()

except mysql.connector.Error as err:
    print(f"Error: {err}")
    sys.exit(1)
