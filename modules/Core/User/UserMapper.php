<?php
/**
 * UserMapper.php
 *
 * Date: 7/04/2014
 * Time: 9:37 PM
 */

namespace Core\User;


class UserMapper extends \App\Mapper {

	protected $finalGraph = array();

	/**
	 * Define properties
	 *
	 * @return mixed|void
	 */
	protected function properties() {
		$this->setModel('\\Core\\User');
		$this->setTable('user');

		$this->addProperty('id', 'id');
		$this->addProperty('uuid', 'uuid');
		$this->addProperty('firstname', 'firstname');
		$this->addProperty('lastname', 'lastname');
		$this->addProperty('birthdate', 'birthdate');

		/* Join the Phone record onto the User record using
		 * the following columns as a match. otherTable and
		 * otherKey refer to the table and key being joined
		 * onto this current mapper's model
		 *
		 * These definitions, when combined into the final
		 * sql query, mustn't create a syntactically incorrect
		 * query, or it'll just snap
		 */
		$this->addJoin('Phone', array(
			'other' => array(
				'table' => 'phone',
				'alias' => 'p',
				'key' => 'user_id'
			),
			'this' => array(
				'alias' => 'u',
				'key' => 'id',
			)
		));
	}

	public function addJoin($name, $item) {
		$this->joins[$name] = $item;
	}

	// User u
	public function from($thisModel, $alias) {
		$this->graph[$this->getTable()] = array();

		return "FROM `{$this->getTable()}` {$alias}";
	}

	// User Phone
	public function join($otherModel) {
		$otherTable = $this->joins[$otherModel]['other']['table'];
		$otherAlias = $this->joins[$otherModel]['other']['alias'];
		$otherKey = $this->joins[$otherModel]['other']['key'];
		$thisTable = $this->getTable();
		$thisAlias = $this->joins[$otherModel]['this']['alias'];
		$thisKey = $this->joins[$otherModel]['this']['key'];

		$str = "
			LEFT JOIN {$otherTable} {$otherAlias}
			ON {$otherAlias}.{$otherKey} = {$thisAlias}.{$thisKey}
		";

		$this->graph[$thisTable][$otherAlias] = '';

		return $str;
	}

	public function build(\App\Collection $rowCollection) {

		foreach($rowCollection as $currentInstance) {


		}
	}

	/**
	 * TODO: Test method
	 */
	public function testQuery() {
		$userMapper = $this;
		$phoneMapper = new \Core\User\PhoneMapper();

		$query = "
			SELECT
				{$userMapper->select('u')},
				{$phoneMapper->select('p')}
			{$userMapper->from('User', 'u')}
			{$userMapper->join('Phone')}
		";

		$statement = $this->getDatabase()->prepare($query);
		$statement->execute();

		foreach($statement as $row) {
			$user = $userMapper->hydrate('u', $row);
			$phone = $phoneMapper->hydrate('p', $row);

			$rowCollection = new \App\Collection();
			$rowCollection->add($user);
			$rowCollection->add($phone);

			$this->build($rowCollection);
		}

//		new \App\Probe($rowCollection);
	}
} 