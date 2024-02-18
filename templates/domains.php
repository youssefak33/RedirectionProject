<?php $title="Mes redirections"  ?> 
<?php ob_start(); ?>
    <main>
    <div class="container">
        <div class="left-column">
            <h2>Noms de Domaines</h2>
            <ul>
                <li><?= $_SERVER['HTTP_HOST']; ?></li>
                <!-- Ajoutez d'autres domaines au besoin -->
            </ul>
        </div>

        <div class="right-column" id="content1">
            <h2>URLs et Redirections</h2>
            <table>
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Redirection</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($redirectionResults as $result) {
                    ?>
                    <tr>
                        <td><a href="<?=$result['originalLink']?>" class="url-link"><?=$result['originalLink']?></a></td>
                        <td><a href="<?=$result['urlPath']?>" class="redirection-link"><?=$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/".$result['urlPath']?></a></td>
                    </tr>
                    <?php 
                    }
                    ?>
                    <!-- Ajoutez d'autres lignes au besoin -->
                </tbody>
            </table>
        </div>
    </div>
    </main>
<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php'); ?>
