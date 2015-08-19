<?php

namespace Hyperion\PersonalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Portfolio
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hyperion\PersonalBundle\Entity\Repository\PortfolioRepository")
 * @Gedmo\Uploadable(allowOverwrite=true, filenameGenerator="SHA1")
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
     * @var \integer $projectYear
     *
     * @ORM\Column(type="integer")
     */
    private $projectYear;
    
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
    private $imgPath;

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
     * Get image path
     * 
     * @return string
     */
    function getImgPath() {
        return $this->imgPath;
    }

    /**
     * Set image path
     * 
     * @param string $imgPath
     * @return Banner
     */
    function setImgPath($imgPath) {
        $this->imgPath = $imgPath;
        
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
