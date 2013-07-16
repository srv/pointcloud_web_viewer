function load(filename) {

	// Toggle the menu
	toggleMenu();
	
	// Show the slider
	var interval = self.setInterval(updateProgressBar,50);
	$('#szlider').show();

	// Init canvas
	scene = new THREE.Scene();
	scene.fog = new THREE.FogExp2(0x000000, 0.0009);
	geometry = new THREE.Geometry();
	geometry.dynamic = true;

	if (container.childNodes.length > 0)
		container.removeChild(container.childNodes[0]);

	// Get the point cloud
	$.ajax({
		url: 'services/get-pointcloud.php',
		data: {file:filename},
		type: 'GET',
		async: true,
		crossDomain: true,
		dataType: 'jsonp',
		success: function(res) {
			if (res == "error" || res == null || res == false) {
				// Ooops, failed to retrieve the pointcloud
				self.clearInterval(interval);
				$('#szlider').hide();
				$('#message').text("Impossible to load the pointcloud, make sure \
	    					you have loaded this file into the /data directory and \
	    					it is not too big (<10MB).");
	    		$('#notification').toggle('fast');
			}
			else {
				// Point cloud is here!
				var lines = res.split('\n');
				for (var i=0; i<lines.length; i++) {
					
					// Sanity check
					if (lines[i].length < 10) break;

					// Load the point
					var point = lines[i].split(',');
					var x = parseFloat(point[0]);
					var y = parseFloat(point[1]);
					var z = parseFloat(point[2]);
					var color = 'rgb(' + point[3] + ',' + point[4] + ',' + point[5] + ')';
					geometry.vertices.push(new THREE.Vector3(x, y, z));
					geometry.colors.push(new THREE.Color(colorToHex(color)));
				}
				
				// Setup the scene
				material = new THREE.ParticleBasicMaterial({ size: 0.02, vertexColors: true });
				particles = new THREE.ParticleSystem(geometry, material);
				scene.add(particles);

				// Render the scene
				renderer = new THREE.WebGLRenderer( {clearAlpha: 1 });
				renderer.setSize(window.innerWidth - 16, window.innerHeight - 16);
				container.appendChild(renderer.domElement);
				renderer.render(scene, camera);
				animate();

				// Hide progress bar
				self.clearInterval(interval);
				$('#szlider').hide();
			}
		},
		error: function() {
			// Ooops, failed to retrieve the pointcloud
			self.clearInterval(interval);
			$('#szlider').hide();
			$('#message').text("Impossible to load the pointcloud, make sure \
				    		you have loaded this file into the /data directory and \
				    		it is not too big (<10MB).");
			$('#notification').toggle('fast');
		}
	});

	return false;
}

function animate() {
	requestAnimationFrame(animate);
	controls.update();
}
function onDocumentMouseMove(evt) {
	mouseX = (event.clientX - window.innerWidth / 2) * 10;
	mouseY = (event.clientY - window.innerHeight / 2) * 10;
	render()
}
function render() {
	renderer.render(scene, camera);
}
function colorToHex(color) {
    if (color.substr(0, 1) === '0x') {
        return color;
    }
    var digits = /(.*?)rgb\((\d+),(\d+),(\d+)\)/.exec(color);
    
    var red = parseInt(digits[2]);
    var green = parseInt(digits[3]);
    var blue = parseInt(digits[4]);
    
    var rgb = blue | (green << 8) | (red << 16);
    return digits[1] + '0x' + rgb.toString(16);
}