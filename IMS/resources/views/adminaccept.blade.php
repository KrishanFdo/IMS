<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alumna | Newly Registered</title>

    <!--bootstrap css-->
    <link href="{{ asset('css/userlist.css') }}" rel="stylesheet">
    <link href="{{ asset('css/usertiles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">
    <link href="{{ asset('css/searchoptions.css') }}" rel="stylesheet">

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
            <li class="active"><a href="/admin-accept" class="text-decoration-none px-3 py-3 d-block">NEWLY REGISTERED</a></li>
            <li class=""><a href="/users" class="text-decoration-none px-3 py-3 d-block">USERS</a></li>
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

                <br>
                <form style="margin-left: 5px;" class="form-group" action="<?=url('/filtered-registers')?>" method="GET">
                    <div style=" display: flex;">
                        <div>
                            <label for="scnumber">Batch</label>
                            <select class="form-select" name="scnumber" style="width: 200px">
                                <option value="">All</option>
                                @foreach ($scnums as $scnum)
                                    <option value="{{ $scnum }}" {{ $selectedscnum == $scnum ? 'selected' : '' }}>SC/{{ $scnum }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-left: 10px;">
                            <label for="role">Degree</label>
                            <select class="form-select" name="role" style="width: 200px">
                                <option value="">All</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ $selectedrole == $role ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div style="margin-left: 10px;">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" style="width: 200px" value="{{ $selectedposition }}">
                            <div class="position-select" id="position-select">
                                <div class="select-positions">
                                    <!-- Dynamic options will be inserted here -->
                                </div>
                            </div>
                        </div>

                        <div style="margin-left: 10px;">
                            <label for="workplace">Workplace</label>
                            <input type="text" class="form-control" id="workplace" name="workplace" style="width: 200px" value="{{ $selectedworkplace }}">
                            <div class="workplace-select" id="workplace-select">
                                <div class="select-workplaces">
                                    <!-- Dynamic options will be inserted here -->
                                </div>
                            </div>
                        </div>

                    </div>
                    <div style=" display: flex;">

                        <div style="">
                            <label for="country">Country</label>
                            <select class="form-select" name="country" style="width: 200px">
                                <option value="">All</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country }}" {{ $selectedcountry == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if(count($data)!=0)
                            @if(count($data)==1)
                                <h5 style="margin-top: 30px; margin-left: 10px; color:rgba(189, 61, 10, 0.925)">{{ count($data) }} User Available</h5>
                            @else
                                <h5 style="margin-top: 30px; margin-left: 10px; color:rgba(189, 61, 10, 0.925)">{{ count($data) }} Users Available</h5>
                            @endif
                        @endif

                        <button type="submit" class="btn btn-primary btn-md col-sm-4" style="width: 150px; height: 40px; margin-left: 10px; margin-top: 20px;">Apply Filters</button>
                        <button type="reset" id="customResetButton" class="btn btn-secondary btn-md col-sm-4" style="width: 150px; height: 40px; margin-left: 10px; margin-top: 20px;">Reset</button>

                    </div>



                    <script>
                        document.getElementById('customResetButton').addEventListener('click', function() {
                            // Perform the desired action when the reset button is clicked
                            window.location.href = "<?=url('/admin-accept')?>";
                        });

                        const searchposition = document.getElementById('position');
                        const positionSelect = document.getElementById('position-select');
                        const selectpositions = positionSelect.querySelector('.select-positions');

                        //list of options
                        const positions = [
                            "All",
                            @foreach ($positions as $position)
                                "{{ $position }}",
                            @endforeach
                        ];

                        searchposition.addEventListener('input', function () {
                            const searchValue = this.value.toLowerCase();
                            const filtered = positions.filter(option => option.toLowerCase().includes(searchValue));

                            // Generate HTML for filtered options
                            const html = filtered.map(option => `<div>${option}</div>`).join('');
                            selectpositions.innerHTML = html;

                            // Show/hide the filtered options container
                            if (searchValue.length > 0) {
                                positionSelect.style.display = 'block';
                            } else {
                                positionSelect.style.display = 'block';
                                // If search box is empty, show all positions
                                selectpositions.innerHTML = positions.map(option => `<div>${option}</div>`).join('');
                            }
                        });

                        // Handle option selection
                        positionSelect.addEventListener('click', function (event) {
                            if (event.target.tagName === 'DIV') {
                                searchposition.value = event.target.textContent;
                                positionSelect.style.display = 'none';
                            }
                        });

                        //serach workplaces
                        const searchworkplace = document.getElementById('workplace');
                        const workplaceSelect = document.getElementById('workplace-select');
                        const selectworkplaces = workplaceSelect.querySelector('.select-workplaces');

                        //list of options
                        const workplaces = [
                            "All",
                            @foreach ($workplaces as $workplace)
                                "{{ $workplace }}",
                            @endforeach
                        ];

                        searchworkplace.addEventListener('input', function () {
                            const searchValue = this.value.toLowerCase();
                            const filtered = workplaces.filter(option => option.toLowerCase().includes(searchValue));

                            // Generate HTML for filtered options
                            const html = filtered.map(option => `<div>${option}</div>`).join('');
                            selectworkplaces.innerHTML = html;

                            // Show/hide the filtered options container
                            if (searchValue.length > 0) {
                                workplaceSelect.style.display = 'block';
                            } else {
                                workplaceSelect.style.display = 'block';
                                // If search box is empty, show all workplaces
                                selectworkplaces.innerHTML = workplaces.map(option => `<div>${option}</div>`).join('');
                            }
                        });

                        // Handle option selection
                        workplaceSelect.addEventListener('click', function (event) {
                            if (event.target.tagName === 'DIV') {
                                searchworkplace.value = event.target.textContent;
                                workplaceSelect.style.display = 'none';
                            }
                        });
                    </script>
                </form>

                @if($data->isEmpty())
                    <br>
                    <div class="alert alert-danger">
                        <p>NO USERS AVAILABLE</p>
                    </div>
                @endif
                <br>
                @foreach($data as $item)
                <div class="user-tile">
                    <div class="user-avatar">
                        <div style="display: flex;">
                        <img src="{{ asset('storage/'.$item->r_imgpath) }}" alt="User Avatar">
                        <div style=" margin-top: 40px; margin-left: 10px">
                            <h4 style="color: blue;">{{ $item->r_fname }} {{ $item->r_lname }}</h4>
                        </div>
                        <div style="float:right; margin-top: 30px; margin-right: 20px;">
                        <div class="container">
                            <form id="{{ $item->r_id }}" action="<?=url('/accept')?>" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->r_id }}">
                                <input type="submit" value="Accept" id="accept" onclick="confirmaccept(event)" data-aid="{{ $item->r_id }}">
                            </form>
                            <script>
                                function confirmaccept(event){
                                    event.preventDefault(); // Prevent the default form submission behavior
                                    const userId = event.target.getAttribute('data-aid');
                                    const result = confirm('Are you sure you want to accept?');
                                    if (result) {
                                        document.getElementById(userId).submit(); // Submit the form if OK is clicked
                                    }
                                }
                            </script>

                            <form id="{{ $item->r_id }}r" action="<?=url('/delete-register')?>" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $item->r_id }}">
                                <input type="submit" value="Remove" id="remove" onclick="confirmremove(event)" data-rid="{{ $item->r_id }}">
                            </form>
                            <script>
                                function confirmremove(event) {
                                    event.preventDefault(); // Prevent the default form submission behavior
                                    const userId = event.target.getAttribute('data-rid');
                                    const result = confirm('Are you sure you want to Remove?');
                                    if (result) {
                                        document.getElementById(userId+'r').submit(); // Submit the form if OK is clicked
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
                                <p><b>SC-Number:</b> {{ $item->r_scnum }}</p>
                                <p><b>Degree:</b> {{ $item->r_role }}</p>
                                <p><b>Email:</b> {{ $item->r_email }}</p>
                                <p><b>Mobile:</b> {{ $item->r_mobile }}</p>
                                <p><b>Pass Out Year:</b> {{ $item->r_pyear }}</p>
                            </div>
                            <div style="margin-left: 80px">
                                <p><b>Workplace:</b> {{ $item->r_workplace }}</p>
                                <p><b>Employees in Workplace:</b> {{ $item->r_employees }}</p>
                                <p><b>Position:</b> {{ $item->r_position }}</p>
                                <p><b>Country:</b> {{ $item->r_country }}</p>
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
