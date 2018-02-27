<?php
/*
Options panel for Amp Custom Layer Admin Page
*/
add_action( 'admin_menu', 'amp_custom_layer_menu' );

/** Step 1. Add Menu*/
function amp_custom_layer_menu() {
	add_menu_page(
    'AMP Custom Layer Options',
    'AMP Custom Layer Options',
    'manage_options',
    'amp-custom-layer-options',
    'amp_custom_layer_options',
    plugins_url('/amp-custom-layer/assets/images/icon.png')
  );
}

function amp_custom_layer_options() {
  //variables for the field
  $option_googleanalytics = 'googleanalytics';
  $option_adsenseclient = 'adsenseclient';
  $option_adsenseslot = 'adsenseslot';
  $option_schemaurl = 'schemaurl';

  //option names
  $hidden_field_name = 'mt_submit_hidden';


  // Read in existing option value from database
  $option_googleanalytics_val = get_option( $option_googleanalytics );
  $option_adsenseclient_val = get_option( $option_adsenseclient );
  $option_adsenseslot_val = get_option( $option_adsenseslot );
  $option_schemaurl_val = get_option( $option_schemaurl);


  // See if the user has posted us some information
  // If they did, this hidden field will be set to 'Y'
  if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' )
  {
      // Read their posted value
      $option_googleanalytics_val =  $_POST[ 'googleanalytics' ];
      $option_adsenseclient_val = $_POST[ 'adsenseclient' ];
      $option_adsenseslot_val = $_POST[ 'adsenseslot' ];
      $option_schemaurl_val = $_POST[ 'schemaurl' ];
  }

    // Save the posted value in the database
    update_option( $option_googleanalytics, $option_googleanalytics_val );
    update_option( $option_adsenseclient, $option_adsenseclient_val );
    update_option($option_adsenseslot, $option_adsenseslot_val);
    update_option($option_schemaurl, $option_schemaurl_val);

    // Put a "settings saved" message on the screen
?>
<div class="updated"><p><strong><?php _e('settings saved.', 'menu-test' ); ?></strong></p></div>

<div class="wrap">
  <h1>AMP Custom Layer Settings</h1>
    <form name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y"/>
        <label>Google Analytics Pub ID</label>
        <input type="text" name="googleanalytics" value="<?php echo $option_googleanalytics_val; ?>"/>
        <br>
        <label>Google Adsense data-ad-client</label>
        <input type="text" name="adsenseclient" value="<?php echo $option_adsenseclient_val; ?>"/>
        <br>
        <label>Google Adsense data-ad-slot</label>
        <input type="text" name="adsenseslot" value="<?php echo $option_adsenseslot_val; ?>"/>
        <br>
        <label>Schema Data Image URL</label>
        <input type="text" name="schemaurl" value="<?php echo $option_schemaurl_val; ?>"/>
        <br>
      <div class="submit">
        <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
      </div>
    </form>
</div>

<?php
}
