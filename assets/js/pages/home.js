'use strict';

let liste_ecart = function(){
    $j('#station_id').change(function()
    {
        let id_station = $(this).val()

        $j.ajax({
            method : 'GET',
            urlEncode : true,
            dataType:'text',
            url : 'action/global__.php?id='+id_station+'&&action=liste_ecart',
            onSuccess : function(data)
            {
                $('#chargement_ecart').html(data)
            }
        })
    })
}

function homeAfterAjax(run,options)
{
    run = $j.str_replace('#','',run);
    options = options || {};
    switch(run)
    {
        case 'dashboard':
            liste_ecart()
        break;
    }
}

