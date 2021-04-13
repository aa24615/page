<?php
/*
 * This file is part of the zyan/page.
 *
 * (c) 读心印 <aa24615@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zyan\Page;

use Zyan\Page\Theme\Theme;

/**
 * Class Page.
 *
 * @package Zyan\Page
 *
 * @author 读心印 <aa24615@qq.com>
 */

class Page extends Theme
{
    protected $first_row;        //起始行数

    protected $list_rows;        //列表每页显示行数

    protected $total_pages;      //总页数

    protected $total_rows;       //总行数

    protected $now_page;         //当前页数

    protected $url_rule = '';

    protected $page_name;        //分页参数的名称

    protected $plus = 3;         //分页偏移量

    protected $url;

    protected $first_page_name = "第一页";
    protected $prev_page_name = "上一页";
    protected $next_page_name = "下一页";
    protected $last_page_name = "最后一页";

    /**
     * Page constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->total_rows = $config['total_rows'];

        $this->url_rule = !empty($config['url_rule']) ? $config['url_rule'] : '';
        $this->list_rows = !empty($config['list_rows']) && $config['list_rows'] <= 100 ? $config['list_rows'] : 15;
        $this->total_pages = ceil($this->total_rows / $this->list_rows);
        $this->page_name = !empty($config['page_name']) ? $config['page_name'] : 'p';

        $this->first_page_name = !empty($config['first_page_name']) ? $config['first_page_name'] : $this->first_page_name;
        $this->prev_page_name = !empty($config['prev_page_name']) ? $config['prev_page_name'] : $this->prev_page_name;
        $this->next_page_name = !empty($config['next_page_name']) ? $config['next_page_name'] : $this->next_page_name;
        $this->last_page_name = !empty($config['last_page_name']) ? $config['last_page_name'] : $this->last_page_name;

        /* 当前页面 */
        if (!empty($config['now_page'])) {
            $this->now_page = intval($config['now_page']);
        } else {
            $this->now_page = !empty($_GET[$this->page_name]) ? intval($_GET[$this->page_name]) : 1;
        }
        $this->now_page = $this->now_page <= 0 ? 1 : $this->now_page;


        if (!empty($this->total_pages) && $this->now_page > $this->total_pages) {
            $this->now_page = $this->total_pages;
        }
        $this->first_row = $this->list_rows * ($this->now_page - 1);
    }


    /**
     * get_link.
     *
     * @param int $page
     * @param string $text
     *
     * @return string
     *
     * @author 读心印 <aa24615@qq.com>
     */
    protected function get_link($page, $text)
    {
        $url = str_replace('?', $page, $this->url_rule);
        return '<a href="' .$url . '">' . $text . '</a>' . PHP_EOL;
    }

    /**
     * 设置当前页面链接.
     *
     * @return void
     *
     * @author 读心印 <aa24615@qq.com>
     */
    protected function set_url()
    {
        $url = $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'], '?') ? '' : "?").$this->url_rule;
        $parse = parse_url($url);
        if (isset($parse['query'])) {
            parse_str($parse['query'], $params);
            unset($params[$this->page_name]);
            $url = $parse['path'].'?'.http_build_query($params);
        }
        if (!empty($params)) {
            $url .= '&';
        }
        $this->url = $url;
    }


    /**
     * 得到$page的ur.
     *
     * @param int $page
     *
     * @return string
     *
     * @author 读心印 <aa24615@qq.com>
     */
    protected function get_url($page)
    {
        if ($this->url === null) {
            $this->set_url();
        }
        //  $lable = strpos('&', $this->url) === FALSE ? '' : '&';
        return $this->url . $this->page_name . '=' . $page;
    }

    /**
     * 得到第一页.
     *
     * @return string
     *
     * @author 读心印 <aa24615@qq.com>
     */
    public function first_page()
    {
        if ($this->now_page > 5) {
            return $this->get_link('1', $this->first_page_name);
        }
        return '';
    }

    /**
     * 最后一页.
     *
     * @return string
     *
     * @author 读心印 <aa24615@qq.com>
     */
    public function last_page()
    {
        if ($this->now_page < $this->total_pages - 5) {
            return $this->get_link($this->total_pages, $this->last_page_name);
        }
        return '';
    }

    /**
     * 上一页.
     *
     * @return string
     *
     * @author 读心印 <aa24615@qq.com>
     */
    public function prev_page()
    {
        if ($this->now_page != 1) {
            return $this->get_link($this->now_page - 1, $this->prev_page_name);
        }
        return '';
    }

    /**
     * 下一页.
     *
     * @return string
     *
     * @author 读心印 <aa24615@qq.com>
     */
    public function next_page()
    {
        if ($this->now_page < $this->total_pages) {
            return $this->get_link($this->now_page + 1, $this->next_page_name);
        }
        return '';
    }

    /**
     * 分页输出
     * @param int $param
     * @return string
     */
    public function show($param = 1)
    {
        if ($this->total_rows < 1) {
            return '';
        }

        $className = 'show' . $param;

        $classNames = get_class_methods($this);

        if (in_array($className, $classNames)) {
            return $this->$className();
        }
        return '';
    }
}
