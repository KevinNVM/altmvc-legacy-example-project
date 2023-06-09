<?php

/**
 * Define the migration table configuration for the 'quotes' table.
 * 
 * This configuration array specifies the table name and the columns with their respective data types and constraints.
 * The migration table follows the SQLite rules for table creation.
 * 
 * Note:
 * - Char length is currently not supported.
 * - Columns cannot have whitespaces.
 * - Timestamps type is not supported.
 * 
 * @return array An array configuration for defining the 'quotes' migration table.
 */

return array(
    'name' => 'quotes',
    'columns' => array(
        'id' => array('INTEGER', 'PRIMARY KEY', 'NOT NULL'),
        'text' => array('STRING', 'NOT NULL'),
        'author' => array('STRING'),
        'created_at' => array('TEXT', 'NULLABLE'),
    )
);