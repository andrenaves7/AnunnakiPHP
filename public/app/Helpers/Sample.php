<?php
/**
 * Sample helper
 *
 * This file is a sample helper
 *
 * Here you can configure the database and a long types of configurations
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
 * @package		Helpers
 */

namespace Helpers;

use Anunnaki\Helper\App\AppHelper;

/**
 * Sample helper
 *
 * @package		Environment
 * @author		Andre Naves
 */
class Sample extends AppHelper
{
	/**
	 * The method must fallow the pattern.
	 * It must have the same name of the class but
	 * the first character must be in lower case
	 * 
	 * @param	string $string
	 * @return	string
	 */
	public function sample($string = 'Hi! I\'m a Sample helper')
	{
		return $string;
	}
}