"use strict";
//var Turbolinks require('Turbolinks')
var $_GET = $j.parse_str($j.substr($j.strstr(getPageName(),'?'), 1), true);
// pour mettre le premier caractère en majuscule
String.prototype.ucFirst=function(){ return this.substr(0,1).toUpperCase()+this.substr(1); }
String.prototype.ucWords=function(){ return this.toUpperCase() }

function getPageName() { 
    var pathName = window.location.toString(), pageName = ""; 
    if(pathName.indexOf("/") != -1) 
    { 
        pageName = pathName.split("/").pop(); 
    }  
    else 
    { 
        pageName = pathName; 
    } 
    return pageName; 
}

function navigateToPage(pageName, dataclick) 
{
    var pageName = pageName ? pageName : getPageName(),
    $_GET = $j.parse_str($j.substr($j.strstr(pageName,'?'), 1), true)
    
    var funcName = $_GET['mdl']+'AfterAjax';    
    $.get(pageName, function (response) {
        var markup = $("<div>" + response + "</div>")
        if(dataclick=='global')
        {
            $("#global").html(markup.find(".wrapper").html()); 
            
            $(".side-nav").metisMenu(); 
            
            $j('a.clickurl').click(function(e)
            {
                navigate_(this); 
                $j.preventDefault(e); 
            })
        }
        else
        { 
            $(".content-page").html(markup.find(".content").html()) 
        } 
        dataTableInit() 

        $('.select2').select2()
        
        if(window[funcName]) window[funcName]((typeof $_GET['run'] == 'undefined') ? $_GET['ctrl'] : $_GET['run']) 
    });
}
    
History.Adapter.bind(window, 'statechange', function(evt) 
{
    navigateToPage(false, dataclick_);
    $_GET = $j.parse_str($j.substr($j.strstr(getPageName(),'?'), 1), true)
}); 

$j('a.clickurl').click(function(e) 
{
    navigate_(this)
    //alert('ok')
    $j.preventDefault(e) 
});

function navigate_(hi)
{
    var pageName = pageName = $j(hi).attr('href') ? $j(hi).attr('href') : $j(hi).attr('data-href'),
        dataclick = ($j(hi).attr('data-clickurl') != 'undefined') ? $j(hi).attr('data-clickurl') : 'sidebar-menu';
    //alert(dataclick)
    window['dataclick_'] = dataclick;
    var title = $j(hi).text();
    History.pushState({'pageName': pageName}, title + ' | S.B.S ', pageName);
    $('.select2').select2()
}

$('#myModal, #myModalAlert, #myModalAlertValidation, #scrollable-modal').on('hide.bs.modal', function (e) { $j('html,body').style('overflow-y','auto') })

function loadModal(id, type, ajaxOption, options)
{
    let mt
    if(id == 'full-width-modal') mt = '20px';
    else if(id == 'scrollable-modal') mt = '20px';
    else mt = '70px';
    var pageName = pageName ? pageName : getPageName()
    $j.parse_str($j.substr($j.strstr(pageName,'?'), 1))

    var funcName = mdl+'AfterAjax';
    $('#'+id).on('show.bs.modal', function (e) {
        $j('#'+id+' .modal-dialog').removeClass('modal-lg').removeClass('modal-sm').style('margin-top',mt).addClass(type);
    })
    
    $j.ajax({
        headers : {"Cache-Control":"no-cache"},
        url: ajaxOption.file,
        onSuccess: function(data)
        {
            $j('#'+id+' .modal-content').html(data);
            $j('html,body').style({'overflow':'hidden'});
            $('[data-toggle="tooltip"]').tooltip();
            dataTableInit();
            if(window[funcName]) window[funcName]( (typeof run == 'undefined') ? ctrl : run, options );
            if(ajaxOption.onSuccess) ajaxOption.onSuccess.call(this, data);
        },
        beforeSend : function(){
            $j('#'+id+' .modal-content').html('<h1 style="text-align:center"><img src="assets/images/loading.gif" /></h1>');
        },
        onError : function(error){
            alert('error.text');
        }
    });
}

/**
* Permet de notifier des messages
**/
function notification(icon, titre, msg, pos='top-right')
{
    //<script>$.NotificationApp.send("Title","Your awesome message text","Position","Background color","Icon")</script>
    var background = "rgba(0,0,0,0.2)";
    $.NotificationApp.send(titre,msg,pos,background,icon)
}

/**
* Permet de faire une suppression générale des données
**/
let deleteGeneral = function ()
{
    $j('.btnopt').click(function(e)
    {
        var btnTxt = $j('.btnopt').html(), id = $j(this).attr('data-id'), action = $j(this).attr('data-action'), matricule = $j(this).attr('data-matricule')
        $j('.btnopt').html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Traitement en cours...').addClass('disabled')
        
        $j.ajax({
            method : 'GET',
            urlEncode : true,
            url : 'action/global__.php?id='+id+'&&action='+action+'&&matricule='+matricule,
            onSuccess : function(data)
            {
                //alert(data)
                $j('.btnopt').html(btnTxt)
                $('#myModalAlert, #myModalAlertValidation').modal('hide')
                notification('success', '', '<strong>'+textError[9]+'</strong>')
                //location.href = data
                setTimeout(function(){ window.location.reload() }, 1000)
            }
        })
        $j.preventDefault(e)
    })
}

