<?php
// Parent shortcode
function table_of_contents_shortcode($atts, $content = null)
{
    $atts = shortcode_atts([
        'header_text' => '',

    ], $atts);
    //

    $output = '<div class="toc-wrapper">';

    if ($atts['header_text']) {
        $output .= '<h3 class="toc-header">' . esc_html($atts['header_text']) . '</h3>';
    }


    $rows_content = do_shortcode($content);

    $output = '<div class="toc-wrapper">';
    if ($atts['header_text']) {
        $output .= '<h3 class="toc-header">' . esc_html($atts['header_text']) . '</h3>';
    }
    $output .= '<table class="toc-table"><tbody>';
    $output .= $rows_content;
    $output .= '</tbody></table></div>';

    return $output;
}
add_shortcode('table_of_contents', 'table_of_contents_shortcode');

// Row shortcode
function table_of_contents_row_shortcode($atts, $content = null)
{
    $cells_content = do_shortcode($content);
    return '<tr class="toc-row">' . $cells_content . '</tr>';
}
add_shortcode('table_of_contents_row', 'table_of_contents_row_shortcode');


// Cell shortcode
function table_of_contents_cell_shortcode($atts)
{
    $atts = shortcode_atts(['cell' => ''], $atts);
    return '<td class="toc-cell">' . esc_html($atts['cell']) . '</td>';
}
add_shortcode('table_of_contents_cell', 'table_of_contents_cell_shortcode');
