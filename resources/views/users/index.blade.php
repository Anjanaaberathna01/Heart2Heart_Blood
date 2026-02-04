<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate Blood</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", Arial, sans-serif;
}

body {
    height: 100vh;
    background-color: #e10600;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 320px;
    background-color: #e10600;
    text-align: center;
    color: #fff;
    padding: 30px 20px;
    border-radius: 25px;
}

.image-box {
    width: 200px;
    height: 200px;
    background-color: #fff;
    border-radius: 50%;
    margin: 0 auto 25px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-box img {
    width: 90%;
    height: 90%;
    border-radius: 50%;
    object-fit: cover;
}

h1 {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 15px;
}

p {
    font-size: 14px;
    line-height: 1.5;
    opacity: 0.9;
    margin-bottom: 25px;
}

.donate-btn {
    width: 100%;
    padding: 12px;
    background-color: #fff;
    color: #e10600;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.donate-btn:hover {
    background-color: #f2f2f2;
}
</style>

<body>
<div class="container">
    <div class="image-box">
        <img src="{{ asset('images/user/open.png') }}" alt="Donate Blood">
    </div>

    <h1>Donate Blood<br>Save Life!</h1>

    <p>
        Donate blood and inspire others to donate.
        A single donation can save many lives.
    </p>

    <button class="donate-btn">
        <a href="{{ route("dashboard") }}" style="text-decoration: none; color: #e10600;">Donate Now</a>
    </button>
</div>

</body>
</html>
