
<div class="account-foot">
    <div class="item">
        <a href="./dashboard">
            <i class="fa-solid fa-house"></i>
            <p>Home</p>
        </a>
    </div>
    <div class="item">
        <a href="./transfer">
            <i class="fa-solid fa-money-bill-transfer"></i>
            <p>Transfer</p>
        </a>
    </div>
    <div class="item">
        <a href="./cards">
            <i class="fa-solid fa-credit-card"></i>
            <p>Cards</p>
        </a>
    </div>
    <div class="item">
        <a href="./settings">
            <i class="fa-solid fa-user-pen"></i>
            <p>settings</p>
        </a>
    </div>
</div>

<script src="assets/js/index.js"></script> 
   <!--<script src="assets/jquery-3.6.1.min.js"></script>-->
<script src="assets/js/aos.js"></script>
    <script> 
    var userNav = document.querySelector('.user-nav');
    var closeIcon = document.getElementById('close-nav');
    var profileIcon = document.getElementById('user-icon');
     profileIcon.addEventListener("click", function(e){
        e.preventDefault();
        userNav.classList.toggle('show-user');
        console.log('clicked! Class toggled:', navCont.classList.contains('show-nav'));  
        
    })
    closeIcon.addEventListener("click", function(e){
        e.preventDefault();
        userNav.classList.toggle('show-user');
        console.log('clicked! Class toggled:', navCont.classList.contains('show-nav'));  
        
    })

        AOS.init({
            easing: 'ease-in-out-sine',
            duration: 1000
        });
    </script>
</body>
</html>