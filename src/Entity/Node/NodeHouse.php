<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 2019-03-12
 * Time: 08:43
 */

namespace App\Entity\Node;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection;

/**
 * @OGM\Node(label="House")
 */
class NodeHouse
{

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $houseId;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $houseName;

    /**
     * @var NodeEquipement[]
     *
     * @OGM\Relationship(type="A_EQUIPEMENT", direction="OUTGOING", collection=true, mappedBy="house")
     */
    protected $equipements;

    /**
     * @var NodeConsult[]
     *
     * @OGM\Relationship(relationshipEntity="NodeConsult", type="CONSULTE", direction="INCOMING", collection=true, mappedBy="house")
     */
    protected $consults;

    /**
     * NodeHouse constructor.
     * @param $houseId
     * @param $houseName
     */
    public function __construct($houseId, $houseName)
    {
        $this->houseId = $houseId;
        $this->houseName = $houseName;
        $this->equipements = new Collection();
        $this->consults = new Collection();
    }

    /**
     * @return mixed
     */
    public function getHouseId()
    {
        return $this->houseId;
    }

    /**
     * @param mixed $houseId
     */
    public function setHouseId($houseId): void
    {
        $this->houseId = $houseId;
    }

    /**
     * @return mixed
     */
    public function getHouseName()
    {
        return $this->houseName;
    }

    /**
     * @param mixed $houseName
     */
    public function setHouseName($houseName): void
    {
        $this->houseName = $houseName;
    }

    /**
     * @return Collection
     */
    public function getEquipements(): Collection
    {
        return $this->equipements;
    }

    /**
     * @param Collection $equipements
     */
    public function setEquipements(Collection $equipements): void
    {
        $this->equipements = $equipements;
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

    public function getNbVisites(): int{
        $nbVisites = 0;
        foreach ($this->consults as $consult){
            $nbVisites += $consult->getNbVisite();
        }
        return $nbVisites;
    }
}