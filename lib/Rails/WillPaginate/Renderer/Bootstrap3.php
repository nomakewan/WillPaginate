<?php
namespace Rails\WillPaginate\Renderer;

class Bootstrap3 extends Base
{
    public function toHtml()
    {
        $html = implode(array_map(function($item){
            if (is_int($item)) {
                return $this->pageNumber($item);
            } else {
                return $this->$item();
            }
        }, $this->pagination()), $this->options['link_separator']);
        
        return $this->htmlContainer($html);
    }
    
    protected function containerAttributes()
    {
        $classes = ['pagination'];
        
        if (isset($this->options['size'])) {
            switch ($this->options['size']) {
                case 'large':
                    $classes[] = 'pagination-lg';
                    break;
                case 'small':
                    $classes[] = 'pagination-sm';
                    break;
            }
        }
        
        return ['class' => $classes];
    }
    
    protected function htmlContainer($html)
    {
        return $this->tag('ul', $html, $this->containerAttributes());
    }

    protected function defaultOptions()
    {
        return array_merge(parent::defaultOptions(), [
            'previous_label' => '«',
            'next_label'     => '»'
        ]);
    }
    
    protected function pageNumber($page)
    {
        if ($page != $this->collection->currentPage()) {
            return $this->tag('li', $this->link($page, $page, ['rel' => $this->relValue($page)]));
        } else {
            return $this->tag('li', $this->tag('span', $page), ['class' => 'active']);
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
        return $this->previousOrNextPage($num, $this->options['previous_label'], 'prev');
    }
    
    protected function nextPage()
    {
        $num = $this->collection->currentPage() < $this->collection->totalPages() ?
                    $this->collection->currentPage() + 1 : false;
        return $this->previousOrNextPage($num, $this->options['next_label'], 'next');
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
