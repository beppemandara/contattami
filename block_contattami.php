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
 * Block contattami is defined here.
 *
 * @package     block_contattami
 * @copyright   2020 Giuseppe Mandarà <giuseppe.mandara@csi.it>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/**
 * contattami block.
 *
 * @package    block_contattami
 * @copyright  2020 Giuseppe Mandarà <giuseppe.mandara@csi.it>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_contattami extends block_list {

    /**
     * Initializes class member variables.
     */
    public function init() {
        // Needed by Moodle to differentiate between blocks.
        $this->title = get_string('pluginname', 'block_contattami');
    }

	/**
     * Returns the block contents.
     *
     * @return stdClass The block contents.
     */
    public function get_content() {

		global $CFG, $COURSE;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $this->content->items[] = html_writer::tag('a', get_string('help','block_contattami'), array('href' => 'help.php'));
        $this->content->icons[] = html_writer::empty_tag('img', array('src' => 'images/icons/1.gif', 'class' => 'icon'));
        $this->content->items[] = html_writer::tag('a', get_string('formlink','block_contattami'), array('href' => 'view.php?courseid='.$COURSE->id));
        $this->content->icons[] = html_writer::empty_tag('img', array('src' => 'images/icons/1.gif', 'class' => 'icon'));

        return $this->content;
	}

	/**
     * Defines configuration data.
     *
     * The function is called immediatly after init().
     */
    public function specialization() {

        if (isset($this->config)) {
            // Load user defined title and make sure it's never empty.
            if (empty($this->config->title)) {
                $this->title = get_string('pluginname', 'block_contattami');
            } else {
                $this->title = $this->config->title;
            }
        }
    }
	
	/**
     * Sets the applicable formats for the block.
     *
     * @return string[] Array of pages and permissions.
     */
	public function applicable_formats() {
    
		return array('all' => false,
                     'site' => true,
                     'site-index' => true,
                     'course-view' => false,
                     'mod' => false);
	}

	/**
     * Enables global configuration of the block in settings.php.
     *
     * @return bool True if the global configuration is enabled.
     */
    function has_config() {
        return true;
	}
	
	/**
     * More than one instance per page?
     *
     * @return boolean
     **/
	public function instance_allow_multiple() {
		return false;
	}

	/**
     * Cron?
     *
     * @return boolean
     **/
	public function cron() {
    
		mtrace( "Block contattami cron script is running" );

		// do something

		return true;
    }
}