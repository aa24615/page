<?php

/*
 * This file is part of the zyan/page.
 *
 * (c) 读心印 <aa24615@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zyan\Tests;

use PHPUnit\Framework\TestCase;
use Zyan\Page\Page;

/**
 * Class PageTest.
 *
 * @package Zyan\Tests
 *
 * @author 读心印 <aa24615@qq.com>
 */
class PageTest extends TestCase
{
    public function testPage()
    {
        $params = array(
            'total_rows' => 1000,
            'url_rule' => '/list/?.html',
            'now_page' => 50,
            'list_rows' => 10,
        );

        $page = new Page($params);


        echo $page->show();

        $this->assertTrue(true);
    }

    public function testPage2()
    {
        $params = array(
            'total_rows' => 1000,
            'url_rule' => '/list/?.html',
            'now_page' => 50,
            'list_rows' => 10,
            'first_page_name' => '<<', //第一页
            'prev_page_name' => '<', //上一页
            'next_page_name' => '>', //下一页
            'last_page_name' => '>>', //最后一页
        );

        $page = new Page($params);


        echo $page->show();

        $this->assertTrue(true);
    }
}
