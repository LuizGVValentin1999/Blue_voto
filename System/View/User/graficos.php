<?php
include ('System/App/php/graficos/graficos.php');

 $grafico1 = grafico(@$_POST['ZONA'],@$_POST['ANO'],@$_POST['CARGO'],@$_POST['MAX_COLUNA']);
 $grafico2 = grafico2(@$_POST['FILTRO'],@$_POST['ANOP']);
 $grafico3 = grafico3(@$_POST['FILTROL'],@$_POST['OPC'],@$_POST['PESQUISA']);
 $grafico4 = grafico4(@$_POST['PESQUISAA']);

 

$n=0;
 foreach($grafico1 as $gr){
     $nomeG1[$n] = $gr['NOME_URNA'];
     $votosG1[$n++] = $gr['VOTOS'];
     
     
 }

    $G1nome = json_encode($nomeG1);
    $G1voto = json_encode($votosG1);
    $m=0;
    foreach($grafico2 as $gr){
        $nomeG2[$m] = $gr['FILTRO'];
        $votosG2[$m++] = $gr['ELEITORES'];
        
        
    }
   
       $G2nome = json_encode($nomeG2);
       $G2voto = json_encode($votosG2);

       if($grafico3){
        $q=0;
        foreach($grafico3 as $gr){
            $nomeG3[$q] = $gr['NOME'];
            $votosG3[$q++] = $gr['VOTOS'];
            
            
        }
       
           $G3nome = json_encode($nomeG3);
           $G3voto = json_encode($votosG3);  
       }
        if($grafico4){
            $w=0;
            foreach($grafico4 as $gr){
                $nomeG4[$w] = $gr['NOME_URNA'];
                $votosG4[$w++] = $gr['VOTOS'];
                
                
            }
           
               $G4nome = json_encode($nomeG4);
               $G4voto = json_encode($votosG4); 

               $tabela  = tabela();
        }
  


    
   
 ?>


<div class="row">
    <div class="col-5 col-12-medium">
        <div style="display: block; width: 500px; height: 600px;" >
            <div style="display: none;" class="grafico11"><?php echo $G1nome?></div>
            <div style="display: none;" class="grafico1"><?php echo $G1voto?></div>
            <canvas id="myChart" style="display: block; width: 500px; height: 600px;"></canvas>
        </div>
    </div>
    <div class="col-7 col-12-medium">
    <h2>Escolha sua preferencia do grafico (Resultado) </h2>
    <form action="#" method="POST">
        <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">

            <select class="select-grafico"name="ZONA" id="demo-category">
                        <option value="<?= @$_POST['ZONA']?@$_POST['ZONA']:''?>" hidden>- <?= @$_POST['ZONA']?'ZONA: '.@$_POST['ZONA']:'ZONA' ?> -</option>
                        <?php
                        $zonas =  mysqli_query($con, "SELECT * FROM nome_zonas");
                        while(@$zona = mysqli_fetch_array($zonas)) {
                        ?>
	            		    <option value="<?php echo $zona['NUMERO']; ?>" ><?php echo $zona['NUMERO']; ?></option>
                        
                        <?php } ?>
            </select>
            <select class="select-grafico"name="ANO" id="demo-category">
                    <option value="<?= @$_POST['ANO']?@$_POST['ANO']:''?>" hidden>- <?= @$_POST['ANO']?'ANO: '.@$_POST['ANO']:'ANO' ?> -</option>
                    
	            	<?php
                        $anos =  mysqli_query($con, "SELECT * FROM periodo;");
                        while(@$ano = mysqli_fetch_array($anos)) {
                        ?>
	            		    <option value="<?php echo $ano['ANO']; ?>" ><?php echo $ano['ANO']; ?></option>
                        
                        <?php } ?>
            </select>
            
            </ul>
            <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">
            <select class="select-grafico" name="CARGO" style="width: 96%;" >
                    
	            	<?php
                        $cargos =  mysqli_query($con, "SELECT * FROM cargo");
                        while(@$cargo = mysqli_fetch_array($cargos)) {
                            if(@$_POST['CARGO'] == $cargo['COD_CARGO'] ){
                                $_cargo = $cargo['CARGO'];
                            }
                        ?>
	            		    <option  value="<?php echo $cargo['COD_CARGO']; ?>" ><?php echo $cargo['CARGO']; ?></option>
                        
                        <?php } ?>
                    <option value="<?= @$_POST['CARGO']?@$_POST['CARGO']:''?>" hidden selected >- <?= @$_cargo?'CARGO: '.@$_cargo:'CARGO' ?> -</option>

            </select>
            <input class="select-grafico" type="text" name="MAX_COLUNA"  value="<?=@$_POST['MAX_COLUNA']?>" placeholder="Max de Colunas" />
       
        </ul>
        <button type="submit" value="1"  name="button"class="button">Gerar Grafico</button>
    
    
    </div>
