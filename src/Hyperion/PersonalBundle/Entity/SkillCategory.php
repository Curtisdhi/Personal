<?php

namespace Hyperion\PersonalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkillCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SkillCategory
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=25)
     */
    private $name;
    
    /**
     * @var Skill[]
     * 
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="category")
     */
    private $skills;
    
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
     * Set name
     *
     * @param string $name
     * @return SkillCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set skills
     *
     * @param Skill[] $skills
     * @return SkillCategory
     */
    public function setSkills($skills) {
        $this->skills = $skills;
    }
    
    /**
     * Get skills
     *
     * @return Skill[] 
     */
    public function getSkills()
    {
        return $this->skills;
    }
    
}