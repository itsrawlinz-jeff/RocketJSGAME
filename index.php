<?php 
    session_start();
    ob_start(); // Start output buffering
    global $identity;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Horizon</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/gamestyle.css" rel="stylesheet">

            <!-- Page Transitions -->
    <!--<script defer src="node_modules/swup/dist"></script> -->
    <!--<script defer src="https://unpkg.com/swup@3"></script>
      -->

      <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js"></script>

    <!-- Add Firestore -->
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-firestore.js"></script>

    <!-- pop Up-->
    <script defer src="transision.js"></script> 
    <link href="transision.css" rel="stylesheet">

</head>

<body id="swup" class="transition-fadeOut">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!----------------------------------- FIREBASE HERE ------------------------------->

<script type="module">

  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
  import { getFirestore, collection, addDoc, updateDoc, doc} from "https://www.gstatic.com/firebasejs/9.17.1/firebase-firestore.js";
  import { onSnapshot } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-firestore.js";

    const firebaseConfig = {
      apiKey: "AIzaSyAD2Lh_5ZguOtuyghcwb9qKoS_uHn8H7Mg",
      authDomain: "horizon-b3c9e.firebaseapp.com",
      projectId: "horizon-b3c9e",
      storageBucket: "horizon-b3c9e.appspot.com",
      messagingSenderId: "336755058283",
      appId: "1:336755058283:web:1d139c74e3c9ceb35ff32e",
      measurementId: "G-4Q7XY7F4JX"
    };
  
    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);

  const bgImage = new Image();
  bgImage.src = 'game_assets/outer-space.jpg';

    function stars(argument) {
        // body...
        let count = 50;
        let scene = document.querySelector('.scene');
        let i = 0;
        while(i < count){
            let star=document.createElement('i');
            let x=Math.floor(Math.random() * window.innerWidth);

            let duration = Math.random() * 1;
            let h = Math.random() * 100;

            star.style.left = x + 'px';
            star.style.width = 1 + 'px';
            star.style.height = 50 + h + 'px';
            star.style.animationDuration = duration + 's';



            scene.appendChild(star);
            i++  
        }
    }
    stars();

    function rocket(){
        // console.log('rocket');
        var rocket1 = document.querySelector('.rocket');
        var busted = document.querySelector('.busted');
        busted.style.display = 'none';

        function blow(){setTimeout(function(){
            rocket1.style.display = 'none';
            busted.style.display = 'block';
            
            let stars = document.querySelectorAll('.scene i');
            stars.forEach(function(star){
                star.style.animationPlayState = 'paused';
            });

            appear();
        }, 2000);}

        // blow();
        function appear(){setTimeout(function(){
            rocket1.style.display = 'block';
            busted.style.display = 'none';
            
            let stars = document.querySelectorAll('.scene i');
            stars.forEach(function(star){
                star.style.animationPlayState = 'running';
            });

            // blow();
        }, 4000);}

        appear();

    }
    rocket();
    

    const animationsCollection = collection(db, 'animations');

    const oddsText = document.querySelector('.oddscounter h1');
    let oddsInterval = null;
    

    const startOddsCounter = () => {
const oddsText = document.querySelector('.oddscounter h1');
// console.log("odds text here", oddsText)
  let oddsInterval = null;

  // Send an AJAX GET request to retrieve the current odds counter value from the server
  let executedOnce = false;

  const updateOddsCounter = () => {
  $.get('http://localhost:8080/oddscounter', (data) => {
    let oddsCount = parseFloat(data);
    let aco = parseFloat(document.getElementById("aco").value);
    console.log(aco);
    let pesa = document.getElementById("pesa").value;
    console.log(pesa);
    if(oddsCount >= aco && !executedOnce){
        var multiply = pesa * aco;
        console.log("mulr here", multiply);
        executedOnce = true; 

        $.ajax({
  url: "update-stake.php",
  type: "POST",
  data: { value: multiply},
  success: function(response) {
    // Handle the response from the server
    console.log(response);
}
});
    }
    console.log("oddscount here", oddsCount);
    // console.log(`odds counter value received from server: ${data}`);

    if (isNaN(oddsCount)) {
      oddsCount = 0.0;
    }
    oddsText.innerHTML = oddsCount.toFixed(2);
  });
};

// Start the odds counter update interval
setInterval(updateOddsCounter, 100); // update every 100 milliseconds

$.post('http://localhost:8080/incrementoddscounter', () => {
  console.log('Odds counter started on the server');
});
    }

//     const stopOddsCounter = () => {
//         const oddsText = document.querySelector('.oddscounter h1');
//         const oddsValue = oddsText.textContent; // Get the value from the element

// // Make an AJAX POST request to your PHP script
// const xhr = new XMLHttpRequest();
// xhr.open('POST', 'index.php');
// xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
// xhr.send('odds=' + encodeURIComponent(oddsValue)); // Send the odds value as a parameter

