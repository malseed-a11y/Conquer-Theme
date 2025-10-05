<?php
add_shortcode('comments_table', 'comments_table_shortcode');

function comments_table_shortcode($atts = [])
{
    $atts = shortcode_atts([
        'table_color' => '#3B82F6',
        'table_name'  => '',
    ], $atts);

    $table_name = sanitize_title($atts['table_name']);

    if (empty($table_name)) {
        return '<p class="comments-no-data">Table name is required.</p>';
    }

    $comments = get_comments([
        'status'     => 'approve',
        'meta_value' => $table_name,
        'order'      => 'ASC',
    ]);


    if (empty($comments)) {
        return '<p class="comments-no-data">No data found for "' . esc_html($atts['table_name']) . '"</p>';
    }

    $output = '<table class="special-table" data-type="' . sanitize_title($table_name) . '">';
    $output .= '<thead>
 
        <th colspan="3" style="background-color:' . esc_attr($atts['table_color']) . ' ;text-align:center;">' . esc_html($atts['table_name']) . '</th>
    <tr>';


    $headers = ['User Name', 'Email', 'Message'];

    foreach ($headers as $header) {
        $output .= '<th style="background-color:' . esc_attr($atts['table_color']) . '">' . esc_html($header) . '</th>';
    }

    $output .= '</tr></thead><tbody>';


    foreach ($comments as $comment) {
        $output .= '<tr>';
        $output .= '<td>' . esc_html($comment->comment_author) . '</td>';
        $output .= '<td>' . esc_html($comment->comment_author_email) . '</td>';
        $output .= '<td>' . esc_html($comment->comment_content) . '</td>';
        $output .= '</tr>';
    }

    $output .= '</tbody></table>';
    return $output;
}
