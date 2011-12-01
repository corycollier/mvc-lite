<?php
/**
 * Class to contain the logic to connect acl-roles to acl-resources
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Class to contain the logic to connect acl-roles to acl-resources
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Lib_Model_AclRoleResource
extends Lib_Model
{
    /**
     * the table used to store data for the model
     *
     * @var string $_table
     */
    protected $_table = 'acl-role';

    /**
     * The role instance that this instance references
     *
     * @var Lib_Model_AclRole $role
     */
    public $role;

    /**
     * The resource instance that this instance references
     *
     * @var Lib_Model_AclResource $resource
     */
    public $resource;

/**
+-----------------+---------------+------+-----+---------+-------+
| Field           | Type          | Null | Key | Default | Extra |
+-----------------+---------------+------+-----+---------+-------+
| id              | int(11)       | NO   | PRI | NULL    |       |
| acl_role_id     | int(11)       | NO   | MUL | NULL    |       |
| acl_resource_id | int(11)       | NO   |     | NULL    |       |
| writable        | enum('t','f') | YES  |     | f       |       |
| readable        | enum('t','f') | YES  |     | f       |       |
+-----------------+---------------+------+-----+---------+-------+
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
        'acl_role_id'  => array(
            'type'      => 'varchar',
            'label'     => 'Acl Role',
            'required'  => true,
            'reference'     => array(
                'model'         => 'Lib_Model_AclRole',
                'foreign_key'   => 'id',
                'property'      => 'role',
            ),
        ),
        'acl_resource_id'  => array(
            'type'      => 'varchar',
            'label'     => 'Acl Resource',
            'required'  => true,
            'reference'     => array(
                'model'         => 'Lib_Model_AclResource',
                'foreign_key'   => 'id',
                'property'      => 'resource',
            ),
        ),
        'writable'  => array(
            'type'      => 'enum',
            'label'     => 'Writable',
            'options'   => array('t','f'),
        ),
        'readable'  => array(
            'type'      => 'enum',
            'label'     => 'Readable',
            'options'   => array('t','f'),
        ),
    );

} // END class Lib_Model_AclRoleResource