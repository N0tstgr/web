from flask import Flask , render_template,request

app = Flask(__name__)

@app.route("/")
def home():
    return render_template("home.html")

@app.route("/submit", methods=["POST"])
def login():
    username = request.form.get("username")
    password = request.form.get("password")

    if username == "Not" and password=="N0t":
        return render_template("welcome.html" ,name = username)

