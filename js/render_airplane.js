// Create a scene
const scene = new THREE.Scene();

// Create a camera
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
camera.position.z = 5;

// Create a renderer
const renderer = new THREE.WebGLRenderer();
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);

// Create a loader for the OBJ file
const loader = new THREE.OBJLoader();
const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 }); // Replace with desired material

// Load the OBJ file
loader.load(
    '3dModels/Airplane1/11803_Airplane_v1_l1.obj', // Path to your OBJ file
    function (object) {
        object.traverse(function (child) {
            if (child instanceof THREE.Mesh) {
                child.material = material; // Apply the material to the loaded model
            }
        });
        scene.add(object); // Add the loaded model to the scene
    },
    undefined,
    function (error) {
        console.error('Error loading OBJ file:', error);
    }
);

// Animation/render loop
function animate() {
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}

animate();
