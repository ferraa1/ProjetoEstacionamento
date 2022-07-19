<?php
    if (isset($_GET['selectedClass'])) {
        $title = ucfirst($selectedClass);
        echo "<h1>".$title."</h1>";
        $selectedClass = $_GET['selectedClass'];
        $instance = new $selectedClass;
    }#This if goes on index.php
    
    $crud = isset($_GET['crud']) ? $_GET['crud'] : "";#index.php too

    if ($crud == "create") {

    } elseif ($crud == "update") {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";

    } else {
        $consulta = isset($_GET['consulta']) ? $_GET['consulta'] : "";
?>
        <form method="get">
            <fieldset>
                <legend>Consultar</legend>
                <input require=true type="hidden" name="selectedClass" id="selectedClass" value="<?=$selectedClass?>">
                <label for="consulta">Consulta</label>
                <br>
                <input type="text" name="consulta" id="consulta" value="<?=$consulta?>">
                <br>
                <br>
                <button class="btn btn-primary" type="submit">Consultar</button>
            </fieldset>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <?php
                        foreach(array_keys($instance->get_vars()) as $value) {
                            echo "<th scope=\"col\">".strtoupper($value)."</th>";
                        }
                    ?>
                    <th scope="col">EDITAR</th>
                    <th scope="col">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    
                ?>
            </tbody>
        </table>
<?php
    }
?>