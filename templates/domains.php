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
                    <tr>
                        <td><a href="#" class="url-link">URL 1</a></td>
                        <td><a href="#" class="redirection-link">Redirection 1</a></td>
                    </tr>
                    <tr>
                        <td><a href="#" class="url-link">URL 2</a></td>
                        <td><a href="#" class="redirection-link">Redirection 2</a></td>
                    </tr>
                    <!-- Ajoutez d'autres lignes au besoin -->
                </tbody>
            </table>
        </div>
    </div>
    </main>
<?php $content = ob_get_clean(); ?>
<?php require('templates/layout.php'); ?>
