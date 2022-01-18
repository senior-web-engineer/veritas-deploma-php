<?php
    class HEAD {
       	private $element = [];
      	private $sourcejs = [];
       	public $codecss;
       	private $codejs;
       	private $title;
        public function createElement($elem) {$this->element[] = htmlentities($elem); return $this->element; }
		public function appendElement() { foreach($this->element as $elem): echo html_entity_decode($elem); endforeach; }
		public function createFileJs($source, $verifSource = true) { if( $verifSource && !is_file($source) ): trigger_error("Impossible d'atteindre ce fichier $source ", E_USER_WARNING); else: $this->sourcejs[] = htmlentities("<script src=\"$source\"></script>"); return $this->sourcejs; endif; }
		public function appendFilejs() {foreach($this->sourcejs as $elem): echo html_entity_decode($elem); endforeach; }
		public function prepareCss($codecss) {if(preg_match('#^\s*$#',$codecss)): trigger_error('La balise style doit contenir quelques règles', E_USER_ERROR); else: $this->codecss = '<style>'.$codecss.'</style>'; endif; }
	    public function prepareJs($codejs) {if(preg_match('#^\s*$#',$codejs)):trigger_error('La balise script doit contenir quelques script javascript', E_USER_ERROR);else:$this->codejs = '<script>'.$codejs.'</script>';endif; }
		public function executeCss() { echo $this->codecss; }
		public function executeJs() { echo $this->codejs; }
		public function addTitle($title) { return $this->title = $title. ' | S.B.S'; }
    }
?>