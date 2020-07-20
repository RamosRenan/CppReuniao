<?php
    echo 'opaaaaaa';
    $URL_ATUAL        = $_SERVER[ 'HTTP_REFERER'];  //$request->input('URL_ATUAL');

    echo "<div align='center'> 
    <span style='position:relative; top: 100px; color:#d3d3d3;'> 
        <span style='font-size:52px;'>&#9888;</span> <br>
        <h3>
        Não é possível inserir mesmo número de eProtocolo na tabela DELIBERAÇÃO. <br>
        Iconsistência, mesmo número de eProtocolo para diversas deliberações. 
        </h3>
        <small style='color:#a5a5a5'> 
            <a href=".'http://'.$URL_ATUAL."> Volte a Página para seguir o ciclo da votação. </a>                          
        </small>
    </span>
    </div>";
?>