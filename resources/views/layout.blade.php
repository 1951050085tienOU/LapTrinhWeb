<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nice Apartment</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="singin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="main.js"></script>
    <script>
      window.onload = function() {
        SetTimeHeader();
      }
    </script>
</head>
<body>

<div class="header">
  <div class="header--logo">
    <div class="header--logo__icon">
    <i class="fas fa-building"></i>
    </div>
    <div class="header--logo__text">NICE APARTMENT</div>
  </div>
  <div class="header--time">
  </div>
  <div class="header--close">
  @can('authenticated')
    <div class="user__img--container">
      <img src="{{Auth::user()->Avatar}}" alt="" class="user--img">
    </div>
  @endcan
      <div class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa-solid fa-square-caret-down"></i></a>
          <ul class="dropdown-menu">
            @cannot('authenticated')
            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
            <li><a href="{{ route('register') }}">Đăng ký</a></li>
            @endcannot

            @can('authenticated')
            <li>
            <div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Đăng xuất') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            </a></li>
            @endcan
          </ul>
      </div>
  </div>
</div>



@can('authenticated')
<div class="container">
  <div class="line"></div>

  <div class="wrap--content">
    @can('Manager')
      <div class="slide_bar" style="height: 500px;">
        <nav class="navbar">
          <ul class="navbar-nav r-affect">
            <li class="nav-item">
              <a class="nav-link" href="#">General</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contracts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Apartment Management</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Individual Management</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Error Report</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Regulations</a>
            </li>
          </ul>
        </nav>
        <div class="clear"></div>
    
        <div class="box_task">
            <p class="box_task-heading">Task</p>
            <p>Empty: <span>{{$empty}}</span></p>
            <p>Report: {{$reportCount}}</p>
            <p>Missed Individual: <span>{{$missedIndividualCount}}</span></p>
            <p class="box_task-footer">Connected: 3</p>
        </div>
      </div>
    <!-- table  -->
      <div class="frame">
          <div class="frame__general">
              <div class="frame__general--number">
                  <h7>Apartment Numbers</h7>
                  <p>{{$tongCacCanHo}}</p>
              </div>
              <div class="frame__general--number">
                  <h7>Individuals Numbers</h7>
                  <p>{{$demNhanKhau}}</p>
              </div>
              <div class="frame__general--number">
                  <h7>Debt Bills Numbers</h7>
                  <p>{{$debtBill}}</p>
              </div>
              <div class="frame__general--number">
                  <h7>Exits Error Reports</h7>
                  <p>{{$reportCount}}</p>
              </div>
          </div>
          
          <div class="frame__average">
            <div class="frame__average--chart">
            <canvas id="myChartRevenue" width="50%" height="50%"></canvas>
            <p class="label-forChart">Revenue Statistics in 2022</p>
            </div>

            <!-- circle chart -->
            <div class="frame__average--circle-chart">
              <canvas id="myChartElectricity" width="50%" height="50%"></canvas>
              <p class="label-forChart">Electricity</p>
              <canvas id="myChartWater" width="50%" height="50%"></canvas>
              <p class="label-forChart">Water</p>
            </div>
          </div>
      </div>
    <!-- end table -->
    @endcan
    
    
      @can('Accountant')
          <div class="slide_bar" style="height: 460px;">
            <nav class="navbar">
              <ul class="navbar-nav r-affect">
                <li class="nav-item">
                  <a class="nav-link" href="#">General</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Statistics</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Customer Bills</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Partner Bills</a>
                </li>
              </ul>
            </nav>
            <div class="box_task" >
                <p class="box_task-heading">Task</p>
                <p>Customer Bills: {{$CustomerBillCount}}</p>
                <p>Partner Bills: {{$partnetBillCount}}</p>
            </div>
          </div>
          <div class="frame"></div>
      @endcan
  </div>
    @endcan
</div>

@yield('content')
@yield('regulation')



    
<footer>
<i class="fa-brands fa-envira"></i>
<i class="fa-solid fa-leaf"></i>
  <span class="footer--text">NICE APARTMENT</span>
</footer>
</body>


<script>
                  const ctxElectricity = document.getElementById('myChartElectricity').getContext('2d');
                  const myChartElectricity = new Chart(ctxElectricity, {
                      type: 'pie',
                      data: {
                          labels: ['Recent Month', 'Total'],
                          datasets: [{
                              label: '# of Votes',
                              data: [40,60],
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(255, 159, 64, 1)'
                              ],
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          }
                      }
                  });
                  </script>

<script>
                  const ctxWater = document.getElementById('myChartWater').getContext('2d');
                  const myChartWater = new Chart(ctxWater, {
                      type: 'pie',
                      data: {
                          labels: ['Recent Month', 'Total'],
                          datasets: [{
                              label: '# of Votes',
                              data: [40,60],
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(255, 159, 64, 1)'
                              ],
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          }
                      }
                  });
                  </script>

<script>
                  const ctxRevenue = document.getElementById('myChartRevenue').getContext('2d');
                  const myChartRevenue = new Chart(ctxRevenue, {
                      type: 'line',
                      data: {
                          labels: ['Recent Month', 'Total'],
                          datasets: [{
                              label: 'Revenue',
                              data: [40,60],
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(255, 159, 64, 1)'
                              ],
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          }
                      }
                  });
                  </script>
</html>