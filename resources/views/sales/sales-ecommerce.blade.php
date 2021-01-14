@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-sales-ecommerce')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Ventas de comercio electrónico<button type="button" data-toggle="modal" data-target="#modal-ecommerce-settings" class="btn btn-outline-success">Configurar comercio electrónico</button> </h1>
@stop

@section('content')
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
						<thead>
							<tr role="row">
								<th>Nº de pedido</th>
								<th>Fecha</th>
								<th>Total productos</th>
								<th>Total descuentos</th>
								<th>Subtotal</th>
								<th>Envíos</th>
								<th>Monto final</th>
								<th>Canal de pagos</th>
								<th>Usuarios</th>
								<th>Detalle</th>
								<th>Confirmado</th>
								<th>Estado</th>
								<th>Comprobante</th>
								<!-- <th>Opciones</th> -->
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bd-example-modal-lg" id="modal-ecommerce-settings" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Configurar comercio electrónico</h4>
				</div>
				<div class="modal-body" id="newModalBody">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="tab-content">
										<!-- /.tab-pane -->
										<div class="active tab-pane" id="new">
											{{ Form::open(array('url' => '/my-company?redirect=sales-ecommerce', 'method' => 'PUT' )) }}
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Código de tienda (store)</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Ingresar código de tienda" name="ecommerce_store" value="{{ $ecommerceCredentials['ecommerce_store'] }}" onClick="this.select();" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Api Key</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Ingresar valor de api key" name="ecommerce_api_key" value="{{ $ecommerceCredentials['ecommerce_api_key'] }}" onClick="this.select();" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Password</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Ingresar valor de password" name="ecommerce_password" value="{{ $ecommerceCredentials['ecommerce_password'] }}" onClick="this.select();" autocomplete="off">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Shared Secret</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" placeholder="Ingresar valor de shared secret" name="ecommerce_shared_secret" value="{{ $ecommerceCredentials['ecommerce_shared_secret'] }}" onClick="this.select();" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<!-- /.tab-content -->
								</div><!-- /.card-body -->
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Regresar</button>
					<button type="submit" class="btn btn-success">Guardar cambios</button>
					{{ Form::close() }}
				</div>
			</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
@stop

@section('scripts')
    @include('sales.partials.scripts-sales-ecommerce')
@stop
