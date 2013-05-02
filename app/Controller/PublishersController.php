<?php
App::uses('AppController', 'Controller');
/**
 * Publishers Controller
 *
 * @property Publisher $Publisher
 */
class PublishersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Publisher->recursive = 0;
		$publishers = $this->paginate();
		$info       = $this->Publisher->getInfo();
		$this->set(compact('publishers', 'info'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Publisher->exists($id)) {
			throw new NotFoundException(__('Invalid publisher'));
		}

		$options = array(
			'conditions' => array(
				'Publisher.' . $this->Publisher->primaryKey => $id
			),
			'recursive' => 2
		);

		$publisher = $this->Publisher->find('first', $options);
		$info      = $this->Publisher->getInfo();
		$this->set(compact('publisher', 'info'));
	}

}