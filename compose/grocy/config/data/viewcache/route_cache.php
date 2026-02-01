<?php return array (
  0 => 
  array (
    'GET' => 
    array (
      '/' => 'route0',
      '/about' => 'route1',
      '/manifest' => 'route2',
      '/barcodescannertesting' => 'route3',
      '/login' => 'route4',
      '/logout' => 'route6',
      '/userfields' => 'route7',
      '/userentities' => 'route9',
      '/users' => 'route13',
      '/usersettings' => 'route16',
      '/products' => 'route18',
      '/quantityunits' => 'route20',
      '/productgroups' => 'route23',
      '/stockoverview' => 'route26',
      '/stockentries' => 'route27',
      '/purchase' => 'route28',
      '/consume' => 'route29',
      '/transfer' => 'route30',
      '/inventory' => 'route31',
      '/stocksettings' => 'route33',
      '/locations' => 'route34',
      '/stockjournal' => 'route36',
      '/locationcontentsheet' => 'route37',
      '/quantityunitpluraltesting' => 'route38',
      '/stockjournal/summary' => 'route39',
      '/quantityunitconversionsresolved' => 'route43',
      '/stockreports/spendings' => 'route44',
      '/shoppinglocations' => 'route45',
      '/shoppinglist' => 'route47',
      '/shoppinglistsettings' => 'route50',
      '/recipes' => 'route51',
      '/recipessettings' => 'route54',
      '/mealplan' => 'route56',
      '/mealplansections' => 'route57',
      '/choresoverview' => 'route59',
      '/choretracking' => 'route60',
      '/choresjournal' => 'route61',
      '/chores' => 'route62',
      '/choressettings' => 'route64',
      '/batteriesoverview' => 'route66',
      '/batterytracking' => 'route67',
      '/batteriesjournal' => 'route68',
      '/batteries' => 'route69',
      '/batteriessettings' => 'route71',
      '/tasks' => 'route73',
      '/taskcategories' => 'route75',
      '/taskssettings' => 'route77',
      '/equipment' => 'route78',
      '/calendar' => 'route80',
      '/api' => 'route81',
      '/manageapikeys' => 'route82',
      '/manageapikeys/new' => 'route83',
      '/api/openapi/specification' => 'route84',
      '/api/system/info' => 'route85',
      '/api/system/time' => 'route86',
      '/api/system/db-changed-time' => 'route87',
      '/api/system/config' => 'route88',
      '/api/system/localization-strings' => 'route90',
      '/api/users' => 'route101',
      '/api/user' => 'route108',
      '/api/user/settings' => 'route109',
      '/api/stock' => 'route113',
      '/api/stock/volatile' => 'route116',
      '/api/recipes/fulfillment' => 'route150',
      '/api/chores' => 'route153',
      '/api/print/shoppinglist/thermal' => 'route160',
      '/api/batteries' => 'route161',
      '/api/tasks' => 'route166',
      '/api/calendar/ical' => 'route169',
      '/api/calendar/ical/sharing-link' => 'route170',
    ),
    'POST' => 
    array (
      '/login' => 'route5',
      '/api/system/log-missing-localization' => 'route89',
      '/api/users' => 'route102',
      '/api/stock/shoppinglist/add-missing-products' => 'route141',
      '/api/stock/shoppinglist/add-overdue-products' => 'route142',
      '/api/stock/shoppinglist/add-expired-products' => 'route143',
      '/api/stock/shoppinglist/clear' => 'route144',
      '/api/stock/shoppinglist/add-product' => 'route145',
      '/api/stock/shoppinglist/remove-product' => 'route146',
      '/api/chores/executions/calculate-next-assignments' => 'route157',
    ),
  ),
  1 => 
  array (
    'GET' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/userfield/([^/]+)|/userentity/([^/]+)()|/userobjects/([^/]+)()()|/userobject/([^/]+)/([^/]+)()()|/user/([^/]+)()()()()|/user/([^/]+)/permissions()()()()()|/files/([^/]+)/([^/]+)()()()()()|/product/([^/]+)()()()()()()()|/quantityunit/([^/]+)()()()()()()()()|/quantityunitconversion/([^/]+)()()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route8',
            1 => 
            array (
              'userfieldId' => 'userfieldId',
            ),
          ),
          3 => 
          array (
            0 => 'route10',
            1 => 
            array (
              'userentityId' => 'userentityId',
            ),
          ),
          4 => 
          array (
            0 => 'route11',
            1 => 
            array (
              'userentityName' => 'userentityName',
            ),
          ),
          5 => 
          array (
            0 => 'route12',
            1 => 
            array (
              'userentityName' => 'userentityName',
              'userobjectId' => 'userobjectId',
            ),
          ),
          6 => 
          array (
            0 => 'route14',
            1 => 
            array (
              'userId' => 'userId',
            ),
          ),
          7 => 
          array (
            0 => 'route15',
            1 => 
            array (
              'userId' => 'userId',
            ),
          ),
          8 => 
          array (
            0 => 'route17',
            1 => 
            array (
              'group' => 'group',
              'fileName' => 'fileName',
            ),
          ),
          9 => 
          array (
            0 => 'route19',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          10 => 
          array (
            0 => 'route21',
            1 => 
            array (
              'quantityunitId' => 'quantityunitId',
            ),
          ),
          11 => 
          array (
            0 => 'route22',
            1 => 
            array (
              'quConversionId' => 'quConversionId',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'regex' => '~^(?|/productgroup/([^/]+)|/product/([^/]+)/grocycode()|/stockentry/([^/]+)()()|/location/([^/]+)()()()|/productbarcodes/([^/]+)()()()()|/stockentry/([^/]+)/grocycode()()()()()|/stockentry/([^/]+)/label()()()()()()|/shoppinglocation/([^/]+)()()()()()()()|/shoppinglistitem/([^/]+)()()()()()()()()|/shoppinglist/([^/]+)()()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route24',
            1 => 
            array (
              'productGroupId' => 'productGroupId',
            ),
          ),
          3 => 
          array (
            0 => 'route25',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          4 => 
          array (
            0 => 'route32',
            1 => 
            array (
              'entryId' => 'entryId',
            ),
          ),
          5 => 
          array (
            0 => 'route35',
            1 => 
            array (
              'locationId' => 'locationId',
            ),
          ),
          6 => 
          array (
            0 => 'route40',
            1 => 
            array (
              'productBarcodeId' => 'productBarcodeId',
            ),
          ),
          7 => 
          array (
            0 => 'route41',
            1 => 
            array (
              'entryId' => 'entryId',
            ),
          ),
          8 => 
          array (
            0 => 'route42',
            1 => 
            array (
              'entryId' => 'entryId',
            ),
          ),
          9 => 
          array (
            0 => 'route46',
            1 => 
            array (
              'shoppingLocationId' => 'shoppingLocationId',
            ),
          ),
          10 => 
          array (
            0 => 'route48',
            1 => 
            array (
              'itemId' => 'itemId',
            ),
          ),
          11 => 
          array (
            0 => 'route49',
            1 => 
            array (
              'listId' => 'listId',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'regex' => '~^(?|/recipe/([^/]+)|/recipe/([^/]+)/pos/([^/]+)|/recipe/([^/]+)/grocycode()()|/mealplansection/([^/]+)()()()|/chore/([^/]+)()()()()|/chore/([^/]+)/grocycode()()()()()|/battery/([^/]+)()()()()()()|/battery/([^/]+)/grocycode()()()()()()()|/task/([^/]+)()()()()()()()()|/taskcategory/([^/]+)()()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route52',
            1 => 
            array (
              'recipeId' => 'recipeId',
            ),
          ),
          3 => 
          array (
            0 => 'route53',
            1 => 
            array (
              'recipeId' => 'recipeId',
              'recipePosId' => 'recipePosId',
            ),
          ),
          4 => 
          array (
            0 => 'route55',
            1 => 
            array (
              'recipeId' => 'recipeId',
            ),
          ),
          5 => 
          array (
            0 => 'route58',
            1 => 
            array (
              'sectionId' => 'sectionId',
            ),
          ),
          6 => 
          array (
            0 => 'route63',
            1 => 
            array (
              'choreId' => 'choreId',
            ),
          ),
          7 => 
          array (
            0 => 'route65',
            1 => 
            array (
              'choreId' => 'choreId',
            ),
          ),
          8 => 
          array (
            0 => 'route70',
            1 => 
            array (
              'batteryId' => 'batteryId',
            ),
          ),
          9 => 
          array (
            0 => 'route72',
            1 => 
            array (
              'batteryId' => 'batteryId',
            ),
          ),
          10 => 
          array (
            0 => 'route74',
            1 => 
            array (
              'taskId' => 'taskId',
            ),
          ),
          11 => 
          array (
            0 => 'route76',
            1 => 
            array (
              'categoryId' => 'categoryId',
            ),
          ),
        ),
      ),
      3 => 
      array (
        'regex' => '~^(?|/equipment/([^/]+)|/api/objects/([^/]+)()|/api/objects/([^/]+)/([^/]+)()|/api/userfields/([^/]+)/([^/]+)()()|/api/files/([^/]+)/([^/]+)()()()|/api/users/([^/]+)/permissions()()()()()|/api/user/settings/([^/]+)()()()()()()|/api/stock/entry/([^/]+)()()()()()()()|/api/stock/products/([^/]+)()()()()()()()()|/api/stock/products/([^/]+)/entries()()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route79',
            1 => 
            array (
              'equipmentId' => 'equipmentId',
            ),
          ),
          3 => 
          array (
            0 => 'route91',
            1 => 
            array (
              'entity' => 'entity',
            ),
          ),
          4 => 
          array (
            0 => 'route92',
            1 => 
            array (
              'entity' => 'entity',
              'objectId' => 'objectId',
            ),
          ),
          5 => 
          array (
            0 => 'route96',
            1 => 
            array (
              'entity' => 'entity',
              'objectId' => 'objectId',
            ),
          ),
          6 => 
          array (
            0 => 'route99',
            1 => 
            array (
              'group' => 'group',
              'fileName' => 'fileName',
            ),
          ),
          7 => 
          array (
            0 => 'route105',
            1 => 
            array (
              'userId' => 'userId',
            ),
          ),
          8 => 
          array (
            0 => 'route110',
            1 => 
            array (
              'settingKey' => 'settingKey',
            ),
          ),
          9 => 
          array (
            0 => 'route114',
            1 => 
            array (
              'entryId' => 'entryId',
            ),
          ),
          10 => 
          array (
            0 => 'route117',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          11 => 
          array (
            0 => 'route118',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
        ),
      ),
      4 => 
      array (
        'regex' => '~^(?|/api/stock/products/([^/]+)/locations|/api/stock/products/([^/]+)/price\\-history()|/api/stock/products/by\\-barcode/([^/]+)()()|/api/stock/locations/([^/]+)/entries()()()|/api/stock/bookings/([^/]+)()()()()|/api/stock/transactions/([^/]+)()()()()()|/api/stock/barcodes/external\\-lookup/([^/]+)()()()()()()|/api/stock/products/([^/]+)/printlabel()()()()()()()|/api/stock/entry/([^/]+)/printlabel()()()()()()()()|/api/recipes/([^/]+)/fulfillment()()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route119',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          3 => 
          array (
            0 => 'route120',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          4 => 
          array (
            0 => 'route127',
            1 => 
            array (
              'barcode' => 'barcode',
            ),
          ),
          5 => 
          array (
            0 => 'route133',
            1 => 
            array (
              'locationId' => 'locationId',
            ),
          ),
          6 => 
          array (
            0 => 'route134',
            1 => 
            array (
              'bookingId' => 'bookingId',
            ),
          ),
          7 => 
          array (
            0 => 'route136',
            1 => 
            array (
              'transactionId' => 'transactionId',
            ),
          ),
          8 => 
          array (
            0 => 'route138',
            1 => 
            array (
              'barcode' => 'barcode',
            ),
          ),
          9 => 
          array (
            0 => 'route139',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          10 => 
          array (
            0 => 'route140',
            1 => 
            array (
              'entryId' => 'entryId',
            ),
          ),
          11 => 
          array (
            0 => 'route148',
            1 => 
            array (
              'recipeId' => 'recipeId',
            ),
          ),
        ),
      ),
      5 => 
      array (
        'regex' => '~^(?|/api/recipes/([^/]+)/printlabel|/api/chores/([^/]+)()|/api/chores/([^/]+)/printlabel()()|/api/batteries/([^/]+)()()()|/api/batteries/([^/]+)/printlabel()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route152',
            1 => 
            array (
              'recipeId' => 'recipeId',
            ),
          ),
          3 => 
          array (
            0 => 'route154',
            1 => 
            array (
              'choreId' => 'choreId',
            ),
          ),
          4 => 
          array (
            0 => 'route158',
            1 => 
            array (
              'choreId' => 'choreId',
            ),
          ),
          5 => 
          array (
            0 => 'route162',
            1 => 
            array (
              'batteryId' => 'batteryId',
            ),
          ),
          6 => 
          array (
            0 => 'route165',
            1 => 
            array (
              'batteryId' => 'batteryId',
            ),
          ),
        ),
      ),
    ),
    'POST' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/api/objects/([^/]+)|/api/users/([^/]+)/permissions()|/api/stock/products/([^/]+)/add()()|/api/stock/products/([^/]+)/consume()()()|/api/stock/products/([^/]+)/transfer()()()()|/api/stock/products/([^/]+)/inventory()()()()()|/api/stock/products/([^/]+)/open()()()()()()|/api/stock/products/([^/]+)/merge/([^/]+)()()()()()()|/api/stock/products/by\\-barcode/([^/]+)/add()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route93',
            1 => 
            array (
              'entity' => 'entity',
            ),
          ),
          3 => 
          array (
            0 => 'route106',
            1 => 
            array (
              'userId' => 'userId',
            ),
          ),
          4 => 
          array (
            0 => 'route121',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          5 => 
          array (
            0 => 'route122',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          6 => 
          array (
            0 => 'route123',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          7 => 
          array (
            0 => 'route124',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          8 => 
          array (
            0 => 'route125',
            1 => 
            array (
              'productId' => 'productId',
            ),
          ),
          9 => 
          array (
            0 => 'route126',
            1 => 
            array (
              'productIdToKeep' => 'productIdToKeep',
              'productIdToRemove' => 'productIdToRemove',
            ),
          ),
          10 => 
          array (
            0 => 'route128',
            1 => 
            array (
              'barcode' => 'barcode',
            ),
          ),
        ),
      ),
      1 => 
      array (
        'regex' => '~^(?|/api/stock/products/by\\-barcode/([^/]+)/consume|/api/stock/products/by\\-barcode/([^/]+)/transfer()|/api/stock/products/by\\-barcode/([^/]+)/inventory()()|/api/stock/products/by\\-barcode/([^/]+)/open()()()|/api/stock/bookings/([^/]+)/undo()()()()|/api/stock/transactions/([^/]+)/undo()()()()()|/api/recipes/([^/]+)/add\\-not\\-fulfilled\\-products\\-to\\-shoppinglist()()()()()()|/api/recipes/([^/]+)/consume()()()()()()()|/api/recipes/([^/]+)/copy()()()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route129',
            1 => 
            array (
              'barcode' => 'barcode',
            ),
          ),
          3 => 
          array (
            0 => 'route130',
            1 => 
            array (
              'barcode' => 'barcode',
            ),
          ),
          4 => 
          array (
            0 => 'route131',
            1 => 
            array (
              'barcode' => 'barcode',
            ),
          ),
          5 => 
          array (
            0 => 'route132',
            1 => 
            array (
              'barcode' => 'barcode',
            ),
          ),
          6 => 
          array (
            0 => 'route135',
            1 => 
            array (
              'bookingId' => 'bookingId',
            ),
          ),
          7 => 
          array (
            0 => 'route137',
            1 => 
            array (
              'transactionId' => 'transactionId',
            ),
          ),
          8 => 
          array (
            0 => 'route147',
            1 => 
            array (
              'recipeId' => 'recipeId',
            ),
          ),
          9 => 
          array (
            0 => 'route149',
            1 => 
            array (
              'recipeId' => 'recipeId',
            ),
          ),
          10 => 
          array (
            0 => 'route151',
            1 => 
            array (
              'recipeId' => 'recipeId',
            ),
          ),
        ),
      ),
      2 => 
      array (
        'regex' => '~^(?|/api/chores/([^/]+)/execute|/api/chores/executions/([^/]+)/undo()|/api/chores/([^/]+)/merge/([^/]+)()|/api/batteries/([^/]+)/charge()()()|/api/batteries/charge\\-cycles/([^/]+)/undo()()()()|/api/tasks/([^/]+)/complete()()()()()|/api/tasks/([^/]+)/undo()()()()()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route155',
            1 => 
            array (
              'choreId' => 'choreId',
            ),
          ),
          3 => 
          array (
            0 => 'route156',
            1 => 
            array (
              'executionId' => 'executionId',
            ),
          ),
          4 => 
          array (
            0 => 'route159',
            1 => 
            array (
              'choreIdToKeep' => 'choreIdToKeep',
              'choreIdToRemove' => 'choreIdToRemove',
            ),
          ),
          5 => 
          array (
            0 => 'route163',
            1 => 
            array (
              'batteryId' => 'batteryId',
            ),
          ),
          6 => 
          array (
            0 => 'route164',
            1 => 
            array (
              'chargeCycleId' => 'chargeCycleId',
            ),
          ),
          7 => 
          array (
            0 => 'route167',
            1 => 
            array (
              'taskId' => 'taskId',
            ),
          ),
          8 => 
          array (
            0 => 'route168',
            1 => 
            array (
              'taskId' => 'taskId',
            ),
          ),
        ),
      ),
    ),
    'PUT' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/api/objects/([^/]+)/([^/]+)|/api/userfields/([^/]+)/([^/]+)()|/api/files/([^/]+)/([^/]+)()()|/api/users/([^/]+)()()()()|/api/users/([^/]+)/permissions()()()()()|/api/user/settings/([^/]+)()()()()()()|/api/stock/entry/([^/]+)()()()()()()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route94',
            1 => 
            array (
              'entity' => 'entity',
              'objectId' => 'objectId',
            ),
          ),
          4 => 
          array (
            0 => 'route97',
            1 => 
            array (
              'entity' => 'entity',
              'objectId' => 'objectId',
            ),
          ),
          5 => 
          array (
            0 => 'route98',
            1 => 
            array (
              'group' => 'group',
              'fileName' => 'fileName',
            ),
          ),
          6 => 
          array (
            0 => 'route103',
            1 => 
            array (
              'userId' => 'userId',
            ),
          ),
          7 => 
          array (
            0 => 'route107',
            1 => 
            array (
              'userId' => 'userId',
            ),
          ),
          8 => 
          array (
            0 => 'route111',
            1 => 
            array (
              'settingKey' => 'settingKey',
            ),
          ),
          9 => 
          array (
            0 => 'route115',
            1 => 
            array (
              'entryId' => 'entryId',
            ),
          ),
        ),
      ),
    ),
    'DELETE' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/api/objects/([^/]+)/([^/]+)|/api/files/([^/]+)/([^/]+)()|/api/users/([^/]+)()()()|/api/user/settings/([^/]+)()()()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'route95',
            1 => 
            array (
              'entity' => 'entity',
              'objectId' => 'objectId',
            ),
          ),
          4 => 
          array (
            0 => 'route100',
            1 => 
            array (
              'group' => 'group',
              'fileName' => 'fileName',
            ),
          ),
          5 => 
          array (
            0 => 'route104',
            1 => 
            array (
              'userId' => 'userId',
            ),
          ),
          6 => 
          array (
            0 => 'route112',
            1 => 
            array (
              'settingKey' => 'settingKey',
            ),
          ),
        ),
      ),
    ),
    'OPTIONS' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/api/(.+))$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route171',
            1 => 
            array (
              'routes' => 'routes',
            ),
          ),
        ),
      ),
    ),
  ),
);