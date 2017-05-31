<?php

namespace Hyperion\PersonalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Portfolio
 *
 * @ORM\Table()
 * @ORM\Entity()
 * @Gedmo\Uploadable(allowOverwrite=true, filenameGenerator="SHA1")
 */
class Resume
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
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;
            
    /**
     * @var string
     * 
     * @ORM\Column(type="string", nullable=true)
     * @Gedmo\UploadableFileName
     */
    protected $filename;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Gedmo\UploadableFilePath 
     */
    private $resumePath;
    
    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

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
     * Get resume path
     * 
     * @return string
     */
    function getResumePath() {
        return $this->resumePath;
    }

    /**
     * Set resume path
     * 
     * @param string $resumePath
     * @return Banner
     */
    function setResumePath($resumePath) {
        $this->resumePath = $resumePath;
        
        return $this;
    }

    /**
     * Get file name
     * 
     * @return string
     */
    public function getFileName() {
        return $this->filename;
    }

    /**
     * Get web path
     * NOTE: had to hardcode the path.... need a better way
     * 
     * @return string
     */
    public function getWebPath() {
        return 'uploads/'. $this->getFilename();
    }
    
    
    function getPublished() {
        return $this->published;
    }

    function setPublished($published) {
        $this->published = $published;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }
}
