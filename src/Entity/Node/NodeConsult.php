<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 2019-03-12
 * Time: 13:02
 */

namespace App\Entity\Node;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 *
 * @OGM\RelationshipEntity(type="CONSULTE")
 */
class NodeConsult
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var NodeVisitor
     *
     * @OGM\StartNode(targetEntity="NodeVisitor")
     */
    protected $visitor;

    /**
     * @var NodeHouse
     *
     * @OGM\EndNode(targetEntity="NodeHouse")
     */
    protected $house;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */

    protected $nbVisite;

    /**
     * NodeConsult constructor.
     * @param NodeVisitor $visitor
     * @param NodeHouse $house
     */
    public function __construct(NodeVisitor $visitor, NodeHouse $house)
    {
        $this->visitor = $visitor;
        $this->house = $house;
        $this->nbVisite = 0;
    }

    /**
     * @return NodeVisitor
     */
    public function getVisitor(): NodeVisitor
    {
        return $this->visitor;
    }

    /**
     * @param NodeVisitor $visitor
     */
    public function setVisitor(NodeVisitor $visitor): void
    {
        $this->visitor = $visitor;
    }

    /**
     * @return NodeHouse
     */
    public function getHouse(): NodeHouse
    {
        return $this->house;
    }

    /**
     * @param NodeHouse $house
     */
    public function setHouse(NodeHouse $house): void
    {
        $this->house = $house;
    }

    /**
     * @return int
     */
    public function getNbVisite(): int
    {
        return $this->nbVisite;
    }

    /**
     * @param int $nbVisite
     */
    public function setNbVisite(int $nbVisite): void
    {
        $this->nbVisite = $nbVisite;
    }



    public function incrementNbVisites(): void {
        $this->nbVisite++;
    }

}