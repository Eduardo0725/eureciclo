<?php
$uri = $_SERVER['REQUEST_URI'];
$filename = preg_replace('/\/table\//', '', $uri);

$file = fopen(__DIR__ . "/../../public/storage/$filename", 'r');

if (!$file)
    header('Location:/');
?>

<a href="/">Página inicial</a>

<h3>Tabela:</h3>

<form id="formTable" method="post" enctype="multipart/form-data">
    <table class="table">
        <?php
        $row = 0;
        while (($data = fgetcsv($file)) !== false) {
            $strRow = implode(',', $data);

            if ($row === 0) {
        ?>
                <thead>
                    <tr>
                        <?php
                        echo "<th class='col'>#</th>";

                        foreach ($data as $value)
                            echo "<th class='col'>$value</th>";
                        ?>
                    </tr>
                </thead>
            <?php
            } else {
                if ($row === 1)
                    echo "<tbody>";
            ?>
                <tr>
                    <?php
                    echo "
                <th>
                    <input type='checkbox' name='selectedLines[]' value='$strRow'>
                    $row
                </th>";

                    foreach ($data as $value)
                        echo "<td>$value</td>";
                    ?>
                </tr>
        <?php
            }

            $row++;
        }

        echo "</tbody>";
        ?>
    </table>
</form>

<button type="button" class="send">Enviar dados selecionados por email</button>
<button type="button" class="download">Baixar dados selecionados</button>

<script>
    var form = document.getElementById('formTable');

    document.querySelector('button.send').addEventListener('click', () => {
        if(!document.querySelector("input[name='selectedLines[]']:checked"))
            return alert('selecione alguma linha.');
        //
        
        alert('Funcionalidade não pronta.');
    });

    document.querySelector('button.download').addEventListener('click', () => {
        if(!document.querySelector("input[name='selectedLines[]']:checked"))
            return alert('selecione alguma linha.');
        //
        form.action = location.origin + (location.port ? location.port : '') + '/download';
        form.submit();
    });
</script>