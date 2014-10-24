<?php
/**
 * Di class
 *
 * AnunnakiPHP: A simple framework for all kind of projects (https://anunnakiphp.wordpress.com)
 * Copyright (c) Anunnaki software foundation. (https://anunnakiphp.wordpress.com)
 *
 * Licensed under the MIT license
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright	Copyright (c) Anunnaki software foundation. (https://anunnakiphp.wordpress.com)
 * @link		https://anunnakiphp.wordpress.com AnunnakiPHP
 * @since		AnunnakiPHP v 2.1
 * @license		http://www.opensource.org/licenses/mit-license.php MIT License
 * @package		Anunnaki\Di
 */

namespace Anunnaki\Di;

/**
 * This class is responsible to save the 
 * denpendencies that another classes will use
 * 
 * @package		Anunnaki\Di
 * @author		Andre Naves
 */
class Di
{
	/**
	 * Holds the dependencies that system will use
	 * 
	 * @var		array
	 * @access	private
	 * @example	array('MyClass' => array('Dependency1', 'Dependency2'), 'MyClass2' => 'Dependency1')
	 */
	private $dependencies = array();
	
	/**
	 * Set the dependencies
	 * 
	 * @param	array $key
	 * @param	array $dependencies
	 */
	public function setDependency($key, array $dependencies)
	{
		$dic = array();
		foreach ($dependencies as $dependency) {
			if (is_object($dependency)) {
				$dic[] = $dependency;
			}
		}
		
		$this->dependencies[$key] = $dic;
	}
	
	/**
	 * Return the dependencies of a class
	 * 
	 * @param	string $className
	 * @throws	\Exception
	 * @return	array
	 */
	public function inject($className)
	{
		if (!isset($this->dependencies[$className])) {
			throw new \Exception('The class \'' . $className . '\' has no dependency', 1008);
		}
		
		$return = array();
		
		foreach ($this->dependencies[$className] as $dependency) {
			if (is_object($dependency)) {
				$return[] = $dependency;
			}
		}
		
		return $return;
	}
}