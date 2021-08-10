<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups('linkApiProducts')
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups('linkApiProducts')
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups('linkApiProducts')
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups('linkApiProducts')
     */
    private $moreDetails;

    /**
     * @ORM\Column(type="float")
     * @Groups('linkApiProducts')
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups('linkApiProducts')
     */
    private $isBestSeller = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("linkApiProducts")
     */
    private $isNewArrival = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("linkApiProducts")
     */
    private $isFeatured = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("linkApiProducts")
     */
    private $isSpecialOffer = false;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("linkApiProducts")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, inversedBy="products")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, mappedBy="product")
     * @Groups("linkApiProducts")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=RelatedProduct::class, mappedBy="product")
     * @Groups("linkApiProducts")
     */
    private $relatedProducts;

    /**
     * @ORM\OneToMany(targetEntity=Reviews::class, mappedBy="product")
     * @Groups("linkApiProducts")
     */
    private $reviews;

    /**
     * @ORM\Column(type="integer")
     * @Groups("linkApiProducts")
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("linkApiProducts")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->relatedProducts = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMoreDetails(): ?string
    {
        return $this->moreDetails;
    }

    public function setMoreDetails(?string $moreDetails): self
    {
        $this->moreDetails = $moreDetails;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIsBestSeller(): ?bool
    {
        return $this->isBestSeller;
    }

    public function setIsBestSeller(?bool $isBestSeller): self
    {
        $this->isBestSeller = $isBestSeller;

        return $this;
    }

    public function getIsNewArrival(): ?bool
    {
        return $this->isNewArrival;
    }

    public function setIsNewArrival(?bool $isNewArrival): self
    {
        $this->isNewArrival = $isNewArrival;

        return $this;
    }

    public function getIsFeatured(): ?bool
    {
        return $this->isFeatured;
    }

    public function setIsFeatured(?bool $isFeatured): self
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    public function getIsSpecialOffer(): ?bool
    {
        return $this->isSpecialOffer;
    }

    public function setIsSpecialOffer(?bool $isSpecialOffer): self
    {
        $this->isSpecialOffer = $isSpecialOffer;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addProduct($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection|RelatedProduct[]
     */
    public function getRelatedProducts(): Collection
    {
        return $this->relatedProducts;
    }

    public function addRelatedProduct(RelatedProduct $relatedProduct): self
    {
        if (!$this->relatedProducts->contains($relatedProduct)) {
            $this->relatedProducts[] = $relatedProduct;
            $relatedProduct->setProduct($this);
        }

        return $this;
    }

    public function removeRelatedProduct(RelatedProduct $relatedProduct): self
    {
        if ($this->relatedProducts->removeElement($relatedProduct)) {
            // set the owning side to null (unless already changed)
            if ($relatedProduct->getProduct() === $this) {
                $relatedProduct->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reviews[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Reviews $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setProduct($this);
        }

        return $this;
    }

    public function removeReview(Reviews $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getProduct() === $this) {
                $review->setProduct(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
