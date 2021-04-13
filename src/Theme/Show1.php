<?php

/*
 * This file is part of the zyan/page.
 *
 * (c) 读心印 <aa24615@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Zyan\Page\Theme;

/**
 * Trait Show1
 *
 * @method static \Zyan\Page\Page first_page()
 * @method static \Zyan\Page\Page next_page()
 * @method static \Zyan\Page\Page prev_page()
 * @method static \Zyan\Page\Page last_page()
 * @method static \Zyan\Page\Page get_link()
 * @property  \Zyan\Page\Page  $plus
 * @property  \Zyan\Page\Page  $now_page
 * @property  \Zyan\Page\Page  $total_pages
 *
 * @package Zyan\Page\Theme
 */

trait Show1
{
    protected function show1()
    {
        $plus = $this->plus;
        if ($plus + $this->now_page > $this->total_pages) {
            $begin = $this->total_pages - $plus * 2;
        } else {
            $begin = $this->now_page - $plus;
        }

        $begin = ($begin >= 1) ? $begin : 1;
        $return = '<div class="zyan-page">'.PHP_EOL;
        $return .= $this->first_page();
        $return .= $this->prev_page();
        for ($i = $begin; $i <= $begin + $plus * 2;$i++) {
            if ($i > $this->total_pages) {
                break;
            }
            if ($i == $this->now_page) {
                $return .= "<a class='active'>$i</a>".PHP_EOL;
            } else {
                $return .= $this->get_link($i, $i);
            }
        }
        $return .= $this->next_page();
        $return .= $this->last_page();
        $return .= '</div>';
        return $return;
    }
}
