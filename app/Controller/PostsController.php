<?php


class PostsController extends AppController { 
	public function isAuthorized($user) {
	    // All registered users can add posts
	    if ($this->action === 'add') {
	        return true; 
	    }

	    // The owner of a post can edit and delete it
	    if (in_array($this->action, array('edit', 'delete'))) {
	        $postId = (int) $this->request->params['pass'][0];
	        if ($this->Post->isOwnedBy($postId, $user['id'])) {
	            return true;
	        } 
	    }

	    return parent::isAuthorized($user);
	} 
	
	public function add() {
	    if ($this->request->is('post')) {
	        //Added this line
	        $this->request->data['Post']['user_id'] = $this->Auth->user('id');
	        if ($this->Post->save($this->request->data)) {
	            $this->Flash->success(__('Your post has been saved.')); 
	            return $this->redirect(array('action' => 'index'));
	        }
	    }
	}

	public function view($id = null){  
		// Find user_id of post 
		$options = array(
            'conditions' => array( 
                'id = ' . $id, 
            ),
        ); 
        $data_id = $this->Post->find('first', $options)['Post']['user_id'];

        if( $data_id != null ){
	        // Find author name 
	        $options = array(
	            'conditions' => array(
	                'id = ' . $data_id, 
	            ),
	        ); 
	        $this->loadModel('User'); 
	        $data = $this->User->find('first', $options);
	        $this->set('authorPost', $data['User']['username']); 
	    }
	    else
	    	$this->set('authorPost', ""); 

		if(!$id){
			throw 
			new NotFoundException(__('Invalid post.'));
		} 
		$post = $this->Post->findById($id);
		if(!$post){
			throw new NotFoundException(__('Invalid post.'));
		}

		$this->set('post',$post);
	} 



	public function index() { 
		$data = $this->Post->find('all', array(
							'order'=>array('id ASC'))); 
		
		$index = 0; 
		$nr = count($data); 
		for( $i = 1; $i <= $nr; $i++){
			$options = array(
	            'conditions' => array( 
	                'id = ' . $i, 
	            ),
	        ); 
	        $data_id = $this->Post->find('first', $options);
	        if( !isset($data_id['Post']) ) $nr++; 
	        else{
		        $user_id = $data_id['Post']['user_id']; 
		        
		        if( $user_id != null){
			        // Find author name 
			        $options = array(
			            'conditions' => array( 
			                'id = ' . $user_id, 
			            ),
			        ); 
			        $this->loadModel('User'); 
			        $tmp = $this->User->find('first', $options);
			        $data[$index]['Post']['username'] = $tmp['User']['username']; 
	    		}
	    		else
	    			$data[$index]['Post']['username'] = ""; 
	    		$index++; 
	    	} 
		}

		$this->set('posts', array_reverse($data)); 
	} 

} 




?> 