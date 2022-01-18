			<?php if($_GET['ctrl'] != 'login'):?>
					</div>
	                <footer class="footer">
	                    <div class="container-fluid">
	                        <div class="row">
	                            <div class="col-md-6">
	                                2021 - <?=  date('Y') ?> © diak - diak664@gmail.com
	                            </div>
	                            <div class="col-md-6">
	                                <div class="text-md-right footer-links d-none d-md-block">
	                                    <a href="javascript: void(0);">Support</a>
	                                    <a href="javascript: void(0);">Contact : 620289179</a>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </footer>
				</div>
        	<?php endif; ?>
		</div>
    	<!-- END wrapper -->
    	<script src="<?= JS ?>vendor.min.js" type="text/javascript"></script>
	    <script src="<?= JS ?>app.min.js" type="text/javascript"></script>
	    <script src="<?= MYJS ?>sbs.jlive.js" type="text/javascript"></script>      
		<?php if($_GET['ctrl'] != 'login'):?>
			<script src="<?= MYJS ?>sbs.message.js" type="text/javascript"></script>
			<script src="<?= JS_VENDOR ?>history.min.js" type="text/javascript"></script>
			<script src="<?= JS_VENDOR ?>jquery.dataTables.min.js" type="text/javascript"></script>
		    <script src="<?= JS_VENDOR ?>dataTables.bootstrap4.js" type="text/javascript"></script>
		    <script src="<?= JS_VENDOR ?>dataTables.responsive.min.js"></script> 
		    <script src="<?= JS_VENDOR ?>responsive.bootstrap4.min.js"></script>
			<script src="<?= JS_VENDOR ?>datetimepicker/moment.min.js"></script> 
			<script src="<?= JS_VENDOR ?>datetimepicker/jquery.datetimepicker.full.min.js"></script>
			<script src="<?= JS_VENDOR ?>bootstrap-daterangepicker/daterangepicker.js"></script>
			<script src="<?= JS_VENDOR ?>jquery-ui.min.js"></script>


			<script src="<?= JS_VENDOR ?>Chart.bundle.min.js"></script>
        	<!-- third party js ends -->
        	<!-- demo app -->
        	<script src="<?= MYJS ?>demo.dashboard-projects.js"></script>

			<script src="<?= MYJS ?>sbs.dataTable.js"></script> 
			<script src="<?= MYJS ?>sbsjs.js" type="text/javascript"></script>
		    <script src="<?= MYJS ?>universite.js"></script>
		    <script src="<?= MYJS ?>ministere.js"></script> 
		    <script src="<?= MYJS ?>prag.js"></script> 
		<?php endif;
    	$head->appendFilejs();  $head->executejs(); ?>
    </body>
</html>