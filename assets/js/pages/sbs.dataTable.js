var dataTableLangFr = {
	"sProcessing":     "Traitement en cours...",
	"sSearch":         "Rechercher&nbsp;:",
    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
	"sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
	"sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
	"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
	"sInfoPostFix":    "",
	"sLoadingRecords": "Chargement en cours...",
    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
	"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
	"oPaginate": {
		"sFirst":      "Premier",
		"sPrevious":   "Pr&eacute;c&eacute;dent",
		"sNext":       "Suivant",
		"sLast":       "Dernier"
	},
	"oAria": {
		"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
		"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
	}
},
dataTableLangFrSm = {
	"sProcessing":     "Traitement en cours...",
	"sSearch":         "Rechercher&nbsp;:",
    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
	"sInfo":           "_START_ &agrave; _END_ sur _TOTAL_",
	"sInfoEmpty":      "0 &agrave; 0 sur 0",
	"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
	"sInfoPostFix":    "",
	"sLoadingRecords": "Chargement en cours...",
    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
	"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
	"oPaginate": {
		"sFirst":      "Premier",
		"sPrevious":   "Pr&eacute;",
		"sNext":       "Suiv",
		"sLast":       "Dernier"
	},
	"oAria": {
		"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
		"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
	}
};

function dataTable(id)
{
    $(id).DataTable({
	   	searching: true,
	   	//searching: $(id).attr('frtyp')=='sm' ? false : true,
	    "bPaginate": true,
	    "bLengthChange": false,
	    "bFilter": false,
	    "bSort": true,
	    "bInfo": true,
	    "bAutoWidth": false,					
		'language' : $(id).attr('frtyp')=='sm' ? dataTableLangFrSm : dataTableLangFr,		
		"pageLength" : $(id).attr('frtyp')=='sm' ? 10 : 10,
		drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded")}
	});	
}

function dataTableInit()
{
    if (!$.fn.dataTable.isDataTable('#content-datatable')) dataTable('#content-datatable');
    if (!$.fn.dataTable.isDataTable('#content-datatable2')) dataTable('#content-datatable2');
}

$(document).ready(function() {
	"use strict";
    dataTableInit();
});

