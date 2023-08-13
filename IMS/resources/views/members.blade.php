<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>

    <!--bootstrap css-->
    <link href="{{ asset('css/userlist.css') }}" rel="stylesheet">
    <link href="{{ asset('css/usertiles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/userlist.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

   <div class="main-container d-flex">
    <div class="sidebar " id="side_nav">
         <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
            <h1 class="fs-3 ms-2 name"><span class="text">Allumna-DCS</span></h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
        </div>


        <ul class="list-unstyled px-2 ">
            <li class=""><a href="<?=url('/userhome')?>" class="text-decoration-none px-3 py-3 d-block">HOME</a></li>
            <li class="active"><a href="<?=url('/members')?>" class="text-decoration-none px-3 py-3 d-block">MEMBERS</a></li>

        </ul>


    </div>
    <div class="content">

        <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
            <div class="container-fluid">
            <div class="d-flex justify-content-between d-md-none d-block">
            <button class="btn px-1 py-0 open-btn me-2"><i class="fa-solid fa-bars-staggered"></i></button>
            <a class="navbar-brand fs-4" href="#"></a>
            </div>
            <button class="navbar-toggler p-0 border-0 " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
              <ul class="navbar-nav  mb-2 mb-lg-0">
                <!--<li class="nav-item py-2 p-2 me-4">
                    <i class="fa-solid fa-bell"></i>
                </li>-->
                <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
                    <img src="" class="avatar">
                    <form id="logout" method="POST" action="<?=url('/logout')?>">
                        @csrf
                        <input type="submit" class="btn btn-secondary default btn" onclick="confirmlogout(event)" value="Logout" name="logout" />
                    </form>
                    <script>
                        function confirmlogout(event) {
                            event.preventDefault(); // Prevent the default form submission behavior
                            const result = confirm('Are you sure you want to logout?');
                            if (result) {
                                document.getElementById('logout').submit(); // Submit the form if OK is clicked
                            }
                        }
                    </script>
                </nav>

              </ul>
            </div>
        </div>
          </nav>

                <br>
                <label style="margin-left: 10px; color:rgb(38, 0, 255)">Select The Batch: </label>
                <select id="yearFilter" onchange="applyYearFilter()" style="margin-left: 10px; width: 180px;">
                    <option value="" selected>All</option>
                    <option value="2005">SC/2005</option>
                    <option value="2006">SC/2006</option>
                    <option value="2007">SC/2007</option>
                    <option value="2008">SC/2008</option>
                    <option value="2009">SC/2009</option>
                    <option value="2010">SC/2010</option>
                    <option value="2011">SC/2011</option>
                    <option value="2012">SC/2012</option>
                    <option value="2013">SC/2013</option>
                    <option value="2014">SC/2014</option>
                    <option value="2015">SC/2015</option>
                    <option value="2016">SC/2016</option>
                    <option value="2017">SC/2017</option>
                    <option value="2018">SC/2018</option>
                    <option value="2019">SC/2019</option>
                    <option value="2020">SC/2020</option>
                </select>
                <br><br>

                <div id="filteredUsers">

                @foreach($data as $item)
                @php
                    // Extract year and number from scnum
                    $scParts = explode('/', $item->scnum);
                    $scYear = $scParts[1];
                    $scNumber = $scParts[2];

                @endphp
                <div class="user-tile" data-year="{{ $scYear }}">
                    <div class="user-avatar">
                        <div style="display: flex;">
                            <img src="{{ asset('storage/'.$item->imgpath) }}" alt="User Avatar">
                            <div style=" margin-top: 40px; margin-left: 30px">
                                <h4 style="color: blue;">{{ $item->fname }} {{ $item->lname }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="user-details">

                        <div style="display: flex;">
                            <div>
                            <p><b>SC-Number:</b>{{ $item->scnum }}</p>
                            <p><b>Entered Year:</b> {{ $item->eyear }}</p>
                            <p><b>Pass Out Year:</b> {{ $item->pyear }}</p>
                            <p><b>Degree:</b> {{ $item->role }}</p>
                            </div>
                            <div style="margin-left: 80px">
                            <p><b>Workplace:</b> {{ $item->workplace }}</p>
                            <p><b>Position:</b> {{ $item->position }}</p>
                            <p><b>Extra Qualifications:</b> {{ $item->qualifications }}</p>
                            <p><b>Country:</b> {{ $item->country }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
                </div>
                <script>
                    function applyYearFilter() {
                        var selectedYear = document.getElementById('yearFilter').value;
                        var userDivs = document.getElementsByClassName('user-tile');

                        for (var i = 0; i < userDivs.length; i++) {
                            var userYear = userDivs[i].getAttribute('data-year');

                            if (selectedYear === '' || selectedYear === userYear) {
                                userDivs[i].style.display = 'block';
                            } else {
                                userDivs[i].style.display = 'none';
                            }
                        }
                    }
                </script>

    </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://kit.fontawesome.com/c752b78af3.js" crossorigin="anonymous"></script>


   <script>
    $(".sidebar ul li").on('click', function() {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');

        })

        $('.open-btn').on('click',function(){
     $('.sidebar').addClass('active');
        })

        $('.close-btn').on('click',function(){
     $('.sidebar').removeClass('active');
        })



    </script>


</body>
</html>
