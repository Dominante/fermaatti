<?php
/**
 * ownCloud - domisingers
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Tuukka Verho / Dominante <tuukka.verho@aalto.fi>
 * @copyright Tuukka Verho / Dominante 2015
 */

namespace OCA\DomiSingers\Db;

use OCP\AppFramework\Db\Entity;

class Responsibility extends Entity {

    protected $viskaalitId = 'NULL';
    protected $personId;
    protected $viskaaliusId;
    protected $kausi;
    
    public function __construct() {
        $this->addType('viskaalitId', 'integer');
        $this->addType('personId', 'integer');
        $this->addType('viskaaliusId', 'integer');
    }
}