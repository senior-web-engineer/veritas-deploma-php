<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title><?= TITLE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="Ibrahima Sory Diakité" name="author" />
    <?php if($_GET['ctrl'] == 'details' OR $_GET['ctrl'] == 'update'): ?>
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
        <meta http-equiv="PRAGMA" content="NO-CACHE" />
    <?php endif; ?>
    <link rel="shortcut icon" href="<?= LOGIN_ICON ?>logo.jpg" />
    <link href="<?= CSS ?>icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= CSS ?>app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="<?= CSS ?>style.css" rel="stylesheet" type="text/css" />
    <link href="<?= CSS_VENDOR ?>jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= JS_VENDOR ?>datetimepicker/jquery.datetimepicker.min.css" rel="stylesheet" />
    <link href="<?= JS_VENDOR ?>bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="<?= CSS_VENDOR ?>dataTables.bootstrap4.css" rel="stylesheet" type="text/css" /> 

    <!--script src="<?= MYJS ?>turbolinks.js"  data-turbolinks-eval="false" type="text/javascript"></script-->
    
    <?php $head->appendElement(); $head->executeCss(); ?>
    <!--style type="text/css">
        .turbolinks-progress-bar {
            height: 5px;
            background: red;
        }
    </style-->

    <!--style type="text/css">
        .transition-fade {
            opacity: 1;
        }
        html.is-animating .transition-fade {
            opacity: 0;
            transform: translateY(-50px);
        }
    </style-->
</head>

<body  class="<?php if($_GET['ctrl'] == 'login') echo 'authentication-bg'; else echo 'loading'; ?>">
    <?php if($_GET['ctrl'] != 'login'):?>
        <div id="loading"><img src="<?= LOGIN_ICON ?>loading.gif" /></div>
        <div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog"><div class="modal-content"></div></div>
        </div>
        <div class="modal fade" tabindex="-1" id="myModalAlert" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog"><div class="modal-content modal-filled bg-danger"></div></div>
        </div>
        <div class="modal fade" tabindex="-1" id="myModalAlertValidation" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog"><div class="modal-content"></div></div>
        </div>
        <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-full-width"><div class="modal-content"></div></div>
        </div>        
        <div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document"><div class="modal-content"></div></div>
        </div>
    <?php endif; ?>

    <div id="global" class="<?php if($_GET['ctrl'] == 'login') echo 'auth-fluid__'; else echo 'wrapper';?>">
        <?php if($_GET['ctrl'] != 'login'):
            include SLIDE;
            include MENU;
        endif; ?>
