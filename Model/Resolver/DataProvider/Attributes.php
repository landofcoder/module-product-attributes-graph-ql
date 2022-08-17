<?php

namespace Lof\ProductAttributesGraphQl\Model\Resolver\DataProvider;

use Magento\Catalog\Model\Product\Attribute\Repository;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory;
use Magento\Framework\Api\AttributeInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Attributes
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var CollectionFactory
     */
    private $attributeFactory;

    /**
     * @var Repository
     */
    private $attributeRepository;

    /**
     * @param ProductRepository $productRepository
     * @param CollectionFactory $attributeFactory
     * @param Repository $attributeRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        CollectionFactory $attributeFactory,
        Repository $attributeRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->attributeFactory = $attributeFactory;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Get additional attributes by sku
     *
     * @param $sku
     * @return AttributeInterface[]|null
     * @throws NoSuchEntityException
     */
    public function getAdditionalAttributesBySku($sku)
    {
        if (!$sku) {
            return null;
        }
        $product = $this->productRepository->get($sku);
        $attributes = $product->getAttributes();
        $additionalAttributes = [];
        foreach ($attributes as $attribute) {
            if ($attribute->getIsUserDefined() && $attribute->getIsVisibleOnFront()) {
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

    /**
     * Get visible and filterable attributes and options
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getVisibleAttributes()
    {
        $attributeData = [];
        $attributeInfo = $this->attributeFactory->create();
        foreach ($attributeInfo as $items) {
            if ($items->getIsVisibleOnFront() && $items->getIsFilterable()) {
                $options = $this->attributeRepository->get($items->getAttributeCode())->getOptions();
                $optionData = [];
                foreach ($options as $option) {
                    if (!($option->getValue() == null) || !($option->getLabel() == " ")) {
                        $optionData[] = [
                            'label' => $option->getLabel(),
                            'value' => $option->getValue(),
                        ];
                    }
                }
                if (!empty($optionData)) {
                    $attributeData[] = [
                        'attribute_code' => $items->getAttributeCode(),
                        'attribute_label' => $items->getStoreLabel(),
                        'total_count' => count($optionData),
                        'options' => $optionData,
                    ];
                }
            }
        }
        return $attributeData;
    }
}
