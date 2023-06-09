<?php

/**
 * Seeder file for populating the 'quotes' table with sample data.
 *
 * This seeder file returns an array configuration that specifies the table name and
 * an array of rows representing user data. 
 *
 * @return array An array configuration for populating the 'quotes' table with sample data.
 */


return array(
    'table' => 'quotes',
    'rows' => array(
        array(
            'text' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, omnis.',
            'author' => 'Kevin'
        )
    ),
);