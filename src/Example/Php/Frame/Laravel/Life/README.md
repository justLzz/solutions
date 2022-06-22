### laravel生命周期
```$xslt

// 定义了laravel一个请求的开始时间
define('LARAVEL_START', microtime(true));

// composer自动加载机制
require __DIR__.'/../vendor/autoload.php';

// 这句话你就可以理解laravel,在最开始引入了一个ioc容器。
$app = require_once __DIR__.'/../bootstrap/app.php';

// 打开__DIR__.'/../bootstrap/app.php';你会发现这段代码，绑定了Illuminate\Contracts\Http\Kernel::class，
// 这个你可以理解成之前我们所说的$ioc->bind();方法。
// $app->singleton(
//     Illuminate\Contracts\Http\Kernel::class,
//    App\Http\Kernel::class
// );

// 这个相当于我们创建了Kernel::class的服务提供者
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// 获取一个 Request ，返回一个 Response。以把该内核想象作一个代表整个应用的大黑盒子，输入 HTTP 请求，返回 HTTP 响应。
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// 就是把我们服务器的结果返回给浏览器。
$response->send(); 

// 这个就是执行我们比较耗时的请求，
$kernel->terminate($request, $response);
```