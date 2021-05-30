<?php
declare(strict_types=1);

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Product
 * @ORM\Entity()
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected int $id;

}