<?php
namespace Rails\WillPaginate;

class Config
{
    /**
     * Sets a default custom renderer class.
     * A custom renderer class can be created, extending
     * Renderer\AbstractRenderer.
     */
    protected $renderer = 'bootstrap3';
    
    /**
     * Show pagination even if there's only 1 page
     */
    protected $alwaysShow = false;
    
    /**
     * Set custom configuration values through set(),
     * retrieve with get().
     */
    protected $custom = [];
    
    public function renderer()
    {
        return $this->renderer;
    }
    
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
    }
    
    public function alwaysShow()
    {
        return $this->alwaysShow;
    }
    
    public function setAlwaysShow($alwaysShow)
    {
        $this->alwaysShow = $alwaysShow;
    }
    
    public function set($key, $value)
    {
        $this->custom[$key] = $value;
    }
    
    public function get($key)
    {
        if (isset($this->custom[$key])) {
            return $this->custom[$key];
        } else {
            return null;
        }
    }
}
