from flask import Flask, request, jsonify, g
import sqlite3

app = Flask(__name__)
DATABASE =  "logs.db"

def get_db():
    if 'db' not in g:
        g.db = sqlite3.connect(DATABASE)
    return g.db

def close_db(exception = None):
    db = g.pop('db', None)
    if db is not None:
        db.close()

def setup_databse():
    db = get_db()
    cursor = db.cursor()
    cursor.execute('''
        CREATE TABLE IF NOT EXISTS logs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                context TEXT,
                timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
                message TEXT
               )

    ''')
    
    db.commit()

@app.teardown_appcontext
def teardown_db(exception):
    close_db(exception)

@app.route('/log', methods = ['POST'])
def insert_log():
    data = request.get_json()
    context = data.get('context')
    message = data.get('message')

    if not context or not message:
        return jsonify({'error': 'Context and message are required'}), 400
    
    db = get_db()

    script = '''
            INSERT INTO logs (context, message)
            VALUES (?, ?)
    '''
    
    cursor = db.cursor()
    cursor.execute(script, (context, message))
    db.commit()

    return jsonify({'status': 'Log successfully added'}), 201

@app.route('/logs', methods = ['GET'])
def get_logs():
    db = get_db()

    script = 'SELECT * FROM logs'
    cursor = db.cursor()
    cursor.execute(script)
    logs = cursor.fetchall()

    return jsonify(logs), 200

if __name__ == "__main__":
    with app.app_context():
        setup_databse()

    app.run(host="0.0.0.0", debug=True, port=5010)
