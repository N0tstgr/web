from flask import Flask, render_template

app = Flask(__name__)

@app.route("/")
def home():
    return render_template("home.html")

@app.route("/about")
def about():
    return render_template("about.html")

@app.route("/Login")
def Login():
    return render_template("Login.html")

@app.route("/Product.html")
def Product():
    return render_template("Product.html")

   
