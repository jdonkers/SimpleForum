<?php

class Threads extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $created_by;

    /**
     *
     * @var integer
     */
    public $board_id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @var integer
     */
    public $replies;

    /**
     *
     * @var timestamp
     */
    public $created;

    /**
     *
     * @var timestamp
     */
    public $updated;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Posts', 'thread_id', array('alias' => 'Posts'));
        $this->hasMany('id', 'Threads', 'board_id', array('alias' => 'Threads'));
        $this->belongsTo('board_id', 'Threads', 'id', array('alias' => 'Threads'));
        $this->belongsTo('created_by', 'Users', 'id', array('alias' => 'Users'));
    }

}
