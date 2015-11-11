<?php
/**
 * Class to define the base acl-resource model functionality
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Class to define the base acl-resource model functionality
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Lib_Model_AclResource
extends Lib_Model
{
    
    /**
     * the table used to store data for the model
     *
     * @var string $_table
     */
    protected $_table = 'acl-resource';

/**
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| name        | varchar(255) | YES  | UNI | NULL    |                |
| description | varchar(255) | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
*/
    /**
     * the field definitions for the model
     *
     * @var array $_fields
     */    
    protected $_fields = array(
        'id'    => array(
            'type'      => 'int',
            'primary'   => true,
            'required'  => true,
        ),
        'name'  => array(
            'type'      => 'varchar',
            'label'     => 'Name',
            'required'  => true,
        ),
        'description'  => array(
            'type'      => 'varchar',
            'label'     => 'Description',
        ),
    );

} // END class Lib_Model_AppResource