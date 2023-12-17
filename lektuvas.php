<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your head content here -->
    <link rel="icon" href="./include/icon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <title>Simple Three.js Scene</title>
    <style>
        body {
            margin: 0;
        }

        canvas {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Your HTML body content -->

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
        import { OBJLoader } from 'https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/loaders/OBJLoader.js';

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

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