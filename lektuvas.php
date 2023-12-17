<?php
session_start();      // index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

include("include/functions.php");
?>
<!doctype html>

<link rel="stylesheet" type="text/css" href="stylesUzsakymas.css">
<link rel="icon" href="./include/icon.ico" type="image/x-icon">


<?php
if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
{                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

    $_SESSION['prev']="index";

    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
    ?>
    <?php
}
else {

    if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes
    else {if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
    }
    // jei ankstesnis puslapis perdavė $_SESSION['message']
    echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";

    echo "<table class=\"center\"><tr><td>";
    include("include/login.php");                    // prisijungimo forma
    echo "</td></tr></table></div><br>";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
    <link rel="icon" href="./include/icon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <title>Lėktuvo 3D modelis</title>
    <style>
        body {
            margin: 500;
        }

        canvas {
            display: block;
        }

        #container {
        width: 50%; /* Set the width as a percentage of the window's width */
        max-width: 600px; /* Adjusted maximum width for better visibility */
        height: 600px; /* Set the height */
        margin: auto; /* Center the container */
        border: 100px solid lightblue; /* Optional: Add a border for visual reference */

    }
    </style>
</head>

<body>
    <!-- Your HTML body content -->
    <div>
    </div>
    <div id="container">
        <!-- <canvas id="rendererCanvas">lėktuviukas</canvas> -->
    </div>
<div>
    <p>Šitas lėktuvas yra labai geras, labai gerai skrenda, dar nėra nukritęs. Rekomenduojame visiems nekrentančių lėktuvų mėgėjams.</p>
</div>
    <!-- Place the Import map at the top -->
    <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.149.0/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.149.0/examples/jsm/"
            }
        }
    </script>


    <!-- Your Three.js and OBJLoader-related code -->
    <script type="module">
        import * as THREE from 'https://cdn.jsdelivr.net/npm/three@latest/build/three.module.js';
        import {
            OBJLoader
        } from 'https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/loaders/OBJLoader.js';

        import {
            OrbitControls
        } from 'https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/controls/OrbitControls.js';


        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        const controls = new OrbitControls(camera, renderer.domElement);



        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5); // Soft white light
        scene.add(ambientLight);

        // renderer.setSize(window.innerWidth, window.innerHeight);
        // document.body.appendChild(renderer.domElement);
        const container = document.getElementById('container');
        const canvasWidth = container.offsetWidth - (2 * 100); // Considering left and right padding of 20px
        const canvasHeight = container.offsetHeight - (2 * 100); // Considering top and bottom padding of 20px
        renderer.setSize(canvasWidth, canvasHeight);
        container.appendChild(renderer.domElement);

        const loader = new OBJLoader();
        loader.load(
            '3dModels/Airplane1/11803_Airplane_v1_l1.obj',
            function(object) {



                object.scale.set(0.001, 0.001, 0.001); // Scale down the object if it's too large
                scene.add(object);
            },
            function(xhr) {
                console.log((xhr.loaded / xhr.total) * 100 + '% loaded');
            },
            function(error) {
                console.error('An error happened', error);
            }
        );

        camera.position.z = 5;

        const light = new THREE.DirectionalLight(0xffffff); // White directional light
        light.position.set(0, 1, 1); // Position of the light
        scene.add(light);

        function animate() {
            requestAnimationFrame(animate);
            renderer.render(scene, camera);
        }

        animate();
    </script>
</body>

</html>