from flask import Flask, request

app = Flask(__name__)

@app.route("/")
def home():
    return 'Hello user ! this is my first flask app'

@app.route("/about")
def aboutus():
    return 'we provide the best solutions for your problems'

@app.route("/contact")
def contact():
    return 'contact us for your queries'

@app.route("/login")
def login():
    return 'login/register on this page'

@app.route("/submit", methods = ["GET", "POST"])
def submit():
    if request.method== "POST":
     return " you send data"
    else:
      return  "you are only viewing the form"