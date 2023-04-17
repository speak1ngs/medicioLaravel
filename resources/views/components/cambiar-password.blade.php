<section id="register " class="home-section paddingtop-130 h-100 h-custom well">
	<div class="py-5">
		<div class="container well ">
			<h2 class="text-center">Cambiar contraseña</h2>

			<div class="row bottom-password">

				<div class="col-lg-6">
					<label>Contraseña Actual</label>
					<div class="input-group">
						<input type="password" class="form-control pwd" value="iamapassword">
						<span class="input-group-btn">
							<button class="btn btn-skin reveal" type="button"><i
									class="glyphicon glyphicon-eye-open"></i></button>
						</span>

					</div>
					<label>Nueva Contraseña</label>
					<div class="input-group">


						<input type="password" class="form-control pwd" value="iamapassword">
						<span class="input-group-btn">
							<button class="btn btn-skin reveal" type="button"><i
									class="glyphicon glyphicon-eye-open"></i></button>
						</span>
					</div>
				</div>


			</div>

			<button type="button" class="btn btn-skin btn-lg">Guardar</button>
		</div>





	</div>
	<script>
	$(".reveal").on('click', function() {
		var $pwd = $(".pwd");
		if ($pwd.attr('type') === 'password') {
			$pwd.attr('type', 'text');
		} else {
			$pwd.attr('type', 'password');
		}
	});
	</script>

</section>