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
                SELECT 
                    lists.listname,
                    lists.username,
                    lists.description,
                    albums1.cover AS album1_cover,
                    albums2.cover AS album2_cover,
                    albums3.cover AS album3_cover,
                    albums4.cover AS album4_cover,
                    albums5.cover AS album5_cover
                FROM 
                    lists
                LEFT JOIN albums AS albums1 ON lists.album_id1 = albums1.id
                LEFT JOIN albums AS albums2 ON lists.album_id2 = albums2.id
                LEFT JOIN albums AS albums3 ON lists.album_id3 = albums3.id
                LEFT JOIN albums AS albums4 ON lists.album_id4 = albums4.id
                LEFT JOIN albums AS albums5 ON lists.album_id5 = albums5.id
                WHERE lists.username = %s
                ORDER BY
                    lists.list_id DESC
                LIMIT 2;
        '''

        cursor.execute(query, (username,))
        rows = cursor.fetchall()

        lists = []
        for row in rows:
            lists.append({
                "listname": row[0],
                "username": row[1],
                "description": row[2],
                "album1_cover": row[3],
                "album2_cover": row[4],
                "album3_cover": row[5],
                "album4_cover": row[6],
                "album5_cover": row[7]
            })

        lists = json.dumps(lists)

        print(lists)

        conn.commit()

        cursor.close()
        conn.close()

except mysql.connector.Error as err:
    print(f"Error: {err}")
    sys.exit(1)
