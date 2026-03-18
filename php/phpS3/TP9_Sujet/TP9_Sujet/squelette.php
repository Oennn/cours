<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>TP9 PDO</title>
  <link rel="stylesheet" href="form.css" type="text/css" />
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    nav a { margin-right: 15px; }
    table { margin-top: 15px; border-collapse: collapse; }
    th, td { padding: 6px 10px; }
    .menu a { display: block; margin-bottom: 8px; }
  </style>
</head>
<body>
  <h1>TP 9 — PHP / MySQL avec PDO</h1>
  <hr />

  <?php
    $modeCourant   = $_GET['mode'] ?? $_POST['mode'] ?? 'np';
    $qCourante     = $_GET['q'] ?? '';
    $actionCourante = $_GET['action'] ?? 'afficher';

    $checkedNP = ($modeCourant === 'np') ? 'checked' : '';
    $checkedP  = ($modeCourant === 'p')  ? 'checked' : '';
  ?>

  <table width="100%">
    <tr>
      <td width="75%" valign="top">
        <?php echo $zonePrincipale; ?>
      </td>

      <td width="25%" valign="top" style="background-color:silver; padding:10px;">
        <div class="menu">
          <strong>Navigation</strong><br><br>

          <a href="index.php?action=saisir&mode=<?php echo h($modeCourant); ?>">
            Nouvelle saisie
          </a>

          <a href="index.php?action=afficher&mode=<?php echo h($modeCourant); ?>">
            Voir la liste
          </a>

          <hr>

          <?php echo formRecherche($modeCourant, $qCourante); ?>

          <hr>

          <form action="index.php" method="get" style="margin-bottom:15px;">
            <input type="hidden" name="action" value="<?php echo h($actionCourante); ?>">

            <?php if ($qCourante !== ''): ?>
              <input type="hidden" name="q" value="<?php echo h($qCourante); ?>">
            <?php endif; ?>

            <strong>Mode :</strong><br>

            <label>
              <input type="radio" name="mode" value="np"
                     <?php echo $checkedNP; ?>
                     onchange="this.form.submit()">
              Non préparé
            </label>

            <br>

            <label>
              <input type="radio" name="mode" value="p"
                     <?php echo $checkedP; ?>
                     onchange="this.form.submit()">
              Préparé
            </label>
          </form>

        </div>
      </td>
    </tr>
  </table>

  <hr />
</body>
</html>
