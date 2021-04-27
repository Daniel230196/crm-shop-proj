<?php
declare(strict_types=1);


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "leads")
 */
class Lead
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="integer")
     */
    protected $statusId;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="responsable_user", referencedColumnName="id")
     */
    protected $responsableUser;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    protected string $name;

    /**
     * @var int
     * @ORM\Column(name="cost", type="integer",options={"default": Lead::COST } )
     */
    protected int $cost;

    /**
     * Дефолтная сумма сделки
     */
    const COST = 0;


    public function __construct()
    {

    }
}