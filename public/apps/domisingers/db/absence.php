<?php
/**
 * ownCloud - domisingers
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Tuukka Verho / Dominante <tuukka.verho@aalto.fi>
 * @copyright Tuukka Verho / Dominante 2016
 */

namespace OCA\DomiSingers\Db;

use OCP\AppFramework\Db\Entity;

class Absence extends Entity {

    protected $tauotId = 'NULL';
    protected $personId;
    protected $alkoi;
    protected $paattyi;
    protected $selite;
    
    public function __construct() {
        $this->addType('tauotId', 'integer');
        $this->addType('personId', 'integer');
        $this->addType('alkoi', 'date');
        $this->addType('paattyi', 'date');
        $this->addType('selite', 'string');
    }
}
