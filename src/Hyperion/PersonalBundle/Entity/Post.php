<?php

namespace Hyperion\PersonalBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hyperion\PersonalBundle\Entity\Repository\PostRepository")
 */
class Post {

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
     * @ORM\Column(name="title", type="string", length=30)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

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
     * @var string[]
     * 
     * @ORM\Column(type="simple_array", nullable=true)
     * @Assert\All({
     *  @Assert\NotBlank(message="Tags should not be blank."),
     *  @Assert\Length(
     *   min=3,
     *   max=20,
     *   minMessage = "Tags must be at least {{ limit }} characters long.",
     *   maxMessage = "Tags must be no longer than {{ limit }} characters."
     *  ),
     * @Assert\Regex(
     *   pattern="/^[A-Za-z][\w\-\s][A-Za-z0-9]+$/",
     *   message="Tags must start with a letter and can only 
      contain alphanumeric, underscore, and dash characters and can not end with an underscore."
     *  )
     * })
     * @Assert\NotNull(message="You need at least one tag!")
     */
    protected $tags;

    /**
     * @var string
     * 
     * @Gedmo\Slug(fields={"title"}, unique=true)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Post
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor() {
        return $this->author;
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

    /**
     * Set tags
     *
     * @param string $tags
     * @return Post
     */
    public function setTags($tags) {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set slug
     * 
     * @param string $slug
     * @return Post
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     * 
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

}
