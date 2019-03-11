<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 2019-03-11
 * Time: 14:44
 */

namespace App\Entity\Node;

use GraphAware\Neo4j\OGM\Annotations as OGM;


/**
 * @OGM\Node(label="Visitor")
 */
class NodeVisitor
{
    /** @OGM\GraphId() */
    protected $id;

    /** @OGM\Property(type="string") */
    protected $sessionId;

    /**
     * NodeVisitor constructor.
     * @param $id
     * @param $sessionId
     */
    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId): void
    {
        $this->sessionId = $sessionId;
    }



}