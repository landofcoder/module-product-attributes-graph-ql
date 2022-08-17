<?php
namespace Lof\ProductAttributesGraphQl\Model\Resolver;

use Lof\ProductAttributesGraphQl\Model\Resolver\DataProvider\Attributes;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Catalog\Model\Product;

class VisibleAttributes implements ResolverInterface
{
    /**
     * @var Attributes
     */
    protected $attributeRepository;

    /**
     * @param Attributes $attributeRepository
     */
    public function __construct(
        Attributes $attributeRepository,
    ){
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $data = $this->attributeRepository->getVisibleAttributes();
        return [
            'total_count' => count($data),
            'items' => $data
        ];
    }
}
