
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apmokėjimas vykdomas</title>

    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <link rel="stylesheet" href="style1.css">
    <meta http-equiv="refresh" content="5;url=../uzsakymas.php">
</head>
<body>
<main id="cart-main">


    <div class="site-title text-center">
        <div><img src="./assets/checked.png" alt=""></div>
        <h1 class="font-title">Apmokėjimas pavyko!</h1>
    </div>


</main>
<p>Būsite nukreipti į užsakymų puslapį po 3sekundžių...</p>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<?php $phpValue1 = $_GET['phpValue1'];
echo $phpValue1;  ?> 

<script>
    // If you want to give users the option to cancel the redirection, you can use this script
    document.addEventListener('DOMContentLoaded', function() {
        var countdown = 3; // Set the countdown time in seconds

        function updateCountdown() {
            if (countdown > 0) {
                countdown--;
                document.getElementById('countdown').innerText = countdown;
                setTimeout(updateCountdown, 1000);
            } else {
                
                window.location.href = '../uzsakymas.php';
            }
        }
        
        updateCountdown();
    });
    
</script>

</body>
</html>
