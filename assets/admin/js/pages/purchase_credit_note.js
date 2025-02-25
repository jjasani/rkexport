$(document).ready(function() {
    
    //list("ordertable","Order/listing",[0,-1]);
    oTable = $('#purchasecreditnotettable').DataTable
      ({
        "language": {
          "lengthMenu": "_MENU_"
        },
        "pageLength": 10,
        /* "scrollCollapse": true,
        "scrollY": "500px", */
        "columnDefs": [{
          'orderable': false,
          'targets': [0,2,-1]
        },{ targets: [6], className: "text-right" },{ targets: [5], className: "text-center" }],
        "order": [], //Initial no order.
        'serverSide': true,//Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": SITE_URL+"purchase-credit-note/listing",
          "type": "POST",
          "data": function ( data ) {
            data.vendorid = $('#vendorid').val();
            data.startdate = $('#startdate').val();
            data.enddate = $('#enddate').val();
            data.status = $('#status').val();
          },
          beforeSend: function(){
            $('.mask').show();
            $('#loader').show();
          },
          error: function(xhr) {
            //alert(xhr.responseText);
          },
          complete: function(){
            $('.mask').hide();
            $('#loader').hide();
          },
        },
        
      });
    $('.dataTables_filter input').attr('placeholder','Search...');


    //DOM Manipulation to move datatable elements integrate to panel
    $('.panel-ctrls.panel-tbl').append($('.dataTables_filter').addClass("pull-right")).find("label").addClass("panel-ctrls-center");
    $('.panel-ctrls.panel-tbl').append("<i class='separator'></i>");
    $('.panel-ctrls.panel-tbl').append($('.dataTables_length').addClass("pull-left")).find("label").addClass("panel-ctrls-center");

    $('.panel-footer').append($(".dataTable+.row"));
    $('.dataTables_paginate>ul.pagination').addClass("pull-right pagination-md");

    $('#datepicker-range').datepicker({
      todayHighlight: true,
      format: 'dd/mm/yyyy',
      autoclose: true,
      todayBtn:"linked"
    });
    $(function () {
      $('.panel-heading.filter-panel').click(function() {
          $(this).find('.button-icon span').html($(this).find('.button-icon span').text() == 'keyboard_arrow_down' ? 'keyboard_arrow_up' : 'keyboard_arrow_down');
          //$(this).children().toggleClass(" ");
          $(this).next().slideToggle({duration: 200});
          $(this).toggleClass('panel-collapsed');
          return false;
      });
    });
});

function applyFilter(){
  oTable.ajax.reload(null,false);
}
function chagecreditnotestatus(status, CredinoteId){
  var uurl = SITE_URL+"purchase-credit-note/update-status";
  if(CredinoteId!=''){
    swal({title: "Are you sure to change status?",
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, Change it!",   
      closeOnConfirm: false }, 
      function(isConfirm){   
      if (isConfirm) {  
        if(status==2){
            
          $('#rejectcreditnoteModal').modal('show');
          $('#rejectioncreditnoteid').val(CredinoteId);
          $('#rejectionstatus').val(status);
        }else{ 
          $.ajax({
            url: uurl,
            type: 'POST',
            data: {status:status,CredinoteId:CredinoteId},
            success: function(response){
                if(response==1){
                  location.reload();
                }else{
                  new PNotify({title: response,styling: 'fontawesome',delay: '3000',type: 'error'});
                }
              },
            error: function(xhr) {
            //alert(xhr.responseText);
            }
          });  
        } 
      }
    });
  }           
}
function checkvalidationforrejectioncreditnote(){

  var resonforcancellation = $('#resonforrejection').val();
  var CredinoteId = $('#rejectioncreditnoteid').val();
  var status = $('#rejectionstatus').val();
  var isvalidresonforrejection = 1;
  
  PNotify.removeAll();
  $("#resonalert").html('');

  if(resonforcancellation == ''){
    $("#resonforrejection_div").addClass("has-error is-focused");
    $("#resonalert").html('<i class="fa fa-exclamation-triangle"></i> Please enter reson for rejection !');
    isvalidresonforrejection = 0;
  }else {
    if(resonforcancellation.length < 3){
      $("#resonforrejection_div").addClass("has-error is-focused");
      $("#resonalert").html('<i class="fa fa-exclamation-triangle"></i> Reson require minimum 3 characters !');
      isvalidresonforrejection = 0;
    }
  }
  if(isvalidresonforrejection == 1){
      var uurl = SITE_URL+"purchase-credit-note/update-status";
      $.ajax({
      url: uurl,
      type: 'POST',
      data: {status:status,CredinoteId:CredinoteId,resonforcancellation:resonforcancellation},
      success: function(response){
          if(response==1){
            location.reload();
          }else{
            new PNotify({title: response,styling: 'fontawesome',delay: '3000',type: 'error'});
          }
        },
      error: function(xhr) {
      //alert(xhr.responseText);
      }
    }); 
  }

}

function printCreditNote(id){

  var uurl = SITE_URL + "purchase-credit-note/printPurchaseCreditNote";
  $.ajax({
    url: uurl,
    type: 'POST',
    data: {id:id},
    //dataType: 'json',
    async: false,
    beforeSend: function() {
        $('.mask').show();
        $('#loader').show();
    },
    success: function(response) {
        
      var data = JSON.parse(response);
      var html = data['content'];
    
      var frame1 = document.createElement("iframe");
      frame1.name = "frame1";
      frame1.style.position = "absolute";
      frame1.style.top = "-1000000px";
      document.body.appendChild(frame1);
      var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
      frameDoc.document.open();
      frameDoc.document.write(html);
      frameDoc.document.close();
      setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
      }, 500);
    },
    error: function(xhr) {
        //alert(xhr.responseText);
    },
    complete: function() {
        $('.mask').hide();
        $('#loader').hide();
    },
  });
}
