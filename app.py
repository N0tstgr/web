from flask import Flask,  redirect,request, url_for, session, Response

app = Flask(__name__)

@app.route("/", methods=["GET", "POST"])
def login():
    if request.method == "POST":
        username = request.form.get("username")
        password = request.form.get("password")

        if username == "admin" and password =="123":
            session["user"] = username #store in session
            return redirect(url_for("welcome"))
        else:
            return Response("IN-valid credentials. Try again", mimetype = "text/plain")

    return '''
<h2> Login Page <h2>
<form method = "POST"
Username: <input type="text" name="username"><br>
Password: <input type="text" name=password"><br>
<input type="submit" value="Login">

'''
