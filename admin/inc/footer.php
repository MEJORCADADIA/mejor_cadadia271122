	</div>
	</div>
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
	</script>
	<script>
		const alerts = document.querySelectorAll('.alert-timeout')
		if (alerts.length > 0) {
			setTimeout(() => {
				alerts.forEach((alert) => {
					alert.classList.add('d-none')
				})
			}, 10000)
		}
	</script>
	</body>

	</html>