<html>
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> lazyLoad </title>

		<style>
			* {
				margin: 0;
				padding: 0;
			}
			body {
				overflow-x: hidden;
			}
			img {
				width: 100vw;
				height: 100vh;
				/* On set un height par défaut car les images sont l'une à la suite des autres et sont donc toutes dans le viewport au chargement du DOM. */

				margin-bottom: 50px;
				opacity: 0;
			}
			[src-lazy] {
				min-height: 50px;
				min-width: 50px;
				/* On set une taille par défaut qui représente la hitbox de l'élément dans le viewport */
			}
			.fade {
				transform: translate(0%, 0%) !important;
				opacity: 1;
				transition:
					transform 3s ease,
					opacity 5s;
			}
			.slide_top { transform: translate(0%, -50%); }
			.slide_right { transform: translate(50%, 0%); }
			.slide_bottom { transform: translate(0%, 50%); }
			.slide_left { transform: translate(-50%, 0%); }
		</style>
	</head>
	<body>
		<img class="slide_top" src-lazy="img/1.png">
		<img class="slide_right" src-lazy="img/2.png">
		<img class="slide_bottom" src-lazy="img/3.png">
		<img class="slide_left" src-lazy="img/1.jpg">
		<img class="slide_top" src-lazy="img/2.jpg">
		<img class="slide_right" src-lazy="img/3.jpg">
		<img class="slide_bottom" src-lazy="img/4.jpg">
		<img class="slide_left" src-lazy="img/5.jpg">
		<img class="slide_top" src-lazy="img/6.jpg">
		<img class="slide_right" src-lazy="img/7.jpg">
		<img class="slide_bottom" src-lazy="img/8.jpg">
		<img class="slide_left" src-lazy="img/9.jpg">
		<img class="slide_top" src-lazy="img/10.jpg">
		<img class="slide_right" src-lazy="img/11.jpg">
		
		

		<script type="text/javascript">
			const	callback = (entries, observer) => {
				var	img;

				entries.forEach((entry) => {
					img = entry.target;
					if (entry.isIntersecting) {
						img.src = img.getAttribute('src-lazy');
						img.classList.add('fade');
						observer.unobserve(img);
					}
					else {
						// img.classList.remove('fade');
					}
				});
			};
			const	options = {
				threshold: 0,
				rootMargin: "300px 0px 300px 0px",
			};
			const	observer = new IntersectionObserver(callback, options);
			const	images = document.querySelectorAll('[src-lazy]');

			images.forEach((image) => { observer.observe(image); });

			// window.addEventListener('scroll', (event) => {
			// 	var	img_innerHeight;

			// 	for (var i = 0; i < images.length; i++) {
			// 		if (images[i].classList.contains('fade'))
			// 			continue ;
			// 		img_innerHeight = images[i].getBoundingClientRect().top;
			// 		if (img_innerHeight <= window.innerHeight) {
			// 			images[i].src = images[i].getAttribute('src-lazy');
			// 			images[i].classList.add('fade');
			// 		}
			// 	}
			// });
		</script>
	</body>
</html>
