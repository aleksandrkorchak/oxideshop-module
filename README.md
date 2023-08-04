# oxideshop-module
adds the ability to buy goods in installments

1) Copy content to "modules" folder
2) Add module to composer repositories:
   "repositories": {
        "koralex/goods-on-credit": {
            "type": "path",
            "url": "./source/modules/koralex/goodsoncredit"
        }
    }
3) Update composer packages:
   composer update
4) Set the module configuration so that it appears in the admin panel:
   php bin/oe-console oe:module:install-configuration source/modules/koralex/goodsoncredit
5) Run migration for module:
   php vendor/bin/oe-eshop-db_migrate migrations:migrate klxgoodsoncredit
6) Update database views:
   php vendor/bin/oe-eshop-db_views_regenerate
