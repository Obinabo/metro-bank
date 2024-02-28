<div class="footer2" style="background: var(--dark-black); color: var(--white-color);">
        <div class="copyright align-center">
            <?php
                if(isset($_SESSION['id'])){
                    echo '<p class="white">Powered by Walcode</p>';
                }else{
                    echo '<p class="white">Powered by '.SITE_NAME_SHORT.' copyright &copy; 2023</p>';
                }
            ?>
            
        </div>
    </div>
   
   <script src="../assets/js/aos.js"></script>
   <script> 

    var countries = [
        "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", "Armenia",
        "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus",
        "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil",
        "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada",
        "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Costa Rica",
        "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
        "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia",
        "Eswatini", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana",
        "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary",
        "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan",
        "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kosovo", "Kuwait",
        "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania",
        "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands",
        "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro",
        "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand",
        "Nicaragua", "Niger", "Nigeria", "North Macedonia", "Norway", "Oman", "Pakistan", "Palau", "Palestine",
        "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar",
        "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines",
        "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
        "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
        "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan",
        "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia",
        "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom",
        "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam",
        "Yemen", "Zambia", "Zimbabwe"
    ];

    var select = document.getElementById("countrySelect");

    countries.forEach(function (country) {
        var option = document.createElement("option");
        option.value = country.toLowerCase().replace(/\s+/g, '-');
        option.text = country;
        select.add(option);
    });
    

    var mobileIcon = document.getElementById('mobile-icon');
    var navCont = document.querySelector('.admin-cont');
    mobileIcon.addEventListener("click", function(e){
        e.preventDefault();
        navCont.classList.toggle('show-nav');
        console.log('clicked! Class toggled:', navCont.classList.contains('show-nav'));
        var isNavContVisible = navCont.classList.contains('show-nav');

        // Update the content of mobile-icon based on visibility
        if (isNavContVisible) {
            mobileIcon.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        } else {
            mobileIcon.innerHTML = '<i class="fa-solid fa-bars"></i>';
        }
    })
    var itemLinks = document.getElementById('noClick');
        itemLinks.addEventListener('click', function(e){
            e.preventDefault();
        });

    AOS.init({
    easing: 'ease-in-out-sine',
    duration: 1000
     });</script>
</body>
</html>