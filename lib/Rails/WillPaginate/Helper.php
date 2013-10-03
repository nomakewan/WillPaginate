<?php
namespace Rails\WillPaginate;

class Helper extends \Rails\ActionView\Helper
{
    public function willPaginate(\Rails\ActiveRecord\Collection $collection, array $options = [])
    {
        if ($collection->totalPages() <= 1 && !$this->config()->alwaysShow()) {
            return '';
        }
        
        $rendererClass = $this->rendererClass();
        $renderer = new $rendererClass($this, $collection, $options);
        
        return $renderer->toHtml();
    }
    
    protected function rendererClass()
    {
        $option = $this->config()->renderer();
        
        if ($option == 'legacy') {
            return 'WillPaginate\Renderer\Legacy';
        } elseif ($option == 'bootstrap2') {
            return 'WillPaginate\Renderer\Bootstrap2';
        } elseif ($option == 'bootstrap3') {
            return 'WillPaginate\Renderer\Bootstrap3';
        } else {
            return $option;
        }
    }
    
    protected function config()
    {
        return WillPaginate::config();
    }
}
