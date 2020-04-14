<?php

class CI_Chat {

	public function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library('session');
        //print_r($this->ci->session->userdata());
        $_SESSION['user_id'] = $this->ci->session->userdata('autenticado')['user_id'];
        $_SESSION['username'] = $this->ci->session->userdata('autenticado')['username'];
        
        if (!isset($_SESSION['chatHistory'])) {
			$_SESSION['chatHistory'] = array();	
		}
		if (!isset($_SESSION['openChatBoxes'])) {
			$_SESSION['openChatBoxes'] = array();	
		}

		if( isset( $_GET['action'] ) ){
			if ($_GET['action'] == "chatheartbeat") { 
				$this->chatHeartbeat(); 
			} 
			if ($_GET['action'] == "sendchat") { 
				$this->sendChat(); 
			} 
			if ($_GET['action'] == "closechat") { 
				$this->closeChat(); 
			} 
			if ($_GET['action'] == "startchatsession") { 
				$this->startChatSession(); 
			} 
			if ($_GET['action'] == "chathistory") { 
				$this->chatHistory(); 
			} 
		}
    }
	/*
	------------
	*/
	function startChatSession() {
		$items = '';
		if (!empty($_SESSION['openChatBoxes'])) {
			foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
				$items .= $this->chatBoxSession($chatbox);
			}
		}
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		header('Content-type: application/json');
		?>
		{
				"username": "<?php echo $_SESSION['user_id'] ?>",
				"from_username": "<?php echo $_SESSION['username']; ?>",
				"items": [
					<?php echo $items; ?>
		        ]
		}
		<?php
		exit(0);
	}
	/*
	------------
	*/
	function chatBoxSession($chatbox) {
		$items = '';
		if (isset($_SESSION['chatHistory'][$chatbox])) {
			$items = $_SESSION['chatHistory'][$chatbox];
		}else{
			// fetch from database last few records
		}
		return $items;
	}
	/*
	------------
	*/
	function closeChat() {

		unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
		
		echo "1";
		exit(0);
	}
	/*
	------------
	*/
	function sanitize($text) {
		$text = htmlspecialchars($text, ENT_QUOTES);
		$text = str_replace("\n\r","\n",$text);
		$text = str_replace("\r\n","\n",$text);
		$text = str_replace("\n","<br>",$text);
		return $text;
	}
	/*
	--------
	*/

	function sendChat() {
		$from = $_SESSION['user_id'];
		$from_name = $_SESSION['username'];
		$to = $_POST['to'];
		$to_name = $_POST['to_name'];
		$message = $_POST['message'];
		$from_foto = $_POST['from_foto'];
		$to_foto = $_POST['to_foto'];
		$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
		
		$messagesan = $this->sanitize($message);

		if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
			$_SESSION['chatHistory'][$_POST['to']] = '';
		}
		
		$d = array(
			's' => '1',
			'fname' => $to_name,
			'f' => $to,
			'm' => $messagesan,
			'ff' => $from_foto,
		   'tf' => $to_foto,
		);
		
		$_SESSION['chatHistory'][$_POST['to']] .= json_encode( $d ).",";
		//$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
		// {
		// "s": "1",
		// "f": "{$to}",
		// "m": "{$messagesan}"
		// },
		// EOD;
		unset($_SESSION['tsChatBoxes'][$_POST['to']]);
		
		$data = array(
		   'from' => $from,
		   'from_name' => $from_name,
		   'to_name' => $to_name,
		   'to' => $to,
		   'message' => $message,
		   'from_foto' => $from_foto,
		   'to_foto' => $to_foto,
		);
		
		$this->ci->db->set('sent', 'NOW()', FALSE);
		$this->ci->db->insert('chat', $data); 
		echo "1";
		exit(0);
	}


	function chatHistory(){
		$this->ci->db->select('*');
		$this->ci->db->where("(`from` = $_SESSION[user_id]  AND  `to` = ".$this->ci->input->get('to')." )");
		$this->ci->db->or_where("(`to` = $_SESSION[user_id]  AND  `from` = ".$this->ci->input->get('to')." )");
		$this->ci->db->order_by('id','ASC' );
		$query = $this->ci->db->get('chat');
		$items = '';
		$chatBoxes = array();
		foreach ($query->result_array() as $chat) {
			# code...
			$chat['message'] = $this->sanitize($chat['message']);

			$d = array(
				's' => '0',
				'f' => $chat['from'],
				'fname' => $chat['from_name'],
				'm' => $chat['message'],
				'fh' => $chat['sent'],
				'ff' => $chat['from_foto'],
				'tf' => $chat['to_foto'],
			);
			$items.= json_encode( $d ).",";
		}
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		header('Content-type: application/json');
		?>
			{
				"items": [
					<?php echo $items; ?>
		        ]
			}
		<?php
		exit(0);
	} // end function

	function chatHeartbeat() {
		$this->ci->db->select('*');
		$this->ci->db->where('to', $_SESSION['user_id'] );
		$this->ci->db->where('recd',0 );
		$this->ci->db->order_by('id','ASC' );
		$query = $this->ci->db->get('chat');
		$items = '';
		$chatBoxes = array();
		foreach ($query->result_array() as $chat) {
			# code...
			if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
				$items = $_SESSION['chatHistory'][$chat['from']];
			}

			$chat['message'] = $this->sanitize($chat['message']);
			
			$d = array(
				's' => '0',
				'f' => $chat['from'],
				'fname' => $chat['from_name'],
				'm' => $chat['message'],
				'ff' => $chat['from_foto'],
				'tf' => $chat['to_foto'],
			);
			// $items .= <<<EOD
			// {
			// "s": "0",
			// "f": "{$chat['from']}",
			// "m": "{$chat['message']}"
		    // },
		    // EOD;
		    
			$items.=json_encode( $d ).",";

			if (!isset($_SESSION['chatHistory'][$chat['from']])) {
				$_SESSION['chatHistory'][$chat['from']] = '';
			}
			$ch = array(
				's' => '0' ,
				'f' => $chat['from'],
				'fname' => $chat['from_name'],
				'm' => $chat['message'],
				'ff' => $chat['from_foto'],
				'tf' => $chat['to_foto'],
			);
			$_SESSION['chatHistory'][$chat['from']] .=  json_encode( $ch ) .",";
			// $_SESSION['chatHistory'][$chat['from']] .= <<<EOD
			// {
			// "s": "0",
			// "f": "{$chat['from']}",
			// "m": "{$chat['message']}"
			// },
			// EOD;
			
			unset($_SESSION['tsChatBoxes'][$chat['from']]);
			$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
		}

		/*if (!empty($_SESSION['openChatBoxes'])) {
			foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
				if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
					$now = time()-strtotime($time);
					$time = date('g:iA M dS', strtotime($time));
	
					$message = "Sent at $time";
					if ($now > 180) {
	
						$d = array(
							's' => '2',
							'f' => $chatbox,
							'm' => $message,
						);
	
						$items.= json_encode( $d ).",";
						// 	$items .= <<<EOD
						// {
						// "s": "2",
						// "f": "$chatbox",
						// "m": "{$message}"
						// },
						// EOD;
					
						if (!isset($_SESSION['chatHistory'][$chatbox])) {
							$_SESSION['chatHistory'][$chatbox] = '';
						}
						
						$d = array(
							's' => '2',
							'f' => $chatbox,
							'm' => $message,
						);
						
						$_SESSION['chatHistory'][$chatbox].= json_encode( $d ).",";
						// $_SESSION['chatHistory'][$chatbox] .= <<<EOD
						// {
						// "s": "2",
						// "f": "$chatbox",
						// "m": "{$message}"
						// },
						// EOD;
						$_SESSION['tsChatBoxes'][$chatbox] = 1;
					}
				}
			}
		}*/
		
		$this->ci->db->select('*');
		$this->ci->db->set('recd', 1);
		$this->ci->db->where('to', $_SESSION['user_id'] );
		$this->ci->db->where('recd',0 );
		$this->ci->db->update('chat');
		
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
		header('Content-type: application/json');
		?>
			{
				"items": [
					<?php echo $items; ?>
		        ]
			}
		<?php
		exit(0);
	}
} // end class