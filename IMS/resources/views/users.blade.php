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
            <h1 class="fs-3 ms-2 name"><span class="text">Alumna-DCS</span></h1>
            <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
        </div>


        <ul class="list-unstyled px-2 ">
            <li class=""><a href="<?=url('/home')?>" class="text-decoration-none px-3 py-3 d-block">HOME</a></li>
            <li class=""><a href="/admin-accept" class="text-decoration-none px-3 py-3 d-block">NEWLY REGISTERED</a></li>
            <li class="active"><a href="/users" class="text-decoration-none px-3 py-3 d-block">USERS</a></li>
            <li class=""><a href="/emailsend" class="text-decoration-none px-3 py-3 d-block">SEND EMAILS</a></li>
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
                    <form id="logout" method="POST" action="<?=url('/adminlogout')?>">
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

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('mailerror'))
                    <div class="alert alert-danger">
                        {{ session('mailerror') }}
                    </div>
                @endif
                @if($users->isEmpty())
                    <div class="alert alert-danger">
                        <p>NO USERS AVAILABLE</p>
                    </div>
                @endif
                <br>
                <form style="margin-left: 5px;" class="form-group" action="<?=url('/filtered-users')?>" method="GET">
                    <div style=" display: flex;">
                        <div>
                            <label for="scnumber">Batch</label>
                            <select class="form-select" name="scnumber" style="width: 200px">
                                <option value="">All</option>
                                @foreach ($scnums as $scnum)
                                    <option value="{{ $scnum }}">SC/{{ $scnum }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-left: 10px;">
                            <label for="role">Role</label>
                            <select class="form-select" name="role" style="width: 200px">
                                <option value="">All</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-left: 10px;">
                            <label for="position">Position</label>
                            <select class="form-select" name="position" style="width: 200px">
                                <option value="">All</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position }}">{{ $position }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-left: 10px;">
                            <label for="workplace">Workplace</label>
                            <select class="form-select" name="workplace" style="width: 200px">
                                <option value="">All</option>
                                @foreach ($workplaces as $workplace)
                                    <option value="{{ $workplace }}">{{ $workplace }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md col-sm-4" style="width: 150px; height: 40px; margin-left: 10px; margin-top: 20px;">Apply Filters</button>
                </form>

                <br>
                <div id="filteredUsers">
                @foreach($users as $item)

                <div class="user-tile">
                    <div class="user-avatar">
                        <div style="display: flex;">
                        <img src="{{ asset('storage/'.$item->imgpath) }}" alt="User Avatar">
                        <div style=" margin-top: 40px; margin-left: 10px">
                            <h4 style="color: blue;">{{ $item->fname }} {{ $item->lname }}</h4>
                        </div>
                        <div style="float:right; margin-top: 30px; margin-right: 30px; margin-left: 30px;">
                            <div class="container">
                                <form id="{{ $item->id }}" action="<?=url('/delete-user')?>" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="submit" value="Remove" id="remove" onclick="confirmremove(event)" data-rid="{{ $item->id }}">
                                </form>
                                <script>
                                    function confirmremove(event) {
                                        event.preventDefault(); // Prevent the default form submission behavior
                                        const userId = event.target.getAttribute('data-rid');
                                        const result = confirm('Are you sure you want to Remove?');
                                        if (result) {
                                            document.getElementById(userId).submit(); // Submit the form if OK is clicked
                                        }
                                    }
                                </script>

                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="user-details">

                    <div style="display: flex;">
                        <div>
                        <p><b>SC-Number: </b>{{ $item->scnum }}</p>
                        <p><b>Email:</b> {{ $item->email }}</p>
                        <p><b>Mobile:</b> {{ $item->mobile }}</p>
                        <p><b>WhatsApp Mobile:</b> {{ $item->wmobile }}</p>
                        <p><b>Entered Year:</b> {{ $item->eyear }}</p>
                        <p><b>Pass Out Year:</b> {{ $item->pyear }}</p>
                        </div>
                        <div style="margin-left: 80px">
                        <p><b>Degree:</b> {{ $item->role }}</p>
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
