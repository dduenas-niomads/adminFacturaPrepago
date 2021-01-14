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


<script src="{{ asset('/plugins/buttons/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/buttons/buttons.flash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/buttons/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/buttons/pdfmake.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/buttons/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/buttons/buttons.html5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/buttons/buttons.print.min.js') }}" type="text/javascript"></script>

<!-- functions -->
<script>
    var arrayObject = [];
    var objectId = 0;
    var ordersTotal = 0;
    $(function () {
        var saleReportTable = $("#example1").DataTable({
            "info": true,
            "scrollX": true,
            "ordering": false,
            "searching": false,
            "processing": true,
            "serverSide": false,
            "lengthChange": false,
            "bPaginate": true,
            "responsive": false,
            "language": {
                "url": "/js/languages/datatables/es.json"
            },
            "dom": "Bfrtip",
            "buttons": [
                { extend: 'excelHtml5', footer: true },
                { extend: 'pdfHtml5', footer: true, orientation: 'landscape', pageSize: 'LEGAL' }
            ],
            "order": [[ 0, "asc" ]],
            "ajax": function(data, callback, settings) {
                $.get('/api/sales-ecommerce', {
                    limit: data.length,
                    offset: data.start,
                    order: data.order,
                    document: $('#documentInfo').val(),
                    period: $('#periodInfo').val(),
                    orderNumber: $('#orderNumber').val(),
                    report: 1,
                }, function(res) {
                    arrayObject = [];
                    ordersTotal = res.ordersTotal;
                    ordersSubtotal = res.ordersSubtotal;
                    res.body.forEach(element => {
                    arrayObject[element.id] = element;
                    });
                    callback({
                        recordsTotal: res.body.length,
                        recordsFiltered: res.body.length,
                        data: res.body
                    });
                });
            },
            "columns"    : [
                {'data':   function (data) {
                    return data.order_number;
                }},
                {'data':   function (data) {
                    return data.ruc;
                }},
                {'data':   function (data) {
                    return data.serie;
                }},
                {'data':   function (data) {
                    return data.correlative;
                }},
                {'data':   function (data) {
                    return data.created_at;
                }},
                {'data':   function (data) {
                    return data.total_line_items_price;
                }},
                {'data':   function (data) {
                    return data.total_discounts;
                }},
                {'data':   function (data) {
                    return data.subtotal_price;
                }},
                {'data':   function (data) {
                    var text_ = "";
                    data.shipping_lines.forEach(element => {
                        text_ = text_ + "<p>" + element.price + "</p>"; 
                    });
                    return text_; data.subtotal_price;
                }},
                {'data':   function (data) {
                    return data.total_price;
                }},
                {'data':   function (data) {
                    return data.gateway;
                }},
                {'data':   function (data) {
                    return data.email;
                }},
                {'data':   function (data) {
                    return data.confirmed ? "SI": "NO";
                }},
                {'data':   function (data) {
                    return data.financial_status;
                }},
            ],
            // "rowCallback": function() {
            //     $('#modal-on-load').modal('toggle');
            // },
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Update footer
                $(api.column(0, {search:'applied'}).footer()).html('<p>TOTAL VENDIDO: S/ ' + parseFloat(ordersTotal).toFixed(2) + '</p><p>SUBTOTAL VENDIDO: S/ ' + parseFloat(ordersSubtotal).toFixed(2) + '</p><p>' + 'DOCUMENTO: ' + $('#documentInfo').val() + '</p><p>PERIODO: ' + $('#periodInfo').val());
            }
        });
        // Filter button
        $('#filterButton').on('click', function(e) {
            // $('#modal-on-load').modal({ backdrop: 'static', keyboard: false });
            saleReportTable.clear();
            saleReportTable.ajax.reload();
            saleReportTable.search( this.value ).draw();
        });
        openInfoModal = function(id) {
            warehouseId = id;
            if (arrayWarehouses[warehouseId]) {
                // innerHTML
                document.getElementById('infoModalCreatedAt').innerHTML = arrayWarehouses[warehouseId].created_at;
                document.getElementById('infoModalUpdatedAt').innerHTML = arrayWarehouses[warehouseId].updated_at;
                document.getElementById('infoModalUsers').innerHTML = "Ver usuarios";
                document.getElementById('infoModalProducts').innerHTML = "Ver stocks";
                // input value
                document.getElementById('infoModalCommercialName').value = arrayWarehouses[warehouseId].commercial_name;
                document.getElementById('infoModalDocumentNumber').value = arrayWarehouses[warehouseId].document_number;
                document.getElementById('infoModalShowAddress').value = arrayWarehouses[warehouseId].show_address;
                document.getElementById('infoModalPhone').value = arrayWarehouses[warehouseId].phone;
                document.getElementById('infoModalEmail').value = arrayWarehouses[warehouseId].email;
                document.getElementById('infoModalCurrency').value = arrayWarehouses[warehouseId].currency + " - " + getCurrencyName(arrayWarehouses[warehouseId].currency);
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