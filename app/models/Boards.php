<?php

class Boards extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var integer
     */
    public $thread_count;

    /**
     *
     * @var integer
     */
    public $posts_count;
}
