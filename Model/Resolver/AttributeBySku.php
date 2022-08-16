<?php
namespace Lof\ProductAttributesGraphQl\Model\Resolver;

use Lof\ProductAttributesGraphQl\Model\Resolver\DataProvider\Attributes;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class AttributeBySku implements ResolverInterface
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
        if (!isset($args['sku']) || (isset($args['sku']) && !$args['sku'])) {
            throw new GraphQlInputException(__('sku is required.'));
        }

        $data = $this->attributeRepository->getBySku($args['sku']);
        return [
            'total_count' => count($data),
            'items' => $data
        ];
    }
}
