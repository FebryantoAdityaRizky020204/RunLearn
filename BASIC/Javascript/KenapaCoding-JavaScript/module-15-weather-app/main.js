const apiKey = "fbc542d85e570cd7d5e59bcf0d32965c";

// ambil element html yang diperlukan
const locationElement = document.getElementById("location");
const temperatureElement = document.getElementById("temperature");
const descriptionElement = document.getElementById("description");
const iconElement = document.getElementById("weather-icon");

// fungsi untuk mendapatkan data cuaca dari API
async function getWeather(lat, long) {
    const apiURL = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${long}&appid=${apiKey}&units=metric`;
    try {
        const response = await fetch(apiURL);
        const data = await response.json();
        console.log(data);

        locationElement.textContent = `${data.name}, ${data.sys.country}`;
        temperatureElement.textContent = `${Math.round(data.main.temp)}°C`;
        descriptionElement.textContent = data.weather[0].description;

        let iconCode = data.weather[0].icon;
        iconElement.innerHTML = `<img src="https://openweathermap.org/img/wn/${iconCode}.png" alt="Weather Icon"/>`;
    } catch (error) {
        console.error("Error fetching weather data:", error);
        alert("Failed to retrieve weather data. Please try again later.");
    }
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const long = position.coords.longitude;
                getWeather(lat, long);
            },
            (error) => {
                console.error("Error getting location:", error);
                alert(
                    "Unable to retrieve your location. Please allow location access."
                );
            }
        );
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

// memanggil functio getLocation saat halaman dimuat
window.onload = getLocation();
