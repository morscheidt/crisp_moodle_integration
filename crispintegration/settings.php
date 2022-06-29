<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * local webcrispintegration settings definitions.
 *
 * @package   local_crispintegration
 * @copyright 2020 Willy Morscheidt Centre d'innovation pédagogique PSL
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/lib.php');

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_crispintegration', get_string('pluginname', 'local_crispintegration'));
    

    $settings->add(new admin_setting_configtext('local_crispintegration/crispWebsiteId',
        new lang_string('crispWebsiteId', 'local_crispintegration'),
        new lang_string('crispWebsiteId_desc', 'local_crispintegration'), '', PARAM_NOTAGS));
        
    $settings->add(new admin_setting_configtextarea('local_crispintegration/crispSegments',
        new lang_string('crispSegments', 'local_crispintegration'),
        new lang_string('crispSegments_desc', 'local_crispintegration'), '', PARAM_NOTAGS));
    
    $ADMIN->add('localplugins', $settings);
}
