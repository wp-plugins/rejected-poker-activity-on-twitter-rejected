<?php
  /*
   * Plugin Name: Poker Activity on Twitter
   * Version: 1.0
   * Plugin URI:http://www.onlinemarketing.eu
   * Description: Displays the latest Twitter activity for the query "poker".
   * Author: Web Marketing Solutions
   * Author URI: http://www.webmsol.com
   */
  class PokerActivityOnTwitter extends WP_Widget {
    
    // Initialize this widget.
    //
    function PokerActivityOnTwitter() {
      $widget_options = array();
      $control_option = array();
      
      // The first argument is the value that WordPress will use to generate
      // HTML ID values and references in URIs.
      //
      // Examples:
      //  <div id='widget-7_poker_activity_on_twitter-__i__'>
      //  <a href="/wp-admin/widgets.php?editwidget=poker_activity_on_twitter-2&#038;addnew=1&#038;num=3&#038;base=poker_activity_on_twitter">
      //
      // The second argument is the value that will be displayed to the user
      // as the title of the widget when they visit their
      // "wp-admin/widgets.php" page.
      //
      // I have not figured out what the last two arguments are for.
      //
      $this->WP_Widget('poker_activity_on_twitter', 'Poker Activity on Twitter', $widget_options, $control_option);
    }
   
    // Displays the widget.
    //
    function widget($args, $instance) {
      $poker_activity_on_twitter = file_get_contents('http://winchester.webmsol.com/tweets/poker/' . $instance['tweet_count'] . '/' . $instance['stylesheet']);
      echo $poker_activity_on_twitter;
    }

    // Save changes to the widget.
    //
    function update($updated_attributes, $instance) {
      $instance['stylesheet'] = $updated_attributes['stylesheet'];
      $instance['tweet_count'] = $updated_attributes['tweet_count'];
      
      return $instance;
    }

    // Displays a form to edit the widget.
    //
    function form($instance) {
      // Do something that infuses the $instance variable with previously saved
      // options.
      $instance = wp_parse_args((array) $instance, array('stylesheet' => '', 'tweet_count' => ''));
      
      // Literally break out of a function within a class to echo HTML. Way to
      // go WordPress, way to go.
      
      ?>
      
        <p>Number of tweets to display:<br />
          <select name="<?php echo $this->get_field_name('tweet_count') ?>">
            <option value="1" <?php if($instance['tweet_count'] == 1) echo 'selected="true"'; ?>>1</option>
            <option value="2" <?php if($instance['tweet_count'] == 2) echo 'selected="true"'; ?>>2</option>
            <option value="3" <?php if($instance['tweet_count'] == 3) echo 'selected="true"'; ?>>3</option>
            <option value="4" <?php if($instance['tweet_count'] == 4) echo 'selected="true"'; ?>>4</option>
            <option value="5" <?php if($instance['tweet_count'] == 5) echo 'selected="true"'; ?>>5</option>
            <option value="6" <?php if($instance['tweet_count'] == 6) echo 'selected="true"'; ?>>6</option>
            <option value="7" <?php if($instance['tweet_count'] == 7) echo 'selected="true"'; ?>>7</option>
            <option value="8" <?php if($instance['tweet_count'] == 8) echo 'selected="true"'; ?>>8</option>
            <option value="9" <?php if($instance['tweet_count'] == 9) echo 'selected="true"'; ?>>9</option>
            <option value="10" <?php if($instance['tweet_count'] == 10) echo 'selected="true"'; ?>>10</option>
            <option value="11" <?php if($instance['tweet_count'] == 11) echo 'selected="true"'; ?>>11</option>
            <option value="12" <?php if($instance['tweet_count'] == 12) echo 'selected="true"'; ?>>12</option>
            <option value="13" <?php if($instance['tweet_count'] == 13) echo 'selected="true"'; ?>>13</option>
            <option value="14" <?php if($instance['tweet_count'] == 14) echo 'selected="true"'; ?>>14</option>
            <option value="15" <?php if($instance['tweet_count'] == 15) echo 'selected="true"'; ?>>15</option>
          </select></p>
      
        <p>
          <input type="radio" name="<?php echo $this->get_field_name('stylesheet') ?>" value="standard" <?php if($instance['stylesheet'] == 'standard') echo 'checked="true"'; ?> /> Standard styling<br />
          <input type="radio" name="<?php echo $this->get_field_name('stylesheet') ?>" value="custom" <?php if($instance['stylesheet'] == 'custom') echo 'checked="true"'; ?> /> Custom styling
        </p>
        
        <p>If you select "Custom styling", you must write your own styles within the appropriate WordPress stylesheet.</p>
        <p style="font-size: 12px;">Available classes to style:<br />
          .poker_activity_on_twitter<br />
          .poker_activity_on_twitter_list<br />
          .poker_activity_on_twitter_list_item</p>
        
      <?php
      
    }
    
  }

  function PokerActivityOnTwitterInit() {
		register_widget('PokerActivityOnTwitter');
	}
  
	add_action('widgets_init', 'PokerActivityOnTwitterInit');
	
	// Let us know you activated or deactivated our plugin. Thanks!

  function activate_poker_activity_on_twitter() {
    update_option('poker_activity_on_twitter_installed', '1');
    file_get_contents('http://winchester.onlinemarketing.eu/installations/create?installation[uri]=' . urlencode($_SERVER['SERVER_NAME']) . '&installation[activity]=activate&installation[plugin_or_widget_name]=' . urlencode('Poker Activity on Twitter'));
  }
  
  function deactivate_poker_activity_on_twitter() {
    update_option('poker_activity_on_twitter_installed', '0');
    file_get_contents('http://winchester.onlinemarketing.eu/installations/create?installation[uri]=' . urlencode($_SERVER['SERVER_NAME']) . '&installation[activity]=deactivate&installation[plugin_or_widget_name]=' . urlencode('Poker Activity on Twitter'));
  }

  register_activation_hook(__FILE__, 'activate_poker_activity_on_twitter');
  register_deactivation_hook(__FILE__, 'deactivate_poker_activity_on_twitter');

?>