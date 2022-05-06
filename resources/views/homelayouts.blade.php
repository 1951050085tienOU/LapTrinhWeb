<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nice Apartment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="singin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.css"/>
    
    <!-- Popper JS -->
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="main.js"></script>
    <script src='custom/TableLayouts.js'/></script>
    <link rel='stylesheet' href='custom/CustomJS.css'/>
    @yield('head')
</head>

<body>
<div class="header">
  <div class="header--logo">
    <div class="header--logo__icon">
      <!-- <img src="images/logo_apartment.jpg" alt="ảnh logo" class="header--logo__image"> -->
    <i class="fas fa-building"></i>
    </div>
    <div class="header--logo__text">NICE APARTMENT</div>
  </div>
  <div class="header--time">
    <div class="header--time--info"></div>
    <div class="header--time--info"></div>
  </div>
  <div class="header--close">
    <div>
      <i class="fa-solid fa-rectangle-xmark big-close"></i>
    </div>
    <div>
    <i class="fa-solid fa-square-caret-down"></i>
    </div>
  </div>
</div>
<div class="main">
  <div class="slide_bar">

      @if (auth()->user()->Role == 'Manager')
      <nav class="navbar">
        <ul class="navbar-nav r-affect">
          <li class="nav-item" onclick="window.location.replace('?tab-selection=1')">
            <a class="nav-link">General</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=2')">
            <a class="nav-link">Contracts</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=3')">
            <a class="nav-link">Apartment Management</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=4')">
            <a class="nav-link">Individual Management</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=5')">
            <a class="nav-link">Error Report</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=6')">
            <a class="nav-link">Regulations</a>
          </li>
        </ul>
      </nav>
      @else
      <nav class="navbar">
        <ul class="navbar-nav r-affect">
          <li class="nav-item" onclick="window.location.replace('?tab-selection=1')">
            <a class="nav-link">General</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=2')">
            <a class="nav-link">Statistics</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=3')">
            <a class="nav-link">Customer Bills</a>
          </li>
          <li class="nav-item" onclick="window.location.replace('?tab-selection=4')">
            <a class="nav-link">Partner Bills</a>
          </li>
          </li>
        </ul>
      </nav>
      @endif
    <div class="clear"> 
    </div>

    <div class="box_task">
        <p class="box_task-heading">Task</p>
        <p>Empty: 5</p>
        <p>Report: 5</p>
        <p>Missed Individual: 5</p>
        <p class="box_task-footer">Connected: 5</p>
    </div>
  </div>
  <div class="content">
      @yield('content')  
  </div>
</div>

</body>
</html>