<?php
class Paginator
{

    public $items_per_page;
    public $items_total;
    public $current_page;
    public $num_pages;
    public $mid_range;
    public $low;
    public $high;
    public $limit;
    public $return;
    public $default_ipp = 12;
    public $querystring;

    function Paginator()
    {
        $this->current_page = 1;
        $this->mid_range = 7;
        $this->items_per_page = ($_GET['ipp'] != '') ? $_GET['ipp'] : $this->default_ipp;
    }

    function paginate()
    {
        if ($_GET['ipp'] == 'Todas') {
            $this->num_pages = ceil($this->items_total / $this->default_ipp);
            $this->items_per_page = $this->items_total; //$this->default_ipp;
        } else {
            if (!is_numeric($this->items_per_page) OR ($this->items_per_page <= 0)) {
                $this->items_per_page = $this->default_ipp;
            }

            $this->num_pages = ceil($this->items_total / $this->items_per_page);
        }

        $this->current_page = (int)$_GET['page']; // must be numeric > 0

        if (($this->current_page < 1) OR (!is_numeric($this->current_page))) {
            $this->current_page = 1;
        }

        if ($this->current_page > $this->num_pages) {
            $this->current_page = $this->num_pages;
        }

        $prev_page = $this->current_page - 1;
        $next_page = $this->current_page + 1;

        if ($_GET) {
            $args = explode('&', $_SERVER['QUERY_STRING']);

            foreach ($args as $arg) {
                $keyval = explode('=', $arg);

                if (($keyval[0] != 'page') AND ($keyval[0] != 'ipp')) {
                    $this->querystring .= '&amp;' . $arg;
                }
            }
        }

        if ($_POST) {
            foreach ($_POST as $key => $val) {
                if (($key != 'page') AND ($key != 'ipp')) {
                    $this->querystring .= '&amp;' . $key . '=' . $val;
                }
            }
        }

        if ($this->num_pages > 10) {
            $this->return = (($this->current_page != 1) AND ($this->items_total >= 10)) ? "<a class=\"paginate\" href=\"?page=$prev_page&amp;ipp=$this->items_per_page$this->querystring\">&laquo; Anterior</a> " : "<span class=\"inactive\" href=\"#\">&laquo; Anterior</span> ";

            $this->start_range = $this->current_page - floor($this->mid_range / 2);
            $this->end_range = $this->current_page + floor($this->mid_range / 2);

            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }
            if ($this->end_range > $this->num_pages) {
                $this->start_range -= $this->end_range - $this->num_pages;
                $this->end_range = $this->num_pages;
            }

            $this->range = range($this->start_range, $this->end_range);

            for ($i = 1; $i <= $this->num_pages; $i++) {
                if (($this->range[0] > 2) AND ($i == $this->range[0])) {
                    $this->return .= " ... ";
                }
                // loop through all pages. if first, last, or in range, display

                if (($i == 1) OR ($i == $this->num_pages) OR (in_array($i, $this->range))) {
                    $this->return .= (($i == $this->current_page) AND ($_GET['page'] != 'Todas')) ? "<a title=\"V&aacute; para $i de $this->num_pages\" class=\"current\" href=\"#\">$i</a> " : "<a class=\"paginate\" title=\"V&aacute; para $i de $this->num_pages\" href=\"?page=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a> ";
                }

                if (($this->range[$this->mid_range - 1] < $this->num_pages - 1) AND ($i == $this->range[$this->mid_range - 1])) {
                    $this->return .= " ... ";
                }
            }

            $this->return .= ((($this->current_page != $this->num_pages) AND ($this->items_total >= 10)) AND ($_GET['page'] != 'Todas')) ? "<a class=\"paginate\" href=\"?page=$next_page&amp;ipp=$this->items_per_page$this->querystring\">Pr&oacute;ximo &raquo;</a>\n" : "<span class=\"inactive\" href=\"#\">&raquo; Pr&oacute;ximo</span>\n";
            $this->return .= ($_GET['page'] == 'Todas') ? "<a class=\"current\" href=\"#\">Todas</a> \n" : "<a class=\"paginate\" href=\"?page=Todas&amp;ipp=Todas$this->querystring\">Todas</a> \n";

        } else {
            for ($i = 1; $i <= $this->num_pages; $i++) {
                $this->return .= (($i == $this->current_page) AND ($_GET['page'] != 'Todas')) ? '<a class=\'current\' href=\'#\'>' . $i . '</a> ' : "<a class=\"paginate\" href=\"?page=$i&amp;ipp=$this->items_per_page$this->querystring\">$i</a> ";
            }

            $this->return .= ($_GET['page'] == 'Todas') ? "<a class=\"current\" href=\"#\">Todas</a> \n" : "<a class=\"paginate\" href=\"?page=Todas&amp;ipp=Todas$this->querystring\">Todas</a> \n";

            //$this->return .= "<a class=\"paginate\" href=\"?page=1&amp;ipp=Todas$this->querystring\">Todas</a> \n";
        }

        $this->low = ($this->current_page - 1) * $this->items_per_page;
        $this->high = ($_GET['ipp'] == 'Todas') ? $this->items_total : ($this->current_page * $this->items_per_page) - 1;
        $this->limit = ' LIMIT ' . $this->low . ',' . $this->items_per_page;
    }

    function display_items_per_page()
    {
        $items = '';
        $ipp_array = array(10, 25, 50, 100, 'Todas');

        foreach ($ipp_array as $ipp_opt) {
            $items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n" : "<option value=\"$ipp_opt\">$ipp_opt</option>\n";
        }

        return "<span class=\"paginate\">Items por p&aacute;gina:</span><select class=\"paginate\" onchange=\"window.location='?page=1&amp;ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n";
    }

    function display_jump_menu()
    {
        $option='';
        for ($i = 1; $i <= $this->num_pages; $i++) {
            $option.= ($i == $this->current_page) ? "<option value=\"$i\" selected>$i</option>\n" : "<option value=\"$i\">$i</option>\n";
        }
        return "<span class=\"paginate\">P&aacute;gina:</span><select class=\"paginate\" onchange=\"window.location='?page='+this[this.selectedIndex].value+'&amp;ipp=$this->items_per_page$this->querystring';return false\">$option</select>\n";
    }

    function display_pages()
    {
        return $this->return;
    }
}