</div>       
</br>
<h1>Pesquisa %</h1>
<div class="row">
    <div class="col-5 col-12-medium">
        <div style="display: block; width: 500px; height: 600px;" >
            <div style="display: none;" class="grafico22"><?php echo $G2nome?></div>
            <div style="display: none;" class="grafico2"><?php echo $G2voto?></div>
            <canvas id="myChart2" style="display: block; width: 500px; height: 600px;"></canvas>
        </div>
    </div>
    <div class="col-7 col-12-medium">
    <h2>Escolha sua preferencia do grafico (Pesquisa) </h2>
    
        <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">
            <select class="select-grafico" name="FILTRO" >
                
                    <option value="1" <?= @$_POST['FILTRO']==1?'hidden selected':''?> >- GRAU ESCOLARIDADE -</option>
                    <option value="2" <?= @$_POST['FILTRO']==2?'hidden selected':''?> >- FAIXA ETÁRIA -</option>
                    <option value="3" <?= @$_POST['FILTRO']==3?'hidden selected':''?> >- SEXO -</option>
                    <option value="4" <?= @$_POST['FILTRO']==4?'hidden selected':''?> >- ESTADO CIVIL  -</option>

            </select>
            <select class="select-grafico"name="ANOP" id="demo-category">
                    <option value="<?= @$_POST['ANOP']?@$_POST['ANOP']:''?>" hidden>- <?= @$_POST['ANOP']?'ANO: '.@$_POST['ANOP']:'ANO' ?> -</option>
                    
	            	<?php
                        $anos =  mysqli_query($con, "SELECT * FROM periodo;");
                        while(@$ano = mysqli_fetch_array($anos)) {
                        ?>
	            		    <option value="<?php echo $ano['ANO']; ?>" ><?php echo $ano['ANO']; ?></option>
                        
                        <?php } ?>
            </select>
        </ul>
        <button type="submit" value="2" name="button" class="button">Gerar Grafico</button>
    
    
    </div>
</div>         
 </br>


