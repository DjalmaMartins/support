<?php 
//Modulo de Manutenção
function dm_manutencao(){
  if (!current_user_can('publish_posts') || !is_user_logged_in()):
    global $theme_title;
    echo '
          <!doctype html>
          <html lang="pt-br">
          <head>
          <meta charset="UTF-8" />
          <title>' .$theme_title. '</title>
          <style type="text/css">
            html, body{
              height: 99%;      
              background: -webkit-linear-gradient(51deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
              background: -o-linear-gradient(51deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
              background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
              color: white;
              opacity: 0.95;
                }
              .contentsite{
                max-width: 1200px;
                margin: 0 auto;
                text-align:center;    
              }

               .contentsite span{
                text-align:center; 
                margin-top:100px;
                border: 1px solid #FFFFFF;
                color: #fff;
                text-transform: uppercase;
                padding: 20px 30px;
                display: inline-block;
              }     

          </style>
          </head>
          <body>
          <div class="contentsite"><span>'.dm_get_option('msgmanutecao').'</span></div>
          </body>
          </html>   
    ';
    die();
  endif;
}
if(dm_get_option('modomanutencao')) add_action('get_header', 'dm_manutencao');

?>