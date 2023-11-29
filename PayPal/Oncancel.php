<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url=../uzsakymas.php">
    <title>Mokėjimas atšaukiamas...</title>

    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <link rel="stylesheet" href="style1.css">

</head>
<body>
<main id="cart-main">

    <div class="site-title text-center">
        <div><img src="./assets/cancel.png" alt=""></div>
        <h1 class="font-title">Mokėjimas yra atšaukiamas</h1>
    </div>

</main>
<p>Būsite nukreipti į užsakymų puslapį po 3 sekundžių...</p>

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

