<h3>Enviar arquivo CSV:</h3>
<form action="save" method="post" enctype="multipart/form-data">
    <input type="file" name="file_csv" id="file_csv" accept=".csv">
    <input type="submit">
</form>

<br>

<h3>Arquivos:</h3>

<?php
$query = explode('&', preg_replace('/.*\?/', '', $_SERVER['REQUEST_URI']));

// Pega os valores da query.
$getQueryValue = function($regex, $query) {
    return ($data = preg_filter($regex, '$0', $query)) != false
        ? preg_replace('/.*=/', '', end($data))
        : false;
};

$search = $getQueryValue('/search=.*/', $query);
$order = $getQueryValue('/order=.*/', $query);

if (is_dir(__DIR__ . '/../../public/storage')) {
    $storage = dir(__DIR__ . '/../../public/storage');
    $data = [];

    // Pega todos os arquivos do storage e passa para a variável '$data'.
    while (false !== ($entry = $storage->read())) {
        if ($entry === '.' || $entry === '..')
            continue;

        $dateTime = explode('_', $entry);
        $dateTime = preg_replace('/\.csv/', '', array_pop($dateTime));

        $data[$dateTime] = $entry;
    }
    
    // Ordena os arquivos.
    switch ($order) {
        case 'name':
            rsort($data);
            break;
        
        case 'new':
            krsort($data);
            break;

        case 'old':
            ksort($data);
            break;
    }
?>
    <form id="dateTimeAndOrder" action="/" method="get">
        <input type="text" name="search">

        <div>
            <label>Ordenar por:
                <select name="order">
                    <option value="name" <?= $order === 'name' ? 'selected' : '' ?>>Nome</option>
                    <option value="new" <?= $order === 'new' ? 'selected' : '' ?>>Mais recente</option>
                    <option value="old" <?= $order === 'old' ? 'selected' : '' ?>>Mais antigo</option>
                </select>
            </label>
        </div>

        <input type="submit" value="Pesquisar">
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nome (download)</th>
                <th>Data e hora (Y-m-d-H-i-s)</th>
                <th>Link para ver o arquivo</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data as $dateTime => $entry) {
                $filename = explode('_', $entry);
                array_pop($filename);
                $filename = implode('_', $filename);

                if ($search !== false && $search != '')
                    if (strpos(strtolower($filename), $search) === false)
                        continue;
                //

                echo "
                <tr>
                    <td>
                        <a href='/storage/$entry' download='$filename.csv'>$filename</a>
                    </td>

                    <td>
                        <p>$dateTime</p>
                    </td>

                    <td>
                        <a href='/table/$entry'>Visualizar</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
<?php
}
?>