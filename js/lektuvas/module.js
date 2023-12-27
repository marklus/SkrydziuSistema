import * as THREE from 'https://cdn.jsdelivr.net/npm/three@latest/build/three.module.js';
        import {
            OBJLoader
        } from 'https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/loaders/OBJLoader.js';

        import {
            OrbitControls
        } from 'https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/controls/OrbitControls.js';

const params = new URLSearchParams(window.location.search);
const modelPath = params.get('modelPath');



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
            modelPath,
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