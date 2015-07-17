<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <?php echo "
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=ISO-8859-1\">
        <meta http-equiv=\"pragma\" content=\"no-cache\" /><!-- N?o deixar arquivos no cache -->
        <meta http-equiv=\"Content-Language\" content=\"pt-BR\" /><!-- Idioma padr?o-->
        <meta http-equiv=\"expires\" content=\"0\" /><!-- For?a uma nova checagem a cada visita do rob? de busca -->
        <meta http-equiv=\"imagetoolbar\" content=\"no\" /><!-- Elimina a barra de op??es que aparece ao passarmos o mouse por cima de uma imagem no Internet Explorer-->
        <meta name=\"revisit-after\" content=\"7 days\" /><!-- Refaz o cache da p?gina depois de 7 dias em servidores proxy -->
              <meta name=\"rating\" content=\"General\" /><!-- Classificar a p?gina por censura \"Para qualquer idade\" -->
        <meta name=\"author\" content=\"Marlon Jean Ferri\" /><!-- O nome do autor da p?gina -->
              <meta name=\"DC.title\" content=\"$tituloSite\" /> <!-- T?tulo do site -->
        <meta name=\"DC.subject\" lang=\"pt\" content=\"$fraseConteudo\" /><!-- Frase sobre o conte?do do site -->
        <meta name=\"DC.description\" lang=\"pt\" content=\"$descricaoSite\" /><!-- Descri??o do conte?do do site em aproximadamente 20 palavras -->
        <meta name=\"DC.identifier\" scheme=\"DCTERMS.URI\" content=\"" . URL . "\" /><!-- URL do site -->
              <meta name=\"Abstract\" content=\"$fraseConteudo\" /><!-- Frase sobre o conte?do do site -->
        <meta name=\"description\" content=\"$descricaoSite\" /><!-- Descri??o do conte?do do site em aproximadamente 20 palavras -->
        <meta name=\"keywords\" content=\"$palavrasChave\" /><!-- Palavras-chave -->
        <meta name=\"robots\" content=\"all\" /><!-- Robots de todas as p?ginas -->
                ";
        //<meta name=\"ICBM\" content=\"$lat_lon\" /><!-- Coordenadas do endere?o do cliente 
        ?>
        
        <link rel="icon" href="<?php echo URL; ?>/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo URL; ?>/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo URL; ?>/favicon.ico" type="image/vnd.microsoft.icon">
        
        <script type="text/javascript" src="<?php echo URL; ?>/js/cross.browser.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>/js/jquery.js"></script>