<?php
include("../utils/conectadb.php");
include("../utils/validacliente.php");

// COLETANDO O SERVIÇO SELECIONADO DO CATALOGO
$id = isset($_GET['id']) ? intval($_GET['id']) : $_POST['id'];

$sql = "SELECT * FROM catalogo WHERE CAT_ID = '$id'";

$enviaquery = mysqli_query($link, $sql);
if (!$enviaquery || mysqli_num_rows($enviaquery) === 0) {
    die("Serviço não encontrado.");
}
while ($tbl = mysqli_fetch_array($enviaquery)) {
    $id            = (int)$tbl[0];
    $nomeservico   = $tbl[1];
    $descricaoservico = $tbl[2];
    $precoservico  = (float)$tbl[3];
    $temposervico  = (int)$tbl[4]; // minutos
    $ativo         = $tbl[5];
    $imagem_atual  = $tbl[6];
}

// COLETA CABELEIREIRO (exceto Admin)
$sqlfuncionario = "SELECT FUN_ID, FUN_NOME FROM funcionarios WHERE FUN_NOME != 'Administrador'";
$enviaqueryfun = mysqli_query($link, $sqlfuncionario);

// FUNÇÃO DE AGENDAMENTO
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  // VERIFICAR SE NOME DO COYÓ VEM NA VARIÁVEL
  if($nomecliente != null){

    // COLETAR OS INPUTS
    // COLETANDO ID DO SERVIÇO
    $idservico = $_POST['id'];
    // COLETANDO ID DO FUNCIONARIO
    $idfuncionario =$_POST['idfuncionario'];
    //COLETANDO DATA DO AGENDAMENTO
    $dataagenda = $_POST['data'];
    // COLETANDO HORA DO AGENDAMENTO
    $horaagenda = $_POST['horario'];

    // GRAVAR NO BANQUINHO
    $sqlagendar = "INSERT INTO agenda 
    (AG_HORA, AG_DATA, AG_STATUS, FK_CLI_ID, FK_CAT_ID, FK_FUN_ID)
    VALUES 
    ('$horaagenda', '$dataagenda', 1, $idcliente, $id, $idfuncionario)";
    mysqli_query($link, $sqlagendar);
  }
  else{
    echo"<script>window.alert('FAVOR LOGAR COYÓ');</script>";
    echo"<script>window.location.href='logincliente.php';</script>";
  }
}







