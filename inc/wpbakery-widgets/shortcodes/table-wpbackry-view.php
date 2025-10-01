<?php
// Parent shortcode
function table_of_contents_shortcode($atts, $content = null)
{
    $atts = shortcode_atts([
        'header_text' => '',
        'col_number'  => 3,
    ], $atts);

    $col_number = intval($atts['col_number']);

    // Extract child shortcodes
    preg_match_all('/\[table_of_contents_child[^\]]*\]/', $content, $matches);
    $cells_html = [];
    if (!empty($matches[0])) {
        foreach ($matches[0] as $child_shortcode) {
            $cells_html[] = do_shortcode($child_shortcode);
        }
    }


    $output = '<div class="toc-wrapper ">';

    if ($atts['header_text']) {
        $output .= '<h3 class="toc-header">' . esc_html($atts['header_text']) . '</h3>';
    }

    $output .= '<table class="toc-table"><tbody>';

    $count = 0;
    $cells_number = count($cells_html);
    if ($cells_number > 0) {
        while ($count < $cells_number) {
            $output .= '<tr class="toc-row">';
            for ($j = 0; $j < $col_number; $j++) {
                if ($count < $cells_number) {
                    $output .= $cells_html[$count];
                    $count++;
                }
            }
            $output .= '</tr>';
        }
    }

    $output .= '</tbody></table></div>';

    return $output;
}
add_shortcode('table_of_contents', 'table_of_contents_shortcode');

// Child shortcode
function table_of_contents_child_shortcode($atts)
{
    $atts = shortcode_atts(['cell' => ''], $atts);
    return '<td class="toc-cell">' . esc_html($atts['cell']) . '</td>';
}
add_shortcode('table_of_contents_child', 'table_of_contents_child_shortcode');
