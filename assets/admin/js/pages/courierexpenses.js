
$(document).ready(function() {

    //list("courierexpensestable","courierexpenses/listing",[0]);
    oTable = $('#courierexpensestable').DataTable
      ({
        "processing": true,//Feature control the processing indicator.
        "language": {
          "lengthMenu": "_MENU_"
        },
        "pageLength": 10,
        "columnDefs": [{
          'orderable': false,
          'targets': [0,2,-2]
        }],
        "order": [], //Initial no order.
        'serverSide': true,//Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
        "ajax": {
          	"url": SITE_URL+'courierexpenses/listing',
          	"type": "POST",
          	"data": function ( data ) {
                data.cityid = $('#cityid').val();
                data.paymentmethodid = $('#paymentmethodid').val();
                data.courierid = $('#courierid').val();
                data.fromdate = $('#fromdate').val();
                data.todate = $('#todate').val();
            }
        },
      });
    $('.dataTables_filter input').attr('placeholder','Search...');


    //DOM Manipulation to move datatable elements integrate to panel
    $('.panel-ctrls').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls').append("<i class='separator'></i>");
    $('.panel-ctrls').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");

    $('.panel-footer').append($(".dataTable+.row"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right pagination-md");

    $('#datepicker-range').datepicker({
      todayHighlight: true,
      format: 'yyyy-mm-dd'
  	}).on("change", function() {
    	oTable.ajax.reload(null,false);
  	});

});
$('#cityid').on('change', function (e) {
  oTable.ajax.reload(null,false);
});
$('#paymentmethodid').on('change', function (e) {
  oTable.ajax.reload(null,false);
});
$('#courierid').on('change', function (e) {
  oTable.ajax.reload(null,false);
});

function exportpaymentreport(){
  
  var paymentmethodid = $('#paymentmethodid').val();
  var courierid = $('#courierid').val();
  var cityid = $('#cityid').val();
  var fromdate = $('#fromdate').val();
  var todate = $('#todate').val();
  
  var totalRecords =$("#courierexpensestable").DataTable().page.info().recordsDisplay;
  $.skylo('end');
  if(totalRecords != 0){
    window.location= SITE_URL+"courierexpenses/exportpaymentreport?paymentmethodid="+paymentmethodid+"&courierid="+courierid+"&cityid="+cityid+"&fromdate="+fromdate+"&todate="+todate;
  }else{
    new PNotify({title: 'No data available !',styling: 'fontawesome',delay: '3000',type: 'error'});
  }
  
}

