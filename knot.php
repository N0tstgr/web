
<?php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnviroHealth - Smart Environment, Safer You</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        :root {
            --primary-color: #2c7873;
            --secondary-color: #6fb98f;
            --accent-color: #004445;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .navbar {
            background-color: var(--primary-color);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 5rem 0;
        }

        .feature-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        #map {
            height: 400px;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .risk-score {
            font-size: 3rem;
            font-weight: bold;
            color: var(--accent-color);
        }

        footer {
            background-color: var(--accent-color);
            color: white;
            padding: 2rem 0;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <style>
                #brandName {
                    font-size: 1.75rem;
                    font-weight: 800;
                    color: #FFFAFA;
                    /* Snow white */
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    transition: transform 0.3s ease, opacity 0.3s ease;
                    cursor: pointer;
                }

                #brandName:hover {
                    transform: scale(1.05);
                    opacity: 0.85;
                }
            </style>

            <a class="navbar-brand" id="brandName" href="#">EnviroHealth</a>




            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#map-section">Map</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Smart Environment, Safer You</h1>
            <p class="lead mb-5">Real-time environmental monitoring for Greater Noida to predict health risks and
                suggest safety measures</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-light btn-lg px-4 gap-3">Get Started</button>
               
               <style>
               
               .hero {
  background: linear-gradient(to right, #10b981, #059669);
  padding: 100px 20px;
  color: #fff;
  text-align: center;
}

.hero-content h1 {
  font-size: 3rem;
  font-weight: 800;
  margin-bottom: 20px;
}

.subtext {
  font-size: 1.2rem;
  margin-bottom: 30px;
  max-width: 700px;
  margin-left: auto;
  margin-right: auto;
}

.buttons {
  display: flex;
  justify-content: center;
  gap: 20px;
}

.btn {
  padding: 12px 24px;
  font-weight: 600;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn.primary {
  background-color: #ffffff;
  color: #059669;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.btn.primary:hover {
  background-color: #e5e7eb;
}

.btn.secondary {
  border: 2px solid #fff;
  color: #fff;
}

.btn.secondary:hover {
  background-color: rgba(255,255,255,0.1);
}
</style>
                <button type="button" class="btn btn-outline-light btn-lg px-4">Learn More</button>



            </div>
        </div>
    </section>

<!-- Risk Score Section -->
<section class="py-5">
  <div class="container text-center">
    <style>
      .good { color: green; }
      .moderate { color: orange; }
      .unhealthy { color: orangered; }
      .very-unhealthy { color: red; }
      .hazardous { color: purple; }
    </style>

    <h2 class="mb-4">Air Quality Index</h2>
    <p id="aqi-status">Loading...</p>

    <script>
      const token = "YOUR_API_TOKEN"; // 🔴 Replace with your real AQICN API token
      const city = "greater noida";

      function getColor(aqi) {
        if (aqi <= 50) return { status: "Good", class: "good" };
        if (aqi <= 100) return { status: "Moderate", class: "moderate" };
        if (aqi <= 150) return { status: "Unhealthy for Sensitive Groups", class: "unhealthy" };
        if (aqi <= 200) return { status: "Unhealthy", class: "very-unhealthy" };
        if (aqi <= 300) return { status: "Very Unhealthy", class: "very-unhealthy" };
        return { status: "Hazardous", class: "hazardous" };
      }

      fetch(`https://api.waqi.info/feed/${Greater noida}/?token=${}`)
        .then(res => res.json())
        .then(data => {
          if (data.status === "ok") {
            const aqi = data.data.aqi;
            const { status, class: statusClass } = getColor(aqi);
            const aqiElement = document.getElementById("aqi-status");
            aqiElement.textContent = `AQI: ${aqi} (${status})`;
            aqiElement.className = statusClass;
          } else {
            document.getElementById("aqi-status").textContent = "Data not available";
          }
        })
        .catch(err => {
          console.error("Fetch error:", err);
          document.getElementById("aqi-status").textContent = "Error loading AQI";
        });
    </script>

    <div class="risk-score mb-3">72</div>
    <p class="text-muted">Moderate Risk - Consider wearing a mask outdoors today</p>
    <div class="progress" style="height: 20px;">
      <div class="progress-bar bg-success" role="progressbar" style="width: 25%"></div>
      <div class="progress-bar bg-warning" role="progressbar" style="width: 25%"></div>
      <div class="progress-bar bg-danger" role="progressbar" style="width: 50%"></div>
    </div>
  </div>
</section>


    <!-- Map Section -->
    <section id="map-section" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Greater Noida Environmental Map</h2>
            <div id="map"></div>
            <div class="text-center mt-3">
                <button class="btn btn-primary me-2">Report Hazard</button>
                <button class="btn btn-outline-primary">View Community Reports</button>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="about" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Key Benefits</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Public Health Awareness</h3>
                            <p class="card-text">Centralizes real-time data about air, water, food, and environmental
                                conditions, educating citizens about daily health risks around them.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Preventive Action</h3>
                            <p class="card-text">Empowers users to make smart, informed decisions – like avoiding
                                certain areas, using protective measures, or reporting hazards.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">For Students & Authorities</h3>
                            <p class="card-text">Students can use it for research and projects. Local authorities gain
                                an additional, crowd-verified channel of environmental reporting.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Scalable Solution</h3>
                            <p class="card-text">Designed with a modular framework, allowing easy integration of new
                                cities or regions by plugging in localized data sources.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Team</h2>
            <div class="row text-center">
                <style>
                    .linkedin-icon img {
                        transition: transform 0.3s ease;
                    }

                    .linkedin-icon img:hover {
                        transform: scale(1.2);
                    }
                </style>

                <div class="col-md-3 col-6 mb-4">
                    <div class="team-leader">
                        <h4 style="display: flex; align-items: center; gap: 8px;">
                            Riya Garg
                            <a href="https://www.linkedin.com/in/riya-garg-b8b8a2323" target="_blank"
                                class="linkedin-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn"
                                    width="24" height="24">
                            </a>
                        </h4>
                    </div>
                </div>

                <style>
                    .linkedin-icon img {
                        transition: transform 0.3s ease;
                    }

                    .linkedin-icon img:hover {
                        transform: scale(1.2);
                    }
                </style>

                <div class="col-md-3 col-6 mb-4">
                    <div class="team-member">
                        <h4 style="display: flex; align-items: center; gap: 8px;">
                            Vikash
                            <a href="https://www.linkedin.com/in/vikash-kasaudhan-3a5272260" target="_blank"
                                class="linkedin-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn"
                                    width="20" height="20">
                            </a>
                        </h4>
                    </div>
                </div>

                <style>
                    .linkedin-icon img {
                        transition: transform 0.3s ease;
                    }

                    .linkedin-icon img:hover {
                        transform: scale(1.2);
                    }
                </style>

                <div class="col-md-3 col-6 mb-4">
                    <div class="team-member">
                        <h4 style="display: flex; align-items: center; gap: 8px;">
                            Deepanshu
                            <a href="https://www.linkedin.com/in/deepanshu-7bb1a2329" target="_blank"
                                class="linkedin-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn"
                                    width="24" height="24">
                            </a>
                        </h4>
                    </div>
                </div>

                <style>
                    .linkedin-icon img {
                        transition: transform 0.3s ease;
                    }

                    .linkedin-icon img:hover {
                        transform: scale(1.2);
                    }
                </style>

                <div class="col-md-3 col-6 mb-4">
                    <div class="team-member">
                        <h4 style="display: flex; align-items: center; gap: 8px;">
                            Abhinav Jha
                            <a href="https://www.linkedin.com/in/abhinav-jha-45b820324" target="_blank"
                                class="linkedin-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn"
                                    width="24" height="24">
                            </a>
                        </h4>
                    </div>
                </div>

    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-3">EnviroHealth - Smart Environment, Safer You</p>
            <p class="mb-3">Developed for Galgotias International Hackathon 2.0</p>
            <div class="mb-3">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white"><i class="fab fa-github"></i></a>
            </div>
            <p>&copy; 2025 Code Crafter Team. All rights reserved.</p>
        </div>
    </footer>



    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize map
        const map = L.map('map').setView([28.4744, 77.5040], 13); // Greater Noida coordinates

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add sample markers for safe/unsafe zones
        L.circle([28.4744, 77.5040], {
            color: 'green',
            fillColor: 'green',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map).bindPopup("Safe Zone - Good Air Quality");

        L.circle([28.4844, 77.5140], {
            color: 'red',
            fillColor: 'red',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map).bindPopup("Unsafe Zone - High Pollution");

        L.circle([28.4644, 77.4940], {
            color: 'orange',
            fillColor: 'orange',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map).bindPopup("Moderate Risk - Check Water Quality");
    </script>
<style>
body {
  margin: 0;
  padding: 0;
  background: #e0f7fa;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

h1 {
  text-align: center;
  color: #00695c;
  margin-top: 30px;
  font-size: 32px;
}

form {
  max-width: 500px;
  margin: 30px auto;
  padding: 25px;
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

form:hover {
  transform: scale(1.02);
}

label {
  display: block;
  margin-top: 15px;
  font-weight: 600;
  color: #333;
}

input[type="text"],
input[type="file"],
textarea {
  width: 100%;
  padding: 12px;
  margin-top: 8px;
  border: 1px solid #b2dfdb;
  border-radius: 10px;
  box-sizing: border-box;
  font-size: 14px;
  transition: border-color 0.3s;
}

input[type="text"]:focus,
textarea:focus {
  border-color: #26a69a;
  outline: none;
}

button[type="submit"] {
  margin-top: 25px;
  width: 100%;
  padding: 14px;
  background: linear-gradient(135deg, #26a69a, #00796b);
  color: white;
  font-size: 16px;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.2s ease;
}

button[type="submit"]:hover {
  background: linear-gradient(135deg, #00796b, #004d40);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 121, 107, 0.3);
}
</style>


 <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    form { display: flex; flex-direction: column; max-width: 400px; }
    label, input, textarea, button { margin-bottom: 10px; }
  </style>
</head>
<body>
  <h1>Report Garbage</h1>
  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="image">Upload Image:</label>
    <input type="file" name="image" accept="image/*" required>

    <label for="location">Location (Address):</label>
    <input type="text" name="location" required>

    <label for="description">Description (optional):</label>
    <textarea name="description" rows="4"></textarea>

    <button type="submit">Submit Report</button>
  </form>




</body>

</html


?>