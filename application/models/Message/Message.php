<?php
	/* requires passing an Account object /Account/Account.php */

	Class Message {
		
		private $_Account;
		
		public function __construct(Account $_Account){
			$this->_Account = $_Account;			
		}
		
		public function Home(){			
			if($this->_Account->IsLoggedIn()) return $this->_DefaultLoggedInMsg();
			else return $this->_DefaultNotLoggedIn();
		}
		
		private function _DefaultNotLoggedIn(){
			$html = "
					<div class='centered-rows'>
						<div id='msg-div'>
						Welcome to StoryVille.me, we hope you stick around, post a question or answer one,
						maybe post a story or experience under the 'Stories' section. We don't censor this
						website, so we do require that you be at least 18 years of age to join. Thanks!
						</div>
					</div>
					";
			return $html;
		}
		
		private function _DefaultLoggedInMsg(){
			$html = "";
			return $html;
		}
		
	}