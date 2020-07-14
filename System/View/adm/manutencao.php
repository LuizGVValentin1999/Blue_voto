<?php
if(@$_POST['ENVIAR']){

    include ('System/App/php/manutencao.php');
    switch ($_POST['ENVIAR']) {
        case "1":
            manutencaoresult(@$_POST['resultado']);
            break;
        case "2":    
            manutencaopesquisa(@$_POST['pesquisa']);
            break;
        case "3":
            manutencaozona(@$_POST['zona']);
            break;
        case "4":
            manutencaocandidato(@$_POST['candidato']);
            break;
        case "5":
            manutencaousuario(@$_POST['usuario']);
            break;
        case "6":
            baixar($_POST['ANO']);
            break;    
       
                        
    }
    

}

?>

<form action="" method="POST">
<h1>Manutenção de arquivo </h1>

<h3> coloque o arquivo de resultado da eleição</h3>
<input name='resultado' type="file" accept=".csv" />
<button type="submit" value="1" name="ENVIAR">Enviar</button>
<h3> coloque o arquivo de resultado de pesquisa</h3>
<input name="pesquisa" type="file" />
<button type="submit" value="2" name="ENVIAR">Enviar</button>
<h3> coloque o arquivo de zona </h3>
<input name="zona" type="file" />
<button type="submit" value="3" name="ENVIAR">Enviar</button>
<h3> coloque o arquivo de candidato para nova pesquisa </h3>
<input name="candidato" type="file" />
<button type="submit" value="4" name="ENVIAR">Enviar</button>
<h3> coloque o arquivo de usuario </h3>
<input name="usuario" type="file" />
<button type="submit" value="5" name="ENVIAR">Enviar</button>
<h3> BAIXAR INFORMAÇÕES DE RESULTADO </h3>
<select class="select-grafico"name="ANO" id="demo-category" style="width: 367px;">
			<option  value="" >Todos</option>
                    <option value="<?= @$_POST['ANO']?@$_POST['ANO']:''?>" hidden selected>- <?= @$_POST['ANO']?'ANO: '.@$_POST['ANO']:'ANO' ?> -</option>
                    
	            	<?php
                        $anos =  mysqli_query($con, "SELECT ANO FROM periodo_eleitoral GROUP BY ANO");
                        while(@$ano = mysqli_fetch_array($anos)) {
                        ?>
	            		    <option value="<?php echo $ano['ANO']; ?>" ><?php echo $ano['ANO']; ?></option>
                        
                        <?php } ?>
            </select>
<button type="submit" value="6" name="ENVIAR">Enviar</button>
</form>
