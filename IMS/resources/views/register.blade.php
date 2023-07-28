<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="CSS/update.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>


<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
  <div >
    <div>
      <div>
        <h1 class="fs-8 ms-6 name"><span class="text" >Department Of Computer Science  - Univesity Of Ruhuna </span></h1>
      </div>
    </div>
    <div class="content">
      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        </nav>
      <div class="dashboard-content ms-5 px-3 pt-4">
        <div class="container mt-3 ms-2">

          <div class="dashboard-content ms-5 px-3 pt-4">
            <div class="container">
              <form class="form-group" action="<?=url('/register-submit')?>" method="POST" enctype='multipart/form-data'>

                <div class="row jumbotron">
                  <div class="col-sm-6 mb-4">
                    <label>First Name</label>
                    <input type="text" class="form-control " name="fname">
                    @error('fname')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label>Last Name</label>
                    <input type="text" class="form-control " name="lname">
                    @error('lname')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label>Year</label>
                    <input type="text" class="form-control " placeholder="****" name="year">
                    @error('year')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label> Phone number </label>
                    <input type="text" class="form-control " placeholder="+94XXXXXXXXX" name="mobile">
                    @error('mobile')
                    <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                  <label> SC number </label>
                    <input type="text" class="form-control" placeholder="SC/20**/*****" name="scnum">
                    @error('scnum')
                        <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Email address" name="email" >
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                  </div>
                  <div class="col-sm-6 mb-4">
                  <div class="col-sm-6 mb-4">
                          <label>Role</label>  <br>
                    <div>   <input type="radio" id="role" name="role" value="bcs"/> BCS
                          <br>
                            <input type="radio" id="role" name="role" value="bsc"/> BSC <br/>
                            @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                  <div class="col-sm-6 mb-4">

                    <label class="mt-2"></label>
                    <select class="form-select" aria-label="" name="position" id="select_list">
                      <option value="" disabled selected>Select an option...</option>
                      <option value="Software Developer">Software Developer</option>
                      <option value="UX Designer">UX Designer</option>
                      <option value="Mobile App Developer">Mobile App Developer</option>
                      <option value="IT Project Manager">IT Project Manager</option>
                      <option value="Information Security Analyst">Information Security Analyst</option>
                      <option value="Systems Architect">Systems Architect</option>
                      <option value="AI Engineer">AI Engineer</option>
                      <option value="Computer Hardware Engineer">Computer Hardware Engineer</option>
                      <option value="Video Game Developer">Video Game Developer</option>
                      <option value="UX Designer">UX Designer</option>
                      <option value="Other">Other</option>
                    </select>
                    <br>
                    @error('position')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const selectList = document.getElementById('select_list');
                        const hiddenHtmlTag = document.getElementById('hidden_html_tag');

                        // Function to toggle visibility and required attribute of the HTML tag
                        function toggleHtmlTagVisibility() {
                            if (selectList.value === 'Other') {
                                hiddenHtmlTag.style.display = 'block';
                                hiddenHtmlTag.querySelector('input').setAttribute('required', 'required');
                            } else {
                                hiddenHtmlTag.style.display = 'none';
                                hiddenHtmlTag.querySelector('input').removeAttribute('required');
                            }
                        }

                        // Call the function initially to set the initial state
                        toggleHtmlTagVisibility();

                        // Add an event listener to the select list to update visibility and required attribute on change
                        selectList.addEventListener('change', toggleHtmlTagVisibility);
                    });
                </script>


                  </div>
                  <div class="col-sm-6 mb-4">
                     <div class="col-sm-6 mb-4">
                     <label>Work Place</label>
                     <input type="text" class="form-control" placeholder="Virtusa/ifs/any" name="workplace">
                        <br>
                        @error('workplace')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>


                      <div id="hidden_html_tag" class="col-sm-6 mb-4" style="display: none;">
                            <div class="col-sm-6 mb-4">
                              <label>Other Position</label>
                              <input type="text" class="form-control" placeholder="Position" name="other-position" required>
                             <br>
                             </div>
                        </div>

                  <div class="col-sm-6 mb-4">
                  <label>Profile photo</label>
                      <div class="form-group">
                        <input class="form-control" type="file" name="image" value="" />
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                  </div>
                  <div class="col-sm-6 mb-4" style=" text-align: right;">
                  <label></label>
                  <div>

                    <input type="hidden" name="_token" value="<?=csrf_token()?>">
                    <input type="submit" value="Submit" class="btn btn-primary btn-md col-sm-4">
                </div>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
</body>
</html>
