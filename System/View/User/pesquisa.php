<section id="main" class="wrapper">
	<div class="inner">
        <section>
			<h2>Pesquisa</h2>
			<form method="post" action="home">
				<div class="row gtr-uniform">
					<div class="col-6 col-12-xsmall">
						<input type="text" name="NOME" id="demo-name" value="" placeholder="Nome" />
                    </div>
                    <div class="col-6 col-12-small">
						<input type="radio" id="demo-priority-low" name="SEXO">
						<label for="demo-priority-low">Masculino</label>
						<input type="radio" id="demo-priority-normal" name="SEXO">
						<label for="demo-priority-normal">Feminino</label>
						<input type="radio" id="demo-priority-high" name="SEXO" checked>
						<label for="demo-priority-high">Não Informar</label>
					</div>
                    <div class="col-6 col-12-xsmall">
						<select name="FAIXA" id="demo-category">
							<option value="<?= @$_POST['FAIXA']?@$_POST['FAIXA']:''?>" hidden>- <?= @$_POST['FAIXA']?'FAIXA: '.@$_POST['FAIXA']:'FAIXA ETÁRIA' ?> -</option>
                        <?php
                        $faixas =  mysqli_query($con, "SELECT * FROM faixa_etaria");
                        while(@$faixa = mysqli_fetch_array($faixas)) {
                        ?>
	            		    <option value="<?php echo $faixa['COD_FAIXA_ETARIA']; ?>" ><?php echo $faixa['FAIXA_ETARIA']; ?></option>
                        
                        <?php } ?>
						</select>
                    </div>
                    <div class="col-6 col-12-xsmall">
					<select class="select-grafico" name="GRAU_ESC" >
                    
	            	<?php
                        $grau_escs =  mysqli_query($con, "SELECT * FROM grau_esc");
                        while(@$grau_esc = mysqli_fetch_array($grau_escs)) {
                            if(@$_POST['GRAU_ESC'] == $grau_esc['ID_GRAU_ESC'] ){
                                $_grau_esc = $grau_esc['GRAU_ESC'];
                            }
                        ?>
	            		    <option  value="<?php echo $grau_esc['ID_GRAU_ESC']; ?>" ><?php echo $grau_esc['GRAU_ESC']; ?></option>
                        
                        <?php } ?>
                    <option value="<?= @$_POST['GRAU_ESC']?@$_POST['GRAU_ESC']:''?>" hidden selected >- <?= @$_grau_esc?'GRAU ESCOLARIDADE: '.@$_grau_esc:'GRAU ESCOLARIDADE' ?> -</option>

            </select>
                    </div>
                    <div class="col-6 col-12-xsmall">
					<select class="select-grafico" name="BAIRRO" >
                    
	            	<?php
                        $bairros =  mysqli_query($con, "SELECT * FROM bairro");
                        while(@$bairro = mysqli_fetch_array($bairros)) {
                            if(@$_POST['BAIRRO'] == $bairro['ID_BAIRRO'] ){
                                $_bairro = $bairro['BAIRRO'];
                            }
                        ?>
	            		    <option  value="<?php echo $bairro['ID_BAIRRO']; ?>" ><?php echo $bairro['BAIRRO']; ?></option>
                        
                        <?php } ?>
                    <option value="<?= @$_POST['BAIRRO']?@$_POST['BAIRRO']:''?>" hidden selected >- <?= @$_bairro?'BAIRRO: '.@$_bairro:'BAIRRO' ?> -</option>

            </select>
                    </div>
                    <div class="col-6 col-12-xsmall">
					<input type="text" name="RELIGIAO" id="demo-name" value="" placeholder="Religião" />

                    </div>
                    <div class="col-6 col-12-xsmall">
					<input type="text" name="COR" id="demo-name" value="" placeholder="Cor" />

                    </div>
                    <div class="col-6 col-12-xsmall">
					<input type="text" name="RENDA" id="demo-name" value="" placeholder="Renda" />

                    </div>
                    <div class="col-6 col-12-xsmall">
					<select name="PREFEITO" id="demo-category">
							<option value="<?= @$_POST['PREFEITO']?@$_POST['PREFEITO']:''?>" hidden>- <?= @$_POST['PREFEITO']?'PREFEITO: '.@$_POST['PREFEITO']:'PREFEITO' ?> -</option>
                        <?php
                        $prefeitos =  mysqli_query($con, "SELECT * FROM candidato WHERE ANO = 2020 AND ID_CARGO = 1");
                        while(@$prefeito = mysqli_fetch_array($prefeitos)) {
                        ?>
	            		    <option value="<?php echo $prefeito['ID_CANDIDATO']; ?>" ><?php echo $prefeito['NOME_CANDIDATO']; ?></option>
                        
                        <?php } ?>
						</select>
                    </div>
                    <div class="col-6 col-12-xsmall">
						<select name="VEREADOR" id="demo-category">
						<option value="<?= @$_POST['VEREADOR']?@$_POST['VEREADOR']:''?>" hidden>- <?= @$_POST['VEREADOR']?'VEREADOR: '.@$_POST['VEREADOR']:'VEREADOR' ?> -</option>
                        <?php
                        $vereadors =  mysqli_query($con, "SELECT * FROM candidato WHERE ANO = 2016 AND ID_CARGO = 2");
                        while(@$vereador = mysqli_fetch_array($vereadors)) {
                        ?>
	            		    <option value="<?php echo $vereador['ID_CANDIDATO']; ?>" ><?php echo $vereador['NOME_CANDIDATO']; ?></option>
                        
                        <?php } ?>
						</select>
                    </div>
                    <div class="col-6 col-12-xsmall">
					<select name="PARTIDO" id="demo-category">
						<option value="<?= @$_POST['PARTIDO']?@$_POST['PARTIDO']:''?>" hidden>- <?= @$_POST['PARTIDO']?'PARTIDO: '.@$_POST['PARTIDO']:'PARTIDO' ?> -</option>
                        <?php
                        $partidos =  mysqli_query($con, "SELECT * FROM partido WHERE ANO = 2016");
                        while(@$partido = mysqli_fetch_array($partidos)) {
                        ?>
	            		    <option value="<?php echo $partido['ID_PARTIDO']; ?>" ><?php echo $partido['NOME_PARTIDO']; ?></option>
                        
                        <?php } ?>
						</select>
                    </div>
                
					
					<div class="col-6 col-12-xsmall">
						<ul class="actions">
							<input type="submit" value="Enviar Pesquisa " class="button primary fit" />
						</ul>
					</div>
				</div>
			</form>
		</section>
    </div>
</section>