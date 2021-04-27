<?php
declare(strict_types=1);


use Core\Exceptions\DataException;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $login;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected string $password;

    /**
     *
     */
    protected Category $category;

    /**
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     */
    protected DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=false)
     */
    protected DateTime $updatedAt;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $date): void
    {
        $this->createdAt = $date;
    }

    /**
     * @param DateTime $date
     */
    public function setUpdatedAt(DateTime $date): void
    {
        $this->updatedAt = $date;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function confirmPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    /**
     * @param string $password
     * @throws DataException;
     */
    public function setPassword(string $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if(false === $hash){
            throw new DataException();
        }

        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     *
     */
    public function updatedTimestamps(): void
    {
        $date = new DateTime('now');

        if(is_null($this->getCreatedAt())){
            $this->setCreatedAt($date);
        }

        $this->setUpdatedAt($date);
    }


}