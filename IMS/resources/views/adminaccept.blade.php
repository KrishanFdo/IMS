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
            <h1 class="fs-3 ms-2 name"><span class="text">IMS-UOR-DCS</span></h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
        </div>


        <ul class="list-unstyled px-2 ">
            <li class="active"><a href="useraccep.html" class="text-decoration-none px-3 py-3 d-block">NEW USERS</a></li>
            <li class=""><a href="" class="text-decoration-none px-3 py-3 d-block">USERS DETAILS</a></li>
            <li class=""><a href="" class="text-decoration-none px-3 py-3 d-block">REMOVE USER</a></li>

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
                    <form method="POST" action="">
                        <input type="submit" class="btn btn-secondary default btn" value="Logout" onclick="logOut()" name="logout" />
                    </form>
                </nav>

              </ul>
            </div>
        </div>
          </nav>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach($data as $item)
                <div class="user-tile">
                    <form action="<?=url('/accept')?>" method="POST">
                    @csrf
                    <div class="user-avatar">
                        <img src="{{ asset('storage/'.$item->r_imgpath) }}" alt="User Avatar">
                    </div>
                    <div class="user-details">
                        <h2 style="color: blue;">{{ $item->r_fname }} {{ $item->r_lname }}</h2>
                        <br>
                        <p><b>SC-Number:</b>{{ $item->r_scnum }}</p>
                        <p><b>Email:</b> {{ $item->r_email }}</p>
                        <p><b>Mobile:</b> {{ $item->r_mobile }}</p>
                        <p><b>Year:</b> {{ $item->r_year }}</p>
                        <p><b>BCS/BSC:</b> {{ $item->r_role }}</p>
                        <p><b>Workplace:</b> {{ $item->r_workplace }}</p>
                        <p><b>Position:</b> {{ $item->r_position }}</p>
                        <input type="hidden" name="id" value="{{ $item->r_id }}">
                        <div class="container">
                            <input type="submit" value="Accept" id="accept">
                            <a href="/delete-register/{{ $item->r_id }}" id="remove">Remove</a>
                        </div>

                    </div>
                    </form>
                </div>
                @endforeach

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
