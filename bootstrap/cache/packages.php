<?php return array (
  'beyondcode/laravel-self-diagnosis' => 
  array (
    'providers' => 
    array (
      0 => 'BeyondCode\\SelfDiagnosis\\SelfDiagnosisServiceProvider',
    ),
  ),
  'dingo/api' => 
  array (
    'providers' => 
    array (
      0 => 'Dingo\\Api\\Provider\\LaravelServiceProvider',
    ),
    'aliases' => 
    array (
      'API' => 'Dingo\\Api\\Facade\\API',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'iidestiny/laravel-filesystem-oss' => 
  array (
    'providers' => 
    array (
      0 => 'Iidestiny\\LaravelFilesystemOss\\OssStorageServiceProvider',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'jenssegers/agent' => 
  array (
    'providers' => 
    array (
      0 => 'Jenssegers\\Agent\\AgentServiceProvider',
    ),
    'aliases' => 
    array (
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'liyu/dingo-serializer-switch' => 
  array (
    'providers' => 
    array (
      0 => 'Liyu\\Dingo\\ServiceProvider',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
  ),
  'medz/cors' => 
  array (
    'providers' => 
    array (
      0 => 'Medz\\Cors\\Laravel\\Providers\\LaravelServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'overtrue/laravel-query-logger' => 
  array (
    'providers' => 
    array (
      0 => 'Overtrue\\LaravelQueryLogger\\ServiceProvider',
    ),
  ),
  'propaganistas/laravel-phone' => 
  array (
    'providers' => 
    array (
      0 => 'Propaganistas\\LaravelPhone\\PhoneServiceProvider',
    ),
  ),
  'rap2hpoutre/laravel-log-viewer' => 
  array (
    'providers' => 
    array (
      0 => 'Rap2hpoutre\\LaravelLogViewer\\LaravelLogViewerServiceProvider',
    ),
  ),
  'torann/geoip' => 
  array (
    'providers' => 
    array (
      0 => 'Torann\\GeoIP\\GeoIPServiceProvider',
    ),
    'aliases' => 
    array (
      'GeoIP' => 'Torann\\GeoIP\\Facades\\GeoIP',
    ),
  ),
  'tucker-eric/eloquentfilter' => 
  array (
    'providers' => 
    array (
      0 => 'EloquentFilter\\ServiceProvider',
    ),
  ),
  'tymon/jwt-auth' => 
  array (
    'aliases' => 
    array (
      'JWTAuth' => 'Tymon\\JWTAuth\\Facades\\JWTAuth',
      'JWTFactory' => 'Tymon\\JWTAuth\\Facades\\JWTFactory',
    ),
    'providers' => 
    array (
      0 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
    ),
  ),
);