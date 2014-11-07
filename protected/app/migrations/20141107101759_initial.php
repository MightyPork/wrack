<?php

use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
	public function change()
	{
		$table = $this->table('articles');

		$table
			->addColumn('canonical',   'text',    ['null' => false])
			->addColumn('path',        'text')
			->addColumn('hits',        'integer', ['default' => 0])
			->addColumn('votes_up',    'integer', ['default' => 0])
			->addColumn('votes_down', 'integer', ['default' => 0])

			->addIndex('canonical', array('unique' => true))
			->create();
	}

	public function up() {}
	public function down() {}
}
