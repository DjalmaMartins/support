<?php 
//Gera os titulos
function dm_titulos(){
if(!dm_get_option('seotitulos')) return wp_title('', FALSE, 'right');
	global $nome_site;
		if(is_home()):
		  return $nome_site.' | '.get_bloginfo('description');
		else:
		  return wp_title('', false, 'right').' | '.$nome_site;
 endif;
}

//Tags como keywords SEO

function dm_tagtokeyword(){  
    if(is_single() || is_page()):
    global $post;  
        $tags = wp_get_post_tags($post->ID); 
        $tag_array = NULL; 
        foreach($tags as $tag):  
            $tag_array[] = $tag->name;  
        endforeach;
    if(sizeof($tag_array)>0):  
          $tag_string = implode(', ',$tag_array);  
          if($tag_string !== ''):  
              echo '<meta name="keywords" content="'.$tag_string.'" />'."\r\n";  
      endif;
    endif;  
  endif;  
}
if(dm_get_option('seokeywords')) add_action('wp_head','dm_tagtokeyword');


//Remove as words do slug dos posts ao salvar
//remove stop words do slug dos posts ao salvar
function dm_removestopwords($data, $postarray){
  if($data['post_status'] != 'publish'):
    $data['post_name'] = sanitize_title($data['post_title']);
    
    $slug = explode('-', $data['post_name']);
    $stopwords = array('a', 'agora', 'ainda', 'alguem', 'algum', 'alguma', 'algumas', 'alguns', 'ampla', 'amplas', 'amplo', 'amplos', 'ante', 'antes', 'ao', 'aos', 'apos', 'aquela', 'aquelas', 'aquele', 'aqueles', 'aquilo', 'as', 'ate', 'atraves',
    'cada', 'coisa', 'coisas', 'com', 'como', 'contra', 'contudo',
    'da', 'daquele', 'daqueles', 'das', 'de', 'dela', 'delas', 'dele', 'deles', 'depois', 'dessa', 'dessas', 'desse', 'desses', 'desta', 'destas', 'deste', 'deste', 'destes', 'deve', 'devem', 'devendo', 'dever', 'devera', 'deverao', 'deveria', 'deveriam', 'devia', 'deviam', 'disse', 'disso', 'disto', 'dito', 'diz', 'dizem', 'do', 'dos',
    'e', 'ela', 'elas', 'ele', 'eles', 'em', 'enquanto', 'entre', 'era', 'essa', 'essas', 'esse', 'esses', 'esta', 'estamos', 'estao', 'estas', 'estava', 'estavam', 'estavamos', 'este', 'estes', 'estou', 'eu',
    'fazendo', 'fazer', 'feita', 'feitas', 'feito', 'feitos', 'foi', 'for', 'foram', 'fosse', 'fossem',
    'grande', 'grandes', 'ha', 'isso', 'isto', 'ja', 'la', 'lhe', 'lhes', 'lo',
    'mas', 'mais', 'me', 'mesma', 'mesmas', 'mesmo', 'mesmos', 'meu', 'meus', 'minha', 'minhas', 'muita', 'muitas', 'muito', 'muitos',
    'na', 'nao', 'nas', 'nem', 'nenhum', 'nessa', 'nessas', 'nesta', 'nestas', 'ninguem', 'no', 'nos', 'nos', 'nossa', 'nossas', 'nosso', 'nossos', 'num', 'numa', 'nunca',
    'o', 'os', 'ou', 'outra', 'outras', 'outro', 'outros',
    'para', 'pela', 'pelas', 'pelo', 'pelos', 'pequena', 'pequenas', 'pequeno', 'pequenos', 'per', 'perante', 'pode', 'pude', 'podendo', 'poder', 'poderia', 'poderiam', 'podia', 'podiam', 'pois', 'por', 'porem', 'porque', 'posso', 'pouca', 'poucas', 'pouco', 'poucos', 'primeiro', 'primeiros', 'propria', 'proprias', 'proprio', 'proprios',
    'quais', 'qual', 'quando', 'quanto', 'quantos', 'que', 'quem',
    'sao', 'se', 'seja', 'sejam', 'sem', 'sempre', 'sendo', 'sera', 'serao', 'ser', 'seu', 'seus', 'si', 'sido', 'so', 'sob', 'sobre', 'sua', 'suas',
    'talvez', 'tambem', 'tampouco', 'te', 'tem', 'tendo', 'tenha', 'ter', 'teu', 'teus', 'ti', 'tido', 'tinha', 'tinham', 'toda', 'todas', 'todavia', 'todo', 'todos', 'tu', 'tua', 'tuas', 'tudo',
    'ultima', 'ultimas', 'ultimo', 'ultimos', 'um', 'uma', 'umas', 'uns', 'vai', 'vendo', 'ver', 'vez', 'vindo', 'vir', 'voce', 'voces', 'vos', 'vou');     
    foreach ($slug as $sl => $word):
      if(in_array($word, $stopwords)) unset($slug[$sl]);
    endforeach;   
    $data['post_name'] = implode('-', $slug);
  endif;
  return $data;
}
if(dm_get_option('seostopwords')) add_filter('wp_insert_post_data', 'dm_removestopwords', 100, 2);

//limpa do wp_head removendo tags desnecessárias
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

//remove smart quotes  
remove_filter('the_title', 'wptexturize');
remove_filter('the_content', 'wptexturize');
remove_filter('the_excerpt', 'wptexturize');
remove_filter('comment_text', 'wptexturize');
remove_filter('list_cats', 'wptexturize');
remove_filter('single_post_title', 'wptexturize');

//gera um resumo do post
function dm_resumopost($words=40, $link_text='continue lendo &raquo', $allowed_tags = '', $before='<p>', $after='</p>', $echo=TRUE, $idpost=0){
  if($idpost > 0):
    $post = get_post($idpost);
  else:
    global $post;
  endif;
  if ( $allowed_tags == 'all' ) $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>,<img>';
  $text = preg_replace('/\[.*\]/', '', strip_tags($post->post_content, $allowed_tags));

  $text = explode(' ', $text);
  $tot = count($text);
  if ($tot < $words) $words = $tot;
  $output = '';
  for ($i=0; $i<$words; $i++): $output .= $text[$i] . ' '; endfor;
  $retorno = $before;
  $retorno .= force_balance_tags(rtrim($output));
  if ($i < $tot) $retorno .=  '...';
  if ($link_text != '') $retorno .=  ' <a href="'.get_permalink().'" title="'.get_the_title().'">'.$link_text.'</a>';
  $retorno .=  $after;
  if ($echo == TRUE):
    echo $retorno;
  else:
    return $retorno;
  endif;
}
