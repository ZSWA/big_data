import csv
import happybase

def create_table(table_name):
    connection = happybase.Connection('localhost', 9090)

    # Create table if not exists
    connection.create_table(
        table_name,
        {
            'info': dict()
        }
    )

    connection.close()

def import_csv_to_hbase():
    connection = happybase.Connection('localhost', 9090)

    users = connection.table('users')
    books = connection.table('books')
    ratings = connection.table('ratings')

    users_csv = 'csv_data/users.csv'
    books_csv = 'csv_data/books.csv'
    ratings_csv = 'csv_data/ratings.csv'

    with open(users_csv, 'r') as file:
        csv_reader = csv.DictReader(file)

        for row in csv_reader:
            row_key = row['']
            uid = row['User-ID']
            loc = row['Location']
            age = row['Age']

            # Convert variables to bytes if needed
            row_key_bytes = str(row_key).encode('utf-8')
            uid_bytes = str(uid).encode('utf-8')
            loc_bytes = str(loc).encode('utf-8')
            age_bytes = str(age).encode('utf-8')

            # Insert data into HBase using variables
            users.put(
                row_key_bytes,
                {b'info:User-ID': uid_bytes, b'info:Location': loc_bytes, b'info:Age': age_bytes}
            )
    
    with open(books_csv, 'r') as file:
        csv_reader = csv.DictReader(file)

        for row in csv_reader:
            row_key = row['']
            bid = row['ISBN']
            title = row['Book-Title']
            author = row['Book-Author']
            year = row['Year-Of-Publication']
            publisher = row['Publisher']
            image_url_s = row['Image-URL-S']
            image_url_m = row['Image-URL-M']
            image_url_l = row['Image-URL-L']

            # Convert variables to bytes if needed
            row_key_bytes = str(row_key).encode('utf-8')
            bid_bytes = str(bid).encode('utf-8')
            title_bytes = str(title).encode('utf-8')
            author_bytes = str(author).encode('utf-8')
            year_bytes = str(year).encode('utf-8')
            publisher_bytes = str(publisher).encode('utf-8')
            image_url_s_bytes = str(image_url_s).encode('utf-8')
            image_url_m_bytes = str(image_url_m).encode('utf-8')
            image_url_l_bytes = str(image_url_l).encode('utf-8')

            # Insert data into HBase using variables
            books.put(
                row_key_bytes,
                {b'info:ISBN': bid_bytes, b'info:Book-Title': title_bytes, b'info:Book-Author': author_bytes, b'info:Year-Of-Publication': year_bytes, b'info:Publisher': publisher_bytes, b'info:Image-URL-S': image_url_s_bytes, b'info:Image-URL-M': image_url_m_bytes, b'info:Image-URL-L': image_url_l_bytes}
            )

    with open(ratings_csv, 'r') as file:
        csv_reader = csv.DictReader(file)

        for row in csv_reader:
            row_key = row['']
            uid = row['User-ID']
            bid = row['ISBN']
            rating = row['Book-Rating']

            # Convert variables to bytes if needed
            row_key_bytes = str(row_key).encode('utf-8')
            uid_bytes = str(uid).encode('utf-8')
            bid_bytes = str(bid).encode('utf-8')
            rating_bytes = str(rating).encode('utf-8')

            # Insert data into HBase using variables
            ratings.put(
                row_key_bytes,
                {b'info:User-ID': uid_bytes, b'info:ISBN': bid_bytes, b'info:Book-Rating': rating_bytes}
            )       

    # table.put(b'1', {b'info:User-ID': b'1', b'info:Location': b'New York', b'info:Age': b'24'})
    connection.close()

if __name__ == "__main__":
    create_table('users')
    create_table('books')
    create_table('ratings')

    import_csv_to_hbase()