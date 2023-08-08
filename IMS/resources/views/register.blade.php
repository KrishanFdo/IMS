<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    #login {
        display: inline-block;
        padding: 5px 15px;
        float: right;
        margin-right: 20px;
        background-color: #0c71b4;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.2s ease;
    }

    #login:hover {
        background-color: #9acbe7;
    }

    #login:focus {
        outline: none;
    }
  </style>
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

  <div >
    <div>
      <div>
        <h1 class="fs-8 ms-6 name" style="text-align: center"><span class="text" >Department Of Computer Science  - Univesity Of Ruhuna </span></h1>

      </div>
    </div>
    <div class="content">
      <nav class="navbar navbar-expand-md py-3 navbar-light bg-light ">
        </nav>
      <div class="dashboard-content ms-5 px-3 pt-4">
        <a id="login" href="<?=url('/login')?>">Login</a>
        <div class="container mt-3 ms-2">
          <div class="dashboard-content ms-5 px-3 pt-4">
            <div class="container">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
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
                    <label>Entered Year to the university</label>
                    <input type="text" class="form-control " placeholder="****" name="eyear">
                    @error('eyear')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label> Pass Out Year </label>
                    <input type="text" class="form-control " placeholder="****" name="pyear">
                    @error('pyear')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label>  Phone number </label>
                    <input type="text" class="form-control " placeholder="+94XXXXXXXXX" name="mobile">
                    @error('mobile')
                    <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label>Whatsapp number </label>
                    <input type="text" class="form-control " placeholder="+94XXXXXXXXX" name="wmobile">
                    @error('wmobile')
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
                    <div>   <input type="radio" id="role" name="role" value="BCS General"/> BCS General
                          <br>
                          <input type="radio" id="role" name="role" value="BCS Special"/> BCS Special
                          <br>
                          <input type="radio" id="role" name="role" value="BSC General"/> BSC General
                          <br>
                            <input type="radio" id="role" name="role" value="BSC Special"/> BSC Special<br/>
                            @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                </div>
                  <div class="col-sm-6 mb-4">

                    <label class="mt-2">Position</label>
                    <select class="form-select" aria-label="" name="position" id="select_list">
                      <option value="" disabled selected>Select an option...</option>
                      <option value="University Lecturer ">University Lecturer </option>
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

                <div id="hidden_html_tag" class="col-sm-6 mb-4" style="display: none;">
                    <div class="col-sm-6 mb-4">
                      <label>Other Position</label>
                      <input type="text" class="form-control" placeholder="Position" name="other-position" required>
                     <br>
                     </div>
                </div>


                  </div>
                  <div class="col-sm-6 mb-4">
                    <label>Extra Qualifications</label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Msc" name="qualifications[]">
                      <label class="form-check-label" for="inlineCheckbox1">Msc</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="MSc Reading" name="qualifications[]">
                      <label class="form-check-label" for="inlineCheckbox2">MSc Reading</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Phd" name="qualifications[]">
                      <label class="form-check-label" for="inlineCheckbox3">Phd</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="Phd Reading" name="qualifications[]">
                      <label class="form-check-label" for="inlineCheckbox4">Phd Reading</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox5" value="MPhil" name="qualifications[]">
                      <label class="form-check-label" for="inlineCheckbox5">MPhil</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox6" value="MPhil Reading" name="qualifications[]">
                      <label class="form-check-label" for="inlineCheckbox6">MPhil Reading</label>
                    </div>
                    @error('qualifications[]')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
                  <div class="col-sm-6 mb-4">
                     <div class="col-sm-6 mb-4">
                     <label>Country where you live</label>
                     <select name="country">
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antartica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo">Congo, the Democratic Republic of the</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cota D'Ivoire">Cote d Ivoire</option>
                        <option value="Croatia">Croatia(Hrvatska)</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="East Timor">East Timor</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="France Metropolitan">France, Metropolitan</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                        <option value="Holy See">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran">Iran (Islamic Republic of)</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Democratic People's Republic of Korea">Korea, Democratic People s Republic of</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao">Lao People s Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon" selected>Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macau">Macau</option>
                        <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia">Micronesia, Federated States of</option>
                        <option value="Moldova">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint LUCIA">Saint LUCIA</option>
                        <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia (Slovak Republic)</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                        <option value="Span">Spain</option>
                        <option value="SriLanka" selected>Sri Lanka</option>
                        <option value="St. Helena">St. Helena</option>
                        <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syria">Syrian Arab Republic</option>
                        <option value="Taiwan">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Vietnam">Viet Nam</option>
                        <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                        <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                        <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                        <br>
                        @error('country')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
