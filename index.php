<?php

function normalizeDomain($s)
{
    $s = trim($s);
    if ($s === "") return "";
    $s = preg_replace('#^https?://#i', '', $s);
    $s = explode('/', $s)[0];
    $s = trim($s);
    if ($s === "") return "";
    if ($s[0] !== '.') $s = '.' . $s;
    return strtolower($s);
}

$jsonPath = __DIR__ . "/data/sites.json";

if (!file_exists($jsonPath)) {
    die("sites.json not found.");
}

$json = file_get_contents($jsonPath);
$sites = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON Error: " . json_last_error_msg());
}

if (!is_array($sites)) {
    die("Invalid JSON structure.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selected = $_POST["domains"] ?? [];
    $set = [];

    foreach ($selected as $d) {
        $n = normalizeDomain($d);
        if ($n !== "") $set[$n] = true;
    }

    $final = array_keys($set);
    sort($final);

    $content = implode("\n", $final) . (count($final) ? "\n" : "");

    header("Content-Type: text/plain; charset=utf-8");
    header("Content-Disposition: attachment; filename=bloqueados.txt");
    echo $content;
    exit;
}

include 'components/header.php';
?>

<div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Gerar bloqueados.txt</h4>
    </div>

    <div class="card-body">
        <form method="post">

            <?php foreach ($sites as $categoria => $lista):
                $sectionId = "sec_" . md5($categoria);

                if (!is_array($lista)) continue;
            ?>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h5 class="mb-0"><?= htmlspecialchars($categoria) ?></h5>

                    <div class="d-flex gap-2">
                        <button type="button"
                            class="btn btn-sm btn-outline-success"
                            onclick="toggleSection('<?= $sectionId ?>', true)">
                            Marcar todos
                        </button>

                        <button type="button"
                            class="btn btn-sm btn-outline-danger"
                            onclick="toggleSection('<?= $sectionId ?>', false)">
                            Desmarcar
                        </button>
                    </div>
                </div>

                <div class="row mt-2" id="<?= $sectionId ?>">
                    <?php foreach ($lista as $nome => $dominio):
  
                        $id = "d_" . md5($categoria . '|' . $nome . '|' . $dominio);
                    ?>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3 h-100 shadow-sm site-card">
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="domains[]"
                                        value="<?= htmlspecialchars($dominio) ?>"
                                        id="<?= $id ?>">
                                    <label class="form-check-label fw-semibold" for="<?= $id ?>">
                                        <?= htmlspecialchars($nome) ?>
                                    </label>
                                </div>
                                <div class="text-muted small mt-1"><?= htmlspecialchars($dominio) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endforeach; ?>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-success">Gerar arquivo</button>
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </div>

        </form>
    </div>
</div>

<?php include 'components/footer.php'; ?>