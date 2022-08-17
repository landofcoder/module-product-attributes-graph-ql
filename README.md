# Magento 2 Module Lof_ProductAttributesGraphQl

``landofcoder/module-product-attributes-graphql``


## Main Functionalities
Magento 2 product attributes graphql extension

## Queries

1. Query get product attributes

* $sku : String - product sku

```
query {
    products(filter: {sku: $sku }) {
    items {
        sku
        additionalAttributes {
            total_count
            items {
                id
                code
                label
                value
                }
            }
        }
    total_count
    page_info {
      page_size
    }
  }
}
```

Example Response:

```
{
    "data": {
        "products": {
            "items": [
                {
                    "sku": "SKUE81588-Red",
                    "additionalAttributes": {
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
            ],
            "total_count": 1,
            "page_info": {
                "page_size": 20
            }
        }
    }
}
```

2. Query get all visible and fiterable product attributes and their options

```
query {
    getVisibleAttributes {
      total_count
      items {
          attribute_code
          attribute_label
          total_count
          options{
              label
              value
          }
      }
  }
}
``````

Example Response:

```
{
    "data": {
        "getVisibleAttributes": {
            "total_count": 3,
            "items": [
                {
                    "attribute_code": "new",
                    "attribute_label": "New",
                    "total_count": 2,
                    "options": [
                        {
                            "label": "Yes",
                            "value": "1"
                        },
                        {
                            "label": "No",
                            "value": "0"
                        }
                    ]
                },
                
                {
                    "attribute_code": "season",
                    "attribute_label": "Season",
                    "total_count": 4,
                    "options": [
                        {
                            "label": "Autumn",
                            "value": "253"
                        },
                        {
                            "label": "Spring",
                            "value": "254"
                        },
                        {
                            "label": "Summer",
                            "value": "251"
                        },
                        {
                            "label": "Winter",
                            "value": "252"
                        }
                    ]
                },
                {
                    "attribute_code": "sleeve",
                    "attribute_label": "Sleeve Length",
                    "total_count": 4,
                    "options": [
                        {
                            "label": "Half Sleeve",
                            "value": "233"
                        },
                        {
                            "label": "Long Sleeve",
                            "value": "234"
                        },
                        {
                            "label": "Short Sleeve",
                            "value": "231"
                        },
                        {
                            "label": "Sleeveless",
                            "value": "232"
                        }
                    ]
                }
            ]
        }
    }
}
```
