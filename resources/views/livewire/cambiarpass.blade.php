<div>
<x-header />
<x-body-wrapper >
	<x-navigation-menu />
	<section id="register " class="home-section paddingtop-130 h-100 h-custom well">
	<div class="py-5">
		<div class="container well ">
			<h2 class="text-center">Cambiar contraseña</h2>

			<div class="row bottom-password">

				<div class="col-lg-6">
					<label>Nueva Contraseña</label>
					<div class="input-group">
						<input type="password" class="form-control pwd" value="iamapassword" wire:model="inputPassword1">
						<span class="input-group-btn">
							<button class="btn btn-skin reveal" type="button"><i
									class="glyphicon glyphicon-eye-open"></i></button>
						</span>

					</div>
					<label>Repetir Nueva Contraseña</label>
					<div class="input-group">


						<input type="password" class="form-control pw" value="iamapassword" wire:model="inputPassword2">
						<span class="input-group-btn">
							<button class="btn btn-skin reveal1" type="button"><i
									class="glyphicon glyphicon-eye-open"></i></button>
						</span>
					</div>
				</div>

           

			</div>

            @if (session()->has('message'))

                <div class="alert alert-success">

                    {{ session('message') }}

                </div>

            @endif

			<button type="button" class="btn btn-skin btn-lg" wire:click="setNewPW()">Guardar</button>
		</div>





	</div>
	<script>
	jq(".reveal").on('click', function() {
		var $pwd = $(".pwd");
		if ($pwd.attr('type') === 'password') {
			$pwd.attr('type', 'text');
		} else {
			$pwd.attr('type', 'password');
		}
	});

    jq(".reveal1").on('click', function() {
	
        var $pw = $(".pw");
		if ($pw.attr('type') === 'password') {
			$pw.attr('type', 'text');
		} else {
			$pw.attr('type', 'password');
		}
	});
	</script>

</section>
</x-body-wrapper>
<x-footer />

</div>
