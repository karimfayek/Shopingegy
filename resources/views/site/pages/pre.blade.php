<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	    <title>@yield('title') - {{ config('app.name') }}</title>
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("storage/{{config('settings.home_pre') }}");
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
}

.hero-text button {
background: rgba(0,0,0,.2);
    border: 1px solid #fff;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-family: Droid Arabic Naskh, mango-regular,Arial;
    font-size: 11px;
    letter-spacing: normal;
    line-height: 38px;
    margin: 0;
    min-height: 38px;
    padding: 0;
    text-align: center;
    text-decoration: none;
    text-transform: none;
    float: left;
    width: 155px;
}

.hero-text button:hover {
  background-color: #555;
  color: white;
}
.hero-text button a {
color:#fff}
</style>
</head>
<body>
<div class="hero-image">
  <div class="hero-text">
    <h1 style="font-size:50px">DasKind</h1>
    <p>Choose Language</p>
    <a href="/en"><button>English</button></a>
  <a href="/ar"> <button>العربية</button></a>
  </div>
</div>
</body>
</html>