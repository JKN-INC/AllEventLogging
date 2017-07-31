<?php

include_once('./Services/ActiveRecord/class.ActiveRecord.php');

/**
 * Class ilAllEventLogging
 *
 * @author  JKN Inc. <itstaff@jkninc.com>
 * @version 1.0.0
 */

class ilAllEventLoggingModel extends ActiveRecord {

    const TABLE_NAME = 'evt_evthk_log';
    const DATE_FORMAT = 'Y-m-d H:i:s';
    const EXCEPTIONS = true;
    const TRACE = false;

    static function returnDbTableName() {
        return self::TABLE_NAME;
    }

    /**
     * @var int
     *
     * @con_is_primary true
     * @con_is_unique  true
     * @con_sequence   true
     * @con_has_field  true
     * @con_fieldtype  integer
     * @con_length     8
     */
    protected $id = 0;

    /**
     * @var string
     *
     * @con_has_field  true
     * @con_fieldtype  text
     * @con_length     256
     */
    protected $event = '';

    /**
     * @var string
     *
     * @con_has_field  true
     * @con_fieldtype  text
     * @con_length     256
     */
    protected $component = '';

    /**
     * @var string
     *
     * @con_has_field  true
     * @con_fieldtype  text
     * @con_length     256
     */
    protected $parameters = '';

    /**
     * @var int
     *
     * @con_has_field  true
     * @con_fieldtype  integer
     * @con_length     8
     */
    protected $obj_id = NULL;


    /**
     * @var int
     *
     * @con_has_field  true
     * @con_fieldtype  integer
     * @con_length     8
     */
    protected $usr_id = NULL;

    /**
     * @var int
     *
     * @con_has_field  true
     * @con_fieldtype  integer
     * @con_length     8
     */
    protected $owner = 6;

    /**
     * @var int
     *
     * @db_has_field        true
     * @db_fieldtype        timestamp
     * @db_is_notnull       true
     */
    protected $create_date;

    public function create() {
        global $ilUser;
        $this->setOwner($ilUser->getId());
        $this->setCreateDate(date("Y-m-d H:i:s"));
        parent::create();
    }

    /**
     * @param $component
     * @param bool|false $as_array
     * @return mixed
     */
    public static function _getAllEventsForComponent($component, $as_array = false)
    {
        $result = self::where(array( 'component'=> $component ));
        return ($as_array)?$result->getArray():$result->get();
    }

    /**
     * @param $id
     * @param bool|false $as_array
     */
    public static function _getEventById($id, $as_array = false)
    {
        $result = self::where(array( 'id'=> $id ));
        return ($as_array)?$result->getArray():$result->get();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return string
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @param string $component
     */
    public function setComponent($component)
    {
        $this->component = $component;
    }

    /**
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param string $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return int
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param int $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return int
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param int $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }

    /**
     * @return int
     */
    public function getObjId()
    {
        return $this->obj_id;
    }

    /**
     * @param int $obj_id
     */
    public function setObjId($obj_id)
    {
        $this->obj_id = $obj_id;
    }

    /**
     * @return int
     */
    public function getUsrId()
    {
        return $this->usr_id;
    }

    /**
     * @param int $usr_id
     */
    public function setUsrId($usr_id)
    {
        $this->usr_id = $usr_id;
    }

}

?>