$(function () {


  $('#dtrifornimento').DataTable({

    "columnDefs": [
      {
        "searchable": false,
        "orderable": false,
        "targets": [0]
      }],

    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,

    //ordina i risultati
    "order": [[2, "desc"]],
    //abilita il response della tabella
   "responsive": true,
   "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Italian.json" }

  });



  //Date picker
     $('#datepicker').datepicker({
        language: 'it',
        todayBtn: "linked",
         todayHighlight: true,
         keyboardNavigation: false,
       autoclose: true
     });




  //evento che intercetta la selezione della riga
//  var table = $('#dtclienti').DataTable();
//  $('#dtclienti tbody').on('click', 'tr', function () {
//    var data = table.row(this).data();
    //  alert('You clicked on ' + data[1] + '\'s row');
//  });


//  $('[data-toggle="tooltip"]').tooltip();
});



//evento che intercetta la finestra modale in modifica per passare i parametri
$('#ModalMod').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('idrecord') // Extract info from data-* attributes
  var nome = button.data('nome')
  var tipo = button.data('tipo')
    var costo = button.data('costo')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  //  modal.find('.modal-title').text('New message to ' + recipient)
  //  modal.find('.modal-body input').val(recipient)
  modal.find('input[name="idrecord"]').val(id)
  modal.find('input[name="nome"]').val(nome)
  modal.find('select[name="tipo"]').val(tipo)
  modal.find('input[name="costo"]').val(costo)

});

function Validate(){


var KmPrecedenti = document.getElementById('kmprecedenti');
var KmAttuali = document.getElementById('km');
var KmPercorsi = (Number(KmAttuali.value) - Number(KmPrecedenti.value));
 document.getElementById('kmparz').value = KmPercorsi;


 //Calcola i litri

 var euroLitro = document.getElementById('eurolitro');
 var euro = document.getElementById('euro');
 var Litri = Math.round((Number(euro.value) / Number(euroLitro.value))* 100) / 100;
 	document.getElementById("litri").value = Litri;


  //Calcola i litri per 100Km
  	var l100 = (Number(Litri) *100) / Number(KmPercorsi)
  	document.getElementById("litri100km").value =  Math.round( l100 * 100) / 100;

  	//Calcola Euro al Km
  	var EuroKm = (Number(euro.value) / Number(KmPercorsi))
  	document.getElementById("eurokm").value =  Math.round( EuroKm * 1000) / 1000;

CheckValue();

};

function CheckValue(){

if (document.getElementById('kmparz').value.indexOf("-") != -1){

document.getElementById("insertprodotto").disabled = true;
}else{
document.getElementById("insertprodotto").disabled = false;

}

};

function deleterecord(ID) {
  var agree=confirm("ATTENZIONE! Sicuro di voler cancellare il Record? NON SARANNO RECUPERABILI!");
  if (agree)
  {
//alert(ID);
    console.log(ID);
    //alert("tablename=attivitaprodotto&"+"idattivita="+ID_ATT+"&idprodotto="+ID_PROD);
  //  console.log("tablename=attivitarisorsa&"+"idattivita="+ID_INT+"&idrisorsa="+ID_COST);
    $.ajax({
      type: "POST",
      url: "../Database/interopMyDB.php",
      data: "delete=HISTORY&"+"ID="+ID,
      success: function(msg){
        alert( msg );
        location.reload(true);
        // body.append(data);
      },
      error: function ( xhr ) {
        alert( xhr );
      }
    });
  }  else
  {
    return false ;
  }
};
