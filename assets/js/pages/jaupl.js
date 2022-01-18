"use strict";
(function ($) 
{
    if($.fn.ajaxForm == undefined) {
        $.getScript("http://malsup.github.io/jquery.form.js");
    }
    var feature = {};
    feature.fileapi = $("<input type='file'/>").get(0).files !== undefined;
    feature.formdata = window.FormData !== undefined;
    feature.working = false;
	
    $.fn.gnuplupf = function (options) {
    var opt = $.extend({
        url: " ",
        method: "POST",
        enctype: "multipart/form-data",
        fileName: "myfile",
        allowedTypes: "*",   
        fileTypes: " ",   
        statusId: "staSUhvs",   
        progresseId: "probarPHOTO probarCV probarLEVEL_GRADE probarDOCUMENTS", 
        idAbort: 'abortpa',	   
        uploadClass: 'gr',	   
        maxFileSize: 9000000000000,	   
        formGroup : "file-upload-" + (new Date().getTime()),  
        formData: {},	   
	    dynamicFormData: function () {
           return {};
        },
        onBeforeSend: function (xhr, o, ext) {},
        onSubmit: function (files, xhr) {},
        onSuccess: function (files, response, xhr, ext) {},
        onError: function (files, status, message) {},
	    showProgress: true,
        showAbort: true,	
        showError: true,		
	    onSelect: function (files) {
            return true;
        }    
	}, options);
	  		
    var obj = this;	
    var uploadLabel = $(this);
    (function jqueryFormLoaded() {
        if($.fn.ajaxForm) createCutomInputFile(obj,opt,uploadLabel);   
        else window.setTimeout(checkAjaxFormLoaded, 10);
    })();
    function serializeData(extraData) {
        var serialized = [];
        if(jQuery.type(extraData) == "string") { serialized = extraData.split('&'); } 
        else { serialized = $.param(extraData).split('&'); }
        var len = serialized.length;
        var result = [];
        var i, part;
        for(i = 0; i < len; i++) {
            serialized[i] = serialized[i].replace(/\+/g, ' ');
            part = serialized[i].split('=');
            result.push([decodeURIComponent(part[0]), decodeURIComponent(part[1])]);
        }
        return result;
    }		
    function isFileTypeAllowed (opt, fileName) {
        var fileExtensions = opt.allowedTypes.toLowerCase().split(",");
        var ext = fileName.split('.').pop().toLowerCase();
        if(opt.allowedTypes != "*" && jQuery.inArray(ext, fileExtensions) < 0) {
            return false;
        }
        return true;
    }
		
    function getFileSize(size) {
        var sizeStr = ""; var sizeKB = size / 1024;
        if(parseInt(sizeKB) > 1024) { var sizeMB = sizeKB / 1024; sizeStr = sizeMB.toFixed(2) + " MB";
        } else { sizeStr = sizeKB.toFixed(2) + " KB"; }
        return sizeStr;
    }
		
    function createProgressDiv(opt) {
        this.progressDiv = $("<div class='file-upload-progress'>").hide();
        this.abort = $("#"+opt.idAbort).hide();
        this.progressbar = $("<div class='file-upload-bar'></div>").appendTo(this.progressDiv);
        $("#"+opt.progresseId).append(this.progressDiv);
    }
		
    function beginUpload(opt,form) {
	    var pb = new createProgressDiv(opt);	
        ajaxFormSubmit(obj,opt,form, pb);
		$('#'+opt.idAbort).show('slow');
    }
		
    function createCutomInputFile(obj,opt,uploadLabel){
        var fileUploadId = "gn-upload-id-" + (new Date().getTime());
        var form = $("<form method='" + opt.method + "' action='" + opt.url + "' enctype='" + opt.enctype + "'></form>");
        var fileInputStr = "<input type='file' id='" + fileUploadId + "' name='" + opt.fileName + "'/>";
	    uploadLabel.unbind("click");
        var fileInput = $(fileInputStr).appendTo(form);

		fileInput.change(function (e) {
            if(feature.working){
				opt.onError.call(this, 0, 'Un envoie est dejas en cours');
				return;
            }
            else
            {
                var fileExtensions = opt.allowedTypes.toLowerCase().split(",");
                var fileName = null;
                if(this.files) //supporte l'api files
                {
					fileName = this.files[0].name;
					var ext = fileName.split('.').pop().toLowerCase();
                    opt.fileTypes = ext;
                    if(!isFileTypeAllowed(opt, fileName)) {
                        if(opt.showError) opt.onError.call(this, 0, "Les fichiers <strong>." + ext + "</strong> ne sont pas autorise</div>");
                        return;
                    }					
                    if(opt.onSelect(this.files) == false) return;
    			    if(this.files[0].size > opt.maxFileSize) {
    					if(opt.showError) opt.onError.call(this, 0, "Taille maximum : <strong>" +getFileSize(opt.maxFileSize) + "<strong></div>"); return;
                    }
					beginUpload(opt,form);
                } else {
                    var filenameStr = $(this).val();
                    var flist = [];
                    fileName = filenameStr;
					var ext = fileName.split('.').pop().toLowerCase();
					opt.fileTypes = ext;
                    if(!isFileTypeAllowed(opt, filenameStr)) {
						if(showError) if(opt.showError) opt.onError.call(this, 0, "Les fichiers <strong>." + ext + "</strong> ne sont pas autorise</div>");
                        return;
                    }
                    //fallback for browser without FileAPI
                    flist.push({ name: filenameStr, size: 'NA' });
                    if(opt.onSelect(flist) == false) return;
					beginUpload(opt,form);
                }
			}
		});
		form.css({'margin': 0,'padding': 0});	
		var uplwidth = uploadLabel.width();
        var uplheight = uploadLabel.height();
		uploadLabel.addClass(opt.uploadClass);
        uploadLabel.css({position: 'relative',overflow: 'hidden',cursor: 'default'});
		fileInput.css({'position': 'absolute','cursor': 'pointer','top': '1px','width': uplwidth * 5,'height': uplheight * 2,'right': '0px','z-index': '100','filter': 'alpha(opacity=0)','-ms-filter': "alpha(opacity=0)",'-khtml-opacity': '0.0','-ms-opacity': '0.0','-moz-opacity': '0.0','-webkit-opacity': '0.0','opacity': '0.0'});
		form.appendTo(uploadLabel);
		if(navigator.appVersion.indexOf("MSIE ") != -1){ //IE Browser
            uploadLabel.attr('for', fileUploadId);
        }else {
		    uploadLabel.click(function () { fileInput.blur(); });
        }
    }
    function ajaxFormSubmit(obj,opt,form,pb,fileArray) {
        var options = {
            cache: false,
            contentType: false,
            processData: false,
            forceSync: false,
			data: opt.formData,
            type:opt.method, 		
            beforeSend: function (xhr, o) {
                feature.working = true;
                pb.progressDiv.show();
                $('#'+opt.progresseId).css('display','inline-block');
                if(opt.showAbort) {
                    pb.abort.show();
                    pb.abort.click(function () {
                        xhr.abort();
						pb.progressDiv.hide("slow");
                        form.remove();	
				        createCutomInputFile(obj,opt,uploadLabel); 
				        feature.working = false;							
                    });
                }
                if(!feature.formdata) //For iframe based push
                {
                    pb.progressbar.width('5%');
                } else {pb.progressbar.width('1%');} //Fix for small files
				opt.onBeforeSend.call(this, xhr, o, opt.fileTypes);	
            },       
            beforeSubmit: function (formData, $form, options) {
                if(opt.onSubmit.call(this, fileArray) != false) {
                    var dynData = opt.dynamicFormData();
                    if(dynData) {
                        var sData = serializeData(dynData);
                        if(sData) {
                            for(var j = 0; j < sData.length; j++) {
                                if(sData[j]) {
                                    if(opt.fileData != undefined) options.formData.append(sData[j][0], sData[j][1]);
                                    else options.data[sData[j][0]] = sData[j][1];
                                }
                            }
                        }
                    }   
                    return true;
                }
                return false;
            },
			uploadProgress: function (event, position, total, percentComplete) {
                //Fix for smaller file uploads in MAC
                if(percentComplete > 98) percentComplete = 98;
                var percentVal = percentComplete + '%';
                if(percentComplete > 1) pb.progressbar.width(percentVal);
                if(opt.showProgress) {
                    pb.progressbar.html(percentVal);
                    pb.progressbar.css('text-align', 'center');
                }
            },
            success: function (data, message, xhr) {
                pb.progressbar.width('100%')
                if(opt.showProgress) {
                    pb.progressbar.html('100%');
                    pb.progressbar.css('text-align', 'center');
                }
                pb.abort.hide('slow');
                pb.progressDiv.hide('slow');
                $('#'+opt.progresseId).hide('slow');
                form.remove();				
				feature.working = false;
				createCutomInputFile(obj,opt,uploadLabel);
				//alert(data);
				opt.onSuccess.call(this, data, xhr, opt.fileTypes);					
            },
            error: function (xhr, status, errMsg) {
                pb.abort.hide();
				$('#'+opt.progresseId).hide('slow');
                pb.progressDiv.hide();
                $("#"+opt.statusId).html("<span style='color:red;'>ERROR: " + errMsg + "</span>");
                xhr.abort();                  
                form.remove();
               opt.onError.call(this, status, errMsg);
            }
        };
		(feature.working) ? $("#"+opt.statusId).html('Un envoie est déjà en cours') : form.ajaxSubmit(options);
    }
    //alert(jauplo.method);
    //alert($.fn.ajaxForm);
    return this;
    };
}(jQuery));
