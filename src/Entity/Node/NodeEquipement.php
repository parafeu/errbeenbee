<?php
/**
 * Created by PhpStorm.
 * User: digital
 * Date: 2019-03-12
 * Time: 08:54
 */

namespace App\Entity\Node;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="Equipement")
 */
class NodeEquipement
{
    /** @OGM\GraphId() */
    protected $id;

    /** @OGM\Property(type="int") */
    protected $equipementId;

    /** @OGM\Property(type="string") */
    protected $equipementName;

    /**
     * NodeEquipement constructor.
     * @param $equipementId
     * @param $equipementName
     */
    public function __construct($equipementId, $equipementName)
    {
        $this->equipementId = $equipementId;
        $this->equipementName = $equipementName;
    }


}