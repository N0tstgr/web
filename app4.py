from flask import Flask,  redirect,request, url_for, session, Response,render_template

app = Flask(__name__)
app.secret_key = "supersecret"

@app.route("/", methods=["GET", "POST"])
def login():
    if request.method == "POST":
        username = request.form.get("username")
        password = request.form.get("password")

        if username == "admin" and password =="123":
            session["user"] = username #store in session
            return render_template("home.html")
            return Response("IN-valid credentials. Try again", mimetype = "text/plain")

    return '''
<h2> Login Page </h2>
<form method = "POST">
Username: <input type="text" name="username" ><br>
Password: <input type="text" name="password"><br>
<input type="submit" value="Login">
</form>
'''

#welcome page after login
@app.route("/welcome")
def welcome():
    if "user" in session:
        return f'''
<h2>Welcome, {session["user"]}!</h2>
<a href={url_for('logout')}>Logout</a>
'''
    
    return redirect(url_for("login"))

#logout route
@app.route("/logout")
def logout():
    session.pop("user", None)
    return redirect(url_for("login"))   

#Project 1 done