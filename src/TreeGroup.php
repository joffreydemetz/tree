<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Tree;

/**
 * Tree group base
 *
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
abstract class TreeGroup
{
  use \JDZ\Utilities\Traits\Get,
      \JDZ\Utilities\Traits\Set;
  
   /**
   * Is it a valid group
   * 
   * @var    bool 
   */
  protected $valid;
  
  /**
   * Group value
   * 
   * @var    mixed 
   */
  protected $value;
  
  /**
   * Group label
   * 
   * @var    string 
   */
  protected $text;
  
  /**
   * Children groups
   * 
   * @var    array 
   */
  protected $groups;
  
  /**
   * Children items
   * 
   * @var    array 
   */
  protected $items;
  
  /**
   * Constructor
   * 
   * @param   array    $properties     Key/Value pairs
   */
  public function __construct(array $properties=[])
  {
    if ( !empty($properties) ){
      $this->setProperties($properties);
    }
    
    if ( !isset($this->value) ){
      $this->value = null;
    }
    
    if ( !isset($this->text) ){
      $this->text = null;
    }
    
    $this->valid  = false;
    $this->type   = 'group';
    $this->groups = [];
    $this->items  = [];
    
    $this->load();
  }
  
  /**
   * Checks if the group is valid.
   *
   * Checks if group contains children categories or pages.
   * 
   * @return   bool
   */
  public function isValid()
  {
    return ( $this->valid === true );
  }
  
  /**
   * Export group to an object
   * 
   * @return   object
   */
  public function toObject()
  {
    $groups = $this->groups;
    foreach($groups as &$group){
      $group = $group->toObject();
    }
    
    $items = $this->items;
    foreach($items as &$item){
      $item = $item->toObject();
    }
    
    return (object)[
      'type'   => $this->type, 
      'value'  => $this->value, 
      'text'   => $this->text, 
      'groups' => $groups,
      'items'  => $items,
    ];
  }
  
  /**
   * Export group infos for an optgrouped select
   * 
   * @return   void
   */
  public function toSelect(array &$optgroups=[], $level=1, $root=true)
  {
    $options = [];
    foreach($this->items as $item){
      $options[] = $item->toSelect();
    }
    
    if ( $root === true ){
      $text = $this->text;
    }
    else {
      $text = '|'.str_repeat('-', $level).' '.$this->text;
    }
    
    $optgroups[] = [
      'text' => $text,
      'options' => $options,
    ];
    
    foreach($this->groups as $group){
      $group->toSelect($optgroups, $level+1, false);
    }
  }
  
  /**
   * Load group
   * 
   * @return   void
   */
  abstract protected function load();
}
