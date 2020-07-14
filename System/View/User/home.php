
<?php 

	include ('System/App/php/home.php');
	$info = gerarLista(@$_POST['ZONA'],@$_POST['ANO'],@$_POST['CARGO'],@$_POST['ORDENACAO']);

	
?>

<!-- Wrapper -->
<div id="wrapper
	<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
				<form action="#" method="POST">
        <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">

            <select class="select-grafico"name="ZONA" id="demo-category">
			<option  value="" >Todos</option>
                        <option value="<?= @$_POST['ZONA']?@$_POST['ZONA']:''?>" hidden selected>- <?= @$_POST['ZONA']?'ZONA: '.@$_POST['ZONA']:'ZONA' ?> -</option>
                        <?php
                        $zonas =  mysqli_query($con, "SELECT * FROM nome_zonas");
                        while(@$zona = mysqli_fetch_array($zonas)) {
                        ?>
	            		    <option value="<?php echo $zona['NUMERO']; ?>" ><?php echo $zona['NUMERO']; ?></option>
                        
                        <?php } ?>
            </select>
            <select class="select-grafico"name="ANO" id="demo-category">
			<option  value="" >Todos</option>
                    <option value="<?= @$_POST['ANO']?@$_POST['ANO']:''?>" hidden selected>- <?= @$_POST['ANO']?'ANO: '.@$_POST['ANO']:'ANO' ?> -</option>
                    
	            	<?php
                        $anos =  mysqli_query($con, "SELECT ANO FROM periodo_eleitoral GROUP BY ANO");
                        while(@$ano = mysqli_fetch_array($anos)) {
                        ?>
	            		    <option value="<?php echo $ano['ANO']; ?>" ><?php echo $ano['ANO']; ?></option>
                        
                        <?php } ?>
						<option value="2020" >2020</option>
						
            </select>
            
            </ul>
            <ul class="actions" style="margin-bottom: 0px; margin-left: 0px;">
            <select class="select-grafico" name="CARGO" >
				
			<option  value="" >Todos</option>
                    
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
			<select class="select-grafico" name="ORDENACAO"  >
			<option  value="" >Sem Ordenação</option>
			<option value="<?= @$_POST['ORDENACAO']?@$_POST['ORDENACAO']:''?>" hidden >- <?= @$_POST['ORDENACAO']?'ORDENAÇÃO: '.@$_POST['ORDENACAO']:'ORDENAÇÃO' ?> -</option>
			<option value="1"<?= @$_POST['ORDENACAO']== 1?'selected':''?>>BubbleSort</option>
			<option value="2"<?= @$_POST['ORDENACAO']== 2?'selected':''?>>Selection Sort</option>
			<option value="3"<?= @$_POST['ORDENACAO']== 3?'selected':''?>>Insertion Sort</option>
			<option value="4"<?= @$_POST['ORDENACAO']== 4?'selected':''?>>QuickSort</option>
			<option value="5"<?= @$_POST['ORDENACAO']== 5?'selected':''?>>MergeSort</option>
			<option value="6"<?= @$_POST['ORDENACAO']== 6?'selected':''?>>HeapSort</option>
			<option value="7"<?= @$_POST['ORDENACAO']== 7?'selected':''?>>Countingsort</option>
			<option value="8"<?= @$_POST['ORDENACAO']== 8?'selected':''?>>Radixsort</option>
			<option value="9"<?= @$_POST['ORDENACAO']== 9?'selected':''?>>Bucketsort</option>
            </select>
		</ul>
		 <?= @$info['tempo']?>
        <button type="submit" class="button " value="1" name="Botao"style="float: right;">Gerar Tabela</button>
	</form>
	<h1 class="major" style="top: 30px;"></h1>
					
				<div class="table-wrapper">
					<table class="alt">
						<thead>
							<tr>
								<th>Name</th>
								<th>Partido</th>
								<th>Ano</th>
								<th>Votos</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach($info['tab'] as $if ){
						
?>

								<tr>
								<td><?=$if['NOME_URNA'] ?></td>
								<td><?=$if['NOME_PARTIDO'] ?></td>
								<td><?=$if['ANO'] ?></td>
								<td><?=$if['VOTOS'] ?></td>
							</tr>

							<?php }
							?>
							
					
						</tbody>
					</table>
				</div>
			</div>
</sectio>
</div>





	
