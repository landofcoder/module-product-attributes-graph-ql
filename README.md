# Magento 2 Module Lof_ProductAttributesGraphQl

``landofcoder/module-product-attributes-graphql``


## Main Functionalities
Magento 2 product attributes graphql extension

## Queries

1. Query get product attributes

* $sku : String - product sku

```
query {
    additionAttributeBySku(sku: $sku) {
        total_count
        items {
          id
          code
          label
          value
        }
    }
}
```

Example Response:

```
{
    "data": {
        "additionAttributeBySku": {
            "total_count": 9,
            "items": [
                {
                    "id": 93,
                    "code": "color",
                    "label": "Color",
                    "value": "Green"
                },
                {
                    "id": 152,
                    "code": "size",
                    "label": "Size",
                    "value": "M"
                },
                {
                    "id": 153,
                    "code": "material",
                    "label": "Material",
                    "value": "Leather"
                },
                {
                    "id": 180,
                    "code": "climate",
                    "label": "Climate",
                    "value": "Hot"
                },
                {
                    "id": 181,
                    "code": "new",
                    "label": "New",
                    "value": "Yes"
                },
                {
                    "id": 182,
                    "code": "pattern",
                    "label": "Pattern",
                    "value": "Color-Blocked"
                },
                {
                    "id": 184,
                    "code": "style_bottom",
                    "label": "Style Bottom",
                    "value": "Compression"
                },
                {
                    "id": 186,
                    "code": "collar",
                    "label": "Collar",
                    "value": "Blue"
                },
                {
                    "id": 187,
                    "code": "season",
                    "label": "Season",
                    "value": "Summer"
                }
            ]
        }
    }
}
```
