from flask import Flask

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