?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../css/catalogo.css">
  <link rel="stylesheet" href="../css/global.css">
  <link href="https://fonts.cdnfonts.com/css/master-lemon" rel="stylesheet">
  <title>Agendamento de Serviços</title>
  <style>
    .login { max-width: 480px; }
    .login select, .login input[type="date"] { width: 100%; padding: 8px; margin: 6px 0; }
    .hint { font-size: 12px; color: #666; margin-top: 4px; white-space: pre-wrap; }
    .erro { color: #b00020; }
  </style>
</head>
<body>
<div class="global">

  <!-- IMAGEM DO SERVIÇO -->
  <div class="imagem">
    <img alt="Imagem do serviço" src="data:image/jpeg;base64,<?= $imagem_atual ?>">
  </div>

  <div class="formulario">

    <a href="catalogo.php"><img src="../icons/arrow47.png" width="50" height="50" alt="Voltar"></a>

    <!-- DETALHES DO SERVIÇO -->
    <form class="login" action="#" method="post" onsubmit="return false;">
      <input type="hidden" id="cat_id" value="<?= $id ?>">
      <input type="hidden" id="duracao" value="<?= $temposervico ?>"> <!-- minutos -->

      <label><b>NOME DO SERVIÇO</b></label>
      <label><?= htmlspecialchars($nomeservico) ?></label>
      <br>

      <label><b>DESCRIÇÃO</b></label>
      <label><?= htmlspecialchars($descricaoservico) ?></label>
      <br>

      <label><b>PREÇO</b></label>
      <label>R$ <?= number_format($precoservico, 2, ',', '.') ?></label>
      <br>

      <label><b>DURAÇÃO</b></label>
      <label>
        <?= $temposervico <= 59 ? $temposervico . " minuto(s)" : number_format($temposervico/60, 1, ',', '.') . " hora(s)" ?>
      </label>
    </form>

    <!-- FORM DE AGENDAMENTO -->
    <form class="login" id="formAgendamento" method="post" action="verservico.php">
      <input type='hidden' name='id' value='<?= $id?>'>
    ''
      <label for="idfuncionario"><b>Profissional</b></label>
      <select class="opt" name="idfuncionario" id="idfuncionario" required>
        <option value="">SELECIONE UM CABELEIREIRO</option>
        <?php while ($func = mysqli_fetch_array($enviaqueryfun)) { ?>
          <option value="<?= (int)$func[0] ?>"><?= htmlspecialchars($func[1]) ?></option>
        <?php } ?>
      </select>

      <label for="data"><b>Data</b></label>
      <input type="date" name="data" id="data" required>
      <div class="hint">Os horários passados de hoje não serão exibidos.</div>

      <label for="horario"><b>Horário disponível</b></label>
      <select class="opt" name="horario" id="horario" required>
        <option value="">Selecione um horário</option>
      </select>

      <br>
      <input type="submit" value="AGENDAR">
    </form>

    <div id="msg" class="hint"></div>

  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const funcionario = document.getElementById("idfuncionario");
  const dataInput   = document.getElementById("data");
  const horarioSel  = document.getElementById("horario");
  const duracaoMin  = parseInt(document.getElementById("duracao").value || "30", 10);
  const catId       = document.getElementById("cat_id").value;
  const msgBox      = document.getElementById("msg");

  function setMsg(text, isError=false) {
    msgBox.textContent = text || "";
    msgBox.className = "hint" + (isError ? " erro" : "");
  }

  // Carrega horários quando escolher profissional e data
  function carregarHorarios() {
    const idfunc = funcionario.value;
    const data = dataInput.value;

    horarioSel.innerHTML = "<option value=''>Carregando...</option>";
    setMsg("");

    if (!idfunc || !data) {
      horarioSel.innerHTML = "<option value=''>Selecione o cabeleireiro e a data</option>";
      return;
    }

    const body = new URLSearchParams({
      idfuncionario: idfunc,
      data: data,
      duracao: duracaoMin.toString(),
      cat_id: catId
    });

    fetch("../utils/verificaagenda.php", {
      method: "POST",
      headers: {"Content-Type": "application/x-www-form-urlencoded"},
      body
    })
    .then(async (r) => {
      const ct = r.headers.get("content-type") || "";
      const raw = await r.text(); // primeiro como texto
      // tenta parsear JSON; se falhar, mostra o HTML bruto para debug
      try {
        const json = JSON.parse(raw);
        return { ok: r.ok, json, raw };
      } catch (e) {
        throw new Error("Resposta não-JSON do servidor:\n" + raw);
      }
    })
    .then(({ json }) => {
      // Aceita formato: ARRAY ["HH:MM:SS", ...] ou OBJ {ok, horarios, error, debug}
      let lista = [];
      if (Array.isArray(json)) {
        lista = json;
      } else if (json && Array.isArray(json.horarios)) {
        if (json.error) setMsg("Aviso: " + json.error, true);
        if (json.debug) setMsg((msgBox.textContent ? msgBox.textContent + "\n" : "") + "Debug: " + json.debug, true);
        lista = json.horarios;
      } else {
        const msg = (json && (json.error || json.message)) || "Formato inesperado de resposta.";
        throw new Error(msg);
      }

      horarioSel.innerHTML = "";
      if (lista.length) {
        const first = document.createElement("option");
        first.value = "";
        first.textContent = "Selecione um horário";
        horarioSel.appendChild(first);

        lista.forEach(h => {
          const opt = document.createElement("option");
          opt.value = h;                 // "HH:MM:SS"
          opt.textContent = h.substring(0,5); // "HH:MM"
          horarioSel.appendChild(opt);
        });
      } else {
        const opt = document.createElement("option");
        opt.value = "";
        opt.textContent = "Nenhum horário disponível";
        horarioSel.appendChild(opt);
        setMsg("Não há horários livres para os filtros selecionados.");
      }
    })
    .catch(err => {
      console.error(err);
      horarioSel.innerHTML = "<option value=''>Erro ao carregar horários</option>";
      setMsg(String(err.message || err), true);
    });
  }

  funcionario.addEventListener("change", carregarHorarios);
  dataInput.addEventListener("change", carregarHorarios);

  // (Exemplo) Evita submit real
  document.getElementById("formAgendamento").addEventListener("submit", (e) => {
    if (!horarioSel.value) {
      e.preventDefault();
      setMsg("Escolha um horário antes de agendar.", true);
      return;
    }

  });
});
</script>
</body>
</html>