// Fonction qui permet de changer le type d'input
// x = élément du DOM, type = nouveau type à attribuer
function changeTypeInput(x, type) {if(x.prop('type') == type) return x; try {return x.prop('type', type);} catch(e) {var html = $("<div>").append(x.clone()).html(),regex = /type=(\")?([^\"\s]+)(\")?/;var tmp = $(html.match(regex) == null?html.replace(">", ' type="' + type + '">'):html.replace(regex, 'type="' + type + '"'));tmp.data('type', x.data('type') );var events = x.data('events');var cb = function(events) {return function() {for(i in events) {var y = events[i];for(j in y) tmp.bind(i, y[j].handler);}}}(events);x.replaceWith(tmp);setTimeout(cb, 10); return tmp;}}

function visibility_pwd()
{
    $('.visibility_password').on('click', function()
    {
        if($(this).prev('input').attr('type') == 'password')
        {
            changeTypeInput($(this).prev('input'), 'text');
            $('.visibility_password').html("<span class='input-group-text'> <i class='mdi mdi-eye-off'></i> </span>");
        }
        else
        {
            changeTypeInput($(this).prev('input'), 'password');
            $('.visibility_password').html("<span class='input-group-text'> <i class='mdi mdi-eye'></i> </span>");
            return false;
        }
    })
}

let deleteUploadTmpFile = function(hi)
{
    var fUrl = $j(hi).attr('data-url');
    $j.ajax({
        method : 'GET',
        urlEncode : true,
        url : 'action/deleteuploadtmpfile.php?url='+fUrl,
        onSuccess : function(data){
            $j(hi).parent().remove();
            if($j('.sqrtsw .delete').el.length == 0){
                $j('#dYWpod').disabled(true);
                //$j('#err').hide();
                $('.pj #popoverPJ').popover('show');
            }
        }
    });        
}

let setting_datetimepicker = function (id)
{
    $.datetimepicker.setLocale('fr');  //Langue
    $('#'+id).datetimepicker({
        timepicker: false, // ne pas afficher du temps
        scrollInput: false,
        mask: true,
        lazyInit: true,
        maxDate: false , // max de la journée
        minDate: false, // min de la journée
        format : "d/m/Y",
        yearStart: 2019,
        yearEnd: (new Date()).getFullYear()+1,
        dayOfWeekStart: 1 // debut de la semaine sous forme de tableau = array (Lundi)
    });
}

let backup = function ()
{
    $j('.btnopt').click(function(e)
    {
        var btnTxt = $j('.btnopt').html()
        $j('.btnopt').html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Sauvegarde en cours...')

        $j.ajax({
            headers : {"Cache-Control":"no-cache"},
            timeout : 6000,
            url : 'action/save_backup.php',
            onSuccess: function(data)
            {
                $('#myModalAlert').modal('hide')
                notification('success', 'Félicitation', '<strong>Sauvegarde éffectué avec succès</strong>', 'top-center')
                setTimeout(function(){ location.reload() }, 1500)
            },
            onError : function(error){
                notification('error', 'Attention', '<strong>'+error.text+'</strong>', 'top-center')
            }
        })
    })
}

let profile = function(action)
{
    let save_file
    if(action == 'profile') save_file = 'save_profile';
    else save_file = 'save_my_pwd';

    visibility_pwd()

    $j('#form_profile').formControl({
        onProccess : function(error, obj){
            if(error) { obj.removeClass('correct').addClass('incorrect') }
            else { obj.removeClass('incorrect').addClass('correct') }
        },
        onSuccess : function(){
            $j('#loading').style('display','block')
            var dataForm = $j(this).form()

            $j.ajax({
                method : 'POST',
                urlEncode : true,
                url : 'action/'+save_file+'.php',
                cache: false,
                onSuccess : function(data) {
                    if(action == 'profile'){
                        $('#myModal').modal('hide');    
                        $j('#loading').style('display','none');
                        notification('success', 'Félicitation', '<strong>'+textError[7]+'</strong>');
                        setTimeout(function(){ window.location.reload() }, 500);
                    } else {
                        if(data == 'desole'){
                            $j('#loading').style('display','none');
                            notification('warning', 'Mot de passe', '<strong>'+textError[16]+'</strong>');
                        }
                        else if(data == 'incorrecte'){
                            $j('#loading').style('display','none');
                            notification('info', 'Information', '<strong>'+textError[24]+'</strong>');
                        }
                        else {
                            $('#myModal').modal('hide');    
                            notification('success', 'Félicitation', '<strong>'+textError[7]+'</strong>');
                            setTimeout(function()
                            {
                                window.location.href = 'index.php?ctrl=login&&mdl=auth&&run=logout'
                            },500);   
                        }
                    }
                }, 
                data : dataForm
            });
        },
        onError : function(){ notification('error', 'Attention', '<strong>'+textError[2]+'</strong>') }
    });
}

let downloadFile = function (id_p, isSendPlusieur)
{
    //$('#'+id_p+' #'+popover).popover('show');
    $j.getScript('assets/js/pages/jquery.form.js',function(){
        $j.getScript('assets/js/pages/jaupl.js', function(){
            $('#'+id_p).gnuplupf({
                maxFileSize:9000000000000,
                method: "POST",
                fileName : 'myfile',
                url:'action/uploadFile.php',
                allowedTypes:'jpg,png,jpeg,pdf', 
                uploadClass: 'file-upload-Jsn', 
                statusId:'errtext',
                beforeSend:function(){ notification('info', 'Information', '<strong>'+textError[12]+'</strong>') },
                onSuccess:function(data,xhr){
                    var f = JSON.parse(data);
                    notification('success', 'Félicitation', '<strong>'+textError[0]+'</strong>')
                    $j('#'+id_p+'list').html('<h5 class="sqrtsw clearfix" data-ext="'+f.ext+'" data-rn="'+f.fileRealName+'" data-hn="'+f.hackName+'" >'+f.fileRealName+' <button onclick="deleteUploadTmpFile(this)" data-url="'+f.fileName+'" type="button" title="Supprimer" class="btn btn-danger delete"><i class="dripicons-trash"></i></button><button data-toggle="modal" onclick="loadModal(\'myModal\',\'modal-lg\',{file:\'action/preview-doc.php?url='+f.fileName+'&id='+f.hackName+'\'});return false;" data-target="#myModal" class="btn btn-primary doc-view"><i data-toggle="tooltip" title="Prévisualisé" class="uil-eye"></i></button> </h5>',isSendPlusieur);
                },
                onError: function( status, errMsg){
                    notification('error', 'Attention', '<strong>'+errMsg+'</strong>', 'top-center')                    
                }
            });
        });
    }); 
}

let saving = function (idForm, IDsuccessMsg, filenameSave)
{
    $j('#'+idForm).formControl({
        onProccess : function(error, obj){ if(error) { obj.removeClass('correct').addClass('incorrect'); } else { obj.removeClass('incorrect').addClass('correct'); }},
        onSuccess : function()
        {
            if($j('.sqrtsw .delete').el.length == 0 && idForm=='form_diplome')
            {               
                notification('error', 'Attention', '<strong>'+textError[25]+'</strong>')
            }
            else
            {
                $j('#loading').style('display','block')
                var dataForm = $j(this).form(), logo = []
                $j('#logolist h5').foreach(function(){
                    logo.push({'hn':$(this).attr('data-hn'),'ext':$(this).attr('data-ext'),'rn':$(this).attr('data-rn')})
                })

                dataForm.logo = JSON.stringify(logo)

                $j.ajax({
                    method : 'POST',
                    urlEncode : true,
                    url : 'action/'+filenameSave+'.php',
                    headers : {"Cache-Control":"no-cache"},
                    cache: false,
                    onSuccess : function(data) 
                    {
                        if(idForm == 'form_verification')
                        {
                            $j('#loading').style('display','none')
                            $('#resultat').html(data)
                        }
                        else
                        {
                            $('#myModal').modal('hide');
                            $j('#loading').style('display','none')
                            notification('success', 'Félicitation', '<strong>'+textError[IDsuccessMsg]+'</strong>')
                            setTimeout(function(){ window.location.reload() }, 500)
                        }
                    }, data:dataForm
                }); 
            }
        },
        onError : function(){ notification('error', 'Attention', '<strong>'+textError[2]+'</strong>') }
    });
}

let preview_doc = function()
{
    $j('#preview_doc').click(function(){
        let id_cargaison = $(this).attr('data-id_cargaison'), type = $(this).attr('data-type')
        $j('#loading').style('display','block')
        $j.ajax({
            cache: false,
            headers : {"Cache-Control":"no-cache"},
            method : 'GET',
            url : 'action/loading_file.php?id='+id_cargaison+'&&type='+type,
            //headers : {"Cache-Control":"cache"},
            onSuccess : function(data)
            {
                $j('#loading').style('display','none')
                $j('#cadre_preview_doc').removeClass('hidden')
                $j('#cadre_preview_doc').html(data)
                $j('#cadre_add_voiture').addClass('hidden')
                $j('#masque_doc').removeClass('hidden')
                $j('#preview_doc').addClass('hidden')
            }
        })
        //e.preventDefault()
    })
    $j('#masque_doc').click(function(){
        $j('#cadre_preview_doc').addClass('hidden')
        $j('#cadre_add_voiture').removeClass('hidden')
        $j('#masque_doc').addClass('hidden')
        $j('#preview_doc').removeClass('hidden')
    })
}

$j(window).load(function()
{
    var pageName = pageName ? pageName : getPageName();
    $j.parse_str($j.substr($j.strstr(pageName,'?'), 1));
    var funcName = mdl+'AfterAjax';
    //$('[data-toggle="timepicker"]').timepicker();
    //alert(funcName)
    //const swup = new Swup();
    if(window[funcName]) window[funcName]((typeof run == 'undefined')?ctrl:run);  
}); 

//Turbolinks.start()