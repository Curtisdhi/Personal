<?php

namespace Hyperion\PersonalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Portfolio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hyperion\PersonalBundle\Entity\Repository\PortfolioRepository")
 */
class Portfolio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Post
     *
     * @ORM\OneToOne(targetEntity="Post", cascade={"persist", "remove"})
     * @Assert\Valid()
    */
    private $post;
    
    /**
     * @var \DateTime $projectYear
     *
     * @ORM\Column(type="integer")
     */
    private $projectYear;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get project year
     * 
     * @return int
     */
    public function getProjectYear() {
        return $this->projectYear;
    }

    /**
     * Set project year
     * 
     * @param int $projectYear
     * @return Portfolio
     */
    public function setProjectYear($projectYear) {
        $this->projectYear = $projectYear;
        
        return $this;
    }

    
    /**
     * Set Post
     *
     * @param Post $post
     * @return Portfolio
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return string 
     */
    public function getPost()
    {
        return $this->post;
    }
    
    
}
