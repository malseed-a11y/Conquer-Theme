<?php



use Elementor\Widget_Base;
use Elementor\Controls_Manager;
// use Elementor\Group_Control_Typography;
// use Elementor\Scheme_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly


class Elementor_Tabel_Widget  extends Widget_Base
{



    public function get_name()
    {
        return 'CustomTable';
    }

    public function get_title()
    {
        return 'الجدول المخصص';
    }
    public function get_icon()
    {
        return 'eicon-pencil';
    }
    public function get_categories()
    {
        return ['basic'];
    }


    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_design',
            [
                'label' => 'التصميم',
            ]
        );
        /**
         * Table Header REPEATER
         */
        $table_header_repeater = new \Elementor\Repeater();

        $table_header_repeater->add_control(
            'header_item_text',
            [
                'label' => 'نص العنوان',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]

        );


        $this->add_control(

            'table_headers',
            [
                'label' => 'عناوين الجدل العلوية',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $table_header_repeater->get_controls(),
                'title_field' => '{{{ header_item_text }}}'


            ]
        );








        /**
         * Table Column REPEATER
         */
        $table_content_repeater = new \Elementor\Repeater();



        $table_content_repeater->add_control(
            'row_or_column',
            [
                'label' => esc_html__('Row Or Column', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'textdomain'),
                        'icon' => 'eicon-divider',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'textdomain'),
                        'icon' => 'eicon-columns',
                    ],
                ],
                'default' => 'column',
                'toggle' => true,
            ]
        );

        $table_content_repeater->add_control(
            'td_or_th',
            [
                'label' => esc_html__('td Or th', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'th' => [
                        'title' => esc_html__('TH', 'textdomain'),
                        'icon' => 'eicon-editor-h1',
                    ],
                    'td' => [
                        'title' => esc_html__('TD', 'textdomain'),
                        'icon' => 'eicon-editor-h2',
                    ],
                ],
                'default' => 'td',
                'toggle' => true,
                'condition' => [
                    'row_or_column' => 'column',
                ],
            ]
        );

        $table_content_repeater->add_control(
            'column_item_text',
            [
                'label' => 'نص العنصر',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'row_or_column' => 'column',
                ],
            ]

        );


        $this->add_control(

            'table_content',
            [
                'label' => 'محتوى الجدول',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $table_content_repeater->get_controls(),
                'title_field' => '{{{ column_item_text }}}'


            ]
        );


        $this->end_controls_section();
    }

    // php render function
    protected function render()
    {

        $settings = $this->get_settings_for_display();
?>

        <table class="table" id="table_prices" style="direction:rtl;border:2px #fff solid;font-size:1.5em">
            <thead>
                <tr>
                    <?php
                    foreach ($settings['table_headers'] as $item) {
                    ?>
                        <th scope="col"><?php echo $item['header_item_text'] ?></th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $count_of_rows = 0;
                foreach ($settings['table_content'] as $item) {
                    if ($item['row_or_column'] == 'row')
                        $count_of_rows++;
                }

                $row_counter = 0;
                $counter = 0;
                foreach ($settings['table_content'] as $item) {
                    if ($item['row_or_column'] == 'row') {

                        if ($counter == 0)
                            echo "<tr>";

                        echo "</tr><tr>";

                        if ($row_counter == $count_of_rows - 1)
                            echo "</tr>";

                        $row_counter++;
                    } else {
                        if ($item['td_or_th'] == 'td')
                            echo '<td>' . $item['column_item_text'] . '</td>';

                        if ($item['td_or_th'] == 'th')
                            echo '<th scope="row">' . $item['column_item_text'] . '</th>';
                    }
                ?>

                <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
<?php
    }
}
