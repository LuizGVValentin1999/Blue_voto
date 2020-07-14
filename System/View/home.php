
     <?php
include ('System/App/php/graficos/graficos.php');

 $grafico1 = grafico(@$_POST['ZONA'],@$_POST['ANO'],@$_POST['CARGO'],@$_POST['MAX_COLUNA']);
 
 

$n=0;
 foreach($grafico1 as $gr){
     $nomeG1[$n] = $gr['NOME_URNA'];
     $votosG1[$n++] = $gr['VOTOS'];
     
     
 }

    $G1nome = json_encode($nomeG1);
    $G1voto = json_encode($votosG1);
    

 ?>
 <div style="display: none;" class="grafico11"><?php echo $G1nome?></div>
  <div style="display: none;" class="grafico1"><?php echo $G1voto?></div>
   <!-- Intro -->
        <section id="intro" class="wrapper style1 fullscreen fade-up">
            <div class="inner">
                <h1>Blue Voto</h1>
                <p>Bem vindo ao projeto <br /> Sistema para Analise de ELeições <a href="User/home">Acessar sem login</a>.</p>
                <ul class="actions">
                    <li><a href="System/View/login/login.php" class="button scrolly">Login</a></li>
                </ul>
            </div>
        </section>

        <!-- One -->
        <section id="one" class="wrapper style2 spotlights">
            <section>
                <div>
                
                <canvas id="myChart" style="display: block; width: 500px; height: 600px;"></canvas>
                </div>
                <div class="content">
                    <div class="inner">
                        <h2>Numeros dos principais candidatos</h2>
                        <p>Esse grafico indica os principais candidados do ano de 2016 e seus numeros de votos</p>
                        <ul class="actions">
                            <li><a href="User/graficos" class="button">Ver outro ano </a></li>
                        </ul>
                    </div>
                </div>
            </section>       
        </section>       
        <!-- Three -->
        <section id="three" class="wrapper style1 fade-up">
            <div class="inner">
                <h2>Deixe seu comentario</h2>
                <div class="split style1">
                    <section>
                        <form method="post" action="#">
                            <div class="fields">
                                <div class="field half">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" />
                                </div>
                                <div class="field half">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" />
                                </div>
                                <div class="field">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" rows="5"></textarea>
                                </div>
                            </div>
                            <ul class="actions">
                                <li><a href="" class="button submit">Send Message</a></li>
                            </ul>
                        </form>
                    </section>
                    <section>
                        <ul class="contact">
                            <li>
                                <h3>Address</h3>
                                <span>12345 Somewhere Road #654<br />
											Nashville, TN 00000-0000<br />
											USA</span>
                            </li>
                            <li>
                                <h3>Email</h3>
                                <a href="#">user@untitled.tld</a>
                            </li>
                            <li>
                                <h3>Phone</h3>
                                <span>(000) 000-0000</span>
                            </li>
                            <li>
                                <h3>Social</h3>
                                <ul class="icons">
                                    <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                                    <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                                    <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
                                    <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                                    <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </section>