//         console.log("stopped here", oddsText);
//     clearInterval(oddsInterval);
//     }
const stopOddsCounter = () => {
  const oddsText = document.querySelector('.oddscounter h1');

  
$.ajax({
  url: "update-stake.php",
  type: "POST",
  data: { value: oddsText },
  success: function(response) {
    // Handle the response from the server
    console.log(response);
}
});
//   const oddsValue = oddsText.textContent; // Get the value from the element

//   const xhr = new XMLHttpRequest();
//   xhr.open('POST', 'update-stake.php');
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState === XMLHttpRequest.DONE) {
//       if (xhr.status === 200) {
//         const response = xhr.responseText;
//         console.log(response); // Handle the response if needed
//       } else {
//         console.error('Error: ' + xhr.status); // Handle errors
//       }
//     }
//   };
//   xhr.send('odds=' + encodeURIComponent(oddsValue));
  
  console.log("stopped here", oddsText);
  clearInterval(oddsInterval);
};


    const animationListener = () => {
    console.log("animationListener");
    onSnapshot(doc(db, "animations", "animation"), (doc) => {
        console.log("Current data: ", doc.data());
        if (doc.data().isPlaying) {
        console.log("start animation");
        var rocket1 = document.querySelector('.rocket');
        var busted = document.querySelector('.busted');
        rocket1.style.display = 'block';
        busted.style.display = 'none';
        let stars = document.querySelectorAll('.scene i');
        stars.forEach(function(star) {
            star.style.animationPlayState = 'running';
        });
        let odds = document.querySelector('.oddscounter'); 
        console.log("odds here", odds);
  
        odds.style.display = 'block';

        startOddsCounter();

        let svgElements = document.querySelector('.scene .moon');
        let svgElement2 = document.querySelector('.scene .planet');
        svgElements.style.display = 'block';
        svgElement2.style.display = 'block';
        } else {
        console.log("stop animation");
        var rocket1 = document.querySelector('.rocket');
        var busted = document.querySelector('.busted');
        rocket1.style.display = 'none';
        busted.style.display = 'block';
        let stars = document.querySelectorAll('.scene i');
        stars.forEach(function(star) {
            star.style.animationPlayState = 'paused';
        });
        stopOddsCounter();
       
        
    let counter = document.querySelector('.counter');
        counter.style.display = 'block';
        let count = 5;
        let counterText = document.querySelector('.counter h1');
        counterText.innerHTML = count;
        let counterInterval = setInterval(function() {
            count--;
            counterText.innerHTML = count;
            if (count == 0) {
            clearInterval(counterInterval);
            counter.style.display = 'none';
            //   startOddsCounter();
            }
        }, 1000);

        let svgElements = document.querySelector('.scene .moon');
        let svgElement2 = document.querySelector('.scene .planet');
        svgElements.style.display = 'none';
        svgElement2.style.display = 'none';
        }
    });
    };



    animationListener();

</script>


