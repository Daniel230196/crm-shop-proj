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
     * @
     */
    protected $responsableUser;

    public function __construct()
    {

    }
}