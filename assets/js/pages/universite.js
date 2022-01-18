'use strict';


function universiteAfterAjax(run,options)
{
    run = $j.str_replace('#','',run);
    options = options || {};
    switch(run)
    {
        case 'televerser':
            $(document).ready(function()
            {
                $('#excel_file').change(function() {
                    $('#export_excel').submit()
                });
                
                $('#export_excel').on('submit',function(e)
                {
                    e.preventDefault();

                    $('#message').html(' Veuillez patienter....')

                    $.ajax({
                        url: "action/export_televerser.php",
                        method:"post",
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {                           
                            //alert(data)
                            $('#message').html(data)
                            notification('success', 'Félicitation', '<strong>'+data+'</strong>');
                            $('#excel_file').val('')
                            setTimeout(function(){ window.location.reload() }, 100)
                        }
                    });
                });
            });
        break;

        case 'nouveau':
            saving('form_etudiant',6, 'save_etudiant')    
        break;

        case 'detail':
            downloadFile('logo', true)
            saving('form_diplome',6, 'save_diplome')
        break;

        case 'validation':
            $j('#validation_bon_commande').click(function(e)
            {
                $j.preventDefault(e)
                var btnTxt = $j('#validation_bon_commande').html(), id = $j(this).attr('data-id')
                $j('#validation_bon_commande').html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Traitement en cours...').addClass('disabled')
        
                $j.ajax({
                    method : 'GET',
                    urlEncode : true,
                    url : 'action/global__.php?id='+id+'&&action=valide_bon',
                    onSuccess : function(data)
                    {
                        $j('#validation_bon_commande').html(btnTxt)
                        notification('success', '', '<strong>'+textError[9]+'</strong>')
                        location.href = data
                        //setTimeout(function(){ window.location.reload() }, 1000)
                    }
                })
            })
        break;
    }
}

