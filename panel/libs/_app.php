<?php
// App 

//Botões de Redes Sociais
function dm_redeSociais(){
    $url = get_permalink();
    $title = get_the_title();
  
    $button = '<ul class="inline-list">';
    //twitter
    $button .= sprintf('<li><a href="http://twitter.com/share?url=%s" target="_blank" class="share-btn twitter"><i class="fa fa-twitter"></i></a></li>', $url, $title);
    //facebook
    $button .= sprintf('<li><a href="http://www.facebook.com/sharer/sharer.php?u=%s" target="_blank" class="share-btn facebook"><i class="fa fa-facebook"></i></a></li>', $url);
    //google plus
    $button .= sprintf('<li><a href="https://plus.google.com/share?url=%s" target="_blank" class="share-btn google-plus"><i class="fa fa-google-plus"></i></a></li>', $url);
    //linkedin
    $button .= sprintf('<li><a href="http://www.linkedin.com/shareArticle?url=%s" target="_blank" class="share-btn linkedin"><i class="fa fa-linkedin"></i></a></li>', $url);
    $button .= '</ul>';
    echo $button;
  }
  //shortcode para embed do youtube
  function dm_youtubesc( $atts, $content = null ) {
    extract(shortcode_atts(array(
      'id' => '',
    ), $atts ) );
    $resultado = '<div class="flex-video"><iframe src="//www.youtube.com/embed/'.$id.'" allowfullscreen="" frameborder="0"></iframe></div>';
    return $resultado;
  }
  add_shortcode('youtube', 'dm_youtubesc');

  //Campos extra para perfil
function dm_campoextrauser($user){
    ?>
    <h3>Configurações de publicidade</h3>
    <table class="form-table">
      <tr>
        <th><label class="adtopopost">Anúncio Topo Posts</label></th>
        <td>
          <textarea class="regular-text" rows="5" name="adtopopost" id="adtopopost"><?php echo esc_attr(get_the_author_meta('adtopopost', $user->ID)); ?></textarea><br />
          <samp class="description">Anúncio de 300X250 (ou responsivo) que será exibido no Topo de cada post.</samp>
        </td>
      </tr>
      <tr>
        <th><label class="adrodapepost">Anúncio Rodapé Posts</label></th>
        <td>
          <textarea class="regular-text" rows="5" name="adrodapepost" id="adrodapepost"><?php echo esc_attr(get_the_author_meta('adrodapepost', $user->ID)); ?></textarea><br />
          <samp class="description">Anúncio de 300X250 (ou responsivo) que será exibido no rodapé de cada post.</samp>
        </td>
      </tr>
    </table>
  
    <?php 
  }
  add_action('show_user_profile', 'dm_campoextrauser');
  add_action('edit_user_profile', 'dm_campoextrauser');
  
  //salva os campo do user
  function dm_campoextrausersalva($user_id){
    if (!current_user_can('edit_user', $user_id)) return FALSE;
    update_user_meta($user_id, 'adtopopost', $_POST['adtopopost']);
    update_user_meta($user_id, 'adrodapepost', $_POST['adrodapepost']);
  }
  add_action('personal_options_update', 'dm_campoextrausersalva');
  add_action('edit_user_profile_update', 'dm_campoextrausersalva');
  
  //salva os social do user
  function dm_userlink($linkscontato){
    $linkscontato['facebook'] = 'Facebook';
    $linkscontato['twitter'] = 'Twitter';
    $linkscontato['linkedin'] = 'LinkedIn';
    $linkscontato['googleplus'] = 'Google Plus';
    $linkscontato['instagram'] = 'Instagram';
    
    return $linkscontato;
  }
  add_filter('user_contactmethods', dm_userlink, 10, 1);