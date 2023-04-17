<section id="register " class="home-section paddingtop-130 h-100 h-custom well">

	<div class="container well">
		<div class="row">
			<div class="align-items-center flex-lg-row-reverse text-center">
				<div editable="rich">
					<h1 class="fw-bolder display-2 ">Paciente Fulano</h1>
				</div>


				<div class="text-center grid">

					<div class="img-thumbnail img-responsive">

						<img class="card-img-top" alt="100%x180" src="{{ mix('./img/team/1.jpg')}}" data-holder-rendered="true"
							style="height: 180px; width: 100%; display: block;">
					</div>
				</div>

			</div>
			<hr>

			<div class="col-sm-6 form-group">
				<label>Nombres</label>
				<input type="text" placeholder="Enter First Name Here.." class="form-control">
			</div>
			<div class="col-sm-6 form-group">
				<label>Apellidos</label>
				<input type="text" placeholder="Enter Last Name Here.." class="form-control">
			</div>

		</div>
		<div class="form-group">
			<label>Cedula</label>
			<input type="text" placeholder="Enter Last Name Here.." class="form-control">
			<label>Calle Principal</label>
			<input type="text" placeholder="Enter Address Here.." class="form-control"></input>
			<label>Calle secundaria</label>
			<input type="text" placeholder="Enter Address Here.." class="form-control"></input>
			<label>Calle terciaria</label>
			<input type="text" placeholder="Enter Address Here.." class="form-control"></input>

		</div>
		<div class="row">
			<div class="col-sm-4 form-group">
				<label for="inputState">Barrio</label>
				<select id="inputState" class="form-control">
					<option selected>Choose...</option>
					<option>...</option>
				</select>
			</div>
			<div class="col-sm-4 form-group">
				<label for="inputState">Ciudad</label>
				<select id="inputState" class="form-control">
					<option selected>Choose...</option>
					<option>...</option>
				</select>
			</div>
			<div class="col-sm-4 form-group">
				<label for="inputState">Pais</label>
				<select id="inputState" class="form-control">
					<option selected>Choose...</option>
					<option>...</option>
				</select>
			</div>
		</div>
		<label>Fecha de Nacimiento</label>

		<div class="row">
			<div class="col-sm-4 form-group">
				<label for="inputState">Dia</label>
				<select id="inputState" class="form-control">
					<option selected>Choose...</option>
					<option>...</option>
				</select>
			</div>
			<div class="col-sm-4 form-group">
				<label for="inputState">Mes</label>
				<select id="inputState" class="form-control">
					<option selected>Choose...</option>
					<option>...</option>
				</select>
			</div>
			<div class="col-sm-4 form-group">
				<label for="inputState">Año</label>
				<select id="inputState" class="form-control">
					<option selected>Choose...</option>
					<option>...</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label>Número de teléfono</label>
			<input type="text" placeholder="Enter Phone Number Here.." class="form-control">
		</div>
		<div class="form-group">
			<label>Email Address</label>
			<input type="text" placeholder="Enter Email Address Here.." class="form-control">
		</div>


		<div class="form-group">

			<label class="form-label" for="customFile">Sube una foto: </label>
			<input type="file" class="form-control" id="customFile">



			</form>


		</div>





		<button type="button" class="btn btn-skin btn-lg">Editar</button>
	
		<button type="button" class="btn btn-skin btn-lg">Guardar</button>

	</div>






</section>