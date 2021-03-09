@extends('adminlte::page')

@section('title', env('APP_NAME'))

@section('nav-sales-report')
    active
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Reporte de ventas por mes y Ruc </h1>
@stop

@section('content')
    <div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <select id="periodInfo" class="form-control">
                                <option value="0">TODOS LOS PERIODOS</option>
                                <option value="2020-11">NOVIEMBRE 2020</option>
                                <option value="2020-12">DICIEMBRE 2020</option>
                                <option value="2021-01">ENERO 2021</option>
                                <option value="2021-02">FEBRERO 2021</option>
                                <option value="2021-03">MARZO 2021</option>
                                <option value="2021-04">ABRIL 2021</option>
                                <option value="2021-05">MAYO 2021</option>
                                <option value="2021-06">JUNIO 2021</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="documentInfo" class="form-control">
                                <option value="0">TODOS LOS DOCUMENTOS</option>
                                <!-- <option value="">10062663231 - TAPIA CHAVEZ HUMBERTO SEGUNDO</option> -->
                                <option value="10096433391">10096433391 - RIVERA THOMAS ROSA CONSUELO</option>
                                <option value="10079504187">10079504187 - TAPIA CHAVEZ DENY ROSA</option>
                                <option value="10741226486">10741226486 - MOQUILLAZA PADILLA RENATO ALONSO</option>
                                <option value="20604134511">20604134511 - RWC INVESTMENTS SAC</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input id="orderNumber" type="text" class="form-control" placeholder="Número de orden">
                        </div>
                        <div class="col-md-3">
                            <button id="filterButton" class="btn btn-success">FILTRAR</button>
                        </div>
                    </div>
					<table id="example1" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
						<thead class="thead-dark">
							<tr role="row">
								<th>Nº de pedido</th>
								<th>RUC</th>
                                <th>Serie</th>
                                <th>Correlativo</th>
								<th>Fecha</th>
								<th>Total productos</th>
								<th>Total descuentos</th>
								<th>Subtotal</th>
								<th>Envíos</th>
								<th>Monto final</th>
								<th>Canal de pagos</th>
								<th>Usuarios</th>
								<th>Confirmado</th>
								<th>Estado</th>
							</tr>
						</thead>
                        <tfoot>
                            <tr>
                                <th colspan="12" style="text-align:left;font-size:120%;">TOTAL VENDIDO: PEN 0.00</th>
                            </tr>
                        </tfoot>
					</table>
				</div>
                <div class="modal fade" id="modal-on-load">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" align="center">
                                <h1 class="modal-title">Procesando información, porfavor espere...</h4>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
    @include('sales.partials.scripts-sales-report')
@stop
