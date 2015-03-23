<?php

class Posts extends \Phalcon\Mvc\Model
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
    public $thread_id;

    /**
     *
     * @var string
     */
    public $content;

    /**
     *
     * @var timestamp
     */
    public $created;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('thread_id', 'Threads', 'id', array('alias' => 'Threads'));
        $this->belongsTo('created_by', 'Users', 'id', array('alias' => 'Users'));
    }

}
