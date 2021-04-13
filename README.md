

# zyan/page

简洁好用的php通用分页


## 要求

1. php >= 7.3
2. Composer

## 安装

```shell
composer require zyan/page -vvv
```
## 快速上手

```php
use Zyan\Page\Page;

$config = [
    'total_rows' => 1000, //总条数
    'url_rule' => '/list/?.html', //url规则 ? 代替分页数
    'now_page' => 50, //当前页
    'list_rows' => 10, //一页显示多少条
];

$page = Page($config);
```

## 输出html
```php
echo $page->show();
```

```html
<div class="zyan-page">
    <a href="/list/1.html">第一页</a>
    <a href="/list/49.html">上一页</a>
    <a href="/list/47.html">47</a>
    <a href="/list/48.html">48</a>
    <a href="/list/49.html">49</a>
    <a class='active'>50</a>
    <a href="/list/51.html">51</a>
    <a href="/list/52.html">52</a>
    <a href="/list/53.html">53</a>
    <a href="/list/51.html">下一页</a>
    <a href="/list/100.html">最后一页</a>
</div>
```

## 自定义名称

```php
$config = [
    'first_page_name' => '<<', //第一页
    'prev_page_name' => '<', //上一页
    'next_page_name' => '>', //下一页
    'last_page_name' => '>>', //最后一页
    //...
];

$page = Page($config);
```

## 参与贡献

1. fork 当前库到你的名下
2. 在你的本地修改完成审阅过后提交到你的仓库
3. 提交 PR 并描述你的修改，等待合并

## License

[MIT license](https://opensource.org/licenses/MIT)
