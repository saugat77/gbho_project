<div class="mb-3">
    <h1 class="text-3xl font-bold text-gray-800 leading-8">Register Account</h1>
</div>
<form class="w-full text-gray-700" method="POST" action="{{ route('register') }}">
    @csrf

    @if(Session::has('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 text-sm p-2 rounded mb-4" role="alert">
        <span class="block sm:inline">{{ session()->get('error') }}</span>
    </div>
    @endif
    


    {{-- Name --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="userid" value="{{ old('userid') }}" placeholder="Your New User id">
            @error('userid')
            <p class="text-danger">{{$errors}}</p>
        @enderror
        </div>
       
        {{-- @if($errors->register->has('userid'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('userid') }}
        </p>
        @endif --}}
    </div>
{{-- Password --}}
<div class="mb-6">
    <div x-data="{ show: false }" class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
        <span class=" text-purple-600">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
        </svg>
        </span>
        <input :type="show ? 'text' : 'password'" class="w-full p-1 placeholder-purple-900 placeholder-opacity-75 text-sm font-medium" name="password" placeholder="Enter Password" autocomplete="new-password">
        <div class=" flex items-center text-sm leading-5" x-cloak>
            <svg x-show="show" class="h-4 w-4 text-purple-600" fill="none" @click="show = !show" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                </path>
            </svg>
            <svg x-show="!show" class="h-4 w-4 text-purple-600" fill="none" @click="show = !show" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                <path fill="currentColor" d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                </path>
            </svg>
        </div>
    </div>
    @if($errors->register->has('password'))
    <p class="text-red-500 text-xs mt-2">
        {{ $errors->register->first('password') }}
    </p>
    @endif
</div>
    {{-- first name --}}
<div class="mb-6">
    <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
        <span class="text-purple-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </span>
        <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="firstname" placeholder="Your first name">
    </div>
    @if($errors->register->has('firstname'))
    <p class="text-red-500 text-xs mt-2">
        {{ $errors->register->first('firstname') }}
    </p>
    @endif
</div>
    {{-- last name --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="lastname" placeholder="Your last name">
        </div>
        @if($errors->register->has('lastname'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('lastname') }}
        </p>
        @endif
    </div>
     {{-- dob --}}
     <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="date" name="dob" placeholder="datepicker">
        </div>
        @if($errors->register->has('dob'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('dob') }}
        </p>
        @endif
    </div>
     {{-- address --}}
     <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="parent_address" placeholder="Your address">
        </div>
        @if($errors->register->has('parent_address'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('address') }}
        </p>
        @endif
    </div>
     {{-- appartment name --}}
     <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="parent_apt" placeholder="Your apartment name">
        </div>
        @if($errors->register->has('parent_apt'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('parent_apt') }}
        </p>
        @endif
    </div> {{-- city --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="parent_city" placeholder="City name">
        </div>
        @if($errors->register->has('parent_city'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('parent_city') }}
        </p>
        @endif
    </div>
     {{-- state --}}
     <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="parent_state" placeholder="State">
        </div>
        @if($errors->register->has('parent_state'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('parent_state') }}
        </p>
        @endif
    </div>
     {{-- country --}}
     <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <select class="form-select w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="parent_country">
                <option>USA</option>
                <option value="AF">Afghanistan</option>
                <option value="AX">Aland Islands</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AS">American Samoa</option>
                <option value="AD">Andorra</option>
                <option value="AO">Angola</option>
                <option value="AI">Anguilla</option>
                <option value="AQ">Antarctica</option>
                <option value="AG">Antigua and Barbuda</option>
                <option value="AR">Argentina</option>
                <option value="AM">Armenia</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="AZ">Azerbaijan</option>
                <option value="BS">Bahamas</option>
                <option value="BH">Bahrain</option>
                <option value="BD">Bangladesh</option>
                <option value="BB">Barbados</option>
                <option value="BY">Belarus</option>
                <option value="BE">Belgium</option>
                <option value="BZ">Belize</option>
                <option value="BJ">Benin</option>
                <option value="BM">Bermuda</option>
                <option value="BT">Bhutan</option>
                <option value="BO">Bolivia</option>
                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                <option value="BA">Bosnia and Herzegovina</option>
                <option value="BW">Botswana</option>
                <option value="BV">Bouvet Island</option>
                <option value="BR">Brazil</option>
                <option value="IO">British Indian Ocean Territory</option>
                <option value="BN">Brunei Darussalam</option>
                <option value="BG">Bulgaria</option>
                <option value="BF">Burkina Faso</option>
                <option value="BI">Burundi</option>
                <option value="KH">Cambodia</option>
                <option value="CM">Cameroon</option>
                <option value="CA">Canada</option>
                <option value="CV">Cape Verde</option>
                <option value="KY">Cayman Islands</option>
                <option value="CF">Central African Republic</option>
                <option value="TD">Chad</option>
                <option value="CL">Chile</option>
                <option value="CN">China</option>
                <option value="CX">Christmas Island</option>
                <option value="CC">Cocos (Keeling) Islands</option>
                <option value="CO">Colombia</option>
                <option value="KM">Comoros</option>
                <option value="CG">Congo</option>
                <option value="CD">Congo, Democratic Republic of the Congo</option>
                <option value="CK">Cook Islands</option>
                <option value="CR">Costa Rica</option>
                <option value="CI">Cote D'Ivoire</option>
                <option value="HR">Croatia</option>
                <option value="CU">Cuba</option>
                <option value="CW">Curacao</option>
                <option value="CY">Cyprus</option>
                <option value="CZ">Czech Republic</option>
                <option value="DK">Denmark</option>
                <option value="DJ">Djibouti</option>
                <option value="DM">Dominica</option>
                <option value="DO">Dominican Republic</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypt</option>
                <option value="SV">El Salvador</option>
                <option value="GQ">Equatorial Guinea</option>
                <option value="ER">Eritrea</option>
                <option value="EE">Estonia</option>
                <option value="ET">Ethiopia</option>
                <option value="FK">Falkland Islands (Malvinas)</option>
                <option value="FO">Faroe Islands</option>
                <option value="FJ">Fiji</option>
                <option value="FI">Finland</option>
                <option value="FR">France</option>
                <option value="GF">French Guiana</option>
                <option value="PF">French Polynesia</option>
                <option value="TF">French Southern Territories</option>
                <option value="GA">Gabon</option>
                <option value="GM">Gambia</option>
                <option value="GE">Georgia</option>
                <option value="DE">Germany</option>
                <option value="GH">Ghana</option>
                <option value="GI">Gibraltar</option>
                <option value="GR">Greece</option>
                <option value="GL">Greenland</option>
                <option value="GD">Grenada</option>
                <option value="GP">Guadeloupe</option>
                <option value="GU">Guam</option>
                <option value="GT">Guatemala</option>
                <option value="GG">Guernsey</option>
                <option value="GN">Guinea</option>
                <option value="GW">Guinea-Bissau</option>
                <option value="GY">Guyana</option>
                <option value="HT">Haiti</option>
                <option value="HM">Heard Island and Mcdonald Islands</option>
                <option value="VA">Holy See (Vatican City State)</option>
                <option value="HN">Honduras</option>
                <option value="HK">Hong Kong</option>
                <option value="HU">Hungary</option>
                <option value="IS">Iceland</option>
                <option value="IN">India</option>
                <option value="ID">Indonesia</option>
                <option value="IR">Iran, Islamic Republic of</option>
                <option value="IQ">Iraq</option>
                <option value="IE">Ireland</option>
                <option value="IM">Isle of Man</option>
                <option value="IL">Israel</option>
                <option value="IT">Italy</option>
                <option value="JM">Jamaica</option>
                <option value="JP">Japan</option>
                <option value="JE">Jersey</option>
                <option value="JO">Jordan</option>
                <option value="KZ">Kazakhstan</option>
                <option value="KE">Kenya</option>
                <option value="KI">Kiribati</option>
                <option value="KP">Korea, Democratic People's Republic of</option>
                <option value="KR">Korea, Republic of</option>
                <option value="XK">Kosovo</option>
                <option value="KW">Kuwait</option>
                <option value="KG">Kyrgyzstan</option>
                <option value="LA">Lao People's Democratic Republic</option>
                <option value="LV">Latvia</option>
                <option value="LB">Lebanon</option>
                <option value="LS">Lesotho</option>
                <option value="LR">Liberia</option>
                <option value="LY">Libyan Arab Jamahiriya</option>
                <option value="LI">Liechtenstein</option>
                <option value="LT">Lithuania</option>
                <option value="LU">Luxembourg</option>
                <option value="MO">Macao</option>
                <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                <option value="MG">Madagascar</option>
                <option value="MW">Malawi</option>
                <option value="MY">Malaysia</option>
                <option value="MV">Maldives</option>
                <option value="ML">Mali</option>
                <option value="MT">Malta</option>
                <option value="MH">Marshall Islands</option>
                <option value="MQ">Martinique</option>
                <option value="MR">Mauritania</option>
                <option value="MU">Mauritius</option>
                <option value="YT">Mayotte</option>
                <option value="MX">Mexico</option>
                <option value="FM">Micronesia, Federated States of</option>
                <option value="MD">Moldova, Republic of</option>
                <option value="MC">Monaco</option>
                <option value="MN">Mongolia</option>
                <option value="ME">Montenegro</option>
                <option value="MS">Montserrat</option>
                <option value="MA">Morocco</option>
                <option value="MZ">Mozambique</option>
                <option value="MM">Myanmar</option>
                <option value="NA">Namibia</option>
                <option value="NR">Nauru</option>
                <option value="NP">Nepal</option>
                <option value="NL">Netherlands</option>
                <option value="AN">Netherlands Antilles</option>
                <option value="NC">New Caledonia</option>
                <option value="NZ">New Zealand</option>
                <option value="NI">Nicaragua</option>
                <option value="NE">Niger</option>
                <option value="NG">Nigeria</option>
                <option value="NU">Niue</option>
                <option value="NF">Norfolk Island</option>
                <option value="MP">Northern Mariana Islands</option>
                <option value="NO">Norway</option>
                <option value="OM">Oman</option>
                <option value="PK">Pakistan</option>
                <option value="PW">Palau</option>
                <option value="PS">Palestinian Territory, Occupied</option>
                <option value="PA">Panama</option>
                <option value="PG">Papua New Guinea</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PH">Philippines</option>
                <option value="PN">Pitcairn</option>
                <option value="PL">Poland</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="QA">Qatar</option>
                <option value="RE">Reunion</option>
                <option value="RO">Romania</option>
                <option value="RU">Russian Federation</option>
                <option value="RW">Rwanda</option>
                <option value="BL">Saint Barthelemy</option>
                <option value="SH">Saint Helena</option>
                <option value="KN">Saint Kitts and Nevis</option>
                <option value="LC">Saint Lucia</option>
                <option value="MF">Saint Martin</option>
                <option value="PM">Saint Pierre and Miquelon</option>
                <option value="VC">Saint Vincent and the Grenadines</option>
                <option value="WS">Samoa</option>
                <option value="SM">San Marino</option>
                <option value="ST">Sao Tome and Principe</option>
                <option value="SA">Saudi Arabia</option>
                <option value="SN">Senegal</option>
                <option value="RS">Serbia</option>
                <option value="CS">Serbia and Montenegro</option>
                <option value="SC">Seychelles</option>
                <option value="SL">Sierra Leone</option>
                <option value="SG">Singapore</option>
                <option value="SX">Sint Maarten</option>
                <option value="SK">Slovakia</option>
                <option value="SI">Slovenia</option>
                <option value="SB">Solomon Islands</option>
                <option value="SO">Somalia</option>
                <option value="ZA">South Africa</option>
                <option value="GS">South Georgia and the South Sandwich Islands</option>
                <option value="SS">South Sudan</option>
                <option value="ES">Spain</option>
                <option value="LK">Sri Lanka</option>
                <option value="SD">Sudan</option>
                <option value="SR">Suriname</option>
                <option value="SJ">Svalbard and Jan Mayen</option>
                <option value="SZ">Swaziland</option>
                <option value="SE">Sweden</option>
                <option value="CH">Switzerland</option>
                <option value="SY">Syrian Arab Republic</option>
                <option value="TW">Taiwan, Province of China</option>
                <option value="TJ">Tajikistan</option>
                <option value="TZ">Tanzania, United Republic of</option>
                <option value="TH">Thailand</option>
                <option value="TL">Timor-Leste</option>
                <option value="TG">Togo</option>
                <option value="TK">Tokelau</option>
                <option value="TO">Tonga</option>
                <option value="TT">Trinidad and Tobago</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="TM">Turkmenistan</option>
                <option value="TC">Turks and Caicos Islands</option>
                <option value="TV">Tuvalu</option>
                <option value="UG">Uganda</option>
                <option value="UA">Ukraine</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                <option value="US">United States</option>
                <option value="UM">United States Minor Outlying Islands</option>
                <option value="UY">Uruguay</option>
                <option value="UZ">Uzbekistan</option>
                <option value="VU">Vanuatu</option>
                <option value="VE">Venezuela</option>
                <option value="VN">Viet Nam</option>
                <option value="VG">Virgin Islands, British</option>
                <option value="VI">Virgin Islands, U.s.</option>
                <option value="WF">Wallis and Futuna</option>
                <option value="EH">Western Sahara</option>
                <option value="YE">Yemen</option>
                <option value="ZM">Zambia</option>
                <option value="ZW">Zimbabwe</option>
              </select>
        </div>
    </div>
        {{-- zip --}}
        <div class="mb-6">
            <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
                <span class="text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span>
                <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="parent_zip" placeholder="Zip">
            </div>
            @if($errors->register->has('parent_zip'))
            <p class="text-red-500 text-xs mt-2">
                {{ $errors->register->first('parent_zip') }}
            </p>
            @endif
        </div>
            {{-- phone --}}
     <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="phone" placeholder="Your Contact number">
        </div>
        @if($errors->register->has('phone'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('phone') }}
        </p>
        @endif
    </div>


    {{-- Email --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="email" value="{{ old('email') }}" placeholder="your@email.com">
        </div>
        @if($errors->register->has('email'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('email') }}
        </p>
        @endif
    </div>
{{-- checkbox if the user is married or not --}}
    <div class="col-12">
        <div class="form-check">
          <input class="form-check-input"  type="checkbox" id ="married" wire:model='married' >
          <label class="form-check-label" for="gridCheck">
            Are u married
          </label>
        </div>
      </div>


      {{-- script tag to hide the form if user doesnt click the checkbox --}}
      <script type="text/javascript">
        $(function(){
         $('#married').click(function(){
           if($(this).is(':checked')){
             $('#hidemarriedinfo').show();
       
           }else{
             $('#hidemarriedinfo').hide();
           }
         });
        });
        
       </script>
       <script>
         $(function(){
         $('#haschild').click(function(){
           if($(this).is(':checked')){
             $('#hidechildinfo').show();
       
           }else{
             $('#hidechildinfo').hide();
           }
         });
        });
        $(function(){
         $('#no').click(function(){
           if($(this).is(':checked')){
             $('#diffadress').show();
       
           }else{
             $('#diffadress').hide();
           }
         });
        });
       </script>
{{-- script end --}}
{{-- spouse first name --}}
<div id="hidemarriedinfo" style="display:none">
<div class="mb-6">
    <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
        <span class="text-purple-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </span>
        <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="spouse_first_name" placeholder="Spouse first name">
    </div>
</div>
{{-- spouse last name --}}
<div class="mb-6">
    <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
        <span class="text-purple-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </span>
        <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="spouse_last_name" placeholder="Spouse last name">
    </div>
</div>


{{-- if the user has child --}}
<div class="col-12">
    <div class="form-check">
      <input class="form-check-input" value="1" type="checkbox" id="haschild" >
      <label class="form-check-label" for="gridCheck">
        Do u have children under the age of 18
      </label>
    </div>
  </div>
  {{-- child first name --}}
  <div id="hidechildinfo" style="display:none">
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="child_first_name" placeholder="Child first name">
        </div>
    </div>
    {{-- child last name --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="child_last_name" placeholder="Child last name">
        </div>
    </div>
    {{-- child age --}}
    <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
            <span class="text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </span>
            <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="integer" name="child_age" placeholder="Child age">
        </div>
    </div>
    <div class="col-12">
        <input class="form-check-input"  type="checkbox" id ="no" >
        <label class="form-check-label" for="gridCheck">
          If he doesnt live with you 
         
        </label>
      </div>
        {{-- child address --}}
        <div id="diffadress" style="display:none">
            <div class="mb-6">
                        <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
                        <span class="text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="child_address" placeholder="Child address">
                </div>
            </div>
              <div class="mb-6">
                <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
                <span class="text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span>
                <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="child_city" placeholder="Child's City">
               </div>
              </div>
              <div class="mb-6">
                <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
                <span class="text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span>
                <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="child_state" placeholder="Child's state">
               </div>
              </div>
            
              <div class="mb-6">
                <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
                <span class="text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span>
                <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="child_country" placeholder="Child's Country">
               </div>
              </div>
              <div class="mb-6">
                <div class="flex items-center space-x-2 p-2 border-2 rounded border-purple-700">
                <span class="text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </span>
                <input class="w-full p-1 bg-transparent placeholder-purple-900 placeholder-opacity-75 text-sm font-medium autofill-transparent" type="text" name="child_zip" placeholder="Child's Zip">
               </div>
              </div>
        </div>
  </div>
</div>
{{-- for price --}}
<input type="hidden" name="registerAmount" value="3487">

    {{-- Password Confirmation --}}
    {{-- <div class="mb-6">
        <div class="flex items-center space-x-2 p-2 border-2 rounded {{ $errors->register->has('password_confirmation') ? 'border-red-500' :'border-purple-700' }}"">
            <span class=" text-purple-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            </span>
            <input type="password" class="w-full p-1 placeholder-purple-900 placeholder-opacity-75 text-sm font-medium" name="password_confirmation" placeholder="Password one last time">
        </div>
        @if($errors->register->has('password_confirmation'))
        <p class="text-red-500 text-xs mt-2">
            {{ $errors->register->first('password_confirmation') }}
        </p>
        @endif
    </div> --}}

 

    {{-- Recaptcha --}}
    {{-- @if (settings('register_enable_captcha') == 'yes')
    <div class="flex flex-wrap mb-6">
        {!! htmlFormSnippet() !!}
        @if($errors->register->has('g-recaptcha-response'))
        <p class="text-red-500 text-xs mt-3">
            <strong>{{ $errors->register->first('g-recaptcha-response') }}</strong>
        </p>
        @endif
    </div>
    @endif --}}

    {{-- Button --}}
    <div class="flex flex-wrap">
        <button type="submit" class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 hover:shadow-lg text-gray-100 font-semibold py-2 px-6 rounded-sm focus:outline-none focus:shadow-outline focus:bg-purple-700 tracking-wider uppercase">
            {{ __('Register') }}
        </button>
    </div>
</form>
