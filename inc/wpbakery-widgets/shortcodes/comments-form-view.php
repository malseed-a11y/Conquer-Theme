<?php
add_shortcode('comments_form', 'comments_form_shortcode');
function comments_form_shortcode($atts)

{

    $atts = shortcode_atts([
        'title' => '',
        'button_name' => ''
    ], $atts);



    $out = '<div class="special-form-wrapper">
    <h2 class="special-title">' . $atts['title'] . '</h2>
    <form class="special-form"  method="post" >
         <input type="hidden" name="table_name" value="' . sanitize_title($atts['title']) . '">

        <div class="form-group">
            <label for="username">User Name</label>
            <input type="text" id="username" name="username"
               
                required>
        </div>

      
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                "
                required>
        </div>

       
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" required> </textarea>
        </div>
        <button id="special-form-submit" type="submit">' . $atts['button_name'] . '</button>
    </form></div>';
    return $out;
}
