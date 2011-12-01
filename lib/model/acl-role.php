<?php
/**
 * Defines the base acl-role model functionality
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Defines the base acl-role model functionality
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Lib_Model_AclRole
extends Lib_Model
{ 
    /**
     * the table used to store data for the model
     *
     * @var string $_table
     */
    protected $_table = 'acl-role';

    /**
     * Property to store the role that owns this role
     *
     * @var Lib_Model_Role
     */
    public $parent;

    /**
     * Property to store the resources associated with this role
     * 
     * @var Lib_Model_AclResource $resources
     */
    public $resources;

/**
+----------------+--------------+------+-----+---------+----------------+
| Field          | Type         | Null | Key | Default | Extra          |
+----------------+--------------+------+-----+---------+----------------+
| id             | int(11)      | NO   | PRI | NULL    | auto_increment |
| name           | varchar(32)  | YES  | UNI | NULL    |                |
| description    | varchar(255) | YES  |     | NULL    |                |
| role_parent_id | int(11)      | NO   |     | NULL    |                |
+----------------+--------------+------+-----+---------+----------------+
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
        'role_parent_id'    => array(
            'type'      => 'int',
            'label'     => 'Role Parent',
            'required'      => false,
            'reference'     => array(
                'model'         => 'Lib_Model_AclRole',
                'foreign_key'   => 'id',
                'property'      => 'parent',
            ),
        ),
    );

    /**
     * the collection definitions for the model
     *
     * @var array $_collections
     */
    protected $_collections = array(
        'resources' => array(
            'property'      => 'resources',
            'type'          => 'many-to-many',
            'model'         => 'Lib_Model_AclResource',
            'reference'     => array(
                'model'         => 'Lib_Model_AclRoleResource',
                'local_key'     => 'id',
                'remote_key'    => 'acl_role_id',
                'foreign_key'   => 'acl_resource_id',
            )
        ),
    );

} // END class Lib_Model_AclRole