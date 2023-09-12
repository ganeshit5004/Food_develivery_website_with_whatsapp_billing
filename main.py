
from flask import Flask,render_template,request


app=Flask(__name__)

@app.route('/')
def home():
    return render_template('register.html')

@app.route('/send')
def wa():
    filename = 'demo.py'
    with open(filename) as f:
        exec(f.read())
    return render_template("final.html")

@app.route('/whats')
def y():
    filename = 'info.py'
    with open(filename) as f:
        exec(f.read())
    return render_template("manage.html")


if __name__=='__main__':
    app.run(debug=True)
