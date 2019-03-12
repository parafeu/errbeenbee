<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 2019-03-11
 * Time: 14:44
 */

namespace App\Entity\Node;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection;

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
     * @var NodeConsult[]
     *
     * @OGM\Relationship(relationshipEntity="NodeConsult", type="CONSULTE", direction="OUTGOING", collection=true, mappedBy="visitor")
     */
    protected $consults;

    /**
     * NodeVisitor constructor.
     * @param $id
     * @param $sessionId
     */
    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
        $this->consults = new Collection();
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

    /**
     * @return NodeConsult[]
     */
    public function getConsults()
    {
        return $this->consults;
    }

    /**
     * @param NodeConsult[] $consults
     */
    public function setConsults($consults): void
    {
        $this->consults = $consults;
    }

}