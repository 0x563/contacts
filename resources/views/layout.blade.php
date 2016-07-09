<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contacts</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  @yield('head')
</head>
<body id="app-layout">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Contacts</a>
      </div>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="/">Home</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>
</body>
</html>
