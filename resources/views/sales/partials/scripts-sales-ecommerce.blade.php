<!-- css -->
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/buttons.dataTables.min.css') }}">
<!-- scripts -->
<script src="{{ asset('scripts/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('scripts/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- functions -->
<script>
    var arrayObject = [];
    var objectId = 0;
    $(function () {
        $("#example1").DataTable({
            "info": true,
            "scrollX": false,
            "ordering": false,
            "searching": true,
            "processing": true,
            "serverSide": true,
            "lengthChange": false,
            "bPaginate": true,
            "responsive": false,
            "language": {
                "url": "/js/languages/datatables/es.json"
            },
            "dom": "Bfrtip",
            "buttons": [ 
                // {
                //   text: "Nueva tienda",
                //   action: function ( e, dt, node, config ) {
                //       alert( 'Button activated' );
                //   }
                // }
            ],
            "order": [[ 0, "asc" ]],
            "ajax": function(data, callback, settings) {
                $.get('/api/sales-ecommerce', {
                    limit: data.length,
                    offset: data.start,
                    order: data.order,
                    search: data.search
                }, function(res) {
                    arrayObject = [];
                    res.data.forEach(element => {
                    arrayObject[element.id] = element;
                    });
                    callback({
                        recordsTotal: res.total,
                        recordsFiltered: res.total,
                        data: res.data
                    });
                });
            },
            "columns"    : [
                {'data':   function (data) {
                    return data.order_number;
                }},
                {'data':   function (data) {
                    return data.created_at;
                }},
                {'data':   function (data) {
                    return data.currency + " " + parseFloat(data.subtotal_price).toFixed(2);
                }},
                {'data':   function (data) {
                    var text_ = "";
                    data.shipping_lines.forEach(element => {
                        text_ = text_ + "<p>" + data.currency + " " + parseFloat(element.price).toFixed(2) + "</p>"; 
                    });
                    return text_;
                }},
                {'data':   function (data) {
                    return data.currency + " " + parseFloat(data.total_price).toFixed(2);
                }},
                {'data':   function (data) {
                    return data.gateway;
                }},
                {'data':   function (data) {
                    return data.financial_status;
                }},
                {'data':   function (data) {
                    return '<div class="col-md-12 row">' + 
                        '<div class="col-md-12"><button title="Ver más información" type="button" onClick="openInfoModal(' + data.id + ');" class="btn btn-block btn-outline-info"><i class="fa fa-info"></i></button></div>' +
                    '</div>';
                }, "orderable": false},

            ],
        });
        openInfoModal = function(id) {
            objectId = id;
            if (arrayObject[objectId]) {
                // innerHTML
                document.getElementById('infoOrderNumber').innerHTML = arrayObject[objectId].order_number;
                document.getElementById('infoOrderFinancialStatus').innerHTML = arrayObject[objectId].financial_status;
                document.getElementById('infoOrderGateway').innerHTML = arrayObject[objectId].gateway;
                // Billing Address
                var infoBillingAddress = document.getElementById('infoBillingAddress');
                if (infoBillingAddress !== null) {
                    var infoBillingAddress_ = "";
                    if (arrayObject[objectId].billing_address.length === 0) {
                        infoBillingAddress.innerHTML = "<li>Email: <b>" + arrayObject[objectId].email + "</b></li>";
                    } else {
                        infoBillingAddress_ = infoBillingAddress_ +
                            "<li>Email: <b>" + arrayObject[objectId].email + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ +
                            "<li>Código postal: <b>" + arrayObject[objectId].billing_address.zip + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ + 
                            "<li>Ciudad: <b>" + arrayObject[objectId].billing_address.city + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ + 
                            "<li>Nombre: <b>" + arrayObject[objectId].billing_address.name + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ + 
                            "<li>Teléfono: <b>" + arrayObject[objectId].billing_address.phone + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ + 
                            "<li>País: <b>" + arrayObject[objectId].billing_address.country + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ + 
                            "<li>Dirección 1: <b>" + arrayObject[objectId].billing_address.address1 + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ + 
                            "<li>Dirección 2: <b>" + arrayObject[objectId].billing_address.address2 + "</b></li>";
                        infoBillingAddress_ = infoBillingAddress_ + 
                            "<li>Provincia: <b>" + arrayObject[objectId].billing_address.province + "</b></li>";
                        infoBillingAddress.innerHTML = infoBillingAddress_;
                    }
                }
                // Products
                var infoDetails = document.getElementById('infoDetails');
                if (infoDetails !== null) {
                    var infoDetails_ = "";
                    arrayObject[objectId].line_items.forEach(element => {
                        infoDetails_ = infoDetails_ + 
                            "<li>Prenda: <b>" + element.name + "</b></li>";
                        infoDetails_ = infoDetails_ + 
                            "<li>Código: <b>" + element.vendor + "</b></li>";
                        infoDetails_ = infoDetails_ + 
                            "<li>Precio: <b>" + parseFloat(element.price).toFixed(2) + "</b></li>";
                        infoDetails_ = infoDetails_ + 
                            "<li>Cantidad: <b>" + parseFloat(element.quantity).toFixed(2) + "</b></li>";
                        infoDetails_ = infoDetails_ + "<br>";
                    });
                    infoDetails.innerHTML = infoDetails_;
                }
                // Amounts
                var infoAmounts = document.getElementById('infoAmounts');
                if (infoAmounts !== null) {
                    var infoAmounts_ = "";
                    infoAmounts_ = infoAmounts_ + 
                        "<li>Total prendas: <b>" + parseFloat(arrayObject[objectId].total_line_items_price).toFixed(2) + "</b></li>";
                    infoAmounts_ = infoAmounts_ + 
                        "<li>Descuentos: <b>" + parseFloat(arrayObject[objectId].total_discounts).toFixed(2) + "</b></li>";
                    infoAmounts_ = infoAmounts_ + 
                        "<li>Subtotal: <b>" + parseFloat(arrayObject[objectId].subtotal_price).toFixed(2) + "</b></li>";
                    var deliveryAmount = 0;
                    arrayObject[objectId].shipping_lines.forEach(element => {
                        deliveryAmount = deliveryAmount + element.price;
                    });
                    infoAmounts_ = infoAmounts_ + 
                        "<li>Delivery: <b>" + parseFloat(deliveryAmount).toFixed(2) + "</b></li>";
                    infoAmounts_ = infoAmounts_ + 
                        "<li>Total: <b>" + parseFloat(arrayObject[objectId].total_price).toFixed(2) + "</b></li>";
                    infoAmounts.innerHTML = infoAmounts_;
                }
                $('#modal-info').modal({ backdrop: 'static', keyboard: false });
            } else {
                alert("Error al abrir modal");
            }
        }
        openNewModal = function() {
            $('#modal-new').modal({ backdrop: 'static', keyboard: false });
        }
        openEditModal = function(id) {
            warehouseId = id;
            if (arrayWarehouses[warehouseId]) {
                // innerHTML
                document.getElementById('editModalCreatedAt').innerHTML = arrayWarehouses[warehouseId].created_at;
                document.getElementById('editModalUpdatedAt').innerHTML = arrayWarehouses[warehouseId].updated_at;
                document.getElementById('editModalUsers').innerHTML = "Ver usuarios";
                document.getElementById('editModalProducts').innerHTML = "Ver stocks";
                // input value
                document.getElementById('editModalId').value = arrayWarehouses[warehouseId].id;
                document.getElementById('editModalCommercialName').value = arrayWarehouses[warehouseId].commercial_name;
                document.getElementById('editModalDocumentNumber').value = arrayWarehouses[warehouseId].document_number;
                document.getElementById('editModalShowAddress').value = arrayWarehouses[warehouseId].show_address;
                document.getElementById('editModalPhone').value = arrayWarehouses[warehouseId].phone;
                document.getElementById('editModalEmail').value = arrayWarehouses[warehouseId].email;
                document.getElementById('editModalCurrency').value = arrayWarehouses[warehouseId].currency;
                $('#modal-edit').modal({ backdrop: 'static', keyboard: false });
            } else {
                alert("Error al abrir modal");
            }
        }
        openSerieModal = function(id) {
            warehouseId = id;
            if (arrayWarehouses[warehouseId]) {
                // innerHTML
                document.getElementById('serieModalUpdatedAt').innerHTML = arrayWarehouses[warehouseId].updated_at;
                document.getElementById('serieModalCommercialName').innerHTML = arrayWarehouses[warehouseId].commercial_name;
                document.getElementById('serieModalDocumentNumber').innerHTML = arrayWarehouses[warehouseId].document_number;
                // input value
                document.getElementById('serieModalId').value = warehouseId;
                if (arrayWarehouses[warehouseId].series != null) {
                    // serie
                    document.getElementById('serieModalSerie01').value = arrayWarehouses[warehouseId].series["01"].serie.toUpperCase();
                    document.getElementById('serieModalSerie03').value = arrayWarehouses[warehouseId].series["03"].serie.toUpperCase();
                    document.getElementById('serieModalSerie00').value = arrayWarehouses[warehouseId].series["00"].serie.toUpperCase();
                    document.getElementById('serieModalSerie09').value = arrayWarehouses[warehouseId].series["09"].serie.toUpperCase();
                    // number
                    document.getElementById('serieModalNumber01').value = arrayWarehouses[warehouseId].series["01"].number;
                    document.getElementById('serieModalNumber03').value = arrayWarehouses[warehouseId].series["03"].number;
                    document.getElementById('serieModalNumber00').value = arrayWarehouses[warehouseId].series["00"].number;
                    document.getElementById('serieModalNumber09').value = arrayWarehouses[warehouseId].series["09"].number;
                }
                $('#modal-serie').modal({ backdrop: 'static', keyboard: false });
            } else {
                alert("Error al abrir modal");
            }
        }
        openDeactivateModal = function(id) {
            warehouseId = id;
            var deleteModalBody = document.getElementById('deleteModalBody');
            if (deleteModalBody != null) {
                // input value
                document.getElementById('deleteModalId').value = warehouseId;
                deleteModalBody.innerHTML = "<p>Desea eliminar la tienda: <b>" + arrayWarehouses[warehouseId].commercial_name + "</b>?</p>" +
                    "<p>Esto desactivará a todos los usuarios asociados a la tienda</p>"; 
            }
            $('#modal-delete').modal({ backdrop: 'static', keyboard: false });
        }
        goToEditModal = function() {
            $('#modal-info').modal('hide');
            openEditModal(warehouseId);
        }
        getCurrencyName = function(currency) {
            var currencyName = "";
            switch (currency) {
                case "CLP":
                currencyName = "PESO CHILENO";
                break;
                case "PEN":
                currencyName = "SOL PERUANO";
                break;
                case "USD":
                currencyName = "DÓLAR ESTADOUNIDENSE";
                break;      
                default:
                currencyName = "OTRO";
                break;
            }
            return currencyName;
        }
        goToUrl = function(url) {
            window.location.replace(url);
        }
    });
</script>

@if (isset($notification) && $notification)
	<div class="modal fade" id="modal-notification" style="display: none;">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			    <h4 class="modal-title">{{ isset($result['message']) ? $result['message'] : "Hubo un error en la operación. Intente nuevamente, si el error persiste comuníquese con soporte técnico" }}</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-{{ $result['result'] }}" data-dismiss="modal">Ok</button>
			</div>
		</div>
		<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<script>
		$(function () {
			$('#modal-notification').modal({ backdrop: 'static', keyboard: false });
		});
	</script>
@endif