<!----------------------------------- FIREBASE HERE ------------------------------->



    <!-- Header Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 bg-secondary d-none d-lg-block">
                <a href="" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                    <h1 class="m-0 display-3 text-primary">RKash</h1>
                </a>
            </div>
            <div class="col-lg-9">
                <div class="row bg-dark d-none d-lg-flex">
                    <div class="col-lg-7 text-left text-white">
                        <div class="h-100 d-inline-flex align-items-center border-right border-primary py-2 px-3">
                            <i class="fa fa-envelope text-primary mr-2"></i>
                            <small>info@rocktkach.com</small>
                        </div>
                        <div class="h-100 d-inline-flex align-items-center py-2 px-2">
                            <i class="fa fa-phone-alt text-primary mr-2"></i>
                            <small>+254  ****  | +254******** </small>
                        </div>
                    </div>
                    <div class="col-lg-5 text-right">
                        <div class="d-inline-flex align-items-center pr-2">
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="text-primary p-2" href="">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
                    <a href="" class="navbar-brand d-block d-lg-none">
                        <h1 class="m-0 display-4 text-primary">RKash</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <!--
                    <div class="button large popup-button" data-target="#popup-main">Login Popup</div>
                    <div class="button large popup-button" data-target="#popup-secondary">SignUp Popup</div>
                    -->
                    <?php
                    error_reporting(E_ERROR | E_PARSE);
                    if(!isset($_SESSION['loggedin'])){
                    echo '<button type="button" class="btn btn-primary button large popup-button" data-target="#popup-main">SIGN IN</button> </a>';
                    echo'<br>';
                    echo '<br>';
                    echo '<button type="button" class="btn btn-secondary button large popup-button" data-target="#popup-secondary">SIGN UP</button>';
                    echo '<br>';
                    echo '<br>';
                    
                    }
                    else{
                        echo '<strong> Hello, '.$_SESSION['user_name'].' ! </strong>'.'<br>';
                        
                    }
                    ?>
                    <button onclick ="location.href = 'signout.php';" type="button" class="btn btn-primary button large">SIGN OUT</button> </a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-secondary text-uppercase">Rocket Cash</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-sm btn-outline-light" href="">Home</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-sm btn-outline-light disabled" href="">Project</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <div class="nav-link popup-button"  data-target="#popup-cashier">Cashier </div>
      </li>
      <li class="nav-item">
        <div class="nav-link popup-button" data-target="#popup-affiliate">Affiliate Program</div>
      </li>
      <li class="nav-item">
        <div class="nav-link popup-button" data-target="#popup-FAQs">FAQs</div>
      </li>
       <li class="nav-item">
        <div class="nav-link popup-button" data-target="#popup-profiles">Profile</div>
      </li>
        <li class="nav-item">
        <div class="nav-link popup-button" data-target="#popup-account">Account Balance</div>
      </li>
      </li>
        <li class="nav-item">
        <div class="nav-link popup-button" data-target="#popup-chats">Chats</div>
      </li>
    
    </ul>
  </div>
    </nav>
    <!-- Game Code Start -->
 <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                    <div class="scene"> 

        <style>
        .scene{
            z-index: -1;
            height: 100vh;
            position: relative;
            background:  linear-gradient(to bottom, #0d0d29, #1a1a52);
            background-image: url(game_assets/outer-space.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;

            transition: background-color 2s ease-out;
            }
            .rocket{
                z-index: 1000;
            }
                            @media screen and (max-width: 600px){
                                .scene{
                                    height: 50vh;
                                }
                            }
                        </style>
                        <div class="busted"><h1>BUSTED</h1></div>
                    <div class="rocket">
                        
                    <img src="rocket.png"> 

                   <!--  <input class="form-control" type="text" placeholder="X1.5" readonly style="color:black !important;"> -->
              
<!-- <center>
<button type="button" class="btn btn-secondary">PLAY</button>
<button type="button" class="btn btn-danger">STOP</button>

</center> -->

        </div>

  <script>
    const scene = document.querySelector('.scene');

    function createSVG(className, src) {
  const img = new Image();
  img.src = src;
  img.alt = className;
  img.className = className;
  img.onload = function() {
    // positionSVG(img);
    animateSVG(img);
  }
  scene.appendChild(img);
}


function positionSVG(svg) {
//     const x = Math.random() * (window.innerWidth - svg.width);
//   const y = -300; // adjust y position to be offscreen at top of .scene div
//   svg.style.left = `${x}px`;
//   svg.style.top = `${y}px`;
}

function animateSVG(svg) {
  const duration = Math.random() * 10 + 5;
  const delay = Math.random() * 10;
  const y = window.innerHeight;
  svg.animate([
    { transform: `translateY(0)` },
    { transform: `translateY(${y}px)` }
  ], {
    duration: duration * 10000,
    delay: delay * 0,
    iterations: Infinity
  });
}

// createSVG('cloud', 'game_assets/cloud.svg');

createSVG('moon', 'game_assets/moon.svg');
createSVG('planet', 'game_assets/planet2.svg');

  </script>
<style>


.moon,
.planet{
  position: absolute;
  pointer-events: none;
  /* z-index: -1;  */
}

.moon {
  top: -20%;
  fill: grey;
  width: 200px;
  height: 200px;
  filter: blur(2px);
  left: -10%;
}

.planet {
    top: -25%;
    left: 85%;
    fill: blue;
    width: 300px;
    height: 300px;
  filter: blur(2px);
}

@media screen and (max-width: 600px){
  .planet{
    width: 100px;
    height: 100px;
    left: 85%;
  }
  .moon{
    width: 80px;
    height: 80px;
  }
}

</style>        
        <!-- place the oddscounter at the bottom of the div -->
        <div class="oddscounter"
         style="display: none; position: absolute; bottom: 0;  margin: 10px; padding: 10px; background: none; color: #fff; font-size: 20px; font-weight: bold;">
        
        <h1></h1>
    </div>
        </div>
    </div>

    <div class="counter" style="display: none;">
            Relaunching in: <h1 style="font-size: 20px;"></h1>
        </div>




    <!--Game Code End-->
    <center>
            <form>
        <fieldset disabled>
            
            <div class="mb-3">
            <label for="disabledTextInput" class="form-label" style="color:green !important;"><b>RUNNING STAKES</b>  </label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder=" X30.5">
        </fieldset>
        </form>
        <form action="update-stake.php" method="POST">
        <div class="mb-3">
            <label for="" class="form-label" style="color:blue !important"> <b>AMOUNT</b> </label>
            <input type="number" name="pesa" class="form-control" id="pesa" aria-describedby="Amount To Stake">
            <div id="" class="form-text">Enter the Amount To Stake</div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label"> <b>Auto Cash Out(X)</b> </label>
            <input type="number" name="aco" id="aco" class="form-control" id="1">
        </div>
        
        <button type="submit" class="btn btn-primary">STAKE</button>
        </form>

    </center>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="index.html" class="navbar-brand">
                    <h1 class="m-0 mt-n3 display-4 text-primary">Horizon</h1>
                </a>
                <p>Best Online Gaming Platform</p>
               
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-primary mb-4">Get In Touch</h4>
                <p><i class="fa fa-map-marker-alt text-primary mr-2"></i>Adress Goes Here</p>
                <p><i class="fa fa-phone-alt text-primary mr-2"></i>+95 | +254</p>
                <p><i class="fa fa-envelope text-primary mr-2"></i>info@horizon</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-light btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-light btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-light btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-light btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-semi-bold text-primary mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Services</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Projects</a>
                    <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                </div>
            </div>
           
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: #3E3E4E !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">Horizon Gaming Platforn</a>. All Rights Reserved. <a href="#">Horizon</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary px-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

<!-- Template Javascript -->
    <script src="js/main.js"></script>

    
    
    <div class="popup" id="popup-main">
        <div class="popup-overlay popup-button" data-target="#popup-main"></div>
        <div class="popup-inner">
            <?php
              include("connection.php");
              include("functions.php");
              if($_SERVER['REQUEST_METHOD'] == "POST")
              {
              //something was posted
              $user_name = $_POST['user_nameL'];
              $password = $_POST['passwordL'];
              
              if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
              {
                  //read from database:
                  //$query = "select * from users where user_name = '$user_name' limit 1 ";
                  $query = "SELECT * FROM users JOIN user_status ON users.user_id = user_status.user_id WHERE user_name = '$user_name' LIMIT 1";
                  
              
                  //$result = mysqli_query($con, $query);
                  $result = $con->query($query);
                  if($result)
                  {
                      if($result && mysqli_num_rows($result) > 0)
                      {
                          $user_data = mysqli_fetch_assoc($result);
                          if($user_data['password'] === $password)
                          {
                              $_SESSION['user_id'] = $user_data['user_id'];
                              $_SESSION['user_name'] = $user_data['user_name'];
                              $_SESSION['date'] = $user_data['date'];
                              $_SESSION['loggedin'] = true;
              
                              $_SESSION['user_deposite'] = $user_data['deposite'];
                              $_SESSION['user_withdraw'] = $user_data['withdrawals'];
                              $_SESSION['user_balance'] = $user_data['balance'];
                              $_SESSION['user_winnings'] = $user_data['winnings'];
                              
                              $identity = $user_data['user_id'];
              
                              header("Refresh:0");
                              
                              die;
                              
                          }else{
                              echo "<script>alert('Wrong username or password !!')</script>";
                          }
                      }else{
                          echo "<script>alert('Wrong username or password !!')</script>";
                      }
                  } 
                  else{
                      echo "<script>alert('Wrong username or password !!')</script>";
                  }
                  
              }else
              {
                  echo "<script>alert('Couldn't signIn !!')</script>";
              }
              
              }
               
            ?>
            <div id="box"> 
                <form method= "post">
                    <div style="font-size: 20px; margin: 10px;color:mwhite; ">Login</div>
                    <input id ="text"type="text" name= "user_nameL" placeholder="name" ><br><br>
                    <input id ="text"type="text" name= "contact" placeholder="+254.."><br><br>
                    <input id ="text"type="password" name= "passwordL" placeholder="***"><br><br>
                    <input id ="button"  type="submit" name= "login"><br><br>

                    <button  class="button popup-button" data-target="#popup-main" style="border: none; background-color: whitesmoke;">X</button>
                    <!-- <a href='/RocketJSGame/RocketJSGAME/signUp.html'>Click to Signup</a><br><br> -->
                </form>
            </div>
        </div>
    </div>

    <div class="popup" id="popup-secondary">
        <div class="popup-overlay popup-button" data-target="#popup-secondary"></div>
        <div class="popup-inner">
        <?php
            //session_start();
            include("connection.php");
            require_once "functions.php";
            
            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                //something was posted
                $contact = $_POST['contact'];
                $user_name = $_POST['user_name'];
                $password = $_POST['password'];

                if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
                {
                    //save to database:
                    $user_id = random_num(20);
                    $query = "insert into users (user_id,user_name,contact,password) values ('$user_id', '$user_name', '$contact', '$password')";
                    $sql = "INSERT INTO user_status (user_id, phone, deposite, withdrawals, balance, winnings) VALUES ('$user_id', '$contact', 0, 0, 0, 0)";

                    mysqli_query($con, $query);
                    mysqli_query($con, $sql);

                    // redirect user to login page
                    echo "<script>alert('Success !!')</script>";
                                   
                    //header("Location: login.php");
                    die;
                }else
                {
                    echo "<script>alert('Please enter some valid information!')</script>";
                    
                }

            }

        ?>
        
        <div id="box">
            <form method= "post">
                <div style="font-size: 20px; margin: 10px;color:mwhite; ">Signup</div>
                <input id ="text"type="tel" pattern="[0-9]{10}" name= "contact" placeholder="07.." required><br><br>
                <input id ="text"type="text" name= "user_name" placeholder="name" required><br><br>
                <input id ="text"type="password" name= "password" placeholder="***" required><br><br>
                <input id="checkbox" type="checkbox" name="tac"> I accept <a href='/RocketJSGame/terms_and_conditions.php'>terms and conditions</a><br><br>

                <input id ="submit"type="submit" name= "signup" style="  height: 50px; color: whitesmoke; border: none; border-radius: 5px; font-size: 20px; font-weight: bold; cursor: pointer;padding: 10px;background-color: #4CAF50; "><br><br>
                <button class="button popup-button" data-target="#popup-secondary" style="border: none; background-color: white;">X</button>
                <!-- <a href='/RocketJSGame/RocketJSGAME/logIn.html'>Click to login</a><br><br> -->
            </form>
        </div>
    </div>

    <div class="popup" id="popup-cashier">
        <div class="popup-overlay popup-button" data-target="#popup-cashier"></div>
        <div class="popup-inner">

            <div id="specialbox"> 
                <div class="popupcontent">
                    <div style="font-size: 20px;font-weight: bold; margin-left: 200px;color:mwhite; ">Wallet</div><br>
                    <div class="nav">
                        <div class="nav-btn" data-target="section1">Deposit</div>
                        <div class="nav-btn" data-target="section2">Withdraw</div>
                        <div class="nav-btn" data-target="section3">History</div>
                        <div class="nav-btn" data-target="section4">Bonus</div>
                    </div>
                    <div class="section active" id="section1">
                        <h2>Deposit</h2>
                        <?php
                            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $conr = $row['contact'];
                            $conr = "254" . trim($conr);
                        ?>
                        <form action="payment-api.php" method= "post">
                            <label>Amount(KES)</label><br>
                            <input id ="text" type="text" name= "amount" placeholder="200"><br><br>
                            <input id ="te" type="text" name= "phone_number" value="<?php echo $conr; ?>" readonly>
                            <br><br>
                            <input id ="text"type="text" name= "user_id" value="<?php echo $user_id; ?>" hidden><br><br> 

                                <div class="sec-content">
                                    <p>Please note:</p>
                                    <p style ="font-size: small"> 
                                        *The minimum deposit required to get a bonus is KES 300.<br>
                                        *Withdrawals will NOT be possible until the bonus is redeemed.<br>
                                        *See our bonus terms and conditions for more information<br>
                                    </p>
                                </div><br>

                            <input id ="submit"type="submit" name= "deposit" style="margin-left: 80px; width: 300px; height: 50px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 20px; font-weight: bold; cursor: pointer;"></input><br><br>
                        </form>

                        <form method= "post">
                            <h3>Verify pending mpesa deposit</h3>
                                <div class="sec-content">
                                    <p style ="font-size: small"> 
                                    We automatically verify all mpesa transactions and you may never have to
                                    use this step. ONLY use this if your deposit is delayed for more than a
                                    minute.<br>
                                    </p>
                                </div><br>
                            <label>Mpesa Reference Number:</label><br>
                            <input id ="text"type="text" name= "amount" placeholder="e.g. OKL12X1DM"><br><br>
                            <input id ="button"type="submit" name= "deposit" style="margin-left: 80px; width: 300px;"></input><br><br>
                        </form>
                        
                    </div>
                    <div class="section" id="section2">
                        <h2>Withdraw</h2>
                        <form>
                            <h5>Withholding Tax Notice</h5>
                            <div class="sec-content">
                                <p style ="font-size: small"> 
                                    As provided for by the Income Tax Act, Cap 472, all gaming companies are required to 
                                    withhold winnings at a rate of 20%. This is the Withholding Tax. In compliance with 
                                    the law, Horizon will deduct and remit to KRA 20% of all winnings.
                                </p>
                            </div><br>
                            
                            <label>Amount(KES)</label><br>
                            <input id ="text"type="text" name= "amount" placeholder="50"><br><br>
                            <div class="sec-content">
                             <div class="content-inner"><p style=" width: 400px;">Available Balance:  </p><div> 0</div></div>
                             <div class="content-inner"><p style=" width: 400px;">Withdraw Amount:  </p><div> 50</div></div>
                             <div class="content-inner"><p style=" width: 400px;">Withholding tax:  </p><div>-10</div></div>
                             <div class="content-inner"><p style=" width: 400px;">Withdraw Fee:  </p><div>16</div></div>
                             <div class="content-inner"><p style=" width: 400px;">Disbursed Amount:  </p><div> 24</div></div>
                            </div><br>
                            <input id ="button"type="submit" name= "withdraw" style="margin-left: 80px; width: 300px;"></input><br><br>
                        </form>
                    </div>
                    <div class="section" id="section3">
                        <h2>History</h2>
                        <div class="sec-content">
                            <h3>No History found</h3>
                        </div><br>
                    </div>
                    <div class="section" id="section4">
                        <h2>Bonus</h2>
                        <div class="sec-content">
                            <h3>You have no Bonus yet</h3>
                        </div><br>
                    </div>
                    <button class="button popup-button" data-target="#popup-cashier" style="border: none; background-color: whitesmoke;">X</button>
                </div>
            </div>
            
        </div>
    </div>

    <div class="popup" id="popup-affiliate">
        <div class="popup-overlay popup-button" data-target="#popup-affiliate"></div>
        <div class="popup-inner">
        
            <div id="specialbox"> 
                <div class="popupcontent">
                    <div style="font-size: 20px;font-weight: bold; margin-left: 100px ;color:mwhite; ">Horizon Affiliate Program</div><br>
                    <h5>Refer a friend and earn 10% of their deposits!</h5><br>
                    <p style ="font-size: small">Copy and share your Affiliate link</p>
                    <div style="display:flex; justify-content: space-between">
                        <input style="width: 350px; background-color: rgb(239, 239, 239); " type="text" name= "amount" placeholder="https://horizonbet.co.ke/affiliate/1234567890">
                        <button id ="button" class="button" style="50px; background-color: rgb(17, 157, 50); width:70px; ">Copy</button>
                    </div><br>
                    <div class="nav">
                        <div class="nav-btn" data-target="summery">Summery</div>
                        <div class="nav-btn" data-target="referals">Referals</div>
                        <div class="nav-btn" data-target="payment">Payment</div>
                        <div class="nav-btn" data-target="secfour">FAQ</div>
                    </div>
                    <div class="section active" id="summery">
                            <div class="sec-content">
                             <div class="content-inner"><p style=" width: 400px;">Number of Referrals:  </p><div> 0</div></div>
                             <div class="content-inner"><p style=" width: 400px;">Total Paid:  </p><div> 0</div></div>
                             <div class="content-inner"><p style=" width: 400px;">Total Unpaid:  </p><div>0</div></div>
                            </div><br>
                            <button id ="button" name= "transferToWallet" style="margin-left: 80px; width: 300px;">TRANSFER TO WALLET</button><br><br>
                            <p style ="font-size: x-small">Transfer will be available once you reach KES 100</p><br><br>
                    </div><br><br>
                    <div class="section" id="referals">
                        <div class="sec-content">
                            <h3>You have no Referrals</h3>
                        </div><br>
                    </div>
                    <div class="section" id="payment">
                        <div class="sec-content">
                            <h3>You have not cashed out Affiliate Earnings</h3>
                        </div><br>
                    </div>
                    <div class="section" id="secfour">
                        <div class="sec-content">
                            <h8>WHAT IS HORIZON AFFILIATE PROGRAM</h8>
                                <p>Horizon Affiliate Program is a way for you to earn money by referring your friends to Horizon. You will earn 10% of their deposits.</p>
                            <h8>HOW MUCH DOES IT COST TO JOIN?</h8>
                                <p>It is absolutely free to join Horizon Affiliate Program.</p>
                            <h8>CAN I STILL BENEFIT IF I DON'T HAVE A WEBSITE?</h8>
                                <p>Yes, you can still benefit from Horizon Affiliate Program even if you don't have a website. You can share your Affiliate link on social media, email, or any other way you can think of.</p>
                            <h8>HOW MUCH DO I EARN?</h8>
                                <p>You will earn 10% of your referrals' deposits.</p>
                            <h8>WHAT IS NEGATIVE REVENUE?</h8>
                                <p>Negative Revenue is the amount of money you have lost to your referrals. If your referrals lose money, you will not earn any commission.</p>
                        </div><br>
                    </div>
                    <button class="button popup-button" data-target="#popup-affiliate" style="border: none; background-color: whitesmoke;">X</button>
                </div>
            </div>
    </div>

    <div class="popup" id="popup-FAQs">
        <div class="popup-overlay popup-button" data-target="#popup-FAQs"></div>
        <div class="popup-inner">
        
        <div id="specialbox"> 
                <div class="popupcontent">
                    <div style="font-size: 20px;font-weight: bold; margin-left: 100px ;color:mwhite; "></div><br><br>
                    
                    <div class="active" id="">

                        <div class="sec-content">
                            <br>
                            <h2>BASICS</h2>
                            <hr>
                        
                            <h7>WHAT IS HORIZON?</h7>
                                <p>Horizon is a sports betting platform that allows you to bet on your favorite sports and win big.</p>

                            <h7>HOW DO I PLAY ROCKET?</h7>
                            <p>First you need to have a positive balance, by depositing money through MPESA to your account or receiving a tip from someone in the community.</p>
                            <p>Next, select the amount to bet and a cash out multiplier. Place your bet. Watch the multiplier increase from 1x upwards! You can cash out before your set up cash out limit, pressing the 'Cash Out' button. Get your bet multiplied by that multiplier. But be careful because the game can bust at any time, and you'll get nothing!</p>

                            <h7>IS HORIZON A FAIR GAME?</h7>
                            <p>Yes, Horizon is a fair game! And we can prove it.</p>
                            <p>There are already 3rd party open source scripts to verify and calculate the game results. Check out this handy tool that one of our players generously made.</p>

                            <h7>HOW HIGH CAN THE GAME GO?</h7>
                            <p>There's no real limit!</p>
                        </div>

                        <br><br>

                        
                        <div class="sec-content">
                            <br>
                            <h2>AFFILIATE PROGRAM</h2>
                            <hr>
                            <h7>WHAT IS HORIZON AFFILIATE PROGRAM</h7>
                                <p>Horizon Affiliate Program is a way for you to earn money by referring your friends to Horizon. You will earn 10% of their deposits.</p>
                            <h7>HOW MUCH DOES IT COST TO JOIN?</h7>
                                <p>It is absolutely free to join Horizon Affiliate Program.</p>
                            <h7>CAN I STILL BENEFIT IF I DON'T HAVE A WEBSITE?</h7>
                                <p>Yes, you can still benefit from Horizon Affiliate Program even if you don't have a website. You can share your Affiliate link on social media, email, or any other way you can think of.</p>
                            <h7>HOW MUCH DO I EARN?</h7>
                                <p>You will earn 10% of your referrals' deposits.</p>
                            <h7>WHAT IS NEGATIVE REVENUE?</h7>
                                <p>Negative Revenue is the amount of money you have lost to your referrals. If your referrals lose money, you will not earn any commission.</p>
                        </div>
                        <br><br>

                    </div>
                    <button class="button popup-button" data-target="#popup-FAQs" style="border: none; background-color: whitesmoke;">X</button>
                </div>
            </div>
    </div>

    <div class="popup" id="popup-profiles">
        <div class="popup-overlay popup-button" data-target="#popup-profiles"></div>
        <div class="popup-inner">
        
            <div id="specialbox"> 
            <div class="popupcontent">
                    <div style="font-size: 20px;font-weight: bold; margin-left: 100px ;color:mwhite; ">Account</div><br>
                    <div class="nav">
                        <div class="nav-btn" data-target="overview">Overview</div>
                        <div class="nav-btn" data-target="settings">Settings</div>
                    </div>
                    <div class="section active" id="overview">
                        <h2>Overview</h2>
                        <div class="sec-content">
                             <div class="content-inner"><p style=" width: 400px;">Username:  </p><div> </div> <?php echo $_SESSION['user_name'] ?> </div>
                             <div class="content-inner"><p style=" width: 400px;">Joined:  </p><div> </div> <?php echo $_SESSION['date'] ?> </div>
                        </div><br>
                        <div class="sec-content">
                             <div class="content-inner"><p style=" width: 400px;">Deposits:  </p><div> <?php echo $_SESSION['user_deposite'] ?> </div></div>
                             <div class="content-inner"><p style=" width: 400px;">Withdrawals:  </p><div> <?php echo $_SESSION['user_withdraw'] ?> </div></div>
                             <div class="content-inner"><p style=" width: 400px;">Balance:  </p><div><?php echo $_SESSION['user_balance'] ?></div></div>
                             <div class="content-inner"><p style=" width: 400px;">Winnings:  </p><div><?php echo $_SESSION['user_winnings'] ?></div></div>
                        </div><br>
                    </div>
                    <div>
                        <?php
                            
                        ?>
                        <form method = "post" action = changePass.php >
                            <div class="section" id="settings">
                                <h2>Change Password</h2><br>

                                <div class="sec-content" style="padding:5px 80px 50px 80px">
                                    <br>
                                    <p style ="font-size: normal">New Password</p>
                                    <input id ="text"type="password" name= "new_password" placeholder="****" style="width: 300px;"><br>
                                    <p style ="font-size: normal">Old Password</p>
                                    <input id ="text"type="password" name= "old_password" placeholder="****" style="width: 300px;"><br>
                                </div>
                                <br>
                                <?php
                                    if(isset($_SESSION['loggedin'])){
                                        echo '<input type="submit" name="submit" value="Change:" style="margin-left: 80px; width: 300px; height: 50px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 20px; font-weight: bold; cursor: pointer;"><br><br> 
                                        <br>';
                                    }
                                ?>
                            </div>
                            <br>
                        
                        </form>
                    </div>
                    <button class="button popup-button" data-target="#popup-account" style="border: none; background-color: whitesmoke;">X</button>
                </div>
            </div>
    </div>

    <div class="popup" id="popup-account">
        <div class="popup-overlay popup-button" data-target="#popup-account"></div>
        <div class="popup-inner">
            
            <div id="specialbox"> 
                <div class="popupcontent">
                    <div style="font-size: 20px;font-weight: bold; margin-left: 100px ;color:mwhite; ">Account</div><br>
                    <div class="nav">
                        <div class="nav-btn" data-target="overview">Overview</div>
                        <div class="nav-btn" data-target="settings">Settings</div>
                    </div>
                    <div class="section active" id="overview">
                        <h2>Overview</h2>
                        <div class="sec-content">
                             <div class="content-inner"><p style=" width: 400px;">Username:  </p><div> </div> <?php echo $_SESSION['user_name'] ?> </div>
                             <div class="content-inner"><p style=" width: 400px;">Joined:  </p><div> </div> <?php echo $_SESSION['date'] ?> </div>
                        </div><br>
                        <div class="sec-content">
                             <div class="content-inner"><p style=" width: 400px;">Deposits:  </p><div> <?php echo $_SESSION['user_deposite'] ?> </div></div>
                             <div class="content-inner"><p style=" width: 400px;">Withdrawals:  </p><div> <?php echo $_SESSION['user_withdraw'] ?> </div></div>
                             <div class="content-inner"><p style=" width: 400px;">Balance:  </p><div><?php echo $_SESSION['user_balance'] ?></div></div>
                             <div class="content-inner"><p style=" width: 400px;">Winnings:  </p><div><?php echo $_SESSION['user_winnings'] ?></div></div>
                        </div><br>
                    </div>
                    <div>
                        <?php
                            
                        ?>
                        <form method = "post" action = changePass.php >
                            <div class="section" id="settings">
                                <h2>Change Password</h2><br>

                                <div class="sec-content" style="padding:5px 80px 50px 80px">
                                    <br>
                                    <p style ="font-size: normal">New Password</p>
                                    <input id ="text"type="password" name= "new_password" placeholder="****" style="width: 300px;"><br>
                                    <p style ="font-size: normal">Old Password</p>
                                    <input id ="text"type="password" name= "old_password" placeholder="****" style="width: 300px;"><br>
                                </div>
                                <br>
                                <?php
                                    if(isset($_SESSION['loggedin'])){
                                        echo '<input type="submit" name="submit" value="Change:" style="margin-left: 80px; width: 300px; height: 50px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 20px; font-weight: bold; cursor: pointer;"><br><br> 
                                        <br>';
                                    }
                                ?>
                            </div>
                            <br>
                        
                        </form>
                    </div>
                    <button class="button popup-button" data-target="#popup-account" style="border: none; background-color: whitesmoke;">X</button>
                </div>
            </div>
    </div>
    
    <div class="popup" id="popup-chats">
        <div class="popup-overlay popup-button" data-target="#popup-chats"></div>
        <div class="popup-inner">
        
        <div id="specialbox"> 
                <div class="popupcontent">
                    <div style="font-size: 20px;font-weight: bold; margin-left: 100px ;color:mwhite; "></div><br><br>
                    
                    <div class="active" id="">

                        <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
                        <script type="text/javascript" src="php-chat-100-lines-master/AjaxPush.js"></script>
                        <script type="text/javascript">
                                var comet = new AjaxPush('php-chat-100-lines-master/listener.php', 'php-chat-100-lines-master/sender.php');
                                var n = new Function("return (Math.random()*190).toFixed(0)");

                                // create anonymous users
                                var c = "rgb(" + n() + ", " + n() + "," + n() + ")";
                                var template = "<strong style='color: " + c + "'>" + 'user_' + n() + "</strong>: ";

                                // listener
                                comet.connect(function(data) { $("#history").append(data.message) + "<br>"; });

                                // sender
                                var send = function() {
                                    comet.doRequest({ message: template + $("#message").val() + "<br>" }, function(){
                                        $("#message").val('').focus();
                                    })
                                }
                            </script>
                        <div class="sec-content" >
                            <br>
                            <h2>User chats:</h2>
                            <hr>
                    
                            <div id="history" style="overflow-y: scroll; max-height: 166px;"></div>
                            
                        </div>
                       

                        <div class="" style="padding:5px 80px 50px 80px">
                        
                        <p style ="font-size: normal">Give a contribution:</p>
                        <input type="text" autofocus id="message" placeholder="your message!" style="width: 300px; border-radius: 5px; padding: 4px; border: solid thin #aaa; background-color: whitesmoke;"><br><br>
                        
                        <?php
                                    if(isset($_SESSION['loggedin'])){
                                        echo '<button onclick="send()" style="width: 300px; height: 50px; background-color: rgb(211, 211, 10); color: black; border: none; border-radius: 5px; font-size: 20px; font-weight: bold; cursor: pointer;">Send</button>';
                                    }
                                ?>
                        </div>
                        
                    </div>
                    
                    <button class="button popup-button" data-target="#popup-chats" style="border: none; background-color: whitesmoke;">X</button>
                </div>
            </div>
    </div>
    

</body>

</html>
