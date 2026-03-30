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
        email = sys.argv[2]
        password = sys.argv[3]
        displayname = sys.argv[4]
        gender = sys.argv[5]
        dateofbirth = sys.argv[6]
        bio = sys.argv[7].replace("{{{newline}}}", "\n")
        avatar = sys.argv[8]

        cursor.execute('INSERT INTO `users` (`username`, `email`, `password`, `displayname`, `gender`, `dateofbirth`, `bio`, `avatar`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)', (username, email, password, displayname, gender, dateofbirth, bio, avatar))

        conn.commit()

        cursor.close()
        conn.close()

except mysql.connector.Error as err:
    print(f"Error: {err}")
    sys.exit(1)