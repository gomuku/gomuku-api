<?php

namespace Tests\Db;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint as Table;

class User
{

	/**
	 * const table = users
	 */
	const table = 'users';

	/**
	 * [create description]
	 * @return [type] [description]
	 */
    public static function create(){
    	$schema = Capsule::schema();
        return $schema->create(self::table, function(Table $table){
        	$table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email');
            $table->string('fullname');
        });
    }

    /**
     * [insert description]
     * 
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    public static function insert($data = []){
    	// Perform potentially risky queries in a transaction for easy rollback.
    	$table = self::table;
		try {
		    Capsule::connection()->transaction(function ($con) use ($table, $data) {
		    	$tb = $con->table($table);
		    	foreach($data as $row){
		            $tb->insert($row);
	        	}
		    });
		} catch (\Exception $e) {
		    echo "Uh oh! Inserting didn't work, but I was able to rollback. {$e->getMessage()}";
		}
    }

	/**
	 * [drop description]
	 * @return [type] [description]
	 */
    public static function drop(){
    	$schema = Capsule::schema();
        return $schema->drop(self::table);
    }
}