<h1>Simulação %</h1>
<div class="row">
    <div class="col-5 col-12-medium">
        <div style="display: block; width: 500px; height: 600px;" >
            <div style="display: none;" class="grafico33"><?php echo $G3nome?></div>
            <div style="display: none;" class="grafico3"><?php echo $G3voto?></div>
            <canvas id="myChart3" style="display: block; width: 500px; height: 600px;"></canvas>
        </div>
    </div>
    <div class="col-7 col-12-medium">
    <h2>Escolha sua preferencia do grafico (Simulação) </h2>
    
        <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">
            <select class="select-grafico" name="FILTROL" >
                
                    <option value="1" <?= @$_POST['FILTROL']==1?'hidden selected':''?> >- GRAU ESCOLARIDADE -</option>
                    <option value="2" <?= @$_POST['FILTROL']==2?'hidden selected':''?> >- FAIXA ETÁRIA -</option>
                    <option value="3" <?= @$_POST['FILTROL']==3?'hidden selected':''?> >- SEXO -</option>
                    <option value="4" <?= @$_POST['FILTROL']==4?'hidden selected':''?> >- ZONA  -</option>
                   

            </select>
            <select class="select-grafico" name="OPC" >
            <optgroup label="PREFEITO" style="color: black;">
            <?php
                        $prefeitos =  mysqli_query($con, "SELECT C.NOME_CANDIDATO as NOME_URNA, C.ID_CANDIDATO , PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                                            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_PREFEITO 
                                            JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                                            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
                                             GROUP BY C.ID_CANDIDATO;");
                        while(@$prefeito = mysqli_fetch_array($prefeitos)) {
                        ?>
	            		    <option value="<?php echo 'P;'.$prefeito['ID_CANDIDATO']; ?>" <?= @$_POST['OPC']=='P;'.$prefeito['ID_CANDIDATO']?'hidden selected':''?>> P -- <?php echo $prefeito['NOME_URNA']; ?></option>
                        
                        <?php } ?>
                    </optgroup>
                    <optgroup label="VEREADOR" style="color: black;">
                    <?php
                        $vereadors =  mysqli_query($con, "SELECT C.NOME_CANDIDATO as NOME_URNA, C.ID_CANDIDATO , PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                                            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR 
                                            JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                                            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
                                             GROUP BY C.ID_CANDIDATO;");
                        while(@$vereador = mysqli_fetch_array($vereadors)) {
                        ?>
	            		    <option value="<?php echo 'V;'.$vereador['ID_CANDIDATO']; ?>" <?= @$_POST['OPC']=='V;'.$vereador['ID_CANDIDATO']?'hidden selected':''?> > V -- <?php echo $vereador['NOME_URNA']; ?></option>
                        
                        <?php } ?>
                    </optgroup>
                    <optgroup label="PARTIDO" style="color: black;">
                    <?php
                        $paeridos =  mysqli_query($con, "SELECT PA.ID_PARTIDO, C.ID_CANDIDATO , PA.NOME_PARTIDO, SUM(S.VOTO) AS VOTOS, '2020' as ANO FROM simulacao S
                                            JOIN candidato AS C ON C.ID_CANDIDATO = S.ID_VEREADOR 
                                            JOIN zona AS Z ON Z.ID_ZONA = S.ID_ZONA
                                            JOIN partido AS PA ON PA.ID_PARTIDO = C.ID_PARTIDO  
                                             GROUP BY C.ID_CANDIDATO;");
                        while(@$paerido = mysqli_fetch_array($paeridos)) {
                        ?>
	            		    <option value="<?php echo 'PA;'.$paerido['ID_PARTIDO']; ?>" <?= @$_POST['OPC']=='PA;'.$paerido['ID_PARTIDO']?'hidden selected':''?> > PA -- <?php echo $paerido['NOME_PARTIDO']; ?></option>
                        
                        <?php } ?>
                    </optgroup>
            </select>
            
        </ul>
        <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">
            <select class="select-grafico" name="PESQUISA" >
                
                    <option value="1" <?= @$_POST['PESQUISA']==1?'hidden selected':''?> >- PRIMEIRA PESQUISA -</option>
                    <option value="2" <?= @$_POST['PESQUISA']==2?'hidden selected':''?> >- SEGUNDA PESQUISA-</option>
                    <option value="3" <?= @$_POST['PESQUISA']==3?'hidden selected':''?> >- ACUMULAR-</option>
                    
            
            </select>
           
            
        </ul>
        <button type="submit" value="2" name="button" class="button">Gerar Grafico</button>
   
    
    </div>
</div>  



<div class="row">
    <div class="col-5 col-12-medium">
        <div style="display: block; width: 500px; height: 600px;" >
            <div style="display: none;" class="grafico44"><?php echo $G4nome?></div>
            <div style="display: none;" class="grafico4"><?php echo $G4voto?></div>
            <canvas id="myChart4" style="display: block; width: 500px; height: 600px;"></canvas>
        </div>
    </div>
    <div class="col-7 col-12-medium">
    <h2>Escolha sua preferencia do grafico (Simulação) 2 </h2>
    
        <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">
            <select class="select-grafico" name="PESQUISAA" >
                
                    <option value="1" <?= @$_POST['PESQUISAA']==1?'hidden selected':''?> >- PRIMEIRA PESQUISA -</option>
                    <option value="2" <?= @$_POST['PESQUISAA']==2?'hidden selected':''?> >- SEGUNDA PESQUISA-</option>
                    <option value="3" <?= @$_POST['PESQUISAA']==3?'hidden selected':''?> >- ACUMULAR-</option>
                    
            
            </select>
           
            
        </ul>
        <button type="submit" value="2" name="button" class="button">Gerar Grafico</button>
    </form>
                        </div>
    
<div class="row">
<div class="col-12 col-12-medium">
    <div class="table-wrapper">
					<table class="alt">
                        <?php if($grafico4){ ?>
						<thead>
							<tr>
								<th>Nome</th>
								<th>Media</th>
								<th>S</th>
								<th>Media + 1</th>
								<th>Media - 1</th>
								<th>CV</th>
							</tr>
						</thead>
						<tbody>
                            <?php 
                            

                            
							foreach(@$tabela as $if ){
						
?>

								<tr>
								<td><?=@$if['NOME_URNA'] ?></td>
								<td><?=@$if['MEDIA'] ?></td>
								<td><?=@$if['S'] ?></td>
								<td><?=@$if['MEDIAS1'] ?></td>
								<td><?=@$if['MEDIAM1'] ?></td>
								<td><?=@$if['COEF'] ?></td>
							</tr>

							<?php } }
							?>
							
					
						</tbody>
					</table>
				</div>
    </div>
</div>  
</div>  
</div>  



