<?php
namespace Rails\WillPaginate\Renderer;

class Bootstrap2 extends Base
{
    public function toHtml()
    {
        $html = implode($this->options['linkSeparator'], array_map(function($item){
            if (is_int($item)) {
                return $this->pageNumber($item);
            } else {
                return $this->$item();
            }
        }, $this->pagination()));
        
        return $this->htmlContainer($this->tag('ul', $html));
    }
    
    protected function pageNumber($page)
    {
        if ($page != $this->collection->currentPage()) {
            return $this->tag('li', $this->link($page, $page, ['rel' => $this->relValue($page)]));
        } else {
            return $this->tag('li', $this->tag('span', $page), ['class' => 'current']);
        }
    }
    
    protected function gap()
    {
        return $this->tag('li', $this->link('&hellip;', "#"), ['class' => 'disabled']);
    }
    
    protected function previousPage()
    {
        $num = $this->collection->currentPage() > 1 ?
                    $this->collection->currentPage() - 1 : false;
        return $this->previousOrNextPage($num, $this->options['previousLabel'], 'prev');
    }
    
    protected function nextPage()
    {
        $num = $this->collection->currentPage() < $this->collection->totalPages() ?
                    $this->collection->currentPage() + 1 : false;
        return $this->previousOrNextPage($num, $this->options['nextLabel'], 'next');
    }
    
    protected function previousOrNextPage($page, $text, $classname)
    {
        if ($page) {
            return $this->tag('li', $this->link($text, $page), ['class' => $classname]);
        } else {
            return $this->tag('li', $this->tag('span', $text), ['class' => $classname . ' disabled']);
        }
    }
}
