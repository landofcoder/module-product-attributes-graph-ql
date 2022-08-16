<?php
namespace Lof\ProductAttributesGraphQl\Model\Resolver\DataProvider;

use Magento\Catalog\Model\ProductRepository;

class Attributes
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(
        ProductRepository $productRepository,
    ){
        $this->productRepository = $productRepository;
    }

    /**
     * @param $sku
     * @return \Magento\Framework\Api\AttributeInterface[]|null
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBySku($sku)
    {
        if (!$sku) {
            return null;
        }
        $product = $this->productRepository->get($sku);
        $attributes = $product->getAttributes();
        $additionalAttributes = [];
        foreach ($attributes as $attribute) {
            if($attribute->getIsUserDefined() && $attribute->getIsVisibleOnFront()) {
                $data['id'] = $attribute->getId();
                $data['code'] = $attribute->getAttributeCode();
                $data['label'] = $attribute->getStoreLabel();
                $data['value'] = $product->getAttributeText($attribute->getAttributeCode());
                if (!in_array(null, $data, true) && !in_array(false, $data, true)) {
                    $additionalAttributes[] = $data;
                }
            }
        }
        return $additionalAttributes;
    }
}
