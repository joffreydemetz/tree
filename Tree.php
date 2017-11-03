<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Tree;

/**
 * Tree base class
 *
 * @author Joffrey Demetz <joffrey.demetz@gmail.com>
 */
abstract class Tree
{
  use \JDZ\Utilities\Traits\Get,
      \JDZ\Utilities\Traits\Set;
  
 	/**
   * The complete tree
   * 
	 * @var    object 
	 */
  protected $tree;
  
 	/**
   * The complete tree formatted for an optgroup select
   *
	 * @var    object 
	 */
  protected $select;
  
	/**
	 * Constructor
	 */
  public function __construct(array $properties=[])
  {
    if ( !empty($properties) ){
      $this->setProperties($properties);
    }
    
    $this->tree   = new \stdClass;
    $this->select = new \stdClass;
    
    $this->load();
  }
  
	/**
	 * Get the resulting tree
   * 
   * @return 	object
	 */
  public function getTree()
  {
    return $this->tree;
  }
  
	/**
	 * Get the resulting tree formatted for an optgrouped select
   * 
   * @return 	array
	 */
  public function getSelect()
  {
    return $this->select;
  }
  
	/**
	 * Load tree
   * 
   * @return 	void
	 */
  abstract protected function load();
}