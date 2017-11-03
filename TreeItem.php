<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Tree;

/**
 * Tree item base
 *
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
abstract class TreeItem 
{
  use \JDZ\Utilities\Traits\Get,
      \JDZ\Utilities\Traits\Set;
  
 	/**
   * Is it a valid item
   * 
	 * @var    bool 
	 */
  protected $valid;
  
	/**
   * Item value
   * 
	 * @var    mixed 
	 */
  protected $value;
  
	/**
   * Item label
   * 
	 * @var    string 
	 */
  protected $text;
  
	/**
	 * Constructor
   * 
   * @param 	array    $properties     Key/Value pairs
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
    
    $this->valid = false;
    $this->type  = 'item';
    
    $this->load();
  }
  
	/**
	 * Checks if the item is valid.
   *
   * @return 	bool
	 */
  public function isValid()
  {
    return ( $this->valid === true );
  }
  
	/**
	 * Export item to an object
   * 
   * @return 	object
	 */
  public function toObject()
  {
    return (object)[
      'type'  => $this->type, 
      'value' => $this->value,
      'text'  => $this->text,
    ];
  }
  
	/**
	 * Export item infos for an optcategoryed select
   * 
   * @return 	object
	 */
  public function toSelect()
  {
    return (object)[
      'value' => $this->value,
      'text'  => $this->text,
    ];
  }
  
	/**
	 * Load item
   * 
   * @return 	void
	 */
  abstract protected function load();
}