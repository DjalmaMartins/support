<?php 
$nome_app = 'Opções do Tema';
$prefix_app = 'dm_';
global $theme_dir;
$path_app = $theme_dir.'panel/';

if(is_admin()):
    // Opções do tema para configuração
    $display = array(
        array(
            'nome' => $nome_app,
            'tipo' => 'titulo',
        ),
        
        //Manutenção
		array(
			'nome' => 'Manutenção',
			'tipo' => 'sessao',
		),	
		array(
			'tipo' => 'abrir',
		),
		
		array(
			'nome' => 'Habilitar o modo de manutenção',
			'tipo' => 'checkbox',
			'desc' => 'Marque para ativar o modo de manutenção.',
			'id'   => $prefix_app.'modomanutencao',
			
		),
		
		array(
			'nome' => 'Mensagem de manutenção',
			'tipo' => 'textarea',
			'desc' => 'Mensagem que será exibida aos visitantes quando o site estiver em manutenção.',
			'id'   => $prefix_app.'msgmanutecao',
			
		),
		
		array(
			'nome' => 'Copyright ©',
			'tipo' => 'text',
			'desc' => 'É um direito autoral, a propriedade literária.',
			'id'   => $prefix_app.'copyright',
			
		),		
			
		array(
			'tipo' => 'fechar',
		),

		// Redes sociais

		array(
			'nome' => 'Redes sociais',
			'tipo' => 'sessao',
		),	
		array(
			'tipo' => 'abrir',
		),
		
		array(
			'nome' => 'RSS',
			'tipo' => 'text',
			'desc' => 'Link para seu feed RSS',
			'id'   => $prefix_app.'rssurl',
			'std'  => get_bloginfo('rss2_url'),
		),
		
		array(
			'nome' => 'RSS via email',
			'tipo' => 'text',
			'desc' => 'Link para inscrição via email em seu feed RSS',
			'id'   => $prefix_app.'rssemail',
		),
		
		array(
			'nome' => 'Facebook',
			'tipo' => 'text',
			'desc' => 'Link para seu perfil no Facebook',
			'id'   => $prefix_app.'facebook',
			'std'  => 'http://www.facebook.com',
        ),

		array(
			'nome' => 'Page Facebook',
			'tipo' => 'text',
			'desc' => 'Link para a sua página no Facebook',
			'id'   => $prefix_app.'page_facebook',
			'std'  => 'http://www.facebook.com',
		),
		
		array(
			'nome' => 'Twitter',
			'tipo' => 'text',
			'desc' => 'Link para a sua página no Twitter',
			'id'   => $prefix_app.'twitter',
			'std'  => 'http://www.twitter.com',
		),
		
			array(
			'nome' => 'YouTube',
			'tipo' => 'text',
			'desc' => 'Link para a sua página no YouTube',
			'id'   => $prefix_app.'youtube',
			'std'  => 'http://www.youtube.com',
		),
			
		array(
			'tipo' => 'fechar',
        ),
        
		//Dados
		array(
			'nome' => 'Informações',
			'tipo' => 'sessao',
		),	
		array(
			'tipo' => 'abrir',
		),
		
		
		
		array(
			'nome' => 'Telefone:',
			'tipo' => 'text',
			'desc' => 'Telefone pricipal para contato.',
			'id'   => $prefix_app.'telefone',
			
		),
		
		array(
			'nome' => 'E-mail:',
			'tipo' => 'text',
			'desc' => 'E-mail para contato.',
			'id'   => $prefix_app.'email',
			
		),
        
        array(
			'nome' => 'Endereço:',
			'tipo' => 'text',
			'desc' => 'Endereço do estabelecimento.',
			'id'   => $prefix_app.'end',
			
		),
        
        array(
			'nome' => 'Google Map',
			'tipo' => 'textarea',
			'desc' => 'Exibido mapa.',
			'id'   => $prefix_app.'googlemap',
			
		),
			
		array(
			'tipo' => 'fechar',
		),

	
		//Configurações
		array(
			'nome' => 'Configurações SEO',
			'tipo' => 'sessao',
		),	
		array(
			'tipo' => 'abrir',
		),
		
		array(
			'nome' => 'Titulos Personalizados',
			'tipo' => 'checkbox',
			'desc' => 'Marque para gerar títulos amigáveis.',
			'id'   => $prefix_app.'seotitulos',
			
		),
		
		array(
			'nome' => 'Tags como Keywords',
			'tipo' => 'checkbox',
			'desc' => 'Marque para adicionar as tags dos posts como Keywords (Palavras-chave).',
			'id'   => $prefix_app.'seoKeywords',
			
		),
		
		array(
			'nome' => 'Remover stopwords das URLs',
			'tipo' => 'checkbox',
			'desc' => 'Marque para remover palavras de parada das URLs.',
			'id'   => $prefix_app.'seostopwords',
			
		),
		
		array(
			'nome' => 'Google Analytics',
			'tipo' => 'textarea',
			'desc' => 'Insira o código do Google Analytics para monitorar se site.',
			'id'   => $prefix_app.'analytics',
			
		),
			
		array(
			'tipo' => 'fechar',
		),
    );

    //Return Save
    function dm_display(){
        global $prefix_app, $display, $path_app;
        if(isset($_GET['saved']) && $_GET['saved'] == 'true'):
            echo '<div class="updated fade"><p><strong>Configurações salvas com sucesso!</strong></p></div>';
        endif;
    //Página de opções
?>
<div class="wrap dm-wrap">
    <form method="post">
        <h1 class="wp-heading-inline">Opções do Tema</h1>
        <hr class="wp-header-end">

        <div class="content">
        <div class="tabs-content">
		<?php	
        $i = 0;
        foreach($display as $item):
        switch($item['tipo']):
            case 'titulo':
            echo '<div class="tabs-menu clearfix">
            <ul>';
            break;
            case 'sessao':
            $i++;
        ?>
		<li><a class="tab-menu <?php if($i == 1) echo "active-tab-menu"; ?>" href="#" data-tab="tab<?php echo $i; ?>"><?php echo $item['nome']; ?></a></li>
        <?php  
			break;
			endswitch;
			endforeach;
		?>
	      	</ul>
	    	</div> <!-- tabs-menu -->
        <?php
		$i = 0;
        foreach($display as $item):
            switch($item['tipo']):
			case 'sessao':
			$i++;
		break;
		case 'abrir':
		echo '<div class="tab'. $i . ' tabs dm-opts">
        <span class="submit"><input type="submit" value="Salvar Mudanças" name="save'. $i . '" /></span>';
		break;
		case 'fechar':
		echo '</div>';
		break;
		case 'text':
		?>
        <div class="dm-input">
			<label><?php echo $item['nome']; ?></label>
			<input name="<?php echo $item['id']; ?>" type="text" value="<?php echo dm_get_config($item); ?>" />
			<small><?php echo $item['desc']; ?></small>
			<div class="clearfix"></div>
		</div>
		<?php  
		break;
		case 'select':
		?>
		<div class="dm-input">
			<label><?php echo $item['nome']; ?></label>
			<select name="<?php echo $item['id']; ?>">
				<?php foreach ($item['options'] as $opcao): ?>
					<option <?php if (dm_get_config($item) == $opcao) echo 'selected="selected"' ?>><?php echo $opcao; ?></option>
				<?php endforeach;?>
			</select>
			<small><?php echo $item['desc']; ?></small>
			<div class="clearfix"></div>
		</div>
		<?php  
		break;
		case 'checkbox':
		?>
        <div class="dm-input">
			<label><?php echo $item['nome']; ?></label>
			<input name="<?php echo $item['id']; ?>" type="checkbox" value="True" <?php if (dm_get_config($item)) echo 'checked="checked"' ?> />
			<?php echo $item['desc']; ?>
			<div class="clearfix"></div>
		</div>
		<?php  
		break;
		case 'textarea':
		?>
        <div class="dm-input">
			<label><?php echo $item['nome']; ?></label>
			<textarea name="<?php echo $item['id']; ?>"><?php echo dm_get_config($item);  ?></textarea>
			<small><?php echo $item['desc']; ?></small>
			<div class="clearfix"></div>
		</div>
		<?php  
		break;
		endswitch;
		endforeach;
		?>
        </div> <!-- .tabs -->
		</div> <!-- .content -->
		<input name="action" type="hidden" value="save" />  
    </form>
</div>
<?php
}
    //Salva as opções no BD do panel
    function dm_save(){
        global $prefix_app, $display, $nome_app;
        if (isset($_GET['page']) && $_GET['page'] == 'option'):
            if (isset($_POST['action']) && $_POST['action'] = 'save'):
                foreach ($display as $item):
                    if(isset($item['id']) && $_POST[$item['id']] != ''):
                        update_option($item['id'],
                        $_POST[$item['id']]);
                    elseif (isset($item['id']) &&
                    $_POST[$item['id']] == ''):
                        delete_option($item['id']);
                    endif;
                endforeach;
                header("Location: admin.php?page=option&saved=true");
                die;
            endif;
        endif;
    add_theme_page($nome_app, $nome_app, 'administrator', 'option', 'dm_display');
    }
    add_action('admin_menu', 'dm_save');

    //CSS e JS
    function dm_script(){
        global $path_app;
        wp_register_style('css-admin', $path_app.'assets/css/style.css', array(), '1.0', 'all');
        wp_register_script('js-admin', $path_app.'assets/js/script.js', array(), '1.0');
        wp_enqueue_style('css-admin');
        wp_enqueue_script('js-admin');
    }
	add_action('admin_init', 'dm_script');
endif;
    //Recebe as configurações
    function dm_get_config($item=null, $getstd=TRUE){
        if(is_array($item) && sizeof($item)>0):
            $output = stripslashes(get_option($item['id']));
            if($output == '' & $getstd == TRUE && isset($item['std'])):
                $output = $item['std'];
            endif;
            return $output;
        endif;
        return NULL;
    }
    //Recebe as configurações do BD
    function dm_get_option($nome=NULL){
        if ($nome != NULL):
            global $prefix_app;
            $output = get_option($prefix_app.$nome);
            if($output != '') return stripcslashes($output);
        endif;
        return FALSE;
    }
?>