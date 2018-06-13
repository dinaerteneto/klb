<?php

namespace WeatherStation\Engine\Module\Yearly;

/**
 * Class to generate parameter yearly bars form.
 *
 * @package Includes\Classes
 * @author Pierre Lannoy <https://pierre.lannoy.fr/>.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 or later
 * @since 3.5.0
 */
class Bars extends \WeatherStation\Engine\Module\Maintainer {

    /**
     * Initialize the class and set its properties.
     *
     * @param array $station_information An array containing the station inforrmations.
     * @since 3.5.0
     */
    public function __construct($station_information) {
        self::$module_mode = 'yearly';
        $this->module_type = 'bars';
        $this->module_name = ucfirst(__('bar series', 'live-weather-station'));
        $this->module_hint = __('Display historical data as multiple stackable bars chart. Allows to view, side by side on the same graph, several dataset from several types of measurement having the same physical dimension.', 'live-weather-station');
        $this->module_icon = 'ch fa-lg fa-fw ch-bar-chart-up-4';
        $this->layout = '12-3-4';
        $this->series_number = 4;
        parent::__construct($station_information);
    }

    /**
     * Enqueues needed styles and scripts.
     *
     * @since 3.5.0
     */
    protected function enqueue_resources() {
        wp_enqueue_style('lws-nvd3');
        wp_enqueue_script('lws-nvd3');
        wp_enqueue_script('lws-colorbrewer');
        wp_enqueue_script('lws-spin');
    }

    /**
     * Prepare the data.
     *
     * @since 3.5.0
     */
    protected function prepare() {
        $js_array_yearlyline = $this->get_all_stations_array(false, false, true, true, true, false, true, true, array($this->station_guid));
        if (array_key_exists($this->station_guid, $js_array_yearlyline)) {
            if (array_key_exists(2, $js_array_yearlyline[$this->station_guid])) {
                $this->data = $js_array_yearlyline[$this->station_guid][2];
            }
        }
        else {
            $this->data = null;
        }
        $this->period = $this->get_period_value_js_array($this->station_information);
    }

    /**
     * Print the datasource section of the form.
     *
     * @return string The datasource section, ready to be printed.
     * @since 3.5.0
     */
    protected function get_datasource() {
        $content = '<table cellspacing="0" style="display:inline-block;"><tbody>';
        $content .= $this->get_key_value_option_select('yearly-bars-datas-period-type-'. $this->station_guid, __('Period type', 'live-weather-station'), $this->get_period_type_js_array(), true, 'sliding-month');
        $content .= $this->get_neutral_option_select('yearly-bars-datas-period-value-'. $this->station_guid, __('Period', 'live-weather-station'));
        $content .= $this->get_key_value_option_select('yearly-bars-datas-dimension-' . $this->station_guid, __('Dimension', 'live-weather-station'), $this->get_comparable_dimensions_js_array(), true, 'temperature');
        $a_group = array();
        for ($i=1; $i<=$this->series_number; $i++) {
            $group = $this->get_assoc_option_select('yearly-bars-datas-module-' . $i . '-' . $this->station_guid, __('Module', 'live-weather-station'), $this->data, 0);
            $group .= $this->get_neutral_option_select('yearly-bars-datas-measurement-' . $i . '-' . $this->station_guid, __('Measurement', 'live-weather-station'));
            $group .= $this->get_neutral_option_select('yearly-bars-datas-set-'. $i . '-' . $this->station_guid, __('Dataset', 'live-weather-station'));
            $group .= $this->get_key_value_option_select('yearly-bars-datas-line-mode-' . $i . '-' . $this->station_guid, __('Behavior', 'live-weather-station'), $this->get_stackable_mode_js_array(), true, 'single');
            $group .= $this->get_key_value_option_select('yearly-bars-datas-dot-style-' . $i . '-' . $this->station_guid, __('Values display', 'live-weather-station'), $this->get_dot_style_js_array(), true, 'none', true, false);
            $group .= $this->get_key_value_option_select('yearly-bars-datas-line-style-' . $i . '-' . $this->station_guid, __('Line style', 'live-weather-station'), $this->get_line_style_js_array(), true, 'solid', true, false);
            $group .= $this->get_key_value_option_select('yearly-bars-datas-line-size-' . $i . '-' . $this->station_guid, __('Line size', 'live-weather-station'), $this->get_line_size_js_array(), true, 'regular', true, false);
            $a_group[] = array('content' => $group, 'name' => sprintf(__('Measurement %s', 'live-weather-station'), $i));
        }
        $content .= $this->get_group('yearly-bars-datas-measure-group-', $a_group);
        $content .= '</tbody></table>';
        return $this->get_box('lws-datasource-id', $this->datasource_title, $content);
    }

    /**
     * Print the parameters section of the form.
     *
     * @return string The parameters section, ready to be printed.
     * @since 3.5.0
     */
    protected function get_parameters() {
        $content = '<table cellspacing="0" style="display:inline-block;"><tbody>';
        $content .= $this->get_key_value_option_select('yearly-bars-datas-template-'. $this->station_guid, __('Template', 'live-weather-station'), $this->get_graph_template_js_array(), true, 'neutral');
        $content .= $this->get_key_value_option_select('yearly-bars-datas-color-'. $this->station_guid, __('Color scheme', 'live-weather-station'), $this->get_colorbrewer_js_array(true));
        $content .= $this->get_key_value_option_select('yearly-bars-datas-label-'. $this->station_guid, __('Label', 'live-weather-station'), $this->get_multi_2_label_js_array(), true, 'simple');
        $content .= $this->get_key_value_option_select('yearly-bars-datas-guideline-'. $this->station_guid, __('Control', 'live-weather-station'), $this->get_bar_group_js_array(), true, 'free');
        $content .= $this->get_key_value_option_select('yearly-bars-datas-height-'. $this->station_guid, __('Height', 'live-weather-station'), $this->get_graph_size_js_array(), true, '300px');
        $content .= $this->get_key_value_option_select('yearly-bars-datas-timescale-'. $this->station_guid, __('Time scale', 'live-weather-station'), $this->get_x_scale_js_array(true), true, 'auto');
        $content .= $this->get_key_value_option_select('yearly-bars-datas-valuescale-'. $this->station_guid, __('Value scale', 'live-weather-station'), $this->get_y_scale_js_array(true), true, 'auto');
        $content .= $this->get_key_value_option_select('yearly-bars-datas-interpolation-'. $this->station_guid, __('Start', 'live-weather-station'), $this->get_stacking_js_array(), true, 'grouped', true, false);
        $content .= $this->get_key_value_option_select('yearly-bars-datas-data-'. $this->station_guid, __('Data', 'live-weather-station'), $this->get_graph_data_js_array(), true, 'inline');
        $content .= '</tbody></table>';
        return $this->get_box('lws-parameter-id', $this->parameter_title, $content);
    }

    /**
     * Print the script section of the form.
     *
     * @return string The script section, ready to be printed.
     * @since 3.5.0
     */
    protected function get_script() {
        $content = $this->get_standard_script();
        $content .= '$("#yearly-bars-datas-dimension-' . $this->station_guid . '").change();';
        return $this->get_script_box($content);
    }

    /**
     * Print the preview section of the form.
     *
     * @return string The preview section, ready to be printed.
     * @since 3.5.0
     */
    protected function get_preview() {
        $content = '<div id="lws-graph-preview"></div>';
        return $this->get_box('lws-preview-id', $this->preview_title, $content);